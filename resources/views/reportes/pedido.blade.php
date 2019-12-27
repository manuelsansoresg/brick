<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF-pedido</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Roboto', sans-serif;
        font-size: 13px;
    }

    .bg-yellow{
        background-color: #ffaa00;
    }

    .c-white{
        color: white;
    }

    .hr{
        border: 1px solid #ffaa00;
    }

    .text-bold{
        font-weight: bold;
    }

    .mt-2{
        margin-top: 20px;
    }

    .table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
    }
    
    .table th,
    .table td {
    padding: 0.75rem;
    vertical-align: top;
    /* border-top: 1px solid #eceeef; */
    }
    
    .table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #eceeef;
    }
    
    .table tbody + tbody {
    border-top: 2px solid #eceeef;
    }
    
    .table .table {
    background-color: #fff;
    }
    
    .table-sm th,
    .table-sm td {
    padding: 0.3rem;
    }
    
    .table-bordered {
        /* border: 1px solid #eceeef; */
        border-collapse: collapse;
    }
    
    .table-bordered th,
    .table-bordered td {
    border: 1px solid #eceeef;
    }
    
    .table-bordered thead th,
    .table-bordered thead td {
    border-bottom-width: 2px;
    }
    
    .table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.05);
    }
    
    .table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.075);
    }
    
    .table-active,
    .table-active > th,
    .table-active > td {
    background-color: rgba(0, 0, 0, 0.075);
    }
    
    .table-hover .table-active:hover {
    background-color: rgba(0, 0, 0, 0.075);
    }
    
    .table-hover .table-active:hover > td,
    .table-hover .table-active:hover > th {
    background-color: rgba(0, 0, 0, 0.075);
    }
    
    .table-success,
    .table-success > th,
    .table-success > td {
    background-color: #dff0d8;
    }
    
    .table-hover .table-success:hover {
    background-color: #d0e9c6;
    }
    
    .table-hover .table-success:hover > td,
    .table-hover .table-success:hover > th {
    background-color: #d0e9c6;
    }
    
    .table-info,
    .table-info > th,
    .table-info > td {
    background-color: #d9edf7;
    }
    
    .table-hover .table-info:hover {
    background-color: #c4e3f3;
    }
    
    .table-hover .table-info:hover > td,
    .table-hover .table-info:hover > th {
    background-color: #c4e3f3;
    }
    
    .table-warning,
    .table-warning > th,
    .table-warning > td {
    background-color: #fcf8e3;
    }
    
    .table-hover .table-warning:hover {
    background-color: #faf2cc;
    }
    
    .table-hover .table-warning:hover > td,
    .table-hover .table-warning:hover > th {
    background-color: #faf2cc;
    }
    
    .table-danger,
    .table-danger > th,
    .table-danger > td {
    background-color: #f2dede;
    }
    
    .table-hover .table-danger:hover {
    background-color: #ebcccc;
    }
    
    .table-hover .table-danger:hover > td,
    .table-hover .table-danger:hover > th {
    background-color: #ebcccc;
    }
    
    .thead-inverse th {
    color: #fff;
    background-color: #292b2c;
    }
    
    .thead-default th {
    color: #464a4c;
    background-color: #eceeef;
    }
    
    .table-inverse {
    color: #fff;
    background-color: #292b2c;
    }
    
    .table-inverse th,
    .table-inverse td,
    .table-inverse thead th {
    border-color: #fff;
    }
    
    .table-inverse.table-bordered {
    border: 0;
    }
    
    .table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -ms-overflow-style: -ms-autohiding-scrollbar;
    }
    
    .table-responsive.table-bordered {
    border: 0;
    }
    </style>
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <td><img src="{{ public_path('img/AdminLTELogo.png') }}" alt=""></td>
                <td>Lorem ipsum dolor sit.</td>
                <td>1</td>
            </tr>
        </thead>
    </table>
   
    <table class="table" style="width: 100%">
        <tr>
            <td class="text-bold">Cliente:</td>
            <td>{{ $pedido->Nombre }}</td>
            <td class="text-bold">RFC</td>
            <td>{{ $pedido->RFC }}</td>
        </tr>
        <tr>
            <td class="text-bold">Dirección</td>    
            <td>{{ $pedido->Calle.' '.$pedido->NumeroExterior.' '.$pedido->NumeroExterior.' '.$pedido->Colonia }}</td>
            <td class="text-bold">Teléfono</td>
            <td></td>
        </tr> 
    </table>
<hr class="hr">
    <table class="table mt-2 table-bordered">
        <thead>
            <tr class="bg-yellow c-white">
                <th>Clave</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Descuento</th>
                <th>Precio</th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articulos as $articulo)
                <tr>
                    <td>{{ $articulo->ClaveInterna }}</td>
                    <td>{{ $articulo->descripcion }}</td>
                    <td>{{ precio($articulo->cantidad) }}</td>
                    <td>{{ precio($articulo->descuento) }}</td>
                    <td>{{ precio($articulo->Precio) }}</td>
                    <td>{{ precio($articulo->importe) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table style="width:810px">
        <tr>
            <td style="">
                <p>
                    *No se aceptan cambios ni devoluciones
                    <br>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, doloribus.
                    <br>
                    Lorem ipsum dolor sit amet.
                </p>
               
            </td>
            <td style="text-align:right">
                <table class="table table-bordered"  style="width:72%; text-align:right">
                    <tr style="text-align:right">
                        <td>Subtotal</td>
                        <td>{{ precio($pedido->Subtotal) }}</td>
                    </tr>
                    <tr style="text-align:right">
                        <td>Descuento</td>
                        <td>{{ precio($pedido->descuento) }}</td>
                    </tr>
                    <tr style="text-align:right">
                        <td>IVA</td>
                        <td>{{ precio($pedido->Iva) }}</td>
                    </tr>
                    <tr style="text-align:right">
                        <td>Importe</td>
                        <td>{{ precio($pedido->Importe) }}</td>
                    </tr>
                </table>
            </td>
            
            
        </tr>
        <tr >
            
            {{-- <td>Descuento</td>
            <td>IVA</td>
            <td>Importe</td> --}}
        </tr>
    </table>
</body>

</html>