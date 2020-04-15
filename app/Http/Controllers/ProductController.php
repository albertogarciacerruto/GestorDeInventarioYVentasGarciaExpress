<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Dolar;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    public function list_products()
    {
        $list_products = \DB::table('products')->get();
        return view('principal/products', compact('list_products'));
    }
    public function register()
    {
        return view('principal/register_product');
    }
    public function upload($id_product)
    {
        $product = Product::where('id', '=', decrypt($id_product))->first();
        return view('principal/upload_product', compact('product'));
    }
    public function register_product(ProductRequest $request)
    {
        $name = $request->name;
        $description = $request->description;
        $amount = $request->amount;
        $dolar= Dolar::select('value')->first();
        $who = \Auth::id();
        $product= Product::orderBy('id', 'desc')->first();
        $list = Product::all();
        $cont = count($list);


        if (is_null($product)) {
            $nuevo = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'amount' => $request->amount,
                'bsf' => $request->amount*$dolar->value,
                'user' => $who,
            ]);
        
            if ($request->hasFile('image'))
            {
                $photo = $request->file('image')->store('public');
                $image = \DB::table('products')->where('id','=', $nuevo->id)->update(['image' => $photo]);
            }
        }
        elseif($name === $product->name && $description === $product->description){
        return $this->list_products();
        }
        else {
            $nuevo = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'amount' => $request->amount,
                'bsf' => $request->amount*$dolar->value,
                'user' => $who,
            ]);
            if ($request->hasFile('image'))
            {
                $photo = $request->file('image')->store('public');
                $image = \DB::table('products')->where('id','=', $nuevo->id)->update(['image' => $photo]);
            }        
        }
        $list_products = \DB::table('products')->get();
        return redirect('products');
        //return view('principal/products', compact('list_products'));
    }
    public function destroy($id_product)
    {
        try{
        $product = \DB::table('products')->where('id', '=', decrypt($id_product))->delete();

        $list_products = \DB::table('products')->get();
        return redirect('products');
        }
        catch(\Illuminate\Database\QueryException $ex) {
        return view('errors/product');
        }
    }
    public function edit($id_product)
    {
        $product = \DB::table('products')->where('id', '=', decrypt($id_product))->first();
        return view('principal/edit_product', compact('product'));
    }
    public function update(ProductUpdateRequest $request)
    {
        $name = $request->name;
        $description = $request->description;
        $amount = $request->amount;
        $id = $request->id;
        $who = \Auth::id();

        $update_name = \DB::table('products')->where('id', $id)->update(['name' => $name, 'description' => $description, 'amount' => $amount, 'user' => $who]);
        if ($request->hasFile('image'))
        {
            $photo = $request->file('image')->store('public');
            $image = \DB::table('products')->where('id','=', $id)->update(['image' => $photo]);
        }

        $list_products = \DB::table('products')->get();
        return redirect('products');
        //return view('principal/products', compact('list_products'));
    }
}
