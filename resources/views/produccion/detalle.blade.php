@extends('layouts.default')

@section('content')
{{--    <table-detail pedido_id="{{ $pedido->IdPedido }}" my_date="{{ date('Y-m-d') }}"></table-detail>--}}
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">INICIO</a></li>
                        <li class="breadcrumb-item"> <a href="/admin/produccion?step=process">PRODUCCIÓN </a> </li>
                        <li class="breadcrumb-item active">NUEVO</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-primary">
                        <div class="card-header">DATOS GENERALES</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-9">
                                    <small>Los campos marcados con * son obligatorios </small>
                                    <div class="w-100" id="pedido"></div>
                                    <label class="small">*CLIENTE</label>
                                    <input type="text" class="form-control" value="{{ $pedido->cliente }}" readonly>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">FOLIO</label>
                                    <input class="form-control form-control-sm" value="{{ $pedido->IdPedido }}" type="text"  readonly >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-9">
                                    <label class="small">DOMICILIO</label>
                                    <input type="text" class="form-control" readonly value="{{ $domicilio }}">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">FECHA</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" name="Fecha" value="{{ $pedido->FechaEntrega }}"  class="form-control form-control-sm" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" im-insert="false" readonly>

                                    </div>
                                    <div class="w-100"></div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-9">
                                    <div class="form-group mb-2">
                                        <label class="small">SUPERVISOR</label>
                                        <select name="IdEmpleadoSupervisor" v-model="pedido.IdEmpleadoSupervisor" class="form-control form-control-sm">
                                            @foreach($empleados as $empleado)
                                                <option value="{{ $empleado->Id }}"> {{ $empleado->Nombre }}  </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row ">
                                <div class="col-12 col-md-12">
                                    <div class="col-12 text-right pb-4" style="padding-bottom:20px;">

                                    </div> <!-- /div-action -->

                                    <table  class="table table-bordered table-hover dataTable"  aria-describedby="example2_info">
                                        <thead>
                                        <tr>
                                            <th>DESCRIPCIÓN</th>
                                            <th>CANT</th>
                                            <th>PRODUCCIÓN ACTUAL</th>
                                            <th>DIFERENCIA</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody >
                                        <tr>
                                            <td colspan="5">
                                                <div class="col-12 text-center" style="display: none">
                                                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                                                </div>
                                            </td>
                                        </tr>
                                        @foreach($detalle_produccion as $detalle_produccion)
                                        <tr >
                                            <td>{{ $detalle_produccion->Observaciones }}</td>
                                            <td> {{ (int)$detalle_produccion->Cantidad }} </td>
                                            <td> {{ $detalle_produccion->produccion_actual }}  </td>
                                            <td> {{ $detalle_produccion->diferencia }}  </td>
                                            <td>
                                                <!--<a href="#" class="btn btn-secondary btn-sm"  v-if="detalle_produccion.estatus == 1" disabled >Detalle</a>-->
                                                @if($detalle_produccion->clasificacion == 'd')
                                                    <a href="/admin/produccion/{{ $detalle_produccion->IdProducion }}/{{ $detalle_produccion->IdProducto  }}/detalle-produccion" class="btn btn-success btn-sm" >DETALLE</a>
                                                    <a class="btn btn-secondary btn-sm text-white">AVANCE SECADO</a>
                                                    @else
                                                    <a class="btn btn-secondary btn-sm text-white">DETALLE</a>
                                                    <a href="/admin/produccion/{{ $detalle_produccion->IdProducion }}/{{ $detalle_produccion->IdProducto  }}/avance-secado" class="btn btn-primary btn-sm">AVANCE SECADO</a>
                                                @endif



                                                <!--<a href="#" class="btn btn-secondary btn-sm" v-else disabled >Avance secado</a>-->
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-right pb-4">
                                    <a href="#" class="btn btn-danger">CANCELAR</a>
                                    <a href="#" class="btn btn-success">ACEPTAR</a>
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

@section('js')
    <script>
        $(function() {
            $('[data-mask]').inputmask();
            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });
        })
    </script>


@endsection
