@extends('layouts.admin')
  @section('content')

    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Actualización del valor del dolar</h4>
                <form method="POST" action="{{ url('dollars_edit') }}">
                @csrf
                <div class="mx-auto d-block">
                    <input id="id" type="hidden" name="id" value="{{ $dollar->id }}" readonly="readonly">
                </div>
                <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Valor del dolar</label>
                            <input id="value" type="text" class="form-control{{ $errors->has('value') ? ' is-invalid' : '' }}" name="value" value="{{ $dollar->value }}" required autofocus>
                            @if ($errors->has('value'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('value') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 float-right save">Calcular</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Textual inputs end -->
  @endsection