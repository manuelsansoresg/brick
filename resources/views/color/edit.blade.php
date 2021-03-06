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
                        <li class="breadcrumb-item"><a href="/home">INICIO</a></li>
                        <li class="breadcrumb-item"> <a href="/admin/color">COLORES</a> </li>
                        <li class="breadcrumb-item active"> Editar </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">EDITAR COLOR</div>
                        <div class="card-body">

                            {{ Form::open(['route' => ['color.update', $color->id], 'method' => 'PUT']) }}                            
                            <div class="row ">
                                <div class="col-12 col-md-12">
                                    <div class="form-group mb-2">
                                        <label class="small">DESCRIPCION </label>
                                        <div class="w-100"></div>
                                        <input type="text" name="Descripcion" class="form-control form-control-sm" value="{{ $color->Descripcion }}">
                                        <div class="w-100"></div>
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('Descripcion')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="form-group mb-2">
                                        <label class="small">ABREVIATURA </label>
                                        <div class="w-100"></div>
                                        <input type="text" name="Abreviatura" class="form-control form-control-sm" value="{{ $color->Abreviatura }}">
                                        <div class="w-100"></div>
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('Abreviatura')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-4">
                                    <div class="form-group mb-2">
                                        <label class="small">ESTATUS </label>
                                        <div class="w-100"></div>
                                        <div class="bootstrap-switch-container" style="width: 129px; margin-left: 0px;">
                                            @if($color->Estatus == 1)
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