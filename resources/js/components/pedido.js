var Swal = require('sweetalert2');
const axios = require('axios');

if ($("#pedido").length > 0) {

    //bootstrapValidate({'#FechaEntrega', 'min:20'});



    $("#IdCliente").change(function () {

        var IdCliente = $('#IdCliente').val();

        axios.get
            ('/admin/cliente/direccion/' + IdCliente )
            .then(function (response) {
                var result = response.data;
                var direccion = 'Calle: ' + result.Calle + ' No° Int:' + result.NumeroExterior + ' No° Ext:' + result.NumeroInterior + ' Colonia:' + result.Colonia;
                $('#domicilio').val(direccion);
            })
            .catch(function (error) {

                var result = error.response.data;

                /* $('.spinner-contacto').hide(); */



            })
    });

    $("#frm-producto").submit(function (event) {



        var total_elementos = $('input[name="articulo_cantidad[]"]').length;
        if (total_elementos == 0) {
        Swal.fire({
            title: 'Error!',
            text: 'Agregue un producto para continuar',
            icon: 'error',
        })
        }else{
            $("#frm-producto").submit();
        }

        event.preventDefault();

    });

}
