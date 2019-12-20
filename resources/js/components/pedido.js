var Swal = require('sweetalert2');

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
    
    $("#frm-producto").submit(function (event) { 
        event.preventDefault();
        

        var total_elementos = $('input[name^="articulo_cantidad"]').length;
        if (total_elementos == 0) {
        Swal.fire({
            title: 'Error!',
            text: 'Agregue un producto para continuar',
            icon: 'error',
        })
        }else{
            $("#frm-producto").submit();
        }

        /*
         */


        /*   */
        
    });
   
}