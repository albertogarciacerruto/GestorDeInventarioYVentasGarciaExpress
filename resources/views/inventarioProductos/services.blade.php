@extends('layouts.admin')
  @section('content')

    <div class="row align-items-center" style="margin-top:1%; margin-left:1%">
        <a href="{{url('register_service')}}"><button type="button" class="btn btn-primary col-lg-offset-12">Agregar Nuevo</button></a>
    </div>

    <!-- table dark start -->
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Servicios registrados</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table id="DataTable" class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio Dolares</th>
                                    <th>Precio Bolivares</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($list_services as $service)
                            <tr>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->description }}</td>
                                <td>$ {{ number_format($service->amount, 2) }} </td>
                                <td>Bs. {{ number_format($service->bsf, 2) }} </td>
                                <td class="text-center">
                                    <a href="{{ url('services_edit', encrypt($service->id)) }}"><i class="menu-icon fa fa-edit" title="editar"></i></a>
                                    @if (Auth::user()->type == 'Administrador')
                                    <a href="{{ url('services_destroy', encrypt($service->id)) }}"><i class="menu-icon fa fa-trash-o" title="eliminar"></i></a>
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