@extends('layouts.admin')
  @section('content')

    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Abastecer inventario</h4>
                <form method="POST" action="{{ url('register_inventory') }}">
                @csrf
                <div class="mx-auto d-block">
                    <img class="rounded-circle mx-auto d-block" src="../../storage/app/{{$product->image}}" width="130" height="130" alt="Mi foto de perfil">
                    <input id="product_id" type="hidden" name="product_id" value="{{$product->id}}" readonly="readonly">
                </div>
                <div class="form-group">
                        <label class="col-form-label">Producto</label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $product->name }} - {{ $product->description }}" readonly="readonly">
                </div>
                <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Cantidad</label>
                            <input id="quantity" type="number" min="1" pattern="^[0-9]+" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" value="{{ old('quantity') }}">
                            @if ($errors->has('quantity'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('quantity') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Ubicación</label>
                            <select id="location_id" name="location_id" value="{{ old('location_id') }}" class="form-control">
                            <?php $list_locations = DB::table('locations')->get(); ?>
                            @foreach($list_locations as $location)
                                @if(isset($location))
                                <option value="{{$location->id}}">{{$location->name}} - {{$location->store}}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 float-right">Abastecer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Textual inputs end -->
  @endsection