<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quotation;
use App\User;
use App\Inventory;
use App\Product;
use Carbon\Carbon;
use App\Client;
use \Auth;
use App\Iva;
use App\Service;
use App\Dolar;

class QuotationController extends Controller
{
    public function list_quotations()
    {
        $list_quotations = \DB::table('quotations')->where('status', '!=', 'confirmado')->get();
        return view('operaciones/quotations', compact('list_quotations'));
    }
    public function register()
    {
        $min = \Carbon\Carbon::now();
        $min->toDateTimeString();
        $min = strtotime ($min) ;
        $date_var = date ( 'l' , $min );
        $min = date ( 'Y-m-d' , $min );
        if($date_var == 'Saturday'){ //Verificamos si la fecha de inicio es fin de semana
        $max = strtotime ( '+2 day' , strtotime ( $min ) ) ;
        $max = date ( 'Y-m-d' , $max );
        }elseif($date_var == 'Sunday'){
        $max = strtotime ( '+1 day' , strtotime ( $min ) ) ;
        $max = date ( 'Y-m-d' , $max );
        }
        else{
        $max = strtotime ( '+1 day' , strtotime ( $min ) ) ;
        $max = date ( 'Y-m-d' , $max ); 
        }
        $auth = \Auth::id();
        $conectado = User::where('id', '=', $auth)->first();
        if($conectado->status == 'Activo' ){
        $list_clients = \DB::table('clients')->where('status', '=', 'Activo')->get();
        return view('operaciones/register_quotation', compact('list_clients', 'min', 'max'));
        }
    }
    public function register_quotation(Request $request)
    {

        $dt = $request->date;//Obetenmos Fecha del form
        $client = $request->client_id;//Obtenemos Id de Usuario
        $date = strtotime ($dt) ;
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
        $date_final = strtotime ( '+1 day', strtotime($date_init)); //Se suman 2 dias a la fecha de inicio por el plazo de 24 H.
        $date_var = date ( 'l' , $date_final );
        $date_final = date ( 'Y-m-d' , $date_final );
        if($date_var == 'Saturday'){ //Se verifica si la fecha de vencimiento es fin de semana
        $date_final = strtotime ( '+2 day' , strtotime ( $date_final ) ) ;
        $date_final = date ( 'Y-m-d' , $date_final );
        }elseif($date_var == 'Sunday'){
        $date_final = strtotime ( '+2 day' , strtotime ( $date_final ) ) ;
        $date_final = date ( 'Y-m-d' , $date_final );
        }

        $date_finish = $date_final;//Se obtiene fecha final de vencimiento
        $dolar = Dolar::select('value')->first();
        $quotation= Quotation::orderBy('id', 'desc')->first();
        $who = \Auth::id();
        $iva = Iva::select('id')->where('status', '=', 'Active')->first();
        if(is_null($iva)){
            return view('errors/noiva');
        }
        if (is_null($quotation)) {
        Quotation::create([
        'date_init' => $date_init,
        'date_finish' => $date_finish,
        'dolar_value' => $dolar->value,
        'client_id' => $client,
        'iva_id' => $iva->id,
        'user' => $who,
        ]);
        $list_quotations = \DB::table('quotations')->where('status', '!=', 'confirmado')->get();
        return redirect('quotations');
        //return view('cotizacion/quotations', compact('list_quotations'));
        }
        $quotation= Quotation::orderBy('id', 'asc')->get();
        $contador = count($quotation);
        $mensaje = 'Puede hacer una cotización';
        for ($i = 0; $i < $contador; $i++) {
        if($date_init == $quotation[$i]->date_init && $date_finish == $quotation[$i]->date_finish && $client == $quotation[$i]->client_id){
            $mensaje = 'Ya realizo una solicitud de cotización o pedido para este dia';
            if (Auth::user()->type == 'Cliente'){
            $list_quotations = \DB::table('quotations')->where('status', '!=', 'confirmado')->where('user_id', '=', Auth::user()->id)->get();
            return view('operaciones/quotations', compact('list_quotations', 'mensaje'));
            }
            $list_quotations = \DB::table('quotations')->where('status', '!=', 'confirmado')->get();
            return view('operaciones/quotations', compact('list_quotations', 'mensaje'));
        }
        }
        if($mensaje == 'Puede hacer una cotización') {
        Quotation::create([
            'date_init' => $date_init,
            'date_finish' => $date_finish,
            'dolar_value' => $dolar->value,
            'client_id' => $client,
            'iva_id' => $iva->id,
            'user' => $who,
        ]);
        }
        $list_quotations = \DB::table('quotations')->where('status', '!=', 'confirmado')->get();
        return redirect('quotations');
        //return view('cotizacion/quotations', compact('list_quotations'));

    }
    public function destroy($id_quotation)
    {
        try{
        $quotation = \DB::table('quotations')->where('id', '=', decrypt($id_quotation))->delete();
        $list_quotations = \DB::table('quotations')->where('status', '!=', 'confirmado')->get();
        return redirect('quotations');
        }
        catch(\Illuminate\Database\QueryException $ex) {
        return view('errors/general');
        }
    }
    public function add($id_quotation)
    {
        $quotation = \DB::table('quotations')->where('id', '=', decrypt($id_quotation))->first();
        $client = \DB::table('clients')->where('id', '=', $quotation->client_id)->first();
        $list_inventories = \DB::select('SELECT product_id, SUM(quantity) "total_quantity" FROM inventories WHERE quantity != 0 GROUP BY product_id ORDER BY product_id ASC');
        $list_quotations = \DB::table('inventory_quotation')->where('quotation_id', '=', $quotation->id)->where('quantity', '!=', 0)->get();
        $list_services = \DB::table('services')->get();
        $listServicios = \DB::table('quotation_service')->where('quotation_id', '=', $quotation->id)->get();
        return view('operaciones/add', compact('list_inventories', 'quotation', 'client', 'list_quotations', 'list_services', 'listServicios'));
    }

    public function destroy_quotation($id_quotation, $id_inventory){
        try{
        $who = \Auth::id();
        $inventory = \DB::table('inventories')->where('id', decrypt($id_inventory))->first();
        $product =  \DB::table('products')->where('id', $inventory->product_id)->first();
        $list = \DB::table('inventories')->where('product_id', $product->id)->get();
        $consul = \DB::table('inventory_quotation')->where('quotation_id', decrypt($id_quotation))->get();
        $cont = count($consul);
        $conta = count($list);
        $quotation = \DB::table('quotations')->where('id', decrypt($id_quotation))->first();
        $total_products = $quotation->quantity;
        $value_iva = \DB::table('ivas')->where('id', '=', $quotation->iva_id)->first();
        $subtotal = $quotation->total/(1 + $value_iva->value);
        for ($i = 0; $i < $cont; $i++) {
            for ($j = 0; $j < $conta; $j++) {
                if ( $consul[$i]->inventory_id == $list[$j]->id){
                $inventory =  \DB::table('inventories')->where('id', $consul[$i]->inventory_id)->first();
                $product =  \DB::table('products')->where('id', $inventory->product_id)->first();
                $update_inventory = \DB::table('inventories')->where('id', $consul[$i]->inventory_id)->update(['quantity' => $inventory->quantity + $consul[$i]->quantity, 'user' => $who]);
                $total_products = $total_products - $consul[$i]->quantity;
                $subtotal = $subtotal - ($product->amount * $consul[$i]->quantity);
                $query = \DB::table('inventory_quotation')->where('id', '=', $consul[$i]->id)->delete();
                }
            }
        }

        $value_iva = \DB::table('ivas')->where('id', '=', $quotation->iva_id)->first();
        $iva = $subtotal * $value_iva->value;
        $total = $iva + $subtotal;
        $quotation = \DB::table('quotations')->where('id', '=', decrypt($id_quotation))->first();
        $client = \DB::table('clients')->where('id', '=', $quotation->client_id)->first();
        $list_quotations = \DB::table('inventory_quotation')->where('quotation_id', '=', $quotation->id)->where('quantity', '!=', 0)->get();
        $update_quantity = \DB::table('quotations')->where('id', decrypt($id_quotation))->update(['quantity' => $total_products, 'iva' => $iva, 'total' => $total, 'user' => $who]);
        $quotation = \DB::table('quotations')->where('id', '=', decrypt($id_quotation))->first();
        $list_inventories = \DB::select('SELECT product_id, SUM(quantity) "total_quantity" FROM inventories WHERE quantity != 0 GROUP BY product_id ORDER BY product_id ASC');
        $list_services = \DB::table('services')->get();
        $listServicios = \DB::table('quotation_service')->where('quotation_id', '=', $quotation->id)->get();
        return redirect()->action('QuotationController@add', ['id' => encrypt($quotation->id)]);
        //return view('operaciones/add', compact('list_inventories', 'quotation', 'client', 'list_quotations', 'list_services', 'listServicios'));
        }
        catch(\Illuminate\Database\QueryException $ex) {
        return view('errors/quotation');
        }
    }

    public function destroy_service($id_quotation, $id_service){
        try{
        $who = \Auth::id();
        $service = \DB::table('services')->where('id', decrypt($id_service))->first();
        $quotation = \DB::table('quotations')->where('id', decrypt($id_quotation))->first();
        $value_iva = \DB::table('ivas')->where('id', '=', $quotation->iva_id)->first();
        $subtotal = $quotation->total/(1 + $value_iva->value);
        $subtotal = $subtotal - ($service->amount);
        $query = \DB::table('quotation_service')->where('quotation_id', '=', decrypt($id_quotation))->where('service_id', '=', decrypt($id_service))->delete(); 
        $value_iva = \DB::table('ivas')->where('id', '=', $quotation->iva_id)->first();
        $iva = $subtotal * $value_iva->value;
        $total = $iva + $subtotal;
        $quotation = \DB::table('quotations')->where('id', '=', decrypt($id_quotation))->first();
        $client = \DB::table('clients')->where('id', '=', $quotation->client_id)->first();
        $list_quotations = \DB::table('inventory_quotation')->where('quotation_id', '=', $quotation->id)->where('quantity', '!=', 0)->get();
        $update_quantity = \DB::table('quotations')->where('id', decrypt($id_quotation))->update(['iva' => $iva, 'total' => $total, 'user' => $who]);
        $quotation = \DB::table('quotations')->where('id', '=', decrypt($id_quotation))->first();
        $list_inventories = \DB::select('SELECT product_id, SUM(quantity) "total_quantity" FROM inventories WHERE quantity != 0 GROUP BY product_id ORDER BY product_id ASC');
        $list_services = \DB::table('services')->get();
        $listServicios = \DB::table('quotation_service')->where('quotation_id', '=', $quotation->id)->get();
        return redirect()->action('QuotationController@add', ['id' => encrypt($quotation->id)]);
        //return view('operaciones/add', compact('list_inventories', 'quotation', 'client', 'list_quotations', 'list_services', 'listServicios'));
        }
        catch(\Illuminate\Database\QueryException $ex) {
        return view('errors/quotation');
        }
    }

    public function adding(Request $request, $id_quotation)
    {
        $who = \Auth::id();
        $product = $request->product_id;
        $quantity = $request->quantity;
        $solicitado = $request->quantity;
        $quotation = \DB::table('quotations')->where('id', '=', decrypt($id_quotation))->first();
        $client = \DB::table('clients')->where('id', '=', $quotation->client_id)->first();
        $list_inventories = \DB::select('SELECT product_id, SUM(quantity) "total_quantity" FROM inventories GROUP BY product_id ORDER BY product_id ASC');
        $list_quotations = \DB::table('inventory_quotation')->where('quotation_id', '=', $quotation->id)->where('quantity', '!=', 0)->get();
        $var = \DB::table('inventories')->where('product_id', '=', $product)->where('quantity', '!=', 0)->get();
        $cont = count($var);
        for ($i = 0; $i < $cont; $i++) {
            /*Para Comprobar si existen productos, si lo solicitado es mayor a lo que existe se envia un mensaje de error. */
            if($var[$i]->quantity < $solicitado){
                $new = $var[$i]->quantity;
                $solicitado = $solicitado - $new;
                $query = Quotation::find($quotation->id);
                //---------------------
                //$precio = \DB::table('products')->where('id', '=', $request->product_id)->first();  ////26/01
                $name_product = \DB::table('products')->select('name')->where('id', '=', $request->product_id)->first();
                //---------------------
                //$query->inventories()->attach($var[$i]->id, array('quantity' => $new, 'amount' => $precio->amount, 'user' => $who));
                //$update_inventory = \DB::table('inventories')->where('id', $var[$i]->id)->update(['quantity' => 0, 'user' => $who]);
                if ($i == $cont-1 && empty($var[$i+1]->quantity) ){
                $mensaje = "No existen suficienres elemetos de $name_product->name para completar la solicitud.";
                return redirect()->action('QuotationController@add', ['id' => encrypt($quotation->id), 'mensaje'=> $mensaje ]);
                //return view('operaciones/add', compact('list_inventories', 'quotation', 'client', 'list_quotations', 'mensaje'));
                //return $this->confirmation($id_quotation, $product, $solicitado);
                }
            }
            elseif($var[$i]->quantity == $solicitado ){
                $new = $var[$i]->quantity;
                $solicitado = $solicitado - $new;
                $query = Quotation::find($quotation->id);
                //---------------------
                $producto = \DB::table('products')->where('id', '=', $request->product_id)->first();
                //---------------------
                $query->inventories()->attach($var[$i]->id, array('quantity' => $new, 'amount' => $producto->amount, 'user' => $who));
                $update_inventory = \DB::table('inventories')->where('id', $var[$i]->id)->update(['quantity' => $solicitado, 'user' => $who]);
                break;
            }
            elseif($var[$i]->quantity > $solicitado){
                $new = $var[$i]->quantity;
                $new = $new - $solicitado;
                $query = Quotation::find($quotation->id);
                //---------------------
                $producto = \DB::table('products')->where('id', '=', $request->product_id)->first();
                //---------------------
                $query->inventories()->attach($var[$i]->id, array('quantity' => $solicitado, 'amount' => $producto->amount, 'user' => $who));
                $update_inventories = \DB::table('inventories')->where('id', $var[$i]->id)->update(['quantity' => $new, 'user' => $who]);
                break;
            }
        }
        $list_quotations = \DB::table('inventory_quotation')->where('quotation_id', '=', $quotation->id)->where('quantity', '!=', 0)->get();
        $cont = count($list_quotations);
        $total_products = 0;
        $subtotal = 0;
        for ($i = 0; $i < $cont; $i++) {
            $total_products = $total_products + $list_quotations[$i]->quantity;
            $inventory = \DB::table('inventories')->where('id', '=', $list_quotations[$i]->inventory_id)->first();
            $products = \DB::table('products')->where('id', '=', $inventory->product_id)->first();
            $subtotal = $subtotal + ($products->amount * $list_quotations[$i]->quantity);
        }
        $value_iva = \DB::table('ivas')->where('id', '=', $quotation->iva_id)->first();
        $iva = $subtotal * $value_iva->value;
        $total = $iva + $subtotal;
        $update_quantity = \DB::table('quotations')->where('id', decrypt($id_quotation))->update(['quantity' => $total_products, 'iva' => $iva, 'total' => $total, 'user' => $who]);
        $quotation = \DB::table('quotations')->where('id', '=', decrypt($id_quotation))->first();
        $list_inventories = \DB::select('SELECT product_id, SUM(quantity) "total_quantity" FROM inventories WHERE quantity != 0 GROUP BY product_id ORDER BY product_id ASC');
        $list_services = \DB::table('services')->get();
        $listServicios = \DB::table('quotation_service')->where('quotation_id', '=', $quotation->id)->get();
        return redirect()->action('QuotationController@add', ['id' => encrypt($quotation->id)]);
        //return view('operaciones/add', compact('list_inventories', 'quotation', 'client', 'list_quotations', 'list_services', 'listServicios'));
    }

    public function adding_service(Request $request, $id_quotation)
    {
        $who = \Auth::id();
        $service_id = $request->service_id;
        $service =  \DB::table('services')->where('id', '=', $request->service_id)->first();
        $quotation = \DB::table('quotations')->where('id', '=', decrypt($id_quotation))->first();
        $client = \DB::table('clients')->where('id', '=', $quotation->client_id)->first();
        $list_inventories = \DB::select('SELECT product_id, SUM(quantity) "total_quantity" FROM inventories GROUP BY product_id ORDER BY product_id ASC');
        $list_quotations = \DB::table('inventory_quotation')->where('quotation_id', '=', $quotation->id)->where('quantity', '!=', 0)->get();
        $list_services = \DB::table('quotation_service')->where('quotation_id', '=', $quotation->id)->get();
        $query = Quotation::find($quotation->id);
        $query->services()->attach($service->id, array('amount' => $service->amount, 'user' => $who));
        $list_quotations = \DB::table('inventory_quotation')->where('quotation_id', '=', $quotation->id)->where('quantity', '!=', 0)->get();
        $cont = count($list_quotations);
        $total_products = 0;
        $subtotal = 0;
        for ($i = 0; $i < $cont; $i++) {
            $total_products = $total_products + $list_quotations[$i]->quantity;
            $inventory = \DB::table('inventories')->where('id', '=', $list_quotations[$i]->inventory_id)->first();
            $products = \DB::table('products')->where('id', '=', $inventory->product_id)->first();
            $subtotal = $subtotal + ($products->amount * $list_quotations[$i]->quantity);
        }
        $list_service = \DB::table('quotation_service')->where('quotation_id', '=', $quotation->id)->get();
        $conta = count($list_service);
        for ($i = 0; $i < $conta; $i++) {
            $service = \DB::table('services')->where('id', '=', $list_service[$i]->service_id)->first();
            $subtotal = $subtotal + ($service->amount);
        }
        $value_iva = \DB::table('ivas')->where('id', '=', $quotation->iva_id)->first();
        $iva = $subtotal * $value_iva->value;
        $total = $iva + $subtotal;
        $update_quantity = \DB::table('quotations')->where('id', decrypt($id_quotation))->update(['iva' => $iva, 'total' => $total, 'user' => $who]);
        $quotation = \DB::table('quotations')->where('id', '=', decrypt($id_quotation))->first();
        $list_inventories = \DB::select('SELECT product_id, SUM(quantity) "total_quantity" FROM inventories WHERE quantity != 0 GROUP BY product_id ORDER BY product_id ASC');
        $list_services = \DB::table('services')->get();
        $listServicios = \DB::table('quotation_service')->where('quotation_id', '=', $quotation->id)->get();
        return redirect()->action('QuotationController@add', ['id' => encrypt($quotation->id)]);
    }

    public function print($id_quotation){
  
        set_time_limit(180);
        $quotation = \DB::table('quotations')->where('id', '=', decrypt($id_quotation))->first();
        $client = \DB::table('clients')->where('id', '=', $quotation->client_id)->first();
        $list_quotations = \DB::table('inventory_quotation')->where('quotation_id', '=', $quotation->id)->where('quantity', '!=', 0)->get();
        $list_services = \DB::table('services')->get();
        $listServicios = \DB::table('quotation_service')->where('quotation_id', '=', $quotation->id)->get();
        $pdf = \PDF::loadView('pdf/pdf', compact('quotation', 'list_quotations', 'client', 'list_services', 'listServicios'));
        $pdf->download('presupuesto.pdf');
        return $pdf->stream();
    }

    public function print_bs($id_quotation){
  
        set_time_limit(180);
        $quotation = \DB::table('quotations')->where('id', '=', decrypt($id_quotation))->first();
        $client = \DB::table('clients')->where('id', '=', $quotation->client_id)->first();
        $list_quotations = \DB::table('inventory_quotation')->where('quotation_id', '=', $quotation->id)->where('quantity', '!=', 0)->get();
        $list_services = \DB::table('services')->get();
        $listServicios = \DB::table('quotation_service')->where('quotation_id', '=', $quotation->id)->get();
        $dolar = \DB::table('dolars')->first();
        $pdf = \PDF::loadView('pdf/pdf_bs', compact('quotation', 'list_quotations', 'client', 'list_services', 'listServicios', 'dolar'));
        $pdf->download('presupuesto.pdf');
        return $pdf->stream();
    }
}
