@extends('layouts.default')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">INICIO</a></li>
                        <li class="breadcrumb-item active">ARTICULOS</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h3 class="mr-auto">LISTADO DE ARTICULOS</h3>
                                <div>
                                    <a href="/admin/articulo/create" class="btn btn-block btn-primary btn-sm"><i class="far fa-file"></i> AGREGAR</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <table class="table-default table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead>
                                            <tr>
                                                <th>CVE.INTERNA</th>
                                                <th>DESCRIPCION</th>
                                                <th>FAMILIA</th>
                                                <th>PROVEEDOR</th>
                                                <th>UNIDAD VENTA</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($articulos as $articulo)
                                            <tr>
                                                <td>{{ $articulo->ClaveInterna }}</td>
                                                <td>{{ $articulo->descripcion }}</td>
                                                <td>{{ $articulo->familia }}</td>
                                                <td>{{ $articulo->proveedor }}</td>
                                                <td>{{ $articulo->Abreviatura }}</td>
                                                <td>
                                                    {{ Form::open(['route' => ['articulo.destroy', $articulo->id ],'class' => 'form-inline', 'method' => 'DELETE' ])}}
                                                    <a href="{{route('articulo.edit', $articulo->id)}}" class="btn btn-sm btn-primary">
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
