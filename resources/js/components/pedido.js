var Swal = require('sweetalert2');
const axios = require('axios')

if ($("#pedido").length > 0) { 
    
    //bootstrapValidate({'#FechaEntrega', 'min:20'});
    (function() {
        'use strict';
        window.addEventListener('load', function() {
        //Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        //Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
            });
        }, false);
    })();

    
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