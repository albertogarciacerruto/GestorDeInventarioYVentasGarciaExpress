@extends('layouts.admin')
  @section('content')
  
    <!-- table dark start -->
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Facturas en sistema</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table id="DataTable" class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th># Orden</th>
                                    <th>Fecha Realizada</th>
                                    <th>Estado</th>
                                    <th>Forma Pago</th>
                                    <th>Cliente</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($list_orders as $order)
                            <?php $client = \DB::table('clients')->select('name', 'lastname')->where('id', '=', $order->client_id)->first(); ?>
                            <tr>
                                <td>OP-{{ $order->id }}</td>
                                <td>{{ $order->date_init }}</td>
                                <td>{{ $order->status }}</td>
                                <td><a href="{{ url('payments', encrypt($order->id)) }}">Ver Pagos</a></td>
                                <td>{{ $client->name }} {{ $client->lastname }}</td>
                                <td class="text-center">
                                    @if($order->status == 'procesando')
                                    <a href="{{ url('orders_edit', encrypt($order->id)) }}"><i class="menu-icon fa fa-edit" title="editar"></i></a>
                                    @else
                                    <a href="{{ url('orders_edit', encrypt($order->id)) }}"><span class="badge badge-pill badge-success">Ver Nota</span></a>
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