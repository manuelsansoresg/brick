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
                        <li class="breadcrumb-item"><a href="#">INICIO</a></li>
                        <li class="breadcrumb-item active">PRODUCCIÓN</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h3 class="mr-auto">LISTA DE PRODUCCIÓN</h3>
                                <div>
                                    <a href="/admin/produccion/create" class="btn btn-block btn-primary btn-sm"><i class="far fa-file"></i> AGREGAR</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <table class="table-default table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead class="theade-danger">
                                            <tr>
                                                <th>No.PRODUCCION</th>
                                                <th>FECHA</th>
                                                <th>No.PEDIDO</th>
                                                <th>OBSERVACIONES</th>
                                                <th>ESTATUS</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($producciones as $produccion)
                                            <tr>
                                                <td>{{ $produccion->Id }}</td>
                                                <td>{{ $produccion->Fecha }}</td>
                                                <td>{{ $produccion->IdPedido }}</td>
                                                <td>{{ $produccion->Observaciones }}</td>
                                                <td>
                                                    @if($pedido->Estatus == 1)
                                                    <i class="fas fa-ban text-success"></i> Activo
                                                    @else
                                                    <i class="fas fa-ban text-danger"></i> Inactivo
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="/admin/produccion/pdf/create/{{ $produccion->Id }}" class="btn btn-secondary btn-sm"><i class="fas fa-file-pdf"></i></a>
                                                    <a href="{{route('produccion.edit', $produccion->Id)}}" class="btn btn-sm btn-primary">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <?php 
                                                    $Estatus = ($produccion->Estatus==0)?1:0;
                                                    ?>
                                                       
                                                        @if ($produccion->Estatus == 1)
                                                         <button
                                                            onclick="if(confirm('¿Deseas eliminar el elemento?'))window.location.href='/admin/produccion/destroy/{{ $produccion->Id }}/{{ $Estatus }} '"
                                                            class="btn btn-danger btn-sm ml-1">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>   
                                                        @else
                                                            <button
                                                                onclick="if(confirm('¿Deseas eliminar el elemento?'))window.location.href='/admin/produccion/destroy/{{ $produccion->Id }}/{{ $Estatus }} '"
                                                                class="btn btn-success btn-sm ml-1">
                                                                     <i class="fas fa-check-circle"></i>
                                                            </button>
                                                        @endif                                                    
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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