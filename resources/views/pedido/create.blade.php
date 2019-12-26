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
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"> <a href="/admin/pedido">PEDIDOS</a> </li>
                        <li class="breadcrumb-item active">NUEVO</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-primary">
                        <div class="card-header">DATOS GENERALES</div>
                        <div class="card-body">
                            {{ Form::open(['route' => 'pedido.store', 'method' => 'POST', 'id' =>  'frm-producto', 'class' => 'needs-validation', 'novalidate' ]) }}
                            <input type="hidden" id="contador_inputs" value="0">
                            <input type="hidden" id="type" value="0">
                            <div class="row">
                                <div class="col-12 col-md-9">
                                    <small>Los campos marcados con * son obligatorios </small>
                                    <div class="w-100" id="pedido"></div>
                                    <label class="small">*CLIENTE</label>
                                    <select name="IdCliente" id="IdCliente" class="form-control form-control-sm" required>
                                        @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->Id }}"> {{ $cliente->Nombre }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">FOLIO</label>
                                    <input class="form-control form-control-sm" type="text" placeholder="FOLIO" readonly value="{{ $folio }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-9">
                                    <label class="small">DOMICILIO</label>
                                    <textarea name="domicilio" id="domicilio" cols="10" rows="2" class="form-control form-control-sm" readonly>{{ 'Calle:'.$clientes[0]->Calle.' No° Ext:'.$clientes[0]->NumeroExterior.' No° Int'.$clientes[0]->NumeroInterior.' Colonia:'.$clientes[0]->Colonia }}</textarea>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">FECHA</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" name="Fecha" value="{{ date('Y-m-d') }}" class="form-control form-control-sm" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" im-insert="false" readonly>

                                    </div>
                                    <div class="w-100"></div>
                                    @if($errors)
                                    <span class="text-danger"> {{$errors->first('Fecha')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-9">
                                    <div class="form-group mb-2">
                                        <label class="small">MODELO </label>
                                        <select name="TipoModelo" class="form-control form-control-sm">
                                            @foreach ($modelos as $modelo)
                                            <option value="{{ $modelo->id }}"> {{ $modelo->descripcion }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">*FECHA ENTREGA</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" name="FechaEntrega" id="FechaEntrega" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" im-insert="false" class="form-control form-control-sm" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            La fecha es obligatoria
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    @if($errors)
                                    <span class="text-danger"> {{$errors->first('FechaEntrega')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-12 col-md-12">
                                    <div class="col-12 text-right pb-4" style="padding-bottom:20px;">
                                        <button class="btn btn-success" type="button" onclick="abrirArticulo()" id="addArticulo" data-toggle="tooltip" data-placement="left" title="AGREGAR PRODUCTO"> <i class="glyphicon glyphicon-plus-sign"></i> *AGREGAR PRODUCTO </button>
                                    </div> <!-- /div-action -->
                                    <table id="tblpedido" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>CLAVE</th>
                                                <th>DESCRIPCION</th>
                                                <th>UNI</th>
                                                <th>CANT</th>
                                                <th>PRECIO</th>
                                                <th>DESC</th>
                                                <th>IMPORTE</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_articulo">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <div class="form-group mb-2">
                                        <label class="small">OBSERVACIONES </label>
                                        <div class="w-100"></div>
                                        <textarea name="Observaciones" id="Observaciones" cols="20" rows="13" class="form-control form-control-sm"></textarea>
                                        <div class="w-100"></div>
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('Observaciones')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="form-group mb-2">
                                        <label class="small">SUBTOTAL</label>
                                        <input type="text" id="subtotal" class="form-control form-control-sm" readonly placeholder="SUBTOTAL">
                                        <input type="hidden" name="Subtotal" id="hsubtotal" class="form-control form-control-sm" readonly placeholder="SUBTOTAL">
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('Subtotal')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="small">DESCUENTO</label>
                                        <input type="text" id="descuento" value="0.00" class="form-control form-control-sm" readonly placeholder="DESCUENTO">
                                        <input type="hidden" name="descuento" id="hdescuento" value="0.00" class="form-control form-control-sm" readonly placeholder="DESCUENTO">
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('descuento')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="small">IVA</label>
                                        <input type="text" id="iva" class="form-control form-control-sm" readonly placeholder="IVA">
                                        <input type="hidden" name="Iva" id="hiva" class="form-control form-control-sm" readonly placeholder="IVA">
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('Iva')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="small">IMPORTE</label>
                                        <input type="text" id="importe" class="form-control" readonly placeholder="IMPORTE">
                                        <input type="hidden" name="Importe" id="himporte" class="form-control" readonly placeholder="IMPORTE">
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('Importe')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-right pb-4">
                                    <button class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>

{{-- modal --}}
<!-- Modal -->
<div class="modal fade" id="modalArticulo" tabindex="-1" role="dialog" aria-labelledby="modalArticuloLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalArticuloLabel">Lista de articulos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tabla_articulo" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>CVE.INTERNA</th>
                            <th>DESCRIPCION</th>
                            <th>FAMILIA</th>
                            <th>PROVEEDOR</th>
                            <th>UNIDAD VENTA</th>
                            <th></th>
                        </tr>
                    </thead>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
{{-- modal --}}
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