@extends('layouts.admin')
  @section('content')

    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
    @if(isset($mensaje))
        <div class="alert alert-danger" role="alert">{{$mensaje}}</div>
    @endif
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Registro de pago</h4>
                <form method="POST" action="{{ url('payment_insert') }}" enctype="multipart/form-data" accept="image/*">
                @csrf
                        <div class="form-group col-lg-6">
                            <input id="id_order" type="hidden" name="id_order" value="{{ $id_order }}" readonly="readonly">
                        </div>
                        <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Forma de pago</label>
                            <select id="payment_id" name="payment_id" name="type" class="form-control">
                                  <option selected disabled>Selecciona Método de Pago:</option>
                              @foreach($list_payments as $payment)
                                  <option value="{{ $payment->id }}">{{$payment->name}}</option>
                              @endforeach
                              </select>
                        </div>
                        
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Banco</label>
                            <select data-placeholder="Banco..." class="form-control" id="bank" name="bank" >
                                <option selected disabled>Selecciona Banco:</option>
                                <optgroup label="Nacional">
                                <option value="Mercantil">Mercantil</option>
                                <option value="Provincial">Provincial</option>
                                <option value="Banesco">Banesco</option>
                                <option value="Nacional de credito">Nacional de Crédito</option>
                                <option value="Tesoro">Tesoro</option>
                                <option value="BanCaribe">BanCaribe</option>
                                <option value="Venezolano de credito">Venezolano de Crédito</option>
                                <option value="Exterior">Exterior</option>
                                <option value="Bicentenario">Bicentenario</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Activo">Activo</option>
                                <option value="Fondo Comun">Fondo Común</option>
                                <option value="Otros">Otros en moneda nacional</option>
                                </optgroup>
                                <optgroup label="Moneda Extranjera">
                                <option value="Banco $">Banco $ </option>
                                <option value="Zelle">Zelle</option>
                                
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Número de confirmación</label>
                            <input id="confirmation" type="text" class="form-control{{ $errors->has('confirmation') ? ' is-invalid' : '' }}" name="confirmation" value="{{ old('confirmation') }}">
                            @if ($errors->has('confirmation'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('confirmation') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6">
                            <label class="col-form-label">Comprobante (Opcional)</label>
                            <input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" accept="image/*">
                            @if ($errors->has('image'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">   
                            <label class="col-form-label">Monto</label>
                            <input id="amount" type="text" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}">
                            @if ($errors->has('amount'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-lg-6">
                            <div class="col-auto my-1" style="padding-top: 6%">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="isDolar" value="dolar">
                                    <label class="custom-control-label" for="customControlAutosizing">Dolar</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Comentario (Opcional)</label>
                        <textarea name="suggestion" id="suggestion" rows="2" placeholder="" class="form-control{{ $errors->has('suggestion') ? ' is-invalid' : '' }}">{{ old('suggestion') }}</textarea>
                        @if ($errors->has('suggestion'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('suggestion') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 float-right guardar">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Textual inputs end -->
    
  @endsection

