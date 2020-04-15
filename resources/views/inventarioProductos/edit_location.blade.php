@extends('layouts.admin')
  @section('content')

    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Actualización de datos</h4>
                <form method="POST" action="{{ url('locations_edit') }}">
                @csrf
                    <div class="form-group">
                        <input id="id" type="hidden" name="id" value="{{ $location->id }}" readonly="readonly">
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Almacén</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $location->name }}" name="name" required autofocus>
                            @if ($errors->has('name'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Estante</label>
                            <input id="store" type="text" class="form-control{{ $errors->has('store') ? ' is-invalid' : '' }}" name="store" value="{{ $location->store }}">
                            @if ($errors->has('store'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('store') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 float-right">Modificar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Textual inputs end -->
    

  @endsection