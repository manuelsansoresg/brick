@extends('layouts.default')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">            
            <div class="row mb-2">                    
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">PEDIDO</h1>
                </div><!-- /.col -->
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
                            {{ Form::open(['route' => 'pedido.store', 'method' => 'POST']) }}
                            <div class="row">
                                <div class="col-12 col-md-9">
                                    <label class="small">CLIENTE</label>                                    
                                    <select name="IdProveedor" class="form-control form-control-sm">
                                        @foreach ($proveedores as $proveedor)
                                            <option value="{{ $proveedor->Id }}"> {{ $proveedor->Nombre }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">FOLIO</label>
                                    <input class="form-control form-control-sm" type="text" placeholder="FOLIO" readonly value="0000001">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-9">
                                    <label class="small">DOMICILIO</label>                                                                        
                                    <textarea name="domicilio" cols="10" rows="2" class="form-control form-control-sm" readonly></textarea>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="small">FECHA</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" name="Fecha" class="form-control form-control-sm" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" im-insert="false">
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
                                            <select name="TipoModelo"  class="form-control form-control-sm">
                                                @foreach ($modelos  as $modelo)
                                                    <option value="{{ $modelo->id }}"> {{ $modelo->descripcion }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3" >
                                        <label class="small">FECHA ENTREGA</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" name="FechaEntrega" class="form-control form-control-sm" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" im-insert="false">
                                        </div>
                                        <div class="w-100"></div>
                                        @if($errors)
                                            <span class="text-danger"> {{$errors->first('FechaEntrega')}}</span>
                                        @endif    
                                    </div>   
                            </div>
                            <div class="row ">
                                    <div class="col-12 col-md-12">
                                        <table id="tblpedido" class="table-default table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                            <thead>
                                                <tr>
                                                    <th>CLAVE</th>
                                                    <th>DESCRIPCION</th>
                                                    <th>UNI</th>
                                                    <th>CANT</th>                                                
                                                    <th>PRECIO</th>
                                                    <th>DESC</th>
                                                    <th>IMPORTE</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-8 col-md-5 col-sm-5 col-xs-5">
                                        <div class="form-group mb-2">
                                            <label class="small">OBSERVACIONES </label>
                                            <div class="w-100"></div>
                                            <textarea name="Observaciones" cols="20" rows="13" class="form-control form-control-sm"></textarea>
                                            <div class="w-100"></div>
                                            @if($errors)
                                                <span class="text-danger"> {{$errors->first('Observaciones')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-2 col-sm-3 col-xs-2">
                                        <div class="form-group mb-2">
                                            <label class="small">SUBTOTAL</label>                                        
                                            <input type="text" name="Subtotal" class="form-control form-control-sm" readonly placeholder="SUBTOTAL">                                        
                                            @if($errors)
                                                <span class="text-danger"> {{$errors->first('Subtotal')}}</span>
                                            @endif
                                        </div>                                        
                                        <div class="form-group mb-2">
                                            <label class="small">DESCUENTO</label>                                                
                                            <input type="text" name="descuento" class="form-control form-control-sm" readonly placeholder="DESCUENTO">                                                
                                            @if($errors)
                                                <span class="text-danger"> {{$errors->first('descuento')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="small">IVA</label>                                               
                                            <input type="text" name="Iva" class="form-control form-control-sm" readonly placeholder="IVA">                                                
                                            @if($errors)
                                                <span class="text-danger"> {{$errors->first('Iva')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="small">IMPORTE</label>                                            
                                            <input type="text" name="Importe" class="form-control" readonly placeholder="IMPORTE">                                            
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

<!-- <script src="{{ asset('vendor/adminlte/plugins/datatable/js/responsive.js') }}"></script> -->
<script>
    $(function() {      

        var table = $('#tblpedido').DataTable({

            responsive: true,
            "pageLength": 5,
            "searching": false,
            "pagingType": "simple",
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "BUSCAR:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
        });
    })
</script>
@endsection
