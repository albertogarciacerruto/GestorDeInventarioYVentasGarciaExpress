@extends('layouts.admin')
  @section('content')

  @if($msj == 'no pagado')
    @if($orden->status != 'Devuelto')
    <div class="row align-items-center" style="margin-top:1%; margin-left:1%">
        <a href="{{url('register_pay', encrypt($order))}}"><button type="button" class="btn btn-primary col-lg-offset-12">Nuevo Pago</button></a>
    </div>
    @endif
  @endif
   <!-- table dark start -->
   <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Totales</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th>Pagado: </th>
                                    <th>Diferencia:</th>
                                    <th>Total:</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td> $ {{  number_format($pagado,2) }} </td>
                                <td> $ {{  number_format($diferencia,2) }} </td>
                                <td> $ {{  number_format($orden->total,2) }} </td>
                            </tr>
                            <tr>
                                <td> Bs. {{  number_format(($pagado*$orden->dolar_value),2) }} </td>
                                <td> Bs. {{  number_format(($diferencia*$orden->dolar_value),2) }} </td>
                                <td> Bs. {{  number_format(($orden->total*$orden->dolar_value),2) }} </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- table dark end -->
    <!-- table dark start -->
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Pagos Registrados</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table id="DataTable" class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th>Fecha</th>
                                    <th>Banco</th>
                                    <th>$</th>
                                    <th>Bs.F</th>
                                    <th>N° Confirmación</th>
                                    <th>Forma pago</th>
                                    <th>Ver</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($list_payments as $payment)
                            <?php $pay = \DB::table('payments')->select('name')->where('id', $payment->payment_id)->first();?>
                            <tr>
                                <td>{{ $payment->date }}</td>
                                <td>{{ $payment->bank }}</td>
                                <td>$ {{ number_format($payment->amount,2) }}</td>
                                <td>Bs. {{ number_format(($payment->amount*$orden->dolar_value),2) }}</td>
                                <td>{{ $payment->confirmation}}</td>
                                <td>{{ $pay->name}}</td>
                                @if($payment->image == 'public/default-c.png')
                                <td class="text-center">No</td>
                                @else
                                <td class="text-center"><a href="{{ url('download', encrypt($payment->image)) }}"><i class="menu-icon fa fa-cloud-download" title="descargar"></i></a></td>
                                @endif
                                <td class="text-center">
                                    @if($msj == 'no pagado')
                                    @if (Auth::user()->type == 'Administrador')
                                        @if(isset($payment))
                                        <a href="{{ url('verify', encrypt($payment->id)) }}"><i class="menu-icon fa fa-trash" title="eliminar"></i></a>
                                        @endif
                                    @else
                                        No Disponible
                                    @endif
                                    @else
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