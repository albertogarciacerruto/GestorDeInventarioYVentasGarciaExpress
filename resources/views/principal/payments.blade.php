@extends('layouts.admin')
  @section('content')

    <div class="row align-items-center" style="margin-top:1%; margin-left:1%">
        <a href="{{url('register_payment')}}"><button type="button" class="btn btn-primary col-lg-offset-12">Agregar Nuevo</button></a>
    </div>

    <!-- table dark start -->
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Formas de pago registrados</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table id="DataTable" class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th>Nombre</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($list_payments as $payment)
                            <tr>
                                <td>{{ $payment->name }}</td>
                                <td class="text-center">
                                    <a href="{{ url('payments_edit', encrypt($payment->id)) }}"><i class="menu-icon fa fa-edit"></i></a>
                                    <a href="{{ url('payments_destroy', encrypt($payment->id)) }}"><i class="menu-icon fa fa-trash-o"></i></a>
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