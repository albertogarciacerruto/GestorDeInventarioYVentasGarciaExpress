@extends('layouts.admin')
  @section('content')

   <!-- table dark start -->
   <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Confirmación de eliminación de pago</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Monto $</th>
                                    <th scope="col">Monto Bs.F</th>
                                    <th scope="col">Banco</th>
                                    <th scope="col">Confirmación</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $dolar = \DB::table('orders')->select('dolar_value')->where('id', $pay->order_id)->first();?>
                            <tr>
                                <td>{{$pay->date}}</td>
                                <td>$ {{ number_format($pay->amount,2) }}</td>
                                <td>Bs. {{ number_format(($pay->amount*$dolar->dolar_value),2) }}</td>
                                <td>{{$pay->bank}}</td>
                                <td>{{$pay->confirmation}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row text-center" style="margin-left:2%; margin-bottom:1%">
                <a href="{{ url('payment_delete', encrypt($pay->id)) }}"><button type="button" class="btn btn-primary">Eliminar</button></a>
                <a href="{{ url('orders_edit', encrypt($pay->order_id)) }}" style="margin-left:0.5%"><button type="button" class="btn btn-danger">Cancelar</button></a>
            </div>
        </div>
    </div>
    <!-- table dark end -->

  @endsection