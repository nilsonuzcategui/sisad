$(document).ready(function(){
    $('#add-estudio').on('click',function(){
        $('#mensaje-estudio').hide();
        
        var e_tipo = $('#e_tipo').val();
        var e_fecha = $('#e_fecha').val();
        var e_estudio = $('#e_estudio').val();
        var e_lugar = $('#e_lugar').val();

        var html = '<tr>';
                html += '<td class="e_tipo">'+e_tipo+'</td>';
                html += '<td class="e_fecha">'+e_fecha+'</td>';
                html += '<td class="e_estudio">'+e_estudio+'</td>';
                html += '<td class="e_lugar">'+e_lugar+'</td>';
                html += '<td><button type="button" class="btn btn-outline-danger btn-circle quitar-estudio"><i class="fa fa-trash-o"></i> </button></td>';
           html += '</tr>';
        var mensaje_error = '';
        if (e_tipo != '') {
            if (e_estudio != '') {
                if (e_lugar != '') {
                    $('#table-estudios').append(html);
                    eventos_estudios();

                    $('#e_fecha').val('');
                    $('#e_estudio').val('');
                    $('#e_lugar').val('');
                }else{
                    mensaje_error = 'Es necesario indicar el lugar donde se realizó el estudio';
                }
            }else{
                mensaje_error = 'Es necesario especificar el nombre del estudio';
            }
        }else{
            mensaje_error = 'Es necesario el tipo de estudio';
        }

        if (mensaje_error != '') {
            $('#mensaje-html').html(mensaje_error);
            $('#mensaje-estudio').show();
        }
    });

    function eventos_estudios() {
        $('.quitar-estudio').on('click',function(e){
            var boton = $(this);
            boton.parent().parent().remove();
        });
    }


    //OCUPACIONES
    $('#add-ocupacion').on('click',function(){
        $('#mensaje-ocupacion').hide();
        
        var o_tipo = $('#o_tipo').val();
        var o_ocupacion = $('#o_ocupacion').val();
        var o_fecha = $('#o_fecha').val();
        var o_fecha_fin = $('#o_fecha_fin').val();

        var html = '<tr>';
                html += '<td class="o_tipo">'+o_tipo+'</td>';
                html += '<td class="o_ocupacion">'+o_ocupacion+'</td>';
                html += '<td class="o_fecha">'+o_fecha+'</td>';
                html += '<td class="o_fecha_fin">'+o_fecha_fin+'</td>';
                html += '<td><button type="button" class="btn btn-outline-danger btn-circle quitar-ocupacion"><i class="fa fa-trash-o"></i> </button></td>';
           html += '</tr>';
        var mensaje_error = '';
        if (o_tipo != '') {
            if (o_ocupacion != '') {
                if (o_fecha != '') {
                    $('#table-ocupacion').append(html);
                    eventos_ocupacion();

                    $('#o_ocupacion').val('');
                    $('#o_fecha').val('');
                    $('#o_fecha_fin').val('');
                }else{
                    mensaje_error = 'Es necesario indicar una fecha incial de la ocupación';
                }
            }else{
                mensaje_error = 'Es necesario especificar el nombre de la ocupación';
            }
        }else{
            mensaje_error = 'Es necesario el tipo de ocupación';
        }

        if (mensaje_error != '') {
            $('#mensaje2-html').html(mensaje_error);
            $('#mensaje-ocupacion').show();
        }
    });

    function eventos_ocupacion() {
        $('.quitar-ocupacion').on('click',function(e){
            var boton = $(this);
            boton.parent().parent().remove();
        });
    }








    $('#form-registrar-ministro').submit(function(e){
        e.preventDefault();
        //obtener los estudios
        var array_estudios = [];
        $('#table-estudios tr').each(function( index ) {
            var e_tipo = $('.e_tipo', this).html();
            var e_fecha = $('.e_fecha', this).html();
            var e_estudio = $('.e_estudio', this).html();
            var e_lugar = $('.e_lugar', this).html();

            if(e_tipo != undefined && e_estudio != undefined && e_lugar != undefined){
                var aux_array = [e_tipo,e_fecha,e_estudio,e_lugar];
                array_estudios.push(aux_array);
            }
        });


        //obtener las ocupaciones
        var array_ocupacion = [];
        $('#table-ocupacion tr').each(function( index ) {
            var o_tipo = $('.o_tipo', this).html();
            var o_ocupacion = $('.o_ocupacion', this).html();
            var o_fecha = $('.o_fecha', this).html();
            var o_fecha_fin = $('.o_fecha_fin', this).html();

            if(o_tipo != undefined && o_ocupacion != undefined && o_fecha != undefined){
                var aux_array = [o_tipo,o_ocupacion,o_fecha,o_fecha_fin];
                array_ocupacion.push(aux_array);
            }
        });



        var opt = '&opt=add_ministro';
        var dataString = $(this).serialize()+opt;
        dataString +='&array_estudios='+JSON.stringify(array_estudios);
        dataString +='&array_ocupacion='+JSON.stringify(array_ocupacion);
        $.ajax({
            type: "POST",
            url: 'C/tercero_engine.php',
            data: dataString,
            dataType: "json",
            beforeSend: function () {
              $('#form-registrar-ministro button[type="submit"]').html('Guardando <i class="fa fa-spinner fa-spin"></i>');
              $('input, textarea, button', '#form-registrar-ministro').attr('disabled',true);
              $("#form-registrar-ministro select").prop("disabled", true);
            }
        }).done(function(data){
            if(data['response'] == 'exito'){
              alert('exito');
              limpiar_form();
            }else if(data['response'] == 'cedula_existe'){
                alert('cedula duplicada');
            }else{
                alert('error');
            }
        }).fail(function( jqXHR, textStatus, errorThrown ) {
             if ( console && console.log ) {
                 console.log( "La solicitud a fallado: " +  textStatus);
             }
             alert('internet');
        }).always( function() {
            $('#form-registrar-ministro button[type="submit"]').html('Guardar <i class="fa fa-floppy-o"></i>');
            $('input, textarea, button', '#form-registrar-ministro').removeAttr('disabled');
            $("#form-registrar-ministro select").prop("disabled", false);
        });
    });


    function limpiar_form(){
        $("#form-registrar-ministro")[0].reset();
        $('.quitar-estudio').click();
        $('.quitar-ocupacion').click();
    }
    
});