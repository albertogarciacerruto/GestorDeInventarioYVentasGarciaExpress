@extends('layouts.admin')
  @section('content')

    <div class="row align-items-center" style="margin-top:1%; margin-left:1%">
        <a href="{{url('register_product')}}"><button type="button" class="btn btn-primary col-lg-offset-12">Agregar Nuevo</button></a>
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
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio Dolares</th>
                                    <th>Precio Bolivares</th>
                                    <th>Imagen</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($list_products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>$ {{ number_format($product->amount, 2) }} </td>
                                <td>Bs. {{ number_format($product->bsf, 2) }} </td>
                                <td class="text-center"><img height="50" width="50" src="../storage/app/{{$product->image}}" alt="{{ $product->image }}"></td>
                                <td class="text-center">
                                    <a href="{{ url('products_edit', encrypt($product->id)) }}"><i class="menu-icon fa fa-edit" title="editar"></i></a>
                                    <!--<a href="{{ url('products_view', encrypt($product->id)) }}"><i class="menu-icon fa fa-info-circle" title="info"></i></a>-->
                                    @if (Auth::user()->type == 'Administrador')
                                    <a href="{{ url('products_destroy', encrypt($product->id)) }}"><i class="menu-icon fa fa-trash-o" title="eliminar"></i></a>
                                    @endif
                                    <!--<a href="{{ url('products_barcode', encrypt($product->id)) }}"><i class="menu-icon fa fa-barcode" title="codigo barras"></i></a>-->
                                    <a href="{{ url('products_upload', encrypt($product->id)) }}"><i class="menu-icon fa fa-tag" title="abastecer inventario"></i></a>
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