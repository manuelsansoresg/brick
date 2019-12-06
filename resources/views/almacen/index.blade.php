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
                        <li class="breadcrumb-item"><a href="#">INICIO</a></li>
                        <li class="breadcrumb-item active">ALMACEN</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                              <h3 class="mr-auto">LISTADO DE ALMACENES</h3>
                                <div>
                                    <a href="/admin/almacen/create" class="btn btn-block btn-primary btn-sm"><i class="far fa-file"></i> AGREGAR</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">                            
                            <div class="row mt-3">
                                <div class="col-12">
                                    <table class="table-default table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead>
                                            <tr>
                                                <th>DESCRIPCION</th>
                                                <th>ENCARGADO</th>
                                                <th>MATRIZ</th>
                                                <th>ESTATUS</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($almacenes as $almacen)
                                            <tr>
                                                <td>{{ $almacen->Descripcion }}</td>
                                                <td>{{ $almacen->Encargado }}</td>
                                                <td>
                                                    @if($almacen->Matriz == 1)
                                                        <input type="checkbox" class="custom-control-input" id="chkactivo" value="1">
                                                    @else
                                                        <input type="checkbox" class="custom-control-input" id="chkdesactivo" value="0">
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($almacen->Estatus == 1)
                                                    <i class="custom-control-input"></i> ACTIVO
                                                    @else
                                                    <i class="fas fa-ban text-danger"></i> INACTIVO
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ Form::open(['route' => ['almacen.destroy', $almacen->Id ],'class' => 'form-inline', 'method' => 'DELETE' ])}}
                                                    <a href="{{route('almacen.edit', $almacen->Id)}}" class="btn btn-sm btn-primary">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button onclick="return confirm('¿Deseas eliminar el elemento?')" class="btn btn-danger btn-sm ml-1">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                    {{ Form::close() }}
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