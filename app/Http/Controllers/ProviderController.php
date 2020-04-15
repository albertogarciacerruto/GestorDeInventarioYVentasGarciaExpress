<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;
use App\Http\Requests\ProviderRequest;
use App\Http\Requests\ProviderUpdateRequest;

class ProviderController extends Controller
{
    public function list_providers()
    {
        $list_providers = \DB::table('providers')->get();
        return view('principal/providers', compact('list_providers'));
    }
    public function register()
    {
        return view('principal/register_provider');
    }
    public function register_provider(ProviderRequest $request)
    {
        $rif = $request->rif;
        $name = $request->name;
        $address = $request->address;
        $email = $request->email;
        $phone = $request->phone;
        $who = \Auth::id();
        $provider = Provider::orderBy('id', 'desc')->first();

        if (is_null($provider)) {
        Provider::create([
        'rif' => $request->rif,
        'name' => $request->name,
        'address' => $request->address,
        'email' => $request->email,
        'phone' => $request->phone,
        'user' => $who,
        ]);
        }
        elseif($rif === $provider->rif){
        return $this->list_providers();
        }
        else {
        Provider::create([
        'rif' => $request->rif,
        'name' => $request->name,
        'address' => $request->address,
        'email' => $request->email,
        'phone' => $request->phone,
        'user' => $who,
        ]);
        }
        $list_providers = \DB::table('providers')->get();
        return redirect('providers');
        //return view('suministro/providers', compact('list_providers'));
    }
    public function destroy($id_provider)
    {
        try{
        $provider = \DB::table('providers')->where('id', '=', decrypt($id_provider))->delete();

        $list_providers = \DB::table('providers')->get();
        return redirect('providers');
        }
        catch(\Illuminate\Database\QueryException $ex) {
        return view('errors/provider');
        }
    }
    public function edit($id_provider)
    {
        $provider = \DB::table('providers')->where('id', '=', decrypt($id_provider))->first();

        return view('principal/edit_provider', compact('provider'));
    }
    public function update(ProviderUpdateRequest $request)
    {
        $rif = $request->rif;
        $name = $request->name;
        $address = $request->address;
        $email = $request->email;
        $phone = $request->phone;
        $id = $request->id;
        $who = \Auth::id();
        $update_data = \DB::table('providers')->where('id', $id)->update(['rif' => $rif, 'name' => $name, 'address' => $address, 'email' => $email, 'phone' => $phone, 'user' => $who ]);

        $list_providers = \DB::table('providers')->get();
        return redirect('providers');
        //return view('suministro/providers', compact('list_providers'));
    }
}
