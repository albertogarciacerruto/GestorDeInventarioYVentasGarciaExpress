@extends('layouts.admin')
  @section('content')

    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Actualización de datos</h4>
                <form method="POST" action="{{ url('providers_edit') }}">
                @csrf
                <div class="mx-auto d-block">
                    <input id="id" type="hidden" name="id" value="{{ $provider->id }}" readonly="readonly">
                </div>
                <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Razón Social</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $provider->name }}" name="name" required autofocus>
                            @if ($errors->has('name'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">RIF</label>
                            <input id="rif" type="text" class="form-control{{ $errors->has('rif') ? ' is-invalid' : '' }}" value="{{ $provider->rif }}" name="rif" pattern="^([VEJPG]{1})([0-9]{7,9})$" required>
                            @if ($errors->has('rif'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('rif') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="col-form-label">Dirección</label>
                            <textarea name="address" id="address" rows="2" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" required>{{ $provider->address }}</textarea>
                            @if ($errors->has('address'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </div>
                            @endif
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Correo Electrónico</label>
                            <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $provider->email }}" name="email">
                            @if ($errors->has('email'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Teléfono</label>
                            <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ $provider->phone }}" name="phone" pattern="[0-9]{11}" required>
                            @if ($errors->has('phone'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('phone') }}</strong>
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