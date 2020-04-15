@extends('layouts.admin')
  @section('content')

    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Actualización de datos</h4>
                <form name="frm" method="POST" action="{{ url('clients_edit') }}">
                @csrf
                    <div class="form-group">
                        <input id="id" type="hidden" name="id" value="{{ $client->id }}" readonly="readonly">
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Nombre</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $client->name }}" required autofocus>
                            @if ($errors->has('name'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Apellido</label>
                            <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ $client->lastname }}" required>
                            @if ($errors->has('lastname'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Número de identificación</label>
                            <input id="identification_number" type="text" class="form-control{{ $errors->has('identification_number') ? ' is-invalid' : '' }}" name="identification_number" value="{{ $client->identification_number }}" readonly="readonly" required>
                            @if ($errors->has('identification_number'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('identification_number') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-6">
                        <label class="col-form-label">Correo electrónico</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $client->email }}" required>
                        @if ($errors->has('email'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                        <label class="col-form-label">Telefono</label>
                        <input id="phone" type="text" class="telefono form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $client->phone }}" required>
                        @if ($errors->has('phone'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Dirección</label>
                        <textarea name="address" id="address" rows="2" placeholder="" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}">{{ $client->address }}</textarea>
                        @if ($errors->has('address'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('address') }}</strong>
                            </div>
                        @endif
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