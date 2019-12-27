@extends('layouts.default')
@section('content')
<div class="content-wrapper">   
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">INICIO</a></li>
                        <li class="breadcrumb-item"> <a href="/admin/empleado">EMPLEADOS</a> </li>
                        <li class="breadcrumb-item active">EDITAR</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->            
            {{ Form::open(['route' => ['empleado.update', $empleado->Id], 'method' => 'PUT', 'files' => true]) }}
            <div class="row">
                <div class="col-12 col-md-9">
                    <div class="card border-primary">
                        <div class="card-header">EDITAR EMPLEADO</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h6><strong>DATOS GENERALES</strong></h6>
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-12 col-md-12">
                                    <label class="small">NOMBRE COMPLETO</label>
                                    <input class="form-control is-valid form-control-sm" type="text" value="{{ $empleado->Nombre }}" placeholder="NOMBRE" name="Nombre" required>
                                    <div class="w-100"></div>
                                    @if($errors)
                                    <span class="text-danger"> {{$errors->first('Nombre')}}</span>
                                    @endif
                                </div>                                
                            </div>                            
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label class="small">EMAIL</label>
                                    <input class="form-control form-control-sm" type="text" value="{{ $empleado->Email }}" placeholder="EMAIL" name="Email">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">FECHA NACIMIENTO</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" name="FechaNacimiento" value="{{ $empleado->FechaNacimiento }}" class="form-control form-control-sm" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" im-insert="false">
                                    </div>
                                    <div class="w-100"></div>
                                    @if($errors)
                                        <span class="text-danger"> {{$errors->first('Fecha')}}</span>
                                    @endif
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">NSS</label>
                                    <input class="form-control form-control-sm" value="{{ $empleado->NSS }}" type="text" placeholder="NSS" name="NSS">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h6><strong>DIRECCIÓN</strong></h6>
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-12 col-md-4">
                                    <label class="small">PAIS</label>
                                    <select name="Pais" class="form-control form-control-sm">
                                        <option value="MÉXICO">MÉXICO</option>
                                    </select>                                    
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="small">ESTADOS</label>
                                    <select name="Estado" class="form-control form-control-sm" data-live-search="true">                                       
                                        <option value="no">SELECCIONE ELEMENTO</option>
                                        <option value="Aguascalientes">Aguascalientes</option>
                                        <option value="Baja California">Baja California</option>
                                        <option value="Baja California Sur">Baja California Sur</option>
                                        <option value="Campeche">Campeche</option>
                                        <option value="Chiapas">Chiapas</option>
                                        <option value="Chihuahua">Chihuahua</option>
                                        <option value="Coahuila">Coahuila</option>
                                        <option value="Colima">Colima</option>
                                        <option value="Distrito Federal">Distrito Federal</option>
                                        <option value="Durango">Durango</option>
                                        <option value="Estado de México">Estado de México</option>
                                        <option value="Guanajuato">Guanajuato</option>
                                        <option value="Guerrero">Guerrero</option>
                                        <option value="Hidalgo">Hidalgo</option>
                                        <option value="Jalisco">Jalisco</option>
                                        <option value="Michoacán">Michoacán</option>
                                        <option value="Morelos">Morelos</option>
                                        <option value="Nayarit">Nayarit</option>
                                        <option value="Nuevo León">Nuevo León</option>
                                        <option value="Oaxaca">Oaxaca</option>
                                        <option value="Puebla">Puebla</option>
                                        <option value="Querétaro">Querétaro</option>
                                        <option value="Quintana Roo">Quintana Roo</option>
                                        <option value="San Luis Potosí">San Luis Potosí</option>
                                        <option value="Sinaloa">Sinaloa</option>
                                        <option value="Sonora">Sonora</option>
                                        <option value="Tabasco">Tabasco</option>
                                        <option value="Tamaulipas">Tamaulipas</option>
                                        <option value="Tlaxcala">Tlaxcala</option>
                                        <option value="Veracruz">Veracruz</option>
                                        <option value="Yucatán">Yucatán</option>
                                        <option value="Zacatecas">Zacatecas</option>                                    
                                    </select> 
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="small">CIUDAD</label>
                                    <input class="form-control form-control-sm" type="text" value="{{ $empleado->Ciudad }}" placeholder="CIUDAD" name="Ciudad">
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label class="small">CALLE</label>
                                    <input class="form-control form-control-sm" type="text" placeholder="CALLE" value="{{ $empleado->Calle }}" name="Calle">
                                </div>
                                <div class="col-12 col-md-2">
                                    <label class="small">NO.INT</label>
                                    <input class="form-control form-control-sm" type="text" placeholder="NoInt" name="NoInt" value="{{ $empleado->NoInt }}">
                                </div>
                                <div class="col-12 col-md-2">
                                    <label class="small">No.EXT</label>
                                    <input class="form-control form-control-sm" type="text" placeholder="NoExt" name="NoExt" value="{{ $empleado->NoExt }}">
                                </div>
                                <div class="col-12 col-md-2">
                                    <label class="small">CODIGO POSTAL</label>
                                    <input class="form-control form-control-sm" type="text" placeholder="CODIGO POSTAL" name="Cp" value="{{ $empleado->Cp }}">
                                </div>                                
                            </div>                            
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">                                   
                                    <div class="row">
                                        <div class="col-12 mt-3">
                                            <h6><strong>CONTACTO</strong></h6>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <label class="small">TELEFONO 1</label>
                                        <input class="form-control form-control-sm" type="text" placeholder="TELEFONO" name="Telefono1" value="{{ $empleado->Telefono1 }}">
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <label class="small">TELEFONO 2</label>
                                        <input class="form-control form-control-sm" type="text" placeholder="TELEFONO" name="Telefono2" value="{{ $empleado->Telefono2 }}">
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <label class="small">TELEFONO 3</label>
                                        <input class="form-control form-control-sm" type="text" placeholder="TELEFONO" name="telefono3" value="{{ $empleado->telefono3 }}">
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <label class="small">FAX</label>
                                        <input class="form-control form-control-sm" type="text" value="{{ $empleado->Fax }}" placeholder="FAX" name="Fax">
                                    </div>                                
                                    <div class="col-12 col-md-12">
                                        <label class="small">CELULAR</label>
                                        <input class="form-control form-control-sm" type="text" value="{{ $empleado->Celular }}" placeholder="CELULAR" name="Celular">
                                    </div>                                       
                                    
                                </div>
                               
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    
                                    <div class="w-100"></div>
                                    <div class="row">
                                        <div class="col-12 mt-3">
                                            <h6><strong>  OTROS DATOS</strong></h6>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <label class="small">DEPARTAMENTO</label>
                                        <select name="IdDepartamento" class="form-control form-control-sm">
                                            @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->Id }}"> {{ $departamento->Descripcion }} </option>
                                            @endforeach
                                        </select>                                 
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <label class="small">PUESTO</label>
                                        <select name="IdPuesto" class="form-control form-control-sm">
                                            @foreach ($puestos as $puesto)
                                            <option value="{{ $puesto->Id }}"> {{ $puesto->Descripcion }} </option>
                                            @endforeach
                                        </select>                                 
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <label class="small">PERIODO</label>
                                        <select name="IdPeriodo" class="form-control form-control-sm">
                                            <option value="1">SEMANAL</option>
                                            <option value="2">QUINCENAL</option>                                            
                                        </select>                                    
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <label class="small">TURNO</label>
                                        <select name="IdTurno" class="form-control form-control-sm">
                                            <option value="1">MATUTINO</option>
                                            <option value="2">VESPERTINO</option>                                            
                                            <option value="3">DIURNO</option>                                            
                                        </select>                                    
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col-12 col-md-12">
                                        <label class="small">ESTATUS</label>
                                        <div class="bootstrap-switch-container" style="width: 129px; margin-left: 0px;">                                          
                                            @if($empleado->Estatus == 1)
                                            <input type="checkbox" name="Estatus" checked="" value="1" data-bootstrap-switch="">
                                            @else
                                            <input type="checkbox" name="Estatus" value="1" data-bootstrap-switch="">
                                            @endif
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">                                
                                    <label class="small">OBSERVACIONES </label>
                                    <div class="w-100"></div>
                                        <textarea name="Observaciones" value="{{ $empleado->Observaciones }}" cols="10" rows="2" class="form-control form-control-sm"></textarea>
                                    <div class="w-100"></div>
                                    @if($errors)
                                        <span class="text-danger"> {{$errors->first('Observaciones')}}</span>
                                    @endif
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
                                    @if ($empleado->Imagen == '')
                                        <img src="{{ asset('img/Empleado.jpg') }}" id="output1" class="img-fluid" alt="Responsive image">
                                    @else
                                        <img id="output1" class="img-fluid" src="{{ asset('img/Empleado/thumb_'.$empleado->Imagen) }}" alt="">
                                    
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
        </div>
    </div>
</div>
@endsection