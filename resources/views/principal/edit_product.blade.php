@extends('layouts.admin')
  @section('content')

    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Actualización de datos</h4>
                <form method="POST" action="{{ url('products_edit') }}" enctype="multipart/form-data">
                @csrf
                <div class="mx-auto d-block">
                    <img id="photo" class="rounded-circle mx-auto d-block" src="../../storage/app/{{$product->image}}" width="130" height="130" alt="Mi foto de perfil">
                    <input id="id" type="hidden" name="id" value="{{ $product->id }}" readonly="readonly">
                </div>
                <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Nombre</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $product->name }}" name="name" required autofocus>
                            @if ($errors->has('name'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Imagen</label>
                            <input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" value="{{ $product->image }}" name="image">
                            @if ($errors->has('image'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-form-label">Descripción</label>
                            <textarea name="description" id="description" rows="4" placeholder="" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{ $product->description }}</textarea>
                            @if ($errors->has('description'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </div>
                            @endif
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Precio</label>
                            <input id="amount" type="text" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" value="{{ $product->amount }}" name="amount" required patter="[0-9]+(\.[0-9][0-9]?)?">
                            @if ($errors->has('amount'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 float-right guardar">Modificar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Textual inputs end -->
  @endsection