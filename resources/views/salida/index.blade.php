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
                        <li class="breadcrumb-item active">SALIDAS\REMISION</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h3 class="mr-auto">SALIDAS\REMISION</h3>                                    
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <table class="table-default table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead class="theade-danger">
                                            <tr>
                                                <th>No.PEDIDO</th>
                                                <th>NOMBRE CLIENTE</th>
                                                <th>FECHA</th>
                                                <th>FECHA DE ENTREGA</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pedido_terminados as $pedido_terminado)
                                            <tr>
                                                <td>{{ $pedido_terminado->IdPedido }}</td>
                                                <td>{{ $pedido_terminado->Nombre }}</td>
                                                <td>{{ date('Y-m-d', strtotime($pedido_terminado->created_at)) }}</td>
                                                <td>{{ date('Y-m-d', strtotime($pedido_terminado->FechaEntrega)) }}</td>
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