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
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"> <a href="/admin/produccion/{{ $produccion->IdPedido }}/detalle">Detalle </a> </li>
                        <li class="breadcrumb-item active">DETALLE SECADO</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <form action="" method="POST" id="form_products">
                <div class="row">
                    @csrf
                    <div class="col-12">
                        <div class="card border-primary">
                            <div class="card-header">AVANCES DEL SECADO</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-9">
                                        <small>Los campos marcados con * son obligatorios </small>
                                        <div class="w-100" id="pedido"></div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <small>TOTAL DE ARTICULOS : {{ (int)$detalle_produccion->Cantidad }} </small>
                                    </div>
                                    <div class="col-12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>FECHA</th>
                                                    <th>NOMBRE OPERARIO</th>
                                                    <th>CANTIDAD</th>
                                                    <th>EXCELENTE</th>
                                                    <th>MALOS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  $total_elemento= count($detalle_produccion_avance); ?>
                                                <?php $count = 0; ?>
                                                @foreach($detalle_produccion_avance as $detalle_produccion_avance)
                                                    @if ($detalle_produccion_avance->status == 1)
                                                        <tr>
                                                            <td>{{ date('d-m-Y', strtotime($detalle_produccion_avance->created_at)) }}</td>
                                                            <td>{{ $detalle_produccion_avance->Nombre }}</td>
                                                            <td>{{ (int)$detalle_produccion_avance->Cantidad }}</td>
                                                            <td>
                                                                {{ (int)$detalle_produccion_avance->CantidadBueno }}
                                                                <?php $count = $count +1; ?>
                                                            </td>
                                                            <td>{{ (int)$detalle_produccion_avance->CantidadMalo }}</td>
                                                        </tr>
                                                    @elseif ($detalle_produccion_avance->status == 0)
                                                        <tr>
                                                            <td>{{ date('d-m-Y', strtotime($detalle_produccion_avance->created_at)) }}
                                                                <input type="hidden" name="Id[]" value="{{$detalle_produccion_avance->id }}">
                                                            </td>
                                                            <td>{{ $detalle_produccion_avance->Nombre }}<input type="hidden" name="IdEmpleado[]" value="{{$detalle_produccion_avance->IdEmpleado }}"></td>
                                                            <td>{{ (int)$detalle_produccion_avance->Cantidad }} </td>
                                                            <!--<td><input class="form-control" name="CantidadBueno" type="number" min="0" max="{{ (int)$detalle_produccion_avance->Cantidad }}" value="0"> </td>-->
                                                            <!--<td><input class="form-control" name="CantidadMalo" type="number" min="0" max="{{ (int)$detalle_produccion_avance->Cantidad }}" value="0"> </td>-->
                                                            <td><input class="form-control" type="number" name="CantidadBueno[]" min="0" max="{{ (int)$detalle_produccion_avance->Cantidad }}" value="0" /></td>
                                                            <td><input class="form-control" type="number" name="CantidadMalo[]" min="0" max="{{ (int)$detalle_produccion_avance->Cantidad }}" value="0" /></td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 text-right pb-4">
                                        @if ($total_elemento == $count )
                                            <a href="/admin/produccion/{{ $produccion->IdPedido }}/detalle" class="btn btn-danger">CANCELAR</a>

                                        @else
                                            <a href="/admin/produccion/{{ $produccion->IdPedido }}/detalle" class="btn btn-danger">CANCELAR</a>
                                            <button class="btn btn-success">ACEPTAR</button>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>




@endsection
