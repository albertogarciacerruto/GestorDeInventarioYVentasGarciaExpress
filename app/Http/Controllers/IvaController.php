<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Iva;
use App\Http\Requests\IvaRequest;

class IvaController extends Controller
{
    public function list_iva()
    {
        $list_iva = \DB::table('ivas')->get();
        return view('principal/ivas', compact('list_iva'));
    }
    public function register()
    {
        return view('principal/register_iva');
    }
    public function register_iva(IvaRequest $request)
    {
        $name = $request->name;
        $value = $request->value;
        $iva= \DB::table('ivas')->orderBy('id', 'desc')->first();
        if (is_null($iva)) {
        $nuevo = Iva::create([
        'name' => $request->name,
        'value' => $request->value,
        'user' => \Auth::id(),
        ]);

        $update_status = \DB::table('ivas')->where('id', '=', $nuevo->id)->update(['status' => 'Active']);
        $update_status = \DB::table('ivas')->where('id', '!=', $nuevo->id )->update(['status' => 'Inactive']);
        }
        elseif($name === $iva->name){
        return $this->list_iva();
        }
        else {
        $nuevo = Iva::create([
        'name' => $request->name,
        'value' => $request->value,
        'user' => \Auth::id(),
        ]);
        $update_status = \DB::table('ivas')->where('id', '=', $nuevo->id)->update(['status' => 'Active']);
        $update_status = \DB::table('ivas')->where('id', '!=', $nuevo->id )->update(['status' => 'Inactive']);
        }
        $list_iva = \DB::table('ivas')->get();
        return redirect('iva');
        //return view('iva/iva', compact('list_iva'));
    }
    public function destroy($id_iva)
    {
        try{
            $cod = decrypt($id_iva);
            $consulta = \DB::select("SELECT COUNT(ord.id) AS cantidad FROM orders ord, ivas iv WHERE ord.iva_id = iv.id AND iv.id = '$cod'");
            $query = \DB::select("SELECT COUNT(quo.id) AS cant FROM quotations quo, ivas iv WHERE quo.iva_id = iv.id AND iv.id = '$cod'");

            if($consulta[0]->cantidad == 0 && $query[0]->cant == 0){
                $iva = \DB::table('ivas')->where('id', '=', decrypt($id_iva))->delete();
                $list_iva = \DB::table('ivas')->get();
                return redirect('iva');
            }
            else{
            return view('errors/noiva');
            }
            
            if($query[0]->cant == 0){
                $iva = \DB::table('ivas')->where('id', '=', decrypt($id_iva))->delete();
                $list_iva = \DB::table('ivas')->get();
                return redirect('iva');
            }
            elseif($query[0]->cant > 0){
            return view('errors/noiva');
            }
        }
        catch(\Illuminate\Database\QueryException $ex) {
        return view('errors/iva');
        }
    }
    public function edit($id_iva)
    {
        $iva = \DB::table('ivas')->where('id', '=', decrypt($id_iva))->first();

        return view('principal/edit_iva', compact('iva'));
    }
    public function update(IvaRequest $request)
    {
        $name = $request->name;
        $value = $request->value;
        $id = $request->id;

        $update_data = \DB::table('ivas')->where('id', $id)->update(['name' => $name, 'value' => $value, 'user' => \Auth::id() ]);

        $list_iva = \DB::table('ivas')->get();
        return redirect('iva');
        //return view('iva/iva', compact('list_iva'));
    }
    public function active($id_iva)
    {
        $iva = \DB::table('ivas')->where('id', '=', decrypt($id_iva))->first();
        $update_status = \DB::table('ivas')->where('id', '=', decrypt($id_iva))->update(['status' => 'Active']);
        $update_status = \DB::table('ivas')->where('id', '!=', decrypt($id_iva))->update(['status' => 'Inactive']);

        $list_iva = \DB::table('ivas')->get();
        return redirect()->action('IvaController@list_iva');
        //return view('iva/iva', compact('list_iva'));
    }
}
