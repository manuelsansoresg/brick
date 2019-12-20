window.loadFile = function (event, output) {
    var output = document.getElementById(output);
    output.src = URL.createObjectURL(event.target.files[0]);
}

if ($("#modalArticulo").length > 0) {
    var table;
    var contador_inputs = -1;

    window.abrirArticulo = function(){
        table = $('#tabla_articulo').DataTable({
            "ajax": '/admin/tabla-articulo/list'
        });
        table.destroy(); 
        $('#modalArticulo').modal('show');
        
    }
    
   
    

    window.agregarArticulo = function(clave, descripcion, uni, precio_format, precio){
        contador_inputs = contador_inputs +1 ;
      
        $('#tbody_articulo').append('<tr> <td> <a onclick="eliminarColumna(this)" class="btn btn-danger text-white"><i class="fas fa-minus-circle"></i></a> </td> <td> ' + clave + ' </td> <td> ' + descripcion + ' </td> <td> ' + uni + ' </td> <td> <input type="number" onchange="total()" id="articulo_cantidad-' + contador_inputs + '" name="articulo_cantidad[]" value="1"  oninput="this.value=(parseInt(this.value)||0)" class="form-control"/> </td> <td> $' + precio_format + 'MXN <input type="hidden" id="articulo_precio-' + contador_inputs + '" name="articulo_precio[]" value="' + precio + '"/> </td> <td> <input type="number" id="articulo_desc-' + contador_inputs+'" name="articulo_desc[]" onchange="total()" value="0.00"  class="form-control"/> </td> <td> <input type="text" readonly name="articulo_importe[]" value="' + precio_format+'" class="form-control"/> </td> </tr> ');
       /*  $('#subtotal').val(suma_precio);
        $('#descuento').val(0.00);
        $('#iva').val(iva); */
        total();
       
    }

    window.eliminarColumna = function(row){
      
        $(row).parents('tr').first().remove();
        total();
    }

    window.total = function() {
        
        var suma_precio    = 0;
        var suma_cantidad  = 0;
        var suma_descuento = 0;
        var suma_importe   = 0;
        var cont           = 0; 
        var descuento      = 0;

        var total_elementos = $('input[name^="articulo_precio"]').length;
        console.log('total elementos'+total_elementos);
        for (let index = 0; index < total_elementos; index++) {
            var cantidad      = parseInt($('#articulo_cantidad-' + index).val());
            var precio = parseFloat($('#articulo_precio-'+index).val());
            var articulo_desc = parseFloat($('#articulo_desc-'+index).val());
            descuento += parseFloat((cantidad + precio) * articulo_desc/100);
            console.log('cantidad'+cantidad);
            console.log('precio'+precio);
            console.log('articulo_desc' + articulo_desc);
           
            
        }
        
        $('input[name^="articulo_precio"]').each(function () {
            cont = cont + 1;
            suma_precio += parseFloat($(this).val()) || 0;
            
        });

        /* $('input[name^="articulo_cantidad"]').each(function () {
            suma_cantidad = suma_cantidad + parseFloat($(this).val());
        });
        
        
        $('input[name^="articulo_desc"]').each(function () {
            suma_descuento += parseFloat($(this).val()) || 0;
        });
        
        $('input[name^="articulo_importe"]').each(function () {
            suma_importe += parseFloat($(this).val()) || 0;
           
        }); */
        
        
        
        var subtotal = suma_precio;
        var iva = (subtotal - descuento) * 0.16;
        var importe = (subtotal - descuento) + iva;
        //var descuento_impreso = (suma_cantidad + suma_precio) ;
       /*  console.log('suma_cantidad'+suma_cantidad);
        console.log('suma_precio'+suma_precio);
        console.log('suma_descuento'+suma_descuento);
        console.log('descuento_impreso' + descuento_impreso);
        console.log('total_elementos' + total_elementos); */
        /*  
        
        */
        
        
        
        if(cont > 0){
            $('#subtotal').val(subtotal);
            $('#descuento').val(descuento);
            $('#iva').val(iva);
            $('#importe').val(importe); 
             
        }else{
            $('#subtotal').val(0.00);
            $('#descuento').val(0.00);
            $('#iva').val(0.00);
            $('#importe').val(0.00);
            contador_inputs = -1;
        }
        

    }
}