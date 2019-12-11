@extends('layouts.default')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">INICIO</a></li>
                        <li class="breadcrumb-item"> <a href="/admin/articulo">ARTÍCULO</a> </li>
                        <li class="breadcrumb-item active">EDITAR</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

            {{ Form::open(['route' => ['articulo.update', $articulo->id], 'method' => 'PUT', 'files' => true]) }}
            <div class="row">
                <div class="col-12 col-md-9">
                    <div class="card border-primary">
                        <div class="card-header">AGREGAR ARTÍCULO</div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label class="small">CLAVE INT.</label>
                                    <input name="ClaveInterna" value="{{ $articulo->ClaveInterna }}" class="form-control form-control-sm" type="text" placeholder="CLAVE">
                                </div>
                                <div class="col-12 col-md-9">
                                    <label class="small">DESCRIPCION</label>
                                    <input class="form-control form-control-sm" value="{{ $articulo->descripcion }}" type="text" placeholder="DESCRIPCION" name="descripcion">
                                    <div class="w-100"></div>
                                    @if($errors)
                                    <span class="text-danger"> {{$errors->first('descripcion')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-9">
                                    <label class="small">PROVEEDORES</label>
                                    <div class="input-group mb-3">
                                        <!--<div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">PROVEEDORES</label>
                                        </div>-->
                                        <select name="IdProveedor" class="custom-select">
                                            @foreach ($proveedores as $proveedor)
                                            <option value="{{ $proveedor->Id }}" {{ ($articulo->IdProveedor == $proveedor->Id )? 'selected' : '' }}> {{ $proveedor->Nombre }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">CODIGO DE BARRA</label>
                                    <input class="form-control form-control" value="{{ $articulo->codigobarra }}" type="text" placeholder="CODIGO BARRA" name="codigobarra">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label class="small">COLOR</label>
                                    <select name="IdColor" class="custom-select">
                                        @foreach ($colores as $color)
                                        <option value="{{  $color->id }}"> {{ $color->Descripcion }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">FAMILIA</label>
                                    <select name="IdFamilia" class="custom-select">
                                        @foreach ($familias as $familia)
                                        <option value="{{  $familia->Id }}" {{ ($articulo->IdColor == $familia->Id) ? 'selected' : '' }} > {{ $familia->Descripcion }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">STOCK MAX.</label>
                                    <input class="form-control form-control" type="text" placeholder="STOCK MAX" name="stockmaximo" value="{{ $articulo->stockmaximo }}">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">STOCK MIN.</label>
                                    <input class="form-control form-control" type="text" placeholder="STOCK MIN" name="stockMinimo" value="{{ $articulo->stockMinimo }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label class="small">PRECIO VTA. 1</label>
                                    <input class="form-control form-control-sm" type="text" data-behaviour="decimal" placeholder="PRECIO VTA. 1" name="Precio1" value="{{ $articulo->Precio1 }}">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">PRECI VTA. 2</label>
                                    <input class="form-control form-control-sm" type="text" data-behaviour="decimal" placeholder="PRECIO VTA. 2" name="Precio2" value="{{ $articulo->Precio2 }}">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">PRECIO VTA. 3</label>
                                    <input class="form-control form-control-sm" type="text" data-behaviour="decimal" placeholder="PRECIO VTA. 3" name="Precio3" value="{{ $articulo->Precio3 }}">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">PRECIO COSTO</label>
                                    <input class="form-control form-control-sm" type="text" data-behaviour="decimal" placeholder="PRECIO COSTO" name="PrecioCosto" value="{{ $articulo->PrecioCosto }}">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">UNIDAD COMPRA</label>
                                    <select name="IdUnidadCompra" class="form-control">
                                        @foreach ($unidades as $unidad)
                                        <option value="{{ $unidad->Id }}" {{ ($articulo->IdUnidadCompra == $unidad->Id) ? 'selected' : '' }}>{{ $unidad->Descripcion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">UNIDAD VENTA</label>
                                    <select name="IdUnidadVenta" class="form-control">
                                        @foreach ($unidades as $unidad)
                                        <option value="{{ $unidad->Id }}" {{ ($articulo->IdUnidadVenta == $unidad->Id) ? 'selected' : '' }}>{{ $unidad->Descripcion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9">
                                    <label class="small">OBSERVACIONES </label>
                                    <div class="w-100"></div>
                                    <textarea name="Observaciones" cols="10" rows="2" class="form-control form-control-sm">{{ $articulo->Observaciones }}</textarea>
                                    <div class="w-100"></div>
                                    @if($errors)
                                    <span class="text-danger"> {{$errors->first('Observaciones')}}</span>
                                    @endif
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">ESTATUS</label>
                                    <div class="bootstrap-switch-container" style="width: 129px; margin-left: 0px;">
                                        
                                        @if($articulo->Estatus == 1)
                                        <input type="checkbox" name="Estatus" checked="" value="1" data-bootstrap-switch="">
                                        @else
                                        <input type="checkbox" name="Estatus" value="1" data-bootstrap-switch="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-right pb-4">
                                    <button class="btn btn-primary">ACEPTAR</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card border-primary">
                        <div class="card-header">IMAGEN</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-center">
                                    @if ($articulo->imagen == '')
                                        <img src="{{ asset('img/imagen-no-disponible.png') }}" id="output1" class="img-fluid" alt="Responsive image">
                                    @else
                                        <img id="output1" class="img-fluid" src="{{ asset('img/articulo/thumb_'.$articulo->imagen) }}" alt="">
                                    
                                    @endif
                                </div>
                                <div class="col-12">
                                    <label class="small">IMAGEN</label>
                                    <div class="custom-file">
                                        <input type="file" name="imagen" onchange="loadFile(event, 'output1')" class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">imagen</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
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