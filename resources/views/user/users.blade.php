@extends('layouts.admin')
  @section('content')

    <div class="row align-items-center" style="margin-top:1%; margin-left:1%">
        <a href="{{route('register')}}"><button type="button" class="btn btn-primary col-lg-offset-12">Agregar Nuevo</button></a>
    </div>

    <!-- table dark start -->
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Usuarios registrados</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table id="DataTable" class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo</th>
                                    <th>Rol</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($list_users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->lastname }}</td>
                                @if($user->email_verified_at == null)
                                <td style="color:red">{{ $user->email }}</td>
                                @else
                                <td>{{ $user->email }}</td>
                                @endif
                                <td>{{ $user->type }}</td>
                                <td class="text-center">
                                    <a href="{{ url('users_edit', encrypt($user->id)) }}"><i class="menu-icon fa fa-edit" title="editar"></i></a>
                                    @if (Auth::user()->type == 'Administrador')
                                        @if($user->type == 'Cliente')
                                            @if($user->status == 'Activo')
                                            <a href="{{ url('users_block', encrypt($user->id)) }}"><i class="menu-icon fa fa-eye" title="bloquear"></i></a>
                                            @elseif($user->status == 'Bloqueado')
                                            <a href="{{ url('users_unlock', encrypt($user->id)) }}"><i class="menu-icon fa fa-eye-slash" title="desbloquear"></i></a>
                                            @endif
                                        @endif
                                    @endif
                                    <a href="{{ url('users_pass', encrypt($user->id)) }}"><i class="menu-icon fa fa-key" title="cambiar clave"></i></a>
                                    @if (Auth::user()->type == 'Administrador')
                                        <a href="{{ url('users_destroy', encrypt($user->id)) }}"><i class="menu-icon fa fa-trash-o" title="eliminar"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- table dark end -->

  @endsection