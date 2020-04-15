@extends('layouts.admin')
  @section('content')

    <!-- table dark start -->
    <div class="container">
    <div class="col-12 mt-4">
        @if(isset($mensaje))
            <div class="alert alert-danger" role="alert">{{$mensaje}}</div>
        @endif
        @if($quotation->status != 'Cancelado')
        <div class="card-body">
                <h4 class="header-title">Productos:</h4>
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
                                    <th>Cotizar</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($list_inventories as $inventory)
                            <?php $product = \DB::table('products')->select('products.id','products.name', 'products.image', 'products.amount', 'products.bsf')->where('products.id', '=', $inventory->product_id)->first(); ?>
                            <tr>

                                <td class="text-center"><img height="50" width="50" src="../../storage/app/{{$product->image}}" alt="{{ $product->image }}"></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $inventory->total_quantity }}</td>
                                <td>$ {{ number_format($product->amount, 2) }}</td>
                                <td>Bs. {{ number_format($product->bsf, 2) }}</td>
                                <form method="POST" action="{{ url('quotations_add', encrypt($quotation->id)) }}">
                                @csrf
                                    <td>
                                        <input id="product_id" type="hidden" name="product_id" value="{{$product->id}}">
                                        <input id="quantity" type="number" min="1" pattern="^[0-9]+" class=" col-4 input"  name="quantity" pattern="[0-9]+" required>
                                        <button type="submit" class=" btn boton btn_cargar">Cargar</button>
                                    </td>
                                </form>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    </div>
    
    <!-- table dark end -->

    <!-- table dark start -->
    <div class="container">
    <div class="col-12 mt-4">
        @if($quotation->status != 'Cancelado')
        <div class="card-body">
                <h4 class="header-title">Servicios:</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table id="DataTableTwo" class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio Dolares</th>
                                    <th>Precio Bolivares</th>
                                    <th>Agregar</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($list_services as $service)
                            <tr>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->description }}</td>
                                <td>$ {{ number_format($service->amount, 2) }}</td>
                                <td>Bs. {{ number_format($service->bsf, 2) }}</td>
                                <form method="POST" action="{{ url('services_add', encrypt($quotation->id)) }}">
                                @csrf
                                    <td>
                                        <input id="service_id" type="hidden" name="service_id" value="{{$service->id}}">
                                        <button type="submit" class=" btn boton btn_cargar">Agregar</button>
                                    </td>
                                </form>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    </div>
    
    <!-- table dark end -->


    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-area">
                            <div class="invoice-head">
                                <div class="row">
                                    <div class="iv-left col-6">
                                        <span>Cotización</span>
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
                                        <li>Fecha solicitud : {{$quotation->date_init}}</li>
                                        <li>Fecha vencimiento : {{$quotation->date_finish}}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="invoice-table table-responsive mt-5">
                                <table class="table table-bordered table-hover text-right">
                                    <thead>
                                        <tr class="text-capitalize">
                                            <th scope="col">Producto</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Precio $</th>
                                            <th scope="col">Precio Bs.F</th>
                                            @if($quotation->status != 'Cancelado')
                                            <th scope="col" class="text-center">¿Eliminar?</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list_quotations as $quotations)
                                    <?php $inventory = \DB::table('inventories')->select('id','product_id')->where('id', '=', $quotations->inventory_id)->first(); ?>
                                    <?php $product = \DB::table('products')->select('products.id','products.name', 'products.image', 'products.amount', 'products.bsf')->where('products.id', '=', $inventory->product_id)->first(); ?>
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $quotations->quantity }}</td>
                                            <td>{{  number_format($product->amount,2) }}</td>
                                            <td>{{  number_format(($product->amount*$quotation->dolar_value),2) }}</td>
                                            @if($quotation->status != 'Cancelado')
                                            <td class="text-center">
                                            <a href="{{ url('quotation_destroy', array(encrypt($quotation->id), encrypt($inventory->id))) }}"><i class="menu-icon fa fa-trash-o" title="eliminar"></i></a>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <thead>
                                        <tr class="text-capitalize">
                                            <th scope="col">Servicio</th>
                                            <th scope="col">Descripcion</th>
                                            <th scope="col">Precio $</th>
                                            <th scope="col">Precio Bs.F</th>
                                            @if($quotation->status != 'Cancelado')
                                            <th scope="col" class="text-center">¿Eliminar?</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($listServicios as $servicio)
                                    <?php $service = \DB::table('services')->where('id', '=', $servicio->service_id)->first(); ?>
                                        <tr>
                                            <td>{{ $service->name }}</td>
                                            <td>{{ $service->description }}</td>
                                            <td>{{  number_format($service->amount,2) }}</td>
                                            <td>{{  number_format(($service->amount*$quotation->dolar_value),2) }}</td>
                                            @if($quotation->status != 'Cancelado')
                                            <td class="text-center">
                                            <a href="{{ url('service_destroy', array(encrypt($quotation->id), encrypt($service->id))) }}"><i class="menu-icon fa fa-trash-o" title="eliminar"></i></a>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="3">Total :</td>
                                            <td class="text-left">$ {{ number_format($quotation->total,2) }}</td>
                                            <td class="text-left">Bs. {{ number_format(($quotation->total*$quotation->dolar_value),2) }}</td>
                                        </tr>
                                    </tfoot>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">Balance Total</td>
                                        </tr>
                                    </tfoot>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">I.V.A. :</td>
                                            <td class="text-left">$ {{ number_format($quotation->iva,2)}}</td>
                                            <td class="text-left">Bs. {{ number_format(($quotation->iva*$quotation->dolar_value),2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="invoice-buttons text-right">
                            <a href="{{ url('print_quotation', encrypt($quotation->id)) }}" class="invoice-btn">Imprimir $</a>
                            <a href="{{ url('print_quotation_bs', encrypt($quotation->id)) }}" class="invoice-btn">Imprimir Bs.F</a>
                            @if($quotation->status != 'Cancelado')
                            <a href="{{ url('register_order', encrypt($quotation->id)) }}" class="invoice-btn">Facturar</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  @endsection