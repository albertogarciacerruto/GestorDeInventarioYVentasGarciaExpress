@extends('layouts.admin')
  @section('content')

    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Actualización de datos</h4>
                <form method="POST" action="{{ url('inventories_edit') }}">
                @csrf
                    <div class="mx-auto d-block">
                        <img class="rounded-circle mx-auto d-block" src="../../storage/app/{{$product->image}}" width="130" height="130" alt="{{ $product->image }}">
                        <input id="inventory_id" type="hidden" name="inventory_id" value="{{$inventory->id}}" readonly="readonly">
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Cantidad</label>
                            <input id="quantity" type="text" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" value="{{$inventory->quantity}}" name="quantity" readonly="readonly">
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Apellido</label>
                            <select id="location_id" name="location_id" value="{{ old('location_id') }}" class="form-control">
                            <?php $list_locations = \DB::table('locations')->get(); ?>
                            @foreach($list_locations as $location)
                                @if(isset($location))
                                <option value="{{$location->id}}">{{$location->name}} - {{$location->store}}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <a href="{{ url('/inventories') }}"><button type="submit" class="btn btn-danger mt-4 pr-4 pl-4 float-left">Cancelar</button></a>
                        </div>
                        <div class="form-group col-6">
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 float-right">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Textual inputs end -->
    

  @endsection