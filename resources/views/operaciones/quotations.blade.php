@extends('layouts.admin')
  @section('content')

    <div class="row align-items-center" style="margin-top:1%; margin-left:1%">
        <a href="{{url('register_quotation')}}"><button type="button" class="btn btn-primary col-lg-offset-12">Agregar Nuevo</button></a>
    </div>

    <!-- table dark start -->
    <div class="col-12 mt-4">
        @if(isset($mensaje))
            <div class="alert alert-danger" role="alert">{{$mensaje}}</div>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Cotizaciones en sistema</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table id="DataTable" class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th>Fecha Realizada</th>
                                    <th>Fecha Vencimiento</th>
                                    <th>Estado</th>
                                    <th>Solicitador</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($list_quotations as $quotation)
                            <?php $client = \DB::table('clients')->select('name', 'lastname')->where('id', '=', $quotation->client_id)->first(); ?>
                            <tr>
                                <td>{{ $quotation->date_init }}</td>
                                <td>{{ $quotation->date_finish }}</td>
                                <td>{{ $quotation->status }}</td>
                                <td>{{ $client->name }} {{ $client->lastname }}</td>
                                <td class="text-center">
                                    <a href="{{ url('quotations_add', encrypt($quotation->id)) }}"><i class="menu-icon fa fa-plus-square-o" title="editar"></i></a>
                                    <a href="{{ url('quotations_destroy', encrypt($quotation->id)) }}"><i class="menu-icon fa fa-trash-o" title="eliminar"></i></a>
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