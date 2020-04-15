@extends('layouts.admin')
  @section('content')

    <div class="row align-items-center" style="margin-top:1%; margin-left:1%">
        <a href="{{url('register_client')}}"><button type="button" class="btn btn-primary col-lg-offset-12">Agregar Nuevo</button></a>
    </div>

    <!-- table dark start -->
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Clientes registrados</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table id="DataTable" class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Cedula</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($list_clients as $client)
                            <tr>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->lastname }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->phone }}</td>
                                <td>{{ $client->identification_number }}</td>
                                <td class="text-center">
                                    <a href="{{ url('clients_edit', encrypt($client->id)) }}"><i class="menu-icon fa fa-edit" title="editar"></i></a>
                                    @if (Auth::user()->type == 'Administrador')
                                        @if($client->status == 'Activo')
                                        <a href="{{ url('clients_block', encrypt($client->id)) }}"><i class="menu-icon fa fa-eye" title="bloquear"></i></a>
                                        @elseif($client->status == 'Bloqueado')
                                        <a href="{{ url('clients_unlock', encrypt($client->id)) }}"><i class="menu-icon fa fa-eye-slash" title="desbloquear"></i></a>
                                        @endif
                                    @endif
                                    @if (Auth::user()->type == 'Administrador')
                                        <a href="{{ url('clients_destroy', encrypt($client->id)) }}"><i class="menu-icon fa fa-trash-o" title="eliminar"></i></a>
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