@extends('layouts.admin')
  @section('content')
    <!-- table dark start -->
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Valor del dolar</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table id="DataTable" class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th>Valor</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($list_dollars as $dollar)
                            <tr>
                                <td>{{ $dollar->value }}</td>
                                <td class="text-center">
                                    <a href="{{ url('dollars_edit', encrypt($dollar->id)) }}"><i class="menu-icon fa fa-edit"></i></a>
                                </td>

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- table dark end -->

  @endsection