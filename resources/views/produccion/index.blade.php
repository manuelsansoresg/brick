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
                        <li class="breadcrumb-item"><a href="#">INICIO</a></li>
                        <li class="breadcrumb-item active">PRODUCCIÓN</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h3 class="mr-auto">LISTA DE PRODUCCIÓN</h3>
                                <div>
                                    <a href="/admin/produccion/create" class="btn btn-block btn-primary btn-sm"><i class="far fa-file"></i> AGREGAR</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-pendiente-tab" data-toggle="pill" href="#pills-pendiente" role="tab" aria-controls="pills-pendiente" aria-selected="true">PENDIENTE</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-proceso-tab" data-toggle="pill" href="#pills-proceso" role="tab" aria-controls="pills-proceso" aria-selected="false">EN PROCESO</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-terminado-tab" data-toggle="pill" href="#pills-terminado" role="tab" aria-controls="pills-terminado" aria-selected="false">TERMINADO</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-pendiente" role="tabpanel" aria-labelledby="pills-pendiente-tab">
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
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="pills-proceso" role="tabpanel" aria-labelledby="pills-proceso-tab">
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
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="pills-terminado" role="tabpanel" aria-labelledby="pills-terminado-tab">
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
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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