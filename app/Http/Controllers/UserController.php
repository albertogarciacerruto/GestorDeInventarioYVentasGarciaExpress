<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class UserController extends Controller
{
    public function list_users()
    {
      $list_users = \DB::table('users')->get();
      return view('user/users', compact('list_users'));
    }
    public function destroy($id_user)
    {
      try{
      $user = \DB::table('users')->where('id', '=', decrypt($id_user))->delete();

      $list_users = \DB::table('users')->get();
      return redirect('users');
      }
      catch(\Illuminate\Database\QueryException $ex) {
        return view('errors/user');
      }
    }

    public function block($id_user)
    {
      $user = \DB::table('users')->where('id', '=', decrypt($id_user))->update(['status' => 'Bloqueado']);

      $list_users = \DB::table('users')->get();
      return redirect()->action('UserController@list_users');
      //return view('user/users', compact('list_users'));
    }
    public function unlock($id_user)
    {
      $user = \DB::table('users')->where('id', '=', decrypt($id_user))->update(['status' => 'Activo']);

      $list_users = \DB::table('users')->get();
      return redirect()->action('UserController@list_users');
      //return view('user/users', compact('list_users'));
    }
    public function edit($id_user)
    {
      $user = \DB::table('users')->where('id', '=', decrypt($id_user))->first();

      return view('user/edit_user', compact('user'));
    }
    public function update(Request $request)
    {
      $name = $request->name;
      $lastname = $request->lastname;
      $identification_number = $request->identification_number;
      $email = $request->email;
      $type = $request->type;
      $id = $request->id;

      if ($request->hasFile('image'))
      {
        $foto_perfil = $request->file('image')->store('public');
        $profile = \DB::table('users')->where('id', $id)->update(['image' => $foto_perfil]);
      }
      $update_data = \DB::table('users')->where('id', $id)->update(['name' => $name, 'lastname' => $lastname, 'identification_number' => $identification_number, 'email' => $email, 'type' => $type]);

      $list_users = \DB::table('users')->get();
      return redirect('users');
      //return view('user/users', compact('list_users'));
    }
    public function edit_pass($id_user)
    {
      $user = \DB::table('users')->where('id', '=', decrypt($id_user))->first();

      return view('user/edit_pass', compact('user'));
    }
    public function update_pass(Request $request)
    {
      $password = \Hash::make($request->password);
      $id = $request->id;

      $update_password = \DB::table('users')->where('id', $id)->update(['password' => $password]);

      $list_users = \DB::table('users')->get();

      $user_conected = \Auth::id();
      $user = \DB::table('users')->where('id', $user_conected)->first();
      if($user->type == 'Administrador'){
        return redirect('users');
      }else{
        return view('home');
      }
    }

    public function edit_profile($id_user)
    {
      $user = \DB::table('users')->where('id', '=', decrypt($id_user))->first();

      return view('user/edit_profile', compact('user'));
    }
    public function update_profile(Request $request)
    {
      $name = $request->name;
      $lastname = $request->lastname;
      $email = $request->email;
      $id = $request->id;

      if ($request->hasFile('image'))
      {
        $foto_perfil = $request->file('image')->store('public');
        $profile = \DB::table('users')->where('id', $id)->update(['image' => $foto_perfil]);
      }
      $update_data = \DB::table('users')->where('id', $id)->update(['name' => $name, 'lastname' => $lastname, 'email' => $email]);

      return view('home');
    }
}
