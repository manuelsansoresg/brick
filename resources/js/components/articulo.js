window.loadFile = function (event, output) {
    var output = document.getElementById(output);
    output.src = URL.createObjectURL(event.target.files[0]);
}

if ($("#modalArticulo").length > 0) {
    var table;
    var contador_inputs = parseInt($('#contador_inputs').val())-1;

    window.abrirArticulo = function(){
        table = $('#tabla_articulo').DataTable({
            "destroy": true,
            "bProcessing": true,
            "bServerSide": false,
            "paging": true,
            "sAjaxSource": '/admin/tabla-articulo/list',
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "BUSCAR:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
        });
       
        
        /* table.destroy();  */
        
         

        $('#modalArticulo').modal('show');
        
        
    }
    
   
    

    window.agregarArticulo = function(clave, descripcion, uni, precio_format, precio, id_articulo){
        contador_inputs = contador_inputs +1 ;
       
        $('#tbody_articulo').append('<tr> <td> <a onclick="eliminarColumna(this)" class="btn btn-danger text-white"><i class="fas fa-minus-circle"></i></a> </td> <td> ' + clave + ' </td> <td> ' + descripcion + ' </td> <td> ' + uni + ' </td> <td> <input type="number" onchange="calc_cantidad('+contador_inputs+')" id="articulo_cantidad-' + contador_inputs + '" name="articulo_cantidad[]" value="1"  oninput="this.value=(parseInt(this.value)||0)" class="form-control"/> </td> <td> $' + precio_format + 'MXN <input type="hidden" id="articulo_precio-' + contador_inputs + '" name="articulo_precio[]" value="' + precio + '"/> </td> <td class="d-none"> <input type="number" id="articulo_desc-' + contador_inputs+'" name="articulo_desc[]" onchange="total()" value="0.00"  class="form-control"/> </td> <td> <input type="hidden"  name="articulo_importe[]" id="articulo_importe-'+contador_inputs+'" value="' + precio+'" class="form-control"/> <input type="text" readonly  id="input_importe-'+contador_inputs+'" value="' + number_format(precio,2)+'" class="form-control"/>   <input type="hidden" name="articulo_id[]" value="'+id_articulo+'"/> </td> </tr> ');
       /*  $('#subtotal').val(suma_precio);
        $('#descuento').val(0.00);
        $('#iva').val(iva); */
        total();
       
    }

    window.eliminarColumna = function(row){
      
        $(row).parents('tr').first().remove();
        total();
    }

    window.calc_cantidad = function(id_input){
        var precio   = parseFloat($('#articulo_precio-' + id_input).val()) ;
        var cantidad = parseInt($('#articulo_cantidad-' + id_input).val());
        var importe  = precio * cantidad;
        $('#input_importe-' + id_input).val(number_format(importe));
        $('#articulo_importe-' + id_input).val(importe);

        total();

    }

    window.total = function() {
        
        var suma_precio    = 0;
        var cont           = 0; 
        var descuento      = 0;

        var articulo_cantidad = [];
        var articulo_desc = [];
        var articulo_precio = [];

        var total_elementos = $('input[name^="articulo_precio"]').length;
        
        for (let index = 0; index < total_elementos; index++) {
            /* var cantidad      = parseInt($('#articulo_cantidad-' + index).val());
            var precio        = parseFloat($('#articulo_precio-'+index).val());
            var articulo_desc = parseFloat($('#articulo_desc-'+index).val());
            descuento         += parseFloat((cantidad + precio) * articulo_desc/100); */
            
            /* onsole.log('index' + index);
            console.log('cantidad' + cantidad);
            console.log('precio' + precio); */
            
        }

        $('input[name^="articulo_cantidad"]').each(function () {
            articulo_cantidad.push(parseFloat($(this).val()));

        });
        
        $('input[name^="articulo_precio"]').each(function () {
            articulo_precio.push(parseFloat($(this).val()));

        });

        $('input[name^="articulo_desc"]').each(function () {
            articulo_desc.push(parseFloat($(this).val()));

        });
       /*  console.log(articulo_desc);
        console.log('total'+articulo_desc.length); */
        var total = articulo_desc.length;
        for (let index = 0; index < total; index++) {
            
            var cantidad     = parseInt(articulo_cantidad[index]);
            var precio       = parseFloat(articulo_precio[index]);
            var desc         = parseFloat(articulo_desc[index]);
            
           /*  console.log('(cantidad' + cantidad + ')');
            console.log('(precio' + precio + ')');
            console.log('(desc' + desc + ')');
 */
            descuento += parseFloat((cantidad + precio) * desc / 100);
            //console.log('(descuento' + descuento + ')' );
            
        }
        
        $('input[name^="articulo_importe"]').each(function () { 
            cont = cont + 1;
            suma_precio += parseFloat($(this).val()) || 0;
            
        });
        
        

        
        
        var subtotal = suma_precio;
        var iva = (subtotal - descuento) * 0.16;
        var importe = (subtotal - descuento) + iva;

        /* console.log('subtotal' + subtotal);
        console.log('descuento' + descuento); */
    
        
        
        
        if(cont > 0){
            $('#subtotal').val(number_format(subtotal,2));
            $('#descuento').val(number_format(descuento,2));
            $('#iva').val(number_format(iva,2));
            $('#importe').val(number_format(importe,2)); 
            
            $('#hsubtotal').val(subtotal);
            $('#hdescuento').val(descuento);
            $('#hiva').val(iva);
            $('#himporte').val(importe); 
             
        }else{
            $('#subtotal').val(0.00);
            $('#descuento').val(0.00);
            $('#iva').val(0.00);
            $('#importe').val(0.00);
            contador_inputs = -1;
        }
        

    }

    function number_format(amount, decimals) {

        amount += ''; // por si pasan un numero en vez de un string
        amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

        decimals = decimals || 0; // por si la variable no fue fue pasada

        // si no es un numero o es igual a cero retorno el mismo cero
        if (isNaN(amount) || amount === 0)
            return parseFloat(0).toFixed(decimals);

        // si es mayor o menor que cero retorno el valor formateado como numero
        amount = '' + amount.toFixed(decimals);

        var amount_parts = amount.split('.'),
            regexp = /(\d+)(\d{3})/;

        while (regexp.test(amount_parts[0]))
            amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

        return amount_parts.join('.');
    }
}