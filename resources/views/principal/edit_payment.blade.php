@extends('layouts.admin')
  @section('content')

    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Actualización de datos</h4>
                <form method="POST" action="{{ url('payments_edit') }}">
                @csrf
                <div class="mx-auto d-block">
                    <input id="id" type="hidden" name="id" value="{{ $payment->id }}" readonly="readonly">
                </div>
                <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Nombre o referencia</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $payment->name }}" required autofocus>
                            @if ($errors->has('name'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
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