@extends('layouts.admin')
  @section('content')

    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Registro de proveedores</h4>
                <form method="POST" action="{{ url('register_provider') }}">
                @csrf
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Razón Social</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus>
                            @if ($errors->has('name'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">RIF</label>
                            <input id="rif" type="text" class="form-control{{ $errors->has('rif') ? ' is-invalid' : '' }}" value="{{ old('rif') }}" name="rif" pattern="^([VEJPG]{1})([0-9]{7,9})$" required>
                            @if ($errors->has('rif'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('rif') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-form-label">Dirección</label>
                            <textarea name="address" id="address" rows="2" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}">{{ old('address') }}</textarea>
                            @if ($errors->has('address'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </div>
                            @endif
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Correo electrónico</label>
                            <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" name="email" pattern="[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9.-]+">
                            @if ($errors->has('email'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Teléfono</label>
                            <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" name="phone">
                            @if ($errors->has('phone'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('phone') }}</strong>
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

