@extends('layouts.admin')
  @section('content')

    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Registro de almacenes</h4>
                <form method="POST" action="{{ url('register_location') }}">
                @csrf
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Almacén</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="Principal" autofocus>
                            @if ($errors->has('name'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Estante</label>
                            <input id="store" type="text" class="form-control{{ $errors->has('store') ? ' is-invalid' : '' }}" name="store" value="{{ old('store') }}">
                            @if ($errors->has('store'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('store') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 float-right">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Textual inputs end -->
    

  @endsection

