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
                                            <small>Total de articulos {{ (int)$detalle_produccion->Cantidad }} </small>
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
                                                {{ $cont = 0}}    
                                                @foreach($detalle_produccion_avance as $detalle_produccion_avance)
                                                    @if ($detalle_produccion_avance->status == 1)
                                                        <tr>
                                                            <td>{{ date('Y-m-d', strtotime($detalle_produccion_avance->created_at)) }}</td>
                                                            <td>{{ $detalle_produccion_avance->Nombre }}</td>
                                                            <td>{{ (int)$detalle_produccion_avance->Cantidad }}</td>
                                                            <td>{{ (int)$detalle_produccion_avance->CantidadBueno }}</td>
                                                            <td>{{ (int)$detalle_produccion_avance->CantidadMalo }}</td>
                                                        </tr>
                                                    @elseif ($detalle_produccion_avance->status == 0)
                                                        <tr>
                                                            <td>{{ date('Y-m-d', strtotime($detalle_produccion_avance->created_at)) }}<input type="hidden" name="addmore[{{$cont}}][Id]" value="{{$cont }}" ></td>
                                                            <td>{{ $detalle_produccion_avance->Nombre }}<input type="hidden" name="addmore[{{$cont}}][IdEmpleado]" value="{{$detalle_produccion_avance->Id }}" ></td>
                                                            <td>{{ (int)$detalle_produccion_avance->Cantidad }} </td>
                                                            <!--<td><input class="form-control" name="CantidadBueno" type="number" min="0" max="{{ (int)$detalle_produccion_avance->Cantidad }}" value="0"> </td>-->
                                                            <!--<td><input class="form-control" name="CantidadMalo" type="number" min="0" max="{{ (int)$detalle_produccion_avance->Cantidad }}" value="0"> </td>-->
                                                            <td><input class="form-control" type="number" name="addmore[{{$cont}}][CantidadBueno]" min="0" max="{{ (int)$detalle_produccion_avance->Cantidad }}" value="0"/></td>
                                                            <td><input class="form-control" type="number" name="addmore[{{$cont}}][CantidadMalo]" min="0" max="{{ (int)$detalle_produccion_avance->Cantidad }}" value="0"/></td>
                                                            
                                                        </tr>
                                                    @endif
                                                    {{ $cont = $cont +1 }}
                                                @endforeach
                                                <!--@if($total_detalle > 0)
                                                    <tr>
                                                        <td>{{ date('Y-m-d') }}</td>
                                                        <td>
                                                            <select name="IdEmpleado" id="" class="form-control">
                                                                @foreach($empleados as $empleados)
                                                                    <option value="{{ $empleados->Id }}">{{ $empleados->Nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td> {{ $total_detalle }} </td>
                                                        <td><input class="form-control" name="CantidadBueno" type="number" min="0" max="{{ $total_detalle }}" value="0"> </td>
                                                        <td><input class="form-control" name="CantidadMalo" type="number" min="0" max="{{ $total_detalle }}" value="0"> </td>
                                                    </tr>
                                                @endif-->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 text-right pb-4">
                                            <a href="#" class="btn btn-danger">Cancelar</a>
                                            <button class="btn btn-success">Aceptar</button>
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
