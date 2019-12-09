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
                        <li class="breadcrumb-item"> <a href="/admin/proveedor">CLIENTE</a> </li>
                        <li class="breadcrumb-item active">NUEVO</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-primary">
                        <div class="card-header">EDITAR CLIENTE</div>
                        <div class="card-body">
                            {{ Form::open(['route' => ['cliente.update', $cliente->Id], 'method' => 'PUT']) }}
                            <div class="row">
                                <div class="col-12 col-md-9">
                                    <label class="small">NOMBRE</label>
                                    <input name="Nombre" class="form-control form-control-sm" type="text" value="{{ $cliente->Nombre }}">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">RFC</label>
                                    <input class="form-control form-control-sm" type="text" value="{{ $cliente->RFC }}" name="RFC">
                                    @if($errors)
                                    <span class="text-danger"> {{$errors->first('RFC')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-9">
                                    <label class="small">CALLE</label>
                                    <input name="Calle" class="form-control form-control-sm" type="text" value="{{ $cliente->Calle }}">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">CP</label>
                                    <input class="form-control form-control-sm" type="text" value="{{ $cliente->CodigoPostal }}" name="CodigoPostal">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-2">
                                    <label class="small">NO.EXT</label>
                                    <input name="NumeroExterior" class="form-control form-control-sm" type="text" value="{{ $cliente->NumeroExterior }}">
                                </div>
                                <div class="col-12 col-md-2">
                                    <label class="small">NO.INT</label>
                                    <input class="form-control form-control-sm" type="text" value="{{ $cliente->NumeroInterior }}" name="NumeroInterior">
                                </div>
                                <div class="col-12 col-md-5">
                                    <label class="small">COLONIA</label>
                                    <input class="form-control form-control-sm" type="text" value="{{ $cliente->Colonia }}" name="Colonia">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">CIUDAD</label>
                                    <input class="form-control form-control-sm" type="text" value="{{ $cliente->Ciudad }}" name="Ciudad">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-2">
                                    <label class="small">ESTADO</label>
                                    <select name="Estados" class="form-control form-control-sm">
                                        <option value="Aguascalientes">Aguascalientes</option>
                                        <option value="Baja California">Baja California </option>
                                        <option value="Baja California Sur">Baja California Sur </option>
                                        <option value="Campeche">Campeche </option>
                                        <option value="Chiapas">Chiapas </option>
                                        <option value="Chihuahua">Chihuahua </option>
                                        <option value="Coahuila">Coahuila </option>
                                        <option value="Colima">Colima </option>
                                        <option value="Distrito Federal">Distrito Federal</option>
                                        <option value="Durango">Durango </option>
                                        <option value="Estado de México">Estado de México </option>
                                        <option value="Guanajuato">Guanajuato </option>
                                        <option value="Guerrero">Guerrero </option>
                                        <option value="Hidalgo">Hidalgo </option>
                                        <option value="Jalisco">Jalisco </option>
                                        <option value="Michoacán">Michoacán </option>
                                        <option value="Morelos">Morelos </option>
                                        <option value="Nayarit">Nayarit </option>
                                        <option value="Nuevo León">Nuevo León </option>
                                        <option value="Oaxaca">Oaxaca </option>
                                        <option value="Puebla">Puebla </option>
                                        <option value="Querétaro">Querétaro </option>
                                        <option value="Quintana Roo">Quintana Roo </option>
                                        <option value="San Luis Potosí">San Luis Potosí </option>
                                        <option value="Sinaloa">Sinaloa </option>
                                        <option value="Sonora">Sonora </option>
                                        <option value="Tabasco">Tabasco </option>
                                        <option value="Tamaulipas">Tamaulipas </option>
                                        <option value="Tlaxcala">Tlaxcala </option>
                                        <option value="Veracruz">Veracruz </option>
                                        <option value="Yucatán">Yucatán </option>
                                        <option value="Zacatecas">Zacatecas</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-2">
                                    <label class="small">TELÉFONO 1</label>
                                    <div class="input-group input-group-sm">
                                        <input id="Telefono" name="Telefono" type="number" class="form-control form-control-sm rounded-0 w-100" value="{{ $cliente->Telefono }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text rounded-0 fa fa-phone"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-8">
                                    <label class="small">CONTACTO</label>
                                    <input class="form-control form-control-sm" type="text" value="{{ $cliente->Contacto }}" name="Contacto">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    <label class="small">EMAIL</label>
                                    <input class="form-control form-control-sm" type="email" aria-describedby="emailHelp" value="{{ $cliente->Email }}" name="Email">
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