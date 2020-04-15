<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientUpdateRequest;

class ClientController extends Controller
{
    public function list_clients()
    {
        $list_clients = \DB::table('clients')->get();
        return view('principal/clients', compact('list_clients'));
    }
    public function register()
    {
        return view('principal/register_client');
    }
    public function register_client(ClientRequest $request)
    {
        $name = $request->name;
        $lastname = $request->lastname;
        $email = $request->email;
        $phone = $request->phone;
        $address = $request->address;
        $identification_number = $request->identification_number;
        $client = Client::orderBy('id', 'desc')->first();

        if (is_null($client)) {
        Client::create([
        'name' => $request->name,
        'lastname' => $request->lastname,
        'email' => $request->email,
        'phone' => $request->phone, 
        'address' => $request->address,
        'identification_number' => $request->identification_number,
        'user' => \Auth::id(),
        ]);
        }
        elseif($identification_number === $client->identification_number){
        return $this->list_clients();
        }
        else {
        Client::create([
        'name' => $request->name,
        'lastname' => $request->lastname,
        'email' => $request->email,
        'phone' => $request->phone, 
        'address' => $request->address,
        'identification_number' => $request->identification_number,
        'user' => \Auth::id(),
        ]);
        }
        $list_clients = \DB::table('clients')->get();
        return redirect('clients');
        //return view('inventarioProductos/locations', compact('list_locations'));
    }
    public function destroy($id_client)
    {
        try{
        $client = \DB::table('clients')->where('id', '=', decrypt($id_client))->delete();

        $list_clients = \DB::table('clients')->get();
        return redirect('clients');
        }
        catch(\Illuminate\Database\QueryException $ex) {
        return view('errors/client');
        }
    }
    public function edit($id_client)
    {
        $client = \DB::table('clients')->where('id', '=', decrypt($id_client))->first();

        return view('principal/edit_client', compact('client'));
    }
    public function update(ClientUpdateRequest $request)
    {
        $id = $request->id;
        $name = $request->name;
        $lastname = $request->lastname;
        $email = $request->email;
        $phone = $request->phone;
        $address = $request->address;
        $identification_number = $request->identification_number;
        $actual = \Auth::id();

        $update_data = \DB::table('clients')->where('id', $id)->update(['name' => $name, 'lastname' => $lastname, 'address' => $address, 'email' => $email, 'phone' => $phone,  'identification_number' => $identification_number, 'user' => $actual]);

        $list_clients = \DB::table('clients')->get();
        return redirect('clients');
        //return view('inventarioProductos/locations', compact('list_locations'));
    }

    public function block($id_client)
    {
      $client = \DB::table('clients')->where('id', '=', decrypt($id_client))->update(['status' => 'Bloqueado']);

      $list_clients = \DB::table('clients')->get();
      return redirect()->action('ClientController@list_clients');
      //return view('user/users', compact('list_users'));
    }
    public function unlock($id_client)
    {
      $client = \DB::table('clients')->where('id', '=', decrypt($id_client))->update(['status' => 'Activo']);

      $list_clients = \DB::table('clients')->get();
      return redirect()->action('ClientController@list_clients');
      //return view('user/users', compact('list_users'));
    }
}
