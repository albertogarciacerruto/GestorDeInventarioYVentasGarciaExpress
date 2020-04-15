<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Quotation;
use App\User;
use App\Inventory;
use App\Product;
use App\Order;
use App\Iva;
use App\Dolar;
use App\Payment;
use App\Http\Requests\PayRequest;
use \Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function list_orders()
    {
        $list_orders = \DB::table('orders')-> where('status', '!=', 'Devuelto')->orderBy('date_init', 'desc')->get();
        return view('order/orders', compact('list_orders'));
    }

    public function list_orders_devolution()
    {
        $list_orders = \DB::table('orders')-> where('status', '=', 'Devuelto')->get();
        return view('order/orders_devolution', compact('list_orders'));
    }

    public function register($id_quotation)
    {
        $id_quotation = decrypt($id_quotation);
        $list_payments = Payment::select('id', 'name')->get();
        return view('order/register_order', compact('list_payments', 'id_quotation'));
    }

    public function register_order($id_quotation)
    {
        $who = \Auth::id();
        $date = \Carbon\Carbon::now();
        $date->toDateTimeString();
        $date = strtotime ($date) ;
        $date_var = date ( 'l' , $date );
        $date = date ( 'Y-m-d' , $date );
        if($date_var == 'Saturday'){ //Verificamos si la fecha de inicio es fin de semana
        $date = strtotime ( '+2 day' , strtotime ( $date ) ) ;
        $date = date ( 'Y-m-d' , $date );
        }elseif($date_var == 'Sunday'){
        $date = strtotime ( '+1 day' , strtotime ( $date ) ) ;
        $date = date ( 'Y-m-d' , $date );
        }
        $date_init = $date;

        $quotation = Quotation::where('id', '=', decrypt($id_quotation))->first();
        $num_product = $quotation->quantity;
        $iva = $quotation->iva;
        $total = $quotation->total;
        $client = $quotation->client_id;
        $cotizacion = decrypt($id_quotation);
        $valor_iva = $quotation->iva_id;

        $order = Order::orderBy('id', 'desc')->first();
        if (is_null($order)) {
        $nuevo = Order::create([
            'date_init' => $date_init,
            'client_id' => $client,
            'num_product' => $num_product,
            'iva' => $iva,
            'total' => $total,
            'dolar_value' => $quotation->dolar_value,
            'quotation_id' => $cotizacion,
            'iva_id' => $valor_iva,
            'user' => $who,
        ]);
        $date = \Carbon\Carbon::now();
        $date->toDateTimeString();
        $date = strtotime ($date) ;
        $date = date ( 'Y-m-d' , $date );
        }
        elseif($date_init == $order->date_init && $client == $order->client_id && decrypt($id_quotation) == $order->quotation_id){
        return $this->list_orders();
        }
        else {
        $nuevo = Order::create([
            'date_init' => $date_init,
            'client_id' => $client,
            'num_product' => $num_product,
            'iva' => $iva,
            'total' => $total,
            'dolar_value' => $quotation->dolar_value,
            'quotation_id' => $cotizacion,
            'iva_id' => $valor_iva,
            'user' => $who,
        ]);
        }
        $update_quotation = \DB::table('quotations')->where('id', decrypt($id_quotation))->update(['status' => 'Confirmado', 'user' => $who]);
        return $this->list_orders();
    }

    public function payments($order_id){
        $id = decrypt($order_id);
        $order = decrypt($order_id);
        $orden = \DB::table('orders')->where('id', '=', $order)->first();
        $list_payments = \DB::table('order_payment')->where('order_id', '=', $id)->get();

        $pedido = \DB::table('order_payment')->where('order_id', '=', $order)->get();
        $cont = count($pedido);
        $pagado = 0.0;
        for ($i = 0; $i < $cont; $i++) {
        $pagado = $pagado + $pedido[$i]->amount;
        }
        if($pagado < $orden->total){
        $msj = 'no pagado';
        $diferencia = $orden->total - $pagado;
        }
        elseif($pagado >= $orden->total){
        $msj= 'pagado';
        $diferencia = 0.0;
        }
        return view('order/payments', compact('list_payments', 'order', 'msj', 'diferencia', 'pagado', 'orden'));
    }

    public function pay_insert($order_id){
        $id_order = decrypt($order_id);
        $list_payments = Payment::select('id', 'name')->get();
        return view('order/register_pay', compact('id_order', 'list_payments'));
    }

    public function payment_insert(PayRequest $request){
        $who = \Auth::id();
        $id = $request->id_order;
        $payment = $request->payment_id;
        $date = \Carbon\Carbon::now();
        $date->toDateTimeString();
        $date = strtotime ($date) ;
        $date = date ( 'Y-m-d' , $date );
        $bank = $request->bank;
        $confirmation = $request->confirmation;
        $suggestion = $request->suggestion;
        $amount = $request->amount;
        $moneda = $request->isDolar;
        $order = Order::where('id', '=', $id)->first();
        if($moneda == null){
            $amount = $amount/$order->dolar_value;
        }
        //Para validar Monto
        $orden = \DB::table('orders')->where('id', '=', $id)->first();
        $pedido = \DB::table('order_payment')->where('order_id', '=', $id)->get();
        $cont = count($pedido);
        $pagado = 0.0;
        for ($i = 0; $i < $cont; $i++) {
        $pagado = $pagado + $pedido[$i]->amount;
        }
        $diferencia = $orden->total - $pagado;
        if($amount > $diferencia){
        $id_order = $order->id;
        $list_payments = Payment::select('id', 'name')->get();
        $mensaje = 'El monto es mayor al total establecido';
        return view('pedido/register_pay', compact('id_order', 'list_payments', 'mensaje'));
        }
        //Validacion del monto en formulario

        $consul = \DB::table('order_payment')->orderBy('id', 'desc')->first();
        if($consul == null){
        if ($request->hasFile('image'))
        {
            $foto_comp = $request->file('image')->store('public');
            $query = Order::find($order->id);
            $query->payments()->attach($payment, array('date' =>$date, 'amount' => $amount, 'confirmation' => $confirmation, 'bank' => $bank, 'suggestion' => $suggestion, 'image' => $foto_comp, 'user' => $who));
        }
        else {
            $query = Order::find($order->id);
            $query->payments()->attach($payment, array('date' =>$date, 'amount' => $amount, 'confirmation' => $confirmation, 'bank' => $bank, 'suggestion' => $suggestion, 'user' => $who));
        }
        }
        elseif($consul->payment_id != $payment || $consul->amount != $amount || $consul->confirmation != $confirmation){
        if ($request->hasFile('image'))
        {
            $foto_comp = $request->file('image')->store('public');
            $query = Order::find($order->id);
            $query->payments()->attach($payment, array('date' =>$date, 'amount' => $amount, 'confirmation' => $confirmation, 'bank' => $bank, 'suggestion' => $suggestion, 'image' => $foto_comp, 'user' => $who));
        }
        else {
            $query = Order::find($order->id);
            $query->payments()->attach($payment, array('date' =>$date, 'amount' => $amount, 'confirmation' => $confirmation, 'bank' => $bank, 'suggestion' => $suggestion, 'user' => $who));
        }
        }
        $order = $request->id_order;
        $list_payments = \DB::table('order_payment')->where('order_id', '=', $id)->get();

        $orden = \DB::table('orders')->where('id', '=', $order)->first();
        $pedido = \DB::table('order_payment')->where('order_id', '=', $order)->get();
        $cont = count($pedido);
        $pagado = 0.0;
        for ($i = 0; $i < $cont; $i++) {
        $pagado = $pagado + $pedido[$i]->amount;
        }
        if($pagado < $orden->total){
        $msj = 'no pagado';
        $diferencia = $orden->total - $pagado;
        }
        elseif($pagado >= $orden->total){
        $msj= 'pagado';
        $diferencia = 0.0;
        }
        return redirect()->action('OrderController@payments', ['id' => encrypt($orden->id)]);
    }

    public function payment_delete($payment_id){
        try {
        $var_order = \DB::table('order_payment')->where('id', '=', decrypt($payment_id))->first();
        $payment = \DB::table('order_payment')->where('id', '=', decrypt($payment_id))->delete();
        $id = decrypt($payment_id);
        $order = $var_order->order_id;
        $list_payments = \DB::table('order_payment')->where('order_id', '=', $var_order->order_id)->get();

        $orden = \DB::table('orders')->where('id', '=', $var_order->order_id)->first();
        $pedido = \DB::table('order_payment')->where('order_id', '=', $orden->id)->get();
        $cont = count($pedido);
        $pagado = 0.0;
        for ($i = 0; $i < $cont; $i++) {
        $pagado = $pagado + $pedido[$i]->amount;
        }
        if($pagado < $orden->total){
        $msj = 'no pagado';
        $diferencia = $orden->total - $pagado;
        }
        elseif($pagado >= $orden->total){
        $msj= 'pagado';
        $diferencia = 0.0;
        }

        return redirect()->action('OrderController@payments', ['id' => encrypt($orden->id)]);
        }
        catch(\Illuminate\Database\QueryException $ex) {
        return view('errors/payment');
        }
    }

    public function payment_verify($payment_id){
        $pay = \DB::table('order_payment')->where('id', '=', decrypt($payment_id))->first();
        return view('order/verify', compact('pay'));
    }

    public function edit($id_order)
    {
        //$orden = decrypt($id_order);
        //return redirect()->action('OrderController@payments', ['id' => encrypt($orden)]);
        $order = \DB::table('orders')->where('id', '=', decrypt($id_order))->first();
        $quotation = \DB::table('quotations')->where('id', '=', $order->quotation_id)->first();
        $client = \DB::table('clients')->where('id', '=', $order->client_id)->first();
        $list_quotations = \DB::table('inventory_quotation')->where('quotation_id', '=', $quotation->id)->get();
        $list_services = \DB::table('services')->get();
        $listServicios = \DB::table('quotation_service')->where('quotation_id', '=', $quotation->id)->get();

        return view('order/view', compact('order', 'quotation', 'client', 'list_quotations', 'list_services', 'listServicios' ));
    }

    public function downloadFile($file_id){
        $image = decrypt($file_id);
        return view('order/view_confirmation', compact('image'));
    }



    public function edit_order(Request $request)
    {
        $who = \Auth::id();
        $date_final = $request->date_final;
        $id = $request->id;
        $update_order = \DB::table('orders')->where('id', $id)->update(['date_final' => $date_final, 'user' => $who]);
        if(is_null($date_final) == false ){
        $update_pedido = \DB::table('orders')->where('id', $id)->update(['status' => 'Completado', 'user' => $who]);
        }
        $order = \DB::table('orders')->where('id', '=', $id)->first();
        $quotation = \DB::table('quotations')->where('id', '=', $order->quotation_id)->first();
        $client = \DB::table('clients')->where('id', '=', $order->client_id)->first();
        $list_quotations = \DB::table('inventory_quotation')->where('quotation_id', '=', $quotation->id)->get();
        $list_services = \DB::table('services')->get();
        $listServicios = \DB::table('quotation_service')->where('quotation_id', '=', $quotation->id)->get();

        return redirect()->action('OrderController@edit',['id_order' => encrypt($order->id)]);
    }

    public function devolution($id_order){
        $who = \Auth::id();
        $order = Order::where('id', '=', decrypt($id_order))->first();
        $quotation = Quotation::where('id', '=', $order->quotation_id)->first();

        $consul = \DB::table('inventory_quotation')->where('quotation_id', $quotation->id)->get();
        $cont = count($consul);
        $total_products = $quotation->quantity;
        $value_iva = \DB::table('ivas')->where('id', '=', $quotation->iva_id)->first();
        $subtotal = $quotation->total/(1 + $value_iva->value);
        for ($i = 0; $i < $cont; $i++) {
            if ( $consul[$i]->quotation_id == $quotation->id){
            $inventory =  \DB::table('inventories')->where('id', $consul[$i]->inventory_id)->first();
            $product =  \DB::table('products')->where('id', $inventory->product_id)->first();
            $update_inventory = \DB::table('inventories')->where('id', $consul[$i]->inventory_id)->update(['quantity' => $inventory->quantity + $consul[$i]->quantity, 'user' => $who]);
            $total_products = $total_products - $consul[$i]->quantity;
            $subtotal = $subtotal - ($product->amount * $consul[$i]->quantity);
            //$query = \DB::table('inventory_quotation')->where('id', '=', $consul[$i]->id)->delete();
            }
        }
        //---------------------
        $value_iva = \DB::table('ivas')->where('id', '=', $quotation->iva_id)->first();
        $iva = $subtotal * $value_iva->value;
        //-------------------------
        $total = $iva + $subtotal;
        $quotation = Quotation::where('id', '=', $order->quotation_id)->first();
        $client = \DB::table('clients')->where('id', '=', $quotation->client_id)->first();
        $list_quotations = \DB::table('inventory_quotation')->where('quotation_id', '=', $quotation->id)->get();
        $update_quantity = \DB::table('quotations')->where('id', $quotation->id)->update(['quantity' => $total_products, 'iva' => $iva, 'total' => $total, 'user' => $who]);

        //AQUI SERVICIO
        /*$consulta = \DB::table('quotation_service')->where('quotation_id', $quotation->id)->get();
        $conta = count($consulta);
        $value_iva = \DB::table('ivas')->where('id', '=', $quotation->iva_id)->first();
        $subtotal = $quotation->total/(1 + $value_iva->value);
        for ($i = 0; $i < $conta; $i++) {
            if ( $consulta[$i]->quotation_id == $quotation->id){
            $service =  \DB::table('services')->where('id', $consulta[$i]->service_id)->first();
            $subtotal = $subtotal - ($service->amount);
            //$query = \DB::table('quotation_service')->where('id', '=', $consulta[$i]->id)->delete();
            }
        }*/
        
        /*$value_iva = \DB::table('ivas')->where('id', '=', $quotation->iva_id)->first();
        $iva = $subtotal * $value_iva->value;
        $total = $iva + $subtotal;
        $quotation = \DB::table('quotations')->where('id', '=', $quotation->id)->first();*/

        $client = \DB::table('clients')->where('id', '=', $quotation->client_id)->first();
        $list_quotations = \DB::table('inventory_quotation')->where('quotation_id', '=', $quotation->id)->get();
        $update_quantity = \DB::table('quotations')->where('id', $quotation->id)->update(['quantity' => $total_products, 'iva' => $iva, 'total' => $total, 'user' => $who]);
        $quotation = \DB::table('quotations')->where('id', '=', $quotation->id)->first();
        //$list_aditionals = \DB::table('aditionals')->where('quotation_id', '=', $order->quotation_id)->where('quantity', '!=', 0)->get();
        $list_inventories = \DB::select('SELECT product_id, SUM(quantity) "total_quantity" FROM inventories WHERE quantity != 0 GROUP BY product_id ORDER BY product_id ASC');

        $update_order = \DB::table('orders')->where('id', decrypt($id_order))->update(['status' => 'Devuelto', 'user' => $who]);
        $list_orders = \DB::table('orders')-> where('status', '=', 'Devuelto')->get();
        //return view('pedido/orders_devolution', compact('list_orders'));
        return $this->list_orders_devolution();
    }



    public function print($id_order){
    
    set_time_limit(180);
    $order = \DB::table('orders')->where('id', '=', decrypt($id_order))->first();
    $quotation = \DB::table('quotations')->where('id', '=', $order->quotation_id)->first();
    $client = \DB::table('clients')->where('id', '=', $order->client_id)->first();
    $list_quotations = \DB::table('inventory_quotation')->where('quotation_id', '=', $quotation->id)->get();
    $list_payments = \DB::table('order_payment')->where('order_id', '=', $order->id)->get();
    $list_services = \DB::table('services')->get();
    $listServicios = \DB::table('quotation_service')->where('quotation_id', '=', $quotation->id)->get();
    $cont = count($list_payments);
    $pagado = 0.0;
    for ($i = 0; $i < $cont; $i++) {
        $pagado = $pagado + $list_payments[$i]->amount;
    }
    if($pagado < $order->total){
        $msj = 'no pagado';
    }
    elseif($pagado >= $order->total){
        $msj= 'pagado';
    }

    $pdf = \PDF::loadView('pdf/factura', compact('order', 'quotation', 'client', 'list_quotations', 'list_payments', 'msj', 'list_services', 'listServicios' ));
    $pdf->download('factura_$order->id.pdf');
    return $pdf->stream();
    }

    public function print_bs($id_order){
    
        set_time_limit(180);
        $order = \DB::table('orders')->where('id', '=', decrypt($id_order))->first();
        $quotation = \DB::table('quotations')->where('id', '=', $order->quotation_id)->first();
        $client = \DB::table('clients')->where('id', '=', $order->client_id)->first();
        $list_quotations = \DB::table('inventory_quotation')->where('quotation_id', '=', $quotation->id)->get();
        $list_payments = \DB::table('order_payment')->where('order_id', '=', $order->id)->get();
        $list_services = \DB::table('services')->get();
        $dolar = \DB::table('dolars')->first();
        $listServicios = \DB::table('quotation_service')->where('quotation_id', '=', $quotation->id)->get();
        $cont = count($list_payments);
        $pagado = 0.0;
        for ($i = 0; $i < $cont; $i++) {
            $pagado = $pagado + $list_payments[$i]->amount;
        }
        if($pagado < $order->total){
            $msj = 'no pagado';
        }
        elseif($pagado >= $order->total){
            $msj= 'pagado';
        }
    
        $pdf = \PDF::loadView('pdf/factura_bs', compact('order', 'quotation', 'client', 'list_quotations', 'list_payments', 'msj', 'list_services', 'listServicios', 'dolar' ));
        $pdf->download('factura.pdf');
        return $pdf->stream();
        }

       
}
