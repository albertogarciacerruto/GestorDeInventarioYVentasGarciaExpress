<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Quotation;
use App\Dolar;
use App\Http\Requests\ServiceRequest;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function list_services()
    {
        $list_services = \DB::table('services')->get();
        return view('inventarioProductos/services', compact('list_services'));
    }

    public function register()
    {
        return view('inventarioProductos/register_service');
    }
    /*public function upload($id_product)
    {
        $product = Product::where('id', '=', decrypt($id_product))->first();
        return view('principal/upload_product', compact('product'));
    }*/
    public function register_service(ServiceRequest $request)
    {
        $name = $request->name;
        $description = $request->description;
        $amount = $request->amount;
        $dolar= Dolar::select('value')->first();
        $who = \Auth::id();
        $service= Service::orderBy('id', 'desc')->first();

        if (is_null($service)) {
            $nuevo = Service::create([
                'name' => $request->name,
                'description' => $request->description,
                'amount' => $request->amount,
                'bsf' => $request->amount*$dolar->value,
                'user' => $who,
            ]);
        }
        elseif($name === $service->name && $description === $service->description){
        return $this->list_services();
        }
        else {
            $nuevo = Service::create([
                'name' => $request->name,
                'description' => $request->description,
                'amount' => $request->amount,
                'bsf' => $request->amount*$dolar->value,
                'user' => $who,
            ]);  
        }
        $list_services = \DB::table('services')->get();
        return redirect('services');
        //return view('inventarioProductos/services', compact('list_services'));
    }
    public function destroy($id_service)
    {
        try{
        $service = \DB::table('services')->where('id', '=', decrypt($id_service))->delete();

        $list_services = \DB::table('services')->get();
        return redirect('services');
        }
        catch(\Illuminate\Database\QueryException $ex) {
        return view('errors/service');
        }
    }
    public function edit($id_service)
    {
        $service = \DB::table('services')->where('id', '=', decrypt($id_service))->first();
        return view('inventarioProductos/edit_service', compact('service'));
    }
    public function update(ServiceRequest $request)
    {
        $name = $request->name;
        $description = $request->description;
        $amount = $request->amount;
        $id = $request->id;
        $who = \Auth::id();

        $update_date = \DB::table('services')->where('id', $id)->update(['name' => $name, 'description' => $description, 'amount' => $amount, 'user' => $who]);

        $list_services = \DB::table('services')->get();
        return redirect('services');
        //return view('inventarioProductos/services', compact('list_services'));
    }

}
