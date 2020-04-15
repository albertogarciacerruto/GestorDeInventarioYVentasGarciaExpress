<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dollar;

class DolarController extends Controller
{
    public function list_dollars()
    {
        $list_dollars = \DB::table('dolars')->get();
        return view('principal/dollars', compact('list_dollars'));
    }
    public function edit($id_dollar)
    {
        $dollar = \DB::table('dolars')->where('id', '=', decrypt($id_dollar))->first();

        return view('principal/edit_dollar', compact('dollar'));
    }
    public function update(Request $request)
    {
        $value = $request->value;
        $id = $request->id;

        $update_value = \DB::table('dolars')->where('id', $id)->update(['value' => $value, 'user' => \Auth::id()]);

        $list_products = \DB::table('products')->get();
        $count = count($list_products);

        for ($i = 0; $i < $count; $i++) {
            $valor_product = $list_products[$i]->amount * $value;
            $update_product = \DB::table('products')->where('id', $list_products[$i]->id)->update(['bsf' => $valor_product, 'user' => \Auth::id()]);
        }

        $list_services = \DB::table('services')->get();
        $conta = count($list_services);
        for ($i = 0; $i < $conta; $i++) {
            $valor_service = $list_services[$i]->amount * $value;
            $update_service = \DB::table('services')->where('id', $list_services[$i]->id)->update(['bsf' => $valor_service, 'user' => \Auth::id()]);
        }

        $list_dollars = \DB::table('dolars')->get();
        return view('principal/dollars', compact('list_dollars'));
    }
}
