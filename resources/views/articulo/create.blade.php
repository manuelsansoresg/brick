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
                        <li class="breadcrumb-item"> <a href="/admin/cliente">ARTÍCULO</a> </li>
                        <li class="breadcrumb-item active">NUEVO</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-12 col-md-9">
                    <div class="card border-primary">
                        <div class="card-header">AGREGAR ARTÍCULO</div>
                        <div class="card-body">
                            {{ Form::open(['route' => 'articulo.store', 'method' => 'POST']) }}
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label class="small">CLAVE INT.</label>
                                    <input name="Clave" class="form-control form-control-sm" type="text" placeholder="CLAVE">
                                </div>
                                <div class="col-12 col-md-9">
                                    <label class="small">DESCRIPCION</label>
                                    <input class="form-control form-control-sm" type="text" placeholder="DESCRIPCION" name="Nombre">
                                    <div class="w-100"></div>
                                    @if($errors)
                                    <span class="text-danger"> {{$errors->first('Nombre')}}</span>
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
                                                <option value="{{ $proveedor->Id }}"> {{ $proveedor->Nombre }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">CODIGO DE BARRA</label>
                                    <input class="form-control form-control" type="text" placeholder="CODIGO BARRA" name="codigobarra">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label class="small">COLOR</label>
                                    <select name="colores" class="custom-select">
                                        @foreach ($colores as $color)
                                            <option value="{{  $color->id }}"> {{ $color->Descripcion }} </option>
                                        @endforeach
                                    </select>                                    
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">FAMILIA</label>
                                    <select name="familia" class="custom-select">
                                        @foreach ($familias as $familia)
                                            <option value="{{  $familia->id }}"> {{ $familia->Descripcion }} </option>
                                        @endforeach
                                    </select> 
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">STOCK MAX.</label>
                                    <input class="form-control form-control" type="text" placeholder="STOCK MAX" name="stockmaximo" value="0">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">STOCK MIN.</label>
                                    <input class="form-control form-control" type="text" placeholder="STOCK MIN" name="stockMinimo" value="0">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label class="small">PRECIO VTA. 1</label>
                                    <input class="form-control form-control-sm" type="text" placeholder="PRECIO VTA. 1" name="Precio1">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">PRECI VTA. 2</label>
                                    <input class="form-control form-control-sm" type="text" placeholder="PRECIO VTA. 2" name="Precio2">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">PRECIO VTA. 3</label>
                                    <input class="form-control form-control-sm" type="text" placeholder="PRECIO VTA. 3" name="Precio3">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">PRECIO COSTO</label>
                                    <input class="form-control form-control-sm" type="text" placeholder="PRECIO COSTO" name="PrecioCosto">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9">                                
                                    <label class="small">OBSERVACIONES </label>
                                    <div class="w-100"></div>
                                        <textarea name="Observaciones" cols="10" rows="2" class="form-control form-control-sm"></textarea>
                                    <div class="w-100"></div>
                                    @if($errors)
                                        <span class="text-danger"> {{$errors->first('Observaciones')}}</span>
                                    @endif
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">ESTATUS</label>
                                    <div class="bootstrap-switch-container" style="width: 129px; margin-left: 0px;">
                                        <input type="checkbox" name="Estatus" checked="" value="1" data-bootstrap-switch="">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-right pb-4">
                                    <button class="btn btn-primary">ACEPTAR</button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card border-primary">
                        <div class="card-header">IMAGEN</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <img src="imagen-no-disponible.png" class="img-fluid" alt="Responsive image">
                                </div>
                                <div class="col-12">
                                    <label class="small">IMAGEN</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">imagen</label>
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