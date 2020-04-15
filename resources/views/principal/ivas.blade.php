@extends('layouts.admin')
  @section('content')

    <div class="row align-items-center" style="margin-top:1%; margin-left:1%">
        <a href="{{url('register_iva')}}"><button type="button" class="btn btn-primary col-lg-offset-12">Agregar Nuevo</button></a>
    </div>

    <!-- table dark start -->
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">IVA´s registrados</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table id="DataTable" class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th>Nombre</th>
                                    <th>Valor Décimal</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($list_iva as $iva)
                            <tr>
                                <td>{{ $iva->name }}</td>
                                <td>{{ $iva->value }}</td>
                                <td class="text-center">
                                    @if ($iva->status == 'Inactive')
                                    <a href="{{ url('iva_active', encrypt($iva->id)) }}"><i class="menu-icon fa fa-times" title="activar"></i></a>
                                    @endif
                                    @if ($iva->status == 'Active')
                                    <a href="{{ url('iva_active', encrypt($iva->id)) }}"><i class="menu-icon fa fa-check" title="desactivar"></i></a>
                                    @endif
                                    <a href="{{ url('iva_edit', encrypt($iva->id)) }}"><i class="menu-icon fa fa-edit" title="editar"></i></a>
                                    @if (Auth::user()->type == 'Administrador')
                                    <a href="{{ url('iva_destroy', encrypt($iva->id)) }}"><i class="menu-icon fa fa-trash-o" title="eliminar"></i></a>
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