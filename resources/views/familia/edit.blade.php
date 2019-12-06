@extends('layouts.default')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">FAMILIA</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">INICIO</a></li>
                        <li class="breadcrumb-item"> <a href="/admin/familia">FAMILIA</a> </li>
                        <li class="breadcrumb-item active">EDITAR</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">EDITAR FAMILIA</div>
                        <div class="card-body">
                            {{ Form::open(['route' => ['familia.update', $familia->Id], 'method' => 'PUT']) }}
                            <div class="row ">
                                <div class="col-12 col-md-12">
                                    <div class="form-group mb-2">
                                        <label class="small">DESCRIPCIÓN</label>
                                        <div class="w-100"></div>
                                        <input type="text" name="Descripcion" class="form-control form-control-sm" value="{{ $familia->Descripcion }}">
                                        <div class="w-100"></div>
                                        @if($errors)
                                        <span class="text-danger"> {{$errors->first('Descripcion')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-12">
                                    <div class="form-group mb-2">
                                        <label class="small">ESTATUS</label>
                                        <div class="w-100"></div>
                                        <div class="bootstrap-switch-container" style="width: 129px; margin-left: 0px;">
                                            @if($familia->Estatus == 1)
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