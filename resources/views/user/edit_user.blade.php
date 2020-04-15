@extends('layouts.admin')
  @section('content')

    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Actualización de datos</h4>
                <form name="frm" method="POST" action="{{ url('users_edit') }}">
                @csrf
                    <div class="form-group">
                    <img id="photo" class="rounded-circle mx-auto d-block" src="../../storage/app/{{$user->image}}" width="130" height="130" alt="Mi foto de perfil">
                    <input id="id" type="hidden" name="id" value="{{ $user->id }}" readonly="readonly">
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Nombre</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>
                            @if ($errors->has('name'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Apellido</label>
                            <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ $user->lastname }}" required>
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
                            <input id="identification_number" type="text" class="form-control{{ $errors->has('identification_number') ? ' is-invalid' : '' }}" name="identification_number" value="{{ $user->identification_number }}" readonly="readonly" required>
                            @if ($errors->has('identification_number'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('identification_number') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Rol</label>
                            <input id="type" type="text" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{ $user->type }}" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Correo electrónico</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>
                        @if ($errors->has('email'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
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