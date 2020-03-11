@extends('layouts.default')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Entradas</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h3 class="mr-auto">ENTRADAS</h3>                                    
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <table class="table-default table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                            <thead class="theade-danger">
                                            <tr>
                                                <th>MOVIMIENTO</th>
                                                <th>PROVEEDOR</th>
                                                <th>FECHA</th>
                                                <th>SUBTOTAL</th>
                                                <th>IVA</th>
                                                <th>DESCUENTO</th>
                                                <th>IMPORTE</th>
                                                <th>OBSERVACIONES</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($entradas as $entrada)
                                                <tr>
                                                    <td class="small">{{ $entrada->movimiento }}</td>
                                                    <td class="small">{{ $entrada->proveedor }}</td>
                                                    <td class="small">{{ $entrada->Fecha }}</td>
                                                    <td class="small">{{ precio($entrada->Subtotal) }}</td>
                                                    <td class="small"> {{ (int)$entrada->Iva }}  </td>
                                                    <td class="small"> {{ $entrada->Descuento }}  </td>
                                                    <td class="small"> {{ $entrada->Importe }}  </td>
                                                    <td class="small"> {{ $entrada->Observaciones }}  </td>
                                                    <td>

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
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
@endsection
