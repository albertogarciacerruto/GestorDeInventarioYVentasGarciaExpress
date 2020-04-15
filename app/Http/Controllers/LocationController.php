<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Http\Requests\LocationRequest;

class LocationController extends Controller
{
    public function list_locations()
    {
        $list_locations = \DB::table('locations')->get();
        return view('inventarioProductos/locations', compact('list_locations'));
    }
    public function register()
    {
        return view('inventarioProductos/register_location');
    }
    public function register_location(LocationRequest $request)
    {
        $name = $request->name;
        $store = $request->store;
        $location = Location::orderBy('id', 'desc')->first();

        if (is_null($location)) {
        Location::create([
        'name' => $request->name,
        'store' => $request->store,
        'user' => \Auth::id(),
        ]);
        }
        elseif($store === $location->store){
        return $this->list_locations();
        }
        else {
        Location::create([
        'name' => $request->name,
        'store' => $request->store,
        'user' => \Auth::id(),
        ]);
        }
        $list_locations = \DB::table('locations')->get();
        return redirect('locations');
        //return view('inventarioProductos/locations', compact('list_locations'));
    }
    public function destroy($id_location)
    {
        try{
        $location = \DB::table('locations')->where('id', '=', decrypt($id_location))->delete();

        $list_locations = \DB::table('locations')->get();
        return redirect('locations');
        }
        catch(\Illuminate\Database\QueryException $ex) {
        return view('errors/location');
        }
    }
    public function edit($id_location)
    {
        $location = \DB::table('locations')->where('id', '=', decrypt($id_location))->first();

        return view('inventarioProductos/edit_location', compact('location'));
    }
    public function update(LocationRequest $request)
    {
        $name = $request->name;
        $store = $request->store;
        $id = $request->id;
        $actual = \Auth::id();

        $update_data = \DB::table('locations')->where('id', $id)->update(['name' => $name, 'store' => $store, 'user' => $actual]);

        $list_locations = \DB::table('locations')->get();
        return redirect('locations');
        //return view('inventarioProductos/locations', compact('list_locations'));
    }
}
