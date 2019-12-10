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
                <div class="col-12">
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
                                <div class="col-12 col-md-12">
                                    <label class="small">PROVEEDORES</label>
                                    <select name="IdProveedor" class="form-control form-control-sm">
                                        @foreach ($errors as $proveedor)
                                            <option value="{{ $proveedor->Id }}"> {{ $proveedor->Nombre }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label class="small">COLOR</label>
                                    <select name="colores" class="form-control form-control-sm">
                                        @foreach ($errors as $color)
                                            <option value="{{  $color->id }}"> {{ $color->Descripcion }} </option>
                                        @endforeach
                                    </select>                                    
                                </div>
                                <div class="col-12 col-md-2">
                                    <label class="small">TELÉFONO 1</label>
                                    <div class="input-group input-group-sm">
                                        <input id="Telefono" name="Telefono" type="number" class="form-control form-control-sm rounded-0 w-100">
                                        <div class="input-group-append">
                                            <span class="input-group-text rounded-0 fa fa-phone"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-8">
                                    <label class="small">CONTACTO</label>
                                    <input class="form-control form-control-sm" type="text" placeholder="CONTACTO" name="Contacto">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    <label class="small">EMAIL</label>
                                    <input class="form-control form-control-sm" type="email" aria-describedby="emailHelp" placeholder="EMAIL" name="Email">
                                    <small id="emailHelp" class="form-text text-muted">Nunca compartiremos su correo electrónico con nadie más.</small>
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