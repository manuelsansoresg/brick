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
                            {{ Form::open(['route' => ['pedido.update', $pedido->IdPedido], 'method' => 'PUT', 'id' =>  'frm-producto', 'class' => 'needs-validation', 'novalidate' ]) }}
                            <input type="hidden" id="contador_inputs" value="{{ $total_detalle }}">
                            <input type="hidden" id="type" value="1">
                            <input type="hidden" name="Estatus" value="{{ $pedido->Estatus }}">
                            <div class="row">
                                <div class="col-12 col-md-9">
                                    <small>Los campos marcados con * son obligatorios </small>
                                    <div class="w-100" id="pedido"></div>
                                    <label class="small">*CLIENTE</label>
                                    <select name="IdCliente" class="form-control form-control-sm" required>
                                        @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->Id }}" {{ ($pedido->IdCliente == $cliente->Id )? 'selected' : '' }}> {{ $cliente->Nombre }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">FOLIO</label>
                                    <input class="form-control form-control-sm" type="text" placeholder="FOLIO" readonly value="{{ $pedido->IdPedido }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-9">
                                    <label class="small">DOMICILIO</label>
                                    <textarea name="domicilio" cols="10" rows="2" class="form-control form-control-sm" readonly>{{ $domicilio }}</textarea>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">FECHA</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" name="Fecha" value="{{ date('Y-m-d', strtotime($pedido->fecha)) }}" class="form-control form-control-sm" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" im-insert="false" readonly>

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
                                            <option value="{{ $modelo->id }}" {{ ($pedido->modelo == $modelo->id)? 'selected' : '' }}> {{ $modelo->descripcion }} </option>
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
                                        <input type="text" name="FechaEntrega" id="FechaEntrega" value="{{ date('Y-m-d', strtotime($pedido->FechaEntrega)) }}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" im-insert="false" class="form-control form-control-sm" required>
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
                                            <?php $cont = -1; ?>
                                            @foreach ($detalle_pedidos as $detalle_pedido)
                                            <?php $cont = $cont + 1; ?>
                                            <tr>
                                                <td><a onclick="eliminarColumna(this)" class="btn btn-danger text-white"><i class="fas fa-minus-circle"></i></a></td>
                                                <td>{{ $detalle_pedido->ClaveInterna }}</td>
                                                <td> {{ $detalle_pedido->descripcion }} </td>
                                                <td>{{ $detalle_pedido->Abreviatura }}</td>
                                                <td>

                                                    <input type="number" onchange="calc_cantidad({{ $cont }})" id="articulo_cantidad-{{ $cont }}" name="articulo_cantidad[]" value="{{ (int)$detalle_pedido->cantidad }}" oninput="this.value=(parseInt(this.value)||0)" class="form-control">

                                                </td>
                                                <td>
                                                    <?php $precio = max($detalle_pedido->Precio1, $detalle_pedido->Precio2, $detalle_pedido->Precio3); ?>
                                                    ${{ precio($precio)  }}MXN
                                                    <input type="hidden" id="articulo_precio-{{ $cont }}" name="articulo_precio[]" value="{{ ($precio != '')? $precio : 0 }}">

                                                </td>
                                                <td>
                                                    <input type="number" id="articulo_desc-{{ $cont }}" name="articulo_desc[]" onchange="total()" value="{{ precio($detalle_pedido->descuento) }}" class="form-control">

                                                </td>
                                                <td>
                                                    <input type="hidden" name="articulo_importe[]" id="articulo_importe-{{ $cont }}" value="{{ $detalle_pedido->importe }}" class="form-control">
                                                    <input type="text" readonly="" id="input_importe-{{ $cont }}" value="{{ precio($detalle_pedido->importe) }}" class="form-control">
                                                    <input type="hidden" name="articulo_id[]" value="{{ $detalle_pedido->Idarticulo }}">
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <div class="form-group mb-2">
                                        <label class="small">OBSERVACIONES </label>
                                        <div class="w-100"></div>
                                        <textarea name="Observaciones" id="Observaciones" cols="20" rows="13" class="form-control form-control-sm">{{ $pedido->Observaciones }}</textarea>
                                        <div class="w-100"></div>
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('Observaciones')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="form-group mb-2">
                                        <label class="small">SUBTOTAL</label>
                                        <input type="text" id="subtotal" class="form-control form-control-sm" value="{{ precio($pedido->Subtotal) }}" readonly placeholder="SUBTOTAL">
                                        <input type="hidden" name="Subtotal" id="hsubtotal" value="{{ $pedido->Subtotal }}" class="form-control form-control-sm" readonly placeholder="SUBTOTAL">
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('Subtotal')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="small">DESCUENTO</label>
                                        <input type="text" id="descuento" value="{{ precio($pedido->descuento) }}" class="form-control form-control-sm" readonly placeholder="DESCUENTO">
                                        <input type="hidden" name="descuento" id="hdescuento" value="{{ $pedido->descuento }}" class="form-control form-control-sm" readonly placeholder="DESCUENTO">
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('descuento')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="small">IVA</label>
                                        <input type="text" id="iva" class="form-control form-control-sm" value="{{ $pedido->Iva }}" readonly placeholder="IVA">
                                        <input type="hidden" name="Iva" id="hiva" class="form-control form-control-sm" value="{{ $pedido->Iva }}" readonly placeholder="IVA">
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('Iva')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="small">IMPORTE</label>
                                        <input type="text" value="{{ precio($pedido->Importe) }}" id="importe" class="form-control" readonly placeholder="IMPORTE">
                                        <input type="hidden" value="{{ $pedido->Importe }}" name="Importe" id="himporte" class="form-control" readonly placeholder="IMPORTE">
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