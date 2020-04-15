@extends('layouts.admin')
  @section('content')

    <div class="row align-items-center" style="margin-top:1%; margin-left:1%">
        <a href="{{url('register_location')}}"><button type="button" class="btn btn-primary col-lg-offset-12">Agregar Nuevo</button></a>
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
                                    <th>Almacén</th>
                                    <th>Estante</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($list_locations as $location)
                            <tr>
                                <td>{{ $location->name }}</td>
                                @if($location->store != null)
                                <td>{{ $location->store }}</td>
                                @elseif($location->store == null)
                                <td>N/A</td>
                                @endif
                                <td class="text-center">
                                    <a href="{{ url('locations_edit', encrypt($location->id)) }}"><i class="menu-icon fa fa-edit" title="editar"></i></a>
                                    <a href="{{ url('locations_destroy', encrypt($location->id)) }}"><i class="menu-icon fa fa-trash-o" title="eliminar"></i></a>
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