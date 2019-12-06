@extends('layouts.default')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">ALMACEN</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">INICIO</a></li>
                        <li class="breadcrumb-item"> <a href="/admin/almacen">ALMACEN</a> </li>
                        <li class="breadcrumb-item active">EDITAR</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">EDITAR ALMACEN</div>
                        <div class="card-body">
                            {{ Form::open(['route' => ['almacen.update', $almacen->Id], 'method' => 'PUT']) }}
                            <div class="row ">
                                <div class="col-12 col-md-12">
                                    <div class="form-group mb-2">
                                        <label class="small">DESCRIPCIÓN</label>
                                        <div class="w-100"></div>
                                        <input type="text" name="Descripcion" class="form-control form-control-sm" value="{{ $almacen->Descripcion }}">
                                        <div class="w-100"></div>
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('Descripcion')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-12 col-md-12">
                                    <div class="form-group mb-2">
                                        <label class="small">ENCARGADO</label>
                                        <div class="w-100"></div>
                                        <input type="text" name="Encargado" class="form-control form-control-sm" value="{{ $almacen->Encargado }}">
                                        <div class="w-100"></div>
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('Encargado')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>   
                            <div class="row mt-3">
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-2">
                                        <label class="small">MATRIZ</label>
                                        <div class="w-100"></div>
                                        <div class="bootstrap-switch-container" style="width: 129px; margin-left: 0px;">
                                            @if($almacen->Matriz == 1)
                                                <input type="checkbox" name="Matriz" checked="" value="1" data-bootstrap-switch="">
                                            @else
                                                <input type="checkbox" name="Matriz" value="1" data-bootstrap-switch="">
                                            @endif
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-12 col-md-6">                                    
                                    <div class="form-group mb-2">
                                        <label class="small">ESTATUS</label>
                                        <div class="w-100"></div>
                                        <div class="bootstrap-switch-container" style="width: 129px; margin-left: 0px;">
                                            @if($almacen->Estatus == 1)
                                            <input type="checkbox" name="Estatus" checked="" value="1" data-bootstrap-switch="">
                                            @else
                                            <input type="checkbox" name="Estatus" value="1" data-bootstrap-switch="">
                                            @endif
                                        </div>
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