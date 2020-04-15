@extends('layouts.admin')
  @section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-area">
                            <div class="invoice-head">
                                <div class="row">
                                    <div class="iv-left col-6">
                                        <span>Factura</span>
                                    </div>
                                    <div class="iv-right col-6 text-md-right">
                                        <span>#{{$quotation->id}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="invoice-address">
                                        <h3>{{$client->name}} {{$client->lastname}}</h3>
                                        <h5>{{$client->identification_number}}</h5>
                                        <p>Dirección: {{$client->address}}</p>
                                        <p>Correo: {{$client->email}}</p>
                                        <p>Telefono: {{$client->phone}}</p>
                                        <p>Estatus: {{$quotation->status}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <ul class="invoice-date">
                                        <li>Fecha: {{$order->date_init}}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="invoice-table table-responsive mt-5">
                                <table class="table table-bordered table-hover text-right">
                                    <thead>
                                        <tr class="text-capitalize">
                                            <th scope="col">Producto</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Precio Dolares</th>
                                            <th scope="col">Precio Bolivares</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list_quotations as $quotations)
                                              <?php $inventory = \DB::table('inventories')->select('id','product_id')->where('id', '=', $quotations->inventory_id)->first(); ?>
                                              <?php $product = \DB::table('products')->select('products.id','products.name', 'products.image', 'products.amount', 'products.bsf')->where('products.id', '=', $inventory->product_id)->first(); ?>
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $quotations->quantity }}</td>
                                            <td>{{ number_format($product->amount,2) }}</td>
                                            <td>{{ number_format(($product->amount*$order->dolar_value),2) }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <thead>
                                        <tr class="text-capitalize">
                                            <th scope="col">Servicio</th>
                                            <th scope="col">Descripcion</th>
                                            <th scope="col">Precio Dolares</th>
                                            <th scope="col">Precio Bolivares</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($listServicios as $servicio)
                                    <?php $service = \DB::table('services')->where('id', '=', $servicio->service_id)->first(); ?>
                                        <tr>
                                            <td>{{ $service->name }}</td>
                                            <td>{{ $service->description }}</td>
                                            <td>{{ number_format($servicio->amount,2) }}</td>
                                            <td>{{ number_format(($service->amount*$order->dolar_value),2) }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="2">Total :</td>
                                            <td class="text-left">$ {{ number_format($order->total,2) }}</td>
                                            <td class="text-left">Bs. {{ number_format(($order->total*$order->dolar_value),2) }}</td>
                                        </tr>
                                    </tfoot>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">Balance Total</td>
                                        </tr>
                                    </tfoot>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">I.V.A. :</td>
                                            <td class="text-left">$ {{ number_format($order->iva,2) }}</td>
                                            <td class="text-left">Bs. {{ number_format(($order->iva*$order->dolar_value),2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="invoice-buttons text-right">
                            <a href="{{ url('generate_note', encrypt($order->id)) }}" class="invoice-btn">Imprimir $</a>
                            <a href="{{ url('generate_note_bs', encrypt($order->id)) }}" class="invoice-btn">Imprimir Bs.F</a>
                            <a href="{{ url('payments', encrypt($order->id)) }}" class="invoice-btn">Ver Pagos</a>
                            <a data-toggle="modal" data-target="#newDevolucion" style="color:white" class="invoice-btn">Devolución</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Modal-->
    <div class="modal fade" id="newDevolucion" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Devolución de Pedidos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      ¿Esta seguro de hacer la devolucion del pedido seleccionado?
                      </div>
                      <div class="modal-footer">
                          <a href="{{ url('orders_edit', encrypt($order->id)) }}"><button type="button" class="btn btn-secondary">Cancelar</button></a>
                          <a href="{{ url('devolution', encrypt($order->id)) }}"><button type="button" class="invoice-btn">Procesar Devolución</button></a>
                      </div>
                </div>
            </div>
        </div>

  @endsection