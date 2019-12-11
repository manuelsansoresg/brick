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
                        <li class="breadcrumb-item"> <a href="/admin/pedido">Pedidos</a> </li>
                        <li class="breadcrumb-item active"> Editar </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Editar pedido
                        </div>
                        <div class="card-body">
                            {{ Form::open(['route' => ['pedido.update', $pedido->IdPedido], 'method' => 'PUT']) }}
                            <div class="row mt-3">
                                <div class="col-12 col-md-4">
                                    <div class="form-group mb-2">
                                        <label class="small">Estatus </label>
                                        <div class="w-100"></div>
                                        <div class="bootstrap-switch-container" style="width: 129px; margin-left: 0px;">
                                            @if($pedido->Estatus == 1)
                                                <input type="checkbox" name="Estatus" checked="" value="1" data-bootstrap-switch="">
                                            @else
                                                <input type="checkbox" name="Estatus"  value="1" data-bootstrap-switch="">
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-12 col-md-4">
                                    <label class="small">Fecha Entrega </label>
                                   <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" name="FechaEntrega" value="{{ $pedido->FechaEntrega }}" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" im-insert="false">
                                    </div>
                                    <div class="w-100"></div>
                                    @if($errors)
                                    <span class="text-danger"> {{$errors->first('FechaEntrega')}}</span>
                                    @endif

                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group mb-2">
                                        <label class="small">Proveedor </label>
                                        <div class="w-100"></div>
                                        <select name="IdProveedor"  class="form-control">
                                            @foreach ($proveedores as $proveedor)
                                                <option value="{{ $proveedor->Id }}" {{ ($pedido->IdProveedor == $proveedor->Id  )? 'selected' : '' }}> {{ $proveedor->Nombre }} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group mb-2">
                                        <label class="small">Modelo </label>
                                        <div class="w-100"></div>
                                        <select name="TipoModelo"  class="form-control">
                                            @foreach ($modelos  as $modelo)
                                                <option value="{{ $modelo->id }}" {{ ($pedido->TipoModelo == $modelo->id  )? 'selected' : '' }} > {{ $modelo->descripcion }} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group mb-2">
                                        <label class="small">Subtotal</label>
                                        <div class="w-100"></div>
                                        <input type="text" name="Subtotal" value="{{ $pedido->Subtotal }}" class="form-control">
                                        <div class="w-100"></div>
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('Subtotal')}}</span>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group mb-2">
                                        <label class="small">IVA</label>
                                        <div class="w-100"></div>
                                        <input type="text" name="Iva" value="{{ $pedido->Iva }}" class="form-control">
                                        <div class="w-100"></div>
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('Iva')}}</span>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group mb-2">
                                        <label class="small">Descuento</label>
                                        <div class="w-100"></div>
                                        <input type="text" name="descuento" value="{{ $pedido->descuento }}" class="form-control">
                                        <div class="w-100"></div>
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('descuento')}}</span>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group mb-2">
                                        <label class="small">Importe</label>
                                        <div class="w-100"></div>
                                        <input type="text" name="Importe" value="{{ $pedido->Importe }}" class="form-control">
                                        <div class="w-100"></div>
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('Importe')}}</span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-2">
                                        <label class="small">Observaciones </label>
                                        <div class="w-100"></div>
                                        <textarea name="Observaciones" cols="30" rows="10" class="form-control">{{ $pedido->Observaciones }}</textarea>
                                        <div class="w-100"></div>
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('Observaciones')}}</span>
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
@endsection

@section('js')
    <script>
    $(function () {
        $('[data-mask]').inputmask();
        $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    })
    </script>
@endsection
