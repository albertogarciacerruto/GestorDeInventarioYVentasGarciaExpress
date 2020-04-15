@extends('layouts.admin')
  @section('content')

    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Detalles del producto</h4>
                <div class="mx-auto d-block">
                    <img class="rounded-circle mx-auto d-block" src="../../storage/app/{{$product->image}}" alt="{{ $product->image }}" width="130" height="130" alt="Mi foto de perfil">
                </div>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label class="col-form-label">Nombre</label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $product->name }}" name="name" readonly="readonly">
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="col-form-label">Precio Dolares</label>
                        <input id="amount" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ number_format($product->amount, 2) }}" name="amount" readonly="readonly">
                    </div>    
                </div>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label class="col-form-label">Precio Bolivares</label>
                        <input id="bsf" type="text" class="form-control{{ $errors->has('bsf') ? ' is-invalid' : '' }}" value="{{ number_format($product->bsf, 2) }}" name="bsf" readonly="readonly">
                    </div>    
                </div>
                <div class="form-group">
                    <label class="col-form-label">Descripción</label>
                    <textarea name="description" id="description" rows="4" placeholder="" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" readonly="readonly">{{ $product->description }}</textarea>
                </div>       
            </div>
        </div>
    </div>
    <!-- Textual inputs end -->

    <!-- table dark start -->
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Lotes registrados</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table id="DataTable" class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th>Ubicación</th>
                                    <th>Lote</th>
                                    <th>Fecha</th>
                                    <th>Cantidad</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($details as $detail)
                            @if($detail->quantity > 0)
                            <?php $batch = \DB::table('batches')->select('batches.iden', 'batches.id', 'batches.date')->where('batches.id', '=', $detail->batch_id)->first(); ?>
                            <?php $location = \DB::table('locations')->select('locations.name')->where('locations.id', '=', $detail->location_id)->first(); ?>
                            <tr>
                                <td>{{ $location->name }}</td>
                                <td>{{ $batch->iden }}</td>
                                <td>{{ $batch->date }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td class="text-center">
                                    <a href="{{ url('inventories_edit', encrypt($detail->id)) }}"><i class="menu-icon fa fa-edit" title="editar"></i></a>
                                    <a href="{{ url('inventories_destroy', [encrypt($detail->id), encrypt($detail->product_id)]) }}"><i class="menu-icon fa fa-trash-o" title="eliminar"></i></a>
                                </td>
                            </tr>
                            @endif
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