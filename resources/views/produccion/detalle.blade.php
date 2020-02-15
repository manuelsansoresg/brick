@extends('layouts.default')

@section('content')
    <table-detail pedido_id="{{ $pedido->IdPedido }}" my_date="{{ date('Y-m-d') }}"></table-detail>

    {{-- modal --}}
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
