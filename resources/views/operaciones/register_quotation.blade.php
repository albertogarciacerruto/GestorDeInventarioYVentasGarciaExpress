@extends('layouts.admin')
  @section('content')
    <!--Para Select con buscador-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>

    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Generar cotización</h4>
                <form method="POST" action="{{ url('register_quotation') }}">
                @csrf
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Fecha</label>
                            <input id="datetime-local" type="date" class="form-control datepicker" placeholder="Fecha" min="{{$min}}" max="{{$max}}" name="date" value="{{ old('date') }}" required>
                            @if ($errors->has('date'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('date') }}</strong>
                                </div>
                            @endif
                        </div>
                        @if (Auth::user()->type == 'Administrador' || Auth::user()->type == 'Vendedor')
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Cliente</label>
                            <select data-placeholder="Cliente..."  class="selectpicker" data-live-search="true" tabindex="1" id="client_id" name="client_id" >
                              @foreach($list_clients as $client)
                                  <option value="{{ $client->id }}">{{$client->name}}  {{$client->lastname}} - {{$client->identification_number}}</option>
                              @endforeach
                              </select>
                        </div>
                        @endif
                        @if (Auth::user()->type == 'Cliente')
                        <?php $id = \Auth::id(); ?>
                        <div class="form-group">
                            <input id="client_id" type="hidden" name="client_id" value="{{ $id }}" readonly="readonly">
                        </div>
                        @endif
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

