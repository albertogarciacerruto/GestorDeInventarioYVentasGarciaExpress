<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Batch;
use App\Product;
use App\Quotation;
use App\Http\Requests\InventoryRequest;
use Illuminate\Support\Str;

class InventoryController extends Controller
{
    public function list_inventories()
    {
        $list_inventories = \DB::select('SELECT product_id, SUM(quantity) AS  "total_quantity" FROM inventories GROUP BY product_id HAVING SUM(quantity) > 0 ORDER BY product_id ASC');
        $cont = count($list_inventories);
        for ($i = 0; $i < $cont; $i++) {
        if($list_inventories[$i]->total_quantity < 120 ){
            $update_inventories = \DB::table('inventories')->where('product_id', $list_inventories[$i]->product_id)->update(['status' => 'insuficiente']);
        }
        elseif($list_inventories[$i]->total_quantity >= 120){
            $update_inventories = \DB::table('inventories')->where('product_id', $list_inventories[$i]->product_id)->update(['status' => 'suficiente']);
        }
        }
        return view('inventarioProductos/inventories', compact('list_inventories'));
    }

    /*public function list_inventories_location()
    {
        $list_inventories = \DB::select('SELECT product_id, location_id, SUM(quantity) "total_quantity" FROM inventories GROUP BY product_id, location_id HAVING SUM(quantity) > 0 ORDER BY product_id, location_id ASC');
        $cont = count($list_inventories);
        for ($i = 0; $i < $cont; $i++) {
        if($list_inventories[$i]->total_quantity < 120 ){
            $update_inventories = \DB::table('inventories')->where('product_id', $list_inventories[$i]->product_id)->update(['status' => 'insuficiente']);
        }
        elseif($list_inventories[$i]->total_quantity >= 120){
            $update_inventories = \DB::table('inventories')->where('product_id', $list_inventories[$i]->product_id)->update(['status' => 'suficiente']);
        }
        }
        return view('inventarioProductos/inventories_location', compact('list_inventories'));
    }*/

    public function view($product_id)
    {
        $details = \DB::table('inventories')->select('id', 'batch_id', 'location_id', 'product_id', 'quantity')->where('product_id', '=', decrypt($product_id))->get();
        $product = \DB::table('products')->select('name', 'description', 'amount', 'image', 'bsf')->where('id','=', decrypt($product_id))->first();
        return view('inventarioProductos/detail_inventory', compact('details', 'product'));
    }
    public function register_inventory(InventoryRequest $request)
    {
        $product = Product::where('id', '=', $request->product_id)->first();//Para Lote
        $name = Str::slug($product->name, '-');//Para el lote
        $fecha = new \DateTime();
        $date = $fecha->format("dmYHis");

        $clave_lote = $name . $date;
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $location_id = $request->location_id;
        $inventory = Inventory::orderBy('id', 'desc')->first();
        $who = \Auth::id();

        if (is_null($inventory)) {
        /*$var = \DB::table('product_supply')->where('product_id', '=', $product_id)->get();
        $cont = count($var);
        for ($i = 0; $i < $cont; $i++) {
            $supply = Supply::where('id', '=', $var[$i]->supply_id)->first();
            $a = $var[$i]->meters * $quantity;
            $b = $supply->meters;
            if($b >= $a){
                $msj = 'si';
            }
            if($a > $b) {
                $msj = 'no';
                break;
            }
        }*/
        
        //if($msj == 'si'){
            /*for ($i = 0; $i < $cont; $i++) {
                $supply = Supply::where('id', '=', $var[$i]->supply_id)->first();
                $a = $var[$i]->meters * $quantity;
                $b = $supply->meters;
                if($b >= $a){
                $resta = $b-$a;
                $update_meters = \DB::table('supplies')->where('id', $var[$i]->supply_id)->update(['meters' => $resta, 'user' => $who]);
                $msj = 'si';
                }
            }*/
            $lote = Batch::create([
            'name' => $request->name,
            'date' => new \DateTime(),
            'iden' => $clave_lote,
            'user' => $who,
            ]);
            $nuevo = Inventory::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'location_id' => $request->location_id,
            'batch_id' => $lote->id,
            'user' => $who,
            ]);
            //Verificacion de pendientes en adicionales
            //$who = \Auth::id();
            //$aditional = Aditional::where('product_id', '=', $request->product_id)->where('status', '=', 'Pendiente')->get();
            //$conta = count($aditional);
            //$var = \DB::table('inventories')->where('product_id', '=', $request->product_id)->where('quantity', '!=', 0)->get();
            //$cont = count($var);
            //for ($i = 0; $i < $cont; $i++) {
            /*for ($j = 0; $j < $conta; $j++) {
            if($var[$i]->quantity < $aditional[$j]->quantity){
                $new = $var[$i]->quantity;
                $aditional[$j]->quantity = $aditional[$j]->quantity - $new;
                $query = Quotation::find($aditional[$j]->quotation_id);
                //---------------------
                $precio = \DB::table('products')->where('id', '=', $request->product_id)->first();
                //---------------------
                $query->inventories()->attach($var[$i]->id, array('volume' => $new, 'amount' => $precio->amount, 'user' => $who));
                $update_inventory = \DB::table('inventories')->where('id', $var[$i]->id)->update(['quantity' => 0,  'user' => $who]);
                if ($i == $cont-1 && empty($var[$i+1]->quantity) ){
                $update_aditional = \DB::table('aditionals')->where('id', $aditional[$j]->id)->update(['quantity' => $aditional[$j]->quantity, 'user' => $who]);
                }
            }
            elseif($var[$i]->quantity == (int)$aditional[$j]->quantity ){
                $new = $var[$i]->quantity;
                $aditional[$j]->quantity = (int)$aditional[$j]->quantity - $new;
                $query = Quotation::find($aditional[$j]->quotation_id);
                //---------------------
                $precio = \DB::table('products')->where('id', '=', $request->product_id)->first();
                //---------------------
                $query->inventories()->attach($var[$i]->id, array('volume' => $new, 'amount' => $precio->amount, 'user' => $who));
                $update_inventory = \DB::table('inventories')->where('id', $var[$i]->id)->update(['quantity' => $aditional[$j]->quantity, 'user' => $who]);
                $update_aditional = \DB::table('aditionals')->where('id', $aditional[$j]->id)->update(['quantity' => $aditional[$j]->quantity, 'status' => 'Completado', 'user' => $who]);
                break;
            }
            elseif($var[$i]->quantity > $aditional[$j]->quantity){
                (int)$var[$i]->quantity = $var[$i]->quantity - $aditional[$j]->quantity;
                $query = Quotation::find($aditional[$j]->quotation_id);
                //---------------------
                $precio = \DB::table('products')->where('id', '=', $request->product_id)->first();
                //---------------------
                $query->inventories()->attach($var[$i]->id, array('volume' => $aditional[$j]->quantity, 'amount' => $precio->amount, 'user' => $who));
                $update_inventories = \DB::table('inventories')->where('id', $var[$i]->id)->update(['quantity' => $var[$i]->quantity, 'user' => $who]);
                $update_aditional = \DB::table('aditionals')->where('id', $aditional[$j]->id)->update(['quantity' => 0, 'status' => 'Completado', 'user' => $who]);
                break;
                }
            }*/
            //}
            //Fin de verificacion de adicionales pendientes
        //}
        }
        elseif($product_id === $inventory->product_id && $batch_id === $inventory->batch_id){
        return $this->list_inventories();
        }
        else {
        //$var = \DB::table('product_supply')->where('product_id', '=', $product_id)->get();
        //$cont = count($var);
        //if($cont == 0){
            //$msj = "revisar";
            /*$list_inventories = \DB::select('SELECT product_id, SUM(quantity) "total_quantity" FROM inventories GROUP BY product_id HAVING SUM(quantity) > 0 ORDER BY product_id ASC');
            $cont = count($list_inventories);
            for ($i = 0; $i < $cont; $i++) {
            if($list_inventories[$i]->total_quantity < 120 ){
                $update_inventories = \DB::table('inventories')->where('product_id', $list_inventories[$i]->product_id)->update(['status' => 'insuficiente', 'user' => $who]);
            }
            elseif($list_inventories[$i]->total_quantity >= 120){
                $update_inventories = \DB::table('inventories')->where('product_id', $list_inventories[$i]->product_id)->update(['status' => 'suficiente', 'user' => $who]);
            }
            }
            return view('inventarioProductos/inventories', compact('list_inventories'));*/
        //}
        /*for ($i = 0; $i < $cont; $i++) {
            $supply = Supply::where('id', '=', $var[$i]->supply_id)->first();
            $a = $var[$i]->meters * $quantity;
            $b = $supply->meters;
            if($b >= $a){
                $msj = 'si';
            }elseif($a > $b) {
                $msj = 'no';
                break;
            }
        }*/
        //if($msj == 'si'){
            /*for ($i = 0; $i < $cont; $i++) {
                $supply = Supply::where('id', '=', $var[$i]->supply_id)->first();
                $a = $var[$i]->meters * $quantity;
                $b = $supply->meters;
                if($b >= $a){
                $resta = $b-$a;
                $update_meters = \DB::table('supplies')->where('id', $var[$i]->supply_id)->update(['meters' => $resta]);
                $msj = 'si';
                }
            }*/
            $lote = Batch::create([
            'name' => $request->name,
            'date' => new \DateTime(),
            'iden' => $clave_lote,
            'user' => $who,
            ]);
            $nuevo = Inventory::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'location_id' => $request->location_id,
            'batch_id' => $lote->id,
            'user' => $who,
            ]);
            //$who = \Auth::id();
            //Verificacion de adicionales pendientes
            //$aditional = Aditional::where('product_id', '=', $request->product_id)->where('status', '=', 'Pendiente')->get();
            //$conta = count($aditional);
            //$var = \DB::table('inventories')->where('product_id', '=', $request->product_id)->where('quantity', '!=', 0)->get();
            //$cont = count($var);
            //for ($i = 0; $i < $cont; $i++) {
            /*for ($j = 0; $j < $conta; $j++) {
            if($var[$i]->quantity < $aditional[$j]->quantity){
                $new = $var[$i]->quantity;
                $aditional[$j]->quantity = $aditional[$j]->quantity - $new;
                $query = Quotation::find($aditional[$j]->quotation_id);
                //---------------------
                $precio = \DB::table('products')->where('id', '=', $request->product_id)->first();
                //---------------------
                $query->inventories()->attach($var[$i]->id, array('volume' => $new, 'amount' => $precio->amount, 'user' => $who));
                $update_inventory = \DB::table('inventories')->where('id', $var[$i]->id)->update(['quantity' => 0, 'user' => $who]);
                if ($i == $cont-1 && empty($var[$i+1]->quantity) ){
                $update_aditional = \DB::table('aditionals')->where('id', $aditional[$j]->id)->update(['quantity' => $aditional[$j]->quantity, 'user' => $who]);
                }
            }
            elseif($var[$i]->quantity == (int)$aditional[$j]->quantity ){
                $new = $var[$i]->quantity;
                $aditional[$j]->quantity = (int)$aditional[$j]->quantity - $new;
                $query = Quotation::find($aditional[$j]->quotation_id);
                //---------------------
                $precio = \DB::table('products')->where('id', '=', $request->product_id)->first();
                //---------------------
                $query->inventories()->attach($var[$i]->id, array('volume' => $new, 'amount' => $precio->amount, 'user' => $who));
                $update_inventory = \DB::table('inventories')->where('id', $var[$i]->id)->update(['quantity' => $aditional[$j]->quantity, 'user' => $who]);
                $update_aditional = \DB::table('aditionals')->where('id', $aditional[$j]->id)->update(['quantity' => $aditional[$j]->quantity, 'status' => 'Completado', 'user' =>$who]);
                break;
            }
            elseif($var[$i]->quantity > $aditional[$j]->quantity){
                (int)$var[$i]->quantity = $var[$i]->quantity - $aditional[$j]->quantity;
                $query = Quotation::find($aditional[$j]->quotation_id);
                //---------------------
                $precio = \DB::table('products')->where('id', '=', $request->product_id)->first();
                //---------------------
                $query->inventories()->attach($var[$i]->id, array('volume' => $aditional[$j]->quantity, 'amount' => $precio->amount, 'user' => $who));
                $update_inventories = \DB::table('inventories')->where('id', $var[$i]->id)->update(['quantity' => $var[$i]->quantity, 'user' => $who]);
                $update_aditional = \DB::table('aditionals')->where('id', $aditional[$j]->id)->update(['quantity' => 0, 'status' => 'Completado', 'user' => $who]);
                break;
                }
            }*/
            //}
        //Fin de verificacion de adicionales pendientes
        //}
        }

        $list_inventories = \DB::select('SELECT product_id, SUM(quantity) "total_quantity" FROM inventories GROUP BY product_id HAVING SUM(quantity) > 0 ORDER BY product_id ASC');
        $cont = count($list_inventories);
        for ($i = 0; $i < $cont; $i++) {
        if($list_inventories[$i]->total_quantity < 120 ){
            $update_inventories = \DB::table('inventories')->where('product_id', $list_inventories[$i]->product_id)->update(['status' => 'insuficiente', 'user' => $who]);
        }
        elseif($list_inventories[$i]->total_quantity >= 120){
            $update_inventories = \DB::table('inventories')->where('product_id', $list_inventories[$i]->product_id)->update(['status' => 'suficiente', 'user' => $who]);
        }
        }
        return redirect()->action('InventoryController@list_inventories');
        return view('inventarioProductos/inventories', compact('list_inventories'));
    }

    public function destroy($inventory_id, $product_id)
    {
        try{
        $who = \Auth::id();
        //$var = \DB::table('product_supply')->where('product_id', '=', decrypt($product_id))->get();
        //$cont = count($var);
        /*for ($i = 0; $i < $cont; $i++) {
            $supply = Supply::where('id', '=', $var[$i]->supply_id)->first();
            $inventory = Inventory::where('id', '=', decrypt($inventory_id))->first();
            $a = $var[$i]->meters * $inventory->quantity;
            $b = $supply->meters;
            $suma = $b+$a;
            $update_meters = \DB::table('supplies')->where('id', $var[$i]->supply_id)->update(['meters' => $suma]);

        }*/
        $inventory = \DB::table('inventories')->where('id', '=', decrypt($inventory_id))->delete();
        $details = \DB::table('inventories')->select('id', 'batch_id', 'location_id', 'product_id', 'quantity')->where('product_id', '=', decrypt($product_id))->get();
        $product = \DB::table('products')->select('name', 'description', 'amount', 'image')->where('id','=', decrypt($product_id))->first();
        //Validar la suficiencia de productos finales
            $list_inventories = \DB::select('SELECT product_id, location_id, SUM(quantity) "total_quantity" FROM inventories GROUP BY product_id, location_id HAVING SUM(quantity) > 0 ORDER BY product_id ASC');
            $cont = count($list_inventories);
            for ($i = 0; $i < $cont; $i++) {
            if($list_inventories[$i]->total_quantity < 120 ){
                $update_inventories = \DB::table('inventories')->where('product_id', $list_inventories[$i]->product_id)->update(['status' => 'insuficiente', 'user' => $who]);
            }
            elseif($list_inventories[$i]->total_quantity >= 120){
                $update_inventories = \DB::table('inventories')->where('product_id', $list_inventories[$i]->product_id)->update(['status' => 'suficiente', 'user' => $who]);
            }
            }
        //Termino de Validar la suficiencia de productos finales
        return redirect()->action('InventoryController@list_inventories');
        //return view('inventarioProductos/detail_inventory', compact('details', 'product'));
        }
        catch(\Illuminate\Database\QueryException $ex) {
        return view('errors/inventory');
        }
    }
    public function edit($id_inventory)
    {
        $inventory = Inventory::where('id', '=', decrypt($id_inventory))->first();
        $product = Product::where('id', '=', $inventory->product_id)->first();
        return view('inventarioProductos/update_inventory', compact('inventory', 'product'));
    }
    public function update(Request $request)
    {
        $quantity = $request->quantity;
        $location = $request->location_id;
        $id = $request->inventory_id;
        $who = \Auth::id();
        
        $update_quantity = \DB::table('inventories')->where('id', $id)->update(['quantity' => $quantity, 'location_id' => $location, 'user' => $who]);

        //Validar la suficiencia de productos finales
            $list_inventories = \DB::select('SELECT product_id, location_id, SUM(quantity) "total_quantity" FROM inventories GROUP BY product_id, location_id HAVING SUM(quantity) > 0 ORDER BY product_id ASC');
            $cont = count($list_inventories);
            for ($i = 0; $i < $cont; $i++) {
            if($list_inventories[$i]->total_quantity < 120 ){
                $update_inventories = \DB::table('inventories')->where('product_id', $list_inventories[$i]->product_id)->update(['status' => 'insuficiente', 'user' => $who]);
            }
            elseif($list_inventories[$i]->total_quantity >= 120){
                $update_inventories = \DB::table('inventories')->where('product_id', $list_inventories[$i]->product_id)->update(['status' => 'suficiente', 'user' => $who]);
            }
            }
        //Termino de Validar la suficiencia de productos finales

        $inventory = Inventory::where('id', '=', $id)->first();

        return $this->list_inventories($inventory->product_id);
    }

    public function sufficiency()
    {
        $list_inventories = \DB::select('SELECT product_id, location_id, SUM(quantity) "total_quantity" FROM inventories WHERE status = "insuficiente" GROUP BY product_id, location_id ORDER BY product_id ASC');
        return view('menu/sufficiency', compact('list_inventories'));
    }
    
    public function list_aditioanls()
    {
        $list_aditionals = \DB::select('SELECT pro.name, pro.image, pro.size, adi.quotation_id, adi.quantity, adi.date_aprox FROM products pro, aditionals adi WHERE adi.quantity != 0 AND pro.id = adi.product_id');
        return view('inventarioProductos/aditionals', compact('list_aditionals'));
    }
}
