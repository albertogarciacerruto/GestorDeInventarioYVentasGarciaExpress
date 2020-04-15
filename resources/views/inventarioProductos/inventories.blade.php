@extends('layouts.admin')
  @section('content')
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
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Precio Dolares</th>
                                    <th>Precio Bolivares</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($list_inventories as $inventory)
                            <?php $product = \DB::table('products')->select('products.name', 'products.image', 'products.amount', 'products.bsf')->where('products.id', '=', $inventory->product_id)->first(); ?>
                            <tr>
                                <td class="text-center"><img height="50" width="50" src="../storage/app/{{$product->image}}" alt="{{ $product->image }}"></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $inventory->total_quantity }}</td>
                                <td>$ {{ number_format($product->amount, 2) }} </td>
                                <td>Bs. {{ number_format($product->bsf, 2) }} </td>
                                <td class="text-center">
                                    @if (Auth::user()->type == 'Administrador')
                                    <a href="{{ url('inventories_view', encrypt($inventory->product_id)) }}"><i class="menu-icon fa fa-book" title="ver"></i></a>
                                    @elseif (Auth::user()->type == 'Cliente' || Auth::user()->type == 'Vendedor')
                                    No Disponible
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