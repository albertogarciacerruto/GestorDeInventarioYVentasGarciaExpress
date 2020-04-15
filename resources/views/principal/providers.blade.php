@extends('layouts.admin')
  @section('content')

    <div class="row align-items-center" style="margin-top:1%; margin-left:1%">
        <a href="{{url('register_provider')}}"><button type="button" class="btn btn-primary col-lg-offset-12">Agregar Nuevo</button></a>
    </div>

    <!-- table dark start -->
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Almacenes registrados</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table id="DataTable" class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th>RIF</th>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($list_providers as $provider)
                            <tr>
                                <td>{{ $provider->rif }}</td>
                                <td>{{ $provider->name }}</td>
                                <td>{{ $provider->address }}</td>
                                <td>{{ $provider->email }}</td>
                                <td>{{ $provider->phone }}</td>
                                <td class="text-center">
                                    <a href="{{ url('provider_edit', encrypt($provider->id)) }}"><i class="menu-icon fa fa-edit" title="editar"></i></a>
                                    <a href="{{ url('provider_destroy', encrypt($provider->id)) }}"><i class="menu-icon fa fa-trash-o" title="eliminar"></i></a>
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