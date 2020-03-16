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
                                            <a class="nav-link {{ (!isset($_GET['step']))? 'active' :  '' }}" id="pills-pendiente-tab" data-toggle="pill" href="#pills-pendiente" role="tab" aria-controls="pills-pendiente"  >PENDIENTE</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ (isset($_GET['step']) && $_GET['step'] == 'process' )? 'active' :  '' }}" id="pills-proceso-tab" data-toggle="pill" href="#pills-proceso" role="tab" aria-controls="pills-proceso" aria-selected="true" >EN PROCESO</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ (isset($_GET['step']) && $_GET['step'] == 'finish' )? 'active' :  '' }}" id="pills-terminado-tab" data-toggle="pill" href="#pills-terminado" role="tab" aria-controls="pills-terminado" >TERMINADO</a>
                                        </li>
                                    </ul>
                                    <div class="col-12">
                                        @include('flash::message')
                                    </div>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade {{ (!isset($_GET['step']))? 'show active' :  '' }}" id="pills-pendiente" role="tabpanel" aria-labelledby="pills-pendiente-tab">
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
                                                    @foreach($pedidos as $pedido)
                                                        <tr>
                                                            <td>{{ $pedido->IdPedido }}</td>
                                                            <td>{{ $pedido->Nombre }}</td>
                                                            <td>{{ date('Y-m-d', strtotime($pedido->created_at)) }}</td>
                                                            <td>{{ date('Y-m-d', strtotime($pedido->FechaEntrega)) }}</td>
                                                            <td>
                                                                <a class="btn btn-primary" href="/admin/produccion/{{ $pedido->IdPedido }}/form_autorizar" data-toggle="tooltip" data-placement="top" title="Autorizar"><i class="fas fa-check-circle"></i></a>
                                                                <a class="btn btn-success" href="/admin/produccion/{{ $pedido->IdPedido }}/autorizar/2" data-toggle="tooltip" data-placement="top" title="Cancelar"><i class="fas fa-ban"></i></a>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade  {{ (isset($_GET['step']) && $_GET['step'] == 'process' )? 'show active' :  '' }}" id="pills-proceso" role="tabpanel" aria-labelledby="pills-proceso-tab">
                                            <table class="table-default table table-bordered table-hover dataTable" style="width: 100%" role="grid" aria-describedby="example2_info">
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
                                                    @foreach($pedido_procesados as $pedido_procesado)
                                                        <tr>
                                                            <td>{{ $pedido_procesado->IdPedido }}</td>
                                                            <td>{{ $pedido_procesado->Nombre }}</td>
                                                            <td>{{ date('Y-m-d', strtotime($pedido_procesado->created_at)) }}</td>
                                                            <td>{{ date('Y-m-d', strtotime($pedido_procesado->FechaEntrega)) }}</td>
                                                            <td>
                                                                <a class="btn btn-success" href="/admin/produccion/{{ $pedido_procesado->IdPedido }}/detalle" data-toggle="tooltip" data-placement="top" title="Detalle">
                                                                    <i class="fas fa-bars"></i>
                                                                </a>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade {{ (isset($_GET['step']) && $_GET['step'] == 'finish' )? 'show active' :  '' }}" id="pills-terminado" role="tabpanel" aria-labelledby="pills-terminado-tab">
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
                                                            <a href="/admin/pedido/pdf/create/{{ $pedido_terminado->IdPedido }}" target="_blank" class="btn btn-secondary btn-sm"><i class="fas fa-file-pdf"></i></a>
                                                            <a href="/admin/entrada/save/{{ $pedido_terminado->Id }}" class="btn btn-primary btn-sm"><i class="fas fa-truck-loading"></i></a>
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
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>
@endsection
