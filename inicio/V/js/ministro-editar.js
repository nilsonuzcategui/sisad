$(document).ready(function(){
    $('#add-estudio').on('click',function(){
        var idtercero = $(this).data('idtercero');
        $('#mensaje-estudio').hide();
        
        var e_tipo = $('#e_tipo').val();
        var e_fecha = $('#e_fecha').val();
        var e_estudio = $('#e_estudio').val();
        var e_lugar = $('#e_lugar').val();
        var mensaje_error = '';
        if (e_tipo != '') {
            if (e_estudio != '') {
                if (e_lugar != '') {
                    //AJAX---------------------------------------------------------
                    $.ajax({
                        type: "POST",
                        url: 'C/tercero_engine.php',
                        data: {
                            opt: 'add_estudio',
                            idtercero: idtercero,
                            tipo: e_tipo,
                            fecha: e_fecha,
                            estudio: e_estudio,
                            lugar: e_lugar
                        },
                        dataType: "json",
                        beforeSend: function () {
                            $('#loading-estudio').show();
                            $('#e_tipo').prop("disabled", true);
                            $('#e_fecha, #e_estudio, #e_lugar, #add-estudio').attr('disabled',true);
                        }
                    }).done(function(data){
                        if(data['response'] == 'exito'){
                            var html = '<tr>';
                                    html += '<td class="e_tipo">'+e_tipo+'</td>';
                                    html += '<td class="e_fecha">'+e_fecha+'</td>';
                                    html += '<td class="e_estudio">'+e_estudio+'</td>';
                                    html += '<td class="e_lugar">'+e_lugar+'</td>';
                                    html += '<td><button data-idestudio="'+data['idestudio']+'" type="button" class="btn btn-outline-danger btn-circle quitar-estudio"><i class="fa fa-trash-o"></i> </button></td>';
                            html += '</tr>';
                            $('#table-estudios').append(html);
                            eventos_estudios();
        
                            $('#e_fecha').val('');
                            $('#e_estudio').val('');
                            $('#e_lugar').val('');
                        }else{
                            alert('Hubo un error, vuelva a intentarlo mas tarde.');
                        }
                    }).fail(function( jqXHR, textStatus, errorThrown ) {
                         if ( console && console.log ) {
                             console.log( "La solicitud a fallado: " +  textStatus);
                         }
                         alert('Fallo en la comunicación, compruebe su conexion a internet!');
                    }).always( function() {
                        $('#loading-estudio').hide();
                        $('#e_tipo').prop("disabled", false);
                        $('#e_fecha, #e_estudio, #e_lugar, #add-estudio').removeAttr('disabled');
                    });
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
            var idestudio = boton.data('idestudio');
            $.ajax({
                type: "POST",
                url: 'C/tercero_engine.php',
                data: {
                    opt: 'delete_estudio',
                    idestudio: idestudio
                },
                dataType: "json",
                beforeSend: function () {
                    $('#loading-estudio').show();
                    $('.quitar-estudio').attr('disabled',true);
                }
            }).done(function(data){
                if(data['response'] == 'exito'){
                    boton.parent().parent().remove();
                }else{
                    alert('Hubo un error, vuelva a intentarlo mas tarde.');
                }
            }).fail(function( jqXHR, textStatus, errorThrown ) {
                 if ( console && console.log ) {
                     console.log( "La solicitud a fallado: " +  textStatus);
                 }
                 alert('Fallo en la comunicación, compruebe su conexion a internet!');
            }).always( function() {
                $('#loading-estudio').hide();
                $('.quitar-estudio').removeAttr('disabled');
            });
            
        });
    }
    eventos_estudios();


    //OCUPACIONES
    $('#add-ocupacion').on('click',function(){
        var idtercero = $(this).data('idtercero');
        $('#mensaje-ocupacion').hide();
        
        var o_tipo = $('#o_tipo').val();
        var o_ocupacion = $('#o_ocupacion').val();
        var o_fecha = $('#o_fecha').val();
        var o_fecha_fin = $('#o_fecha_fin').val();

        var mensaje_error = '';
        if (o_tipo != '') {
            if (o_ocupacion != '') {
                if (o_fecha != '') {
                    //AJAX---------------------------------------------------------
                    $.ajax({
                        type: "POST",
                        url: 'C/tercero_engine.php',
                        data: {
                            opt: 'add_ocupacion',
                            idtercero: idtercero,
                            tipo: o_tipo,
                            ocupacion: o_ocupacion,
                            fecha: o_fecha,
                            fecha_fin: o_fecha_fin
                        },
                        dataType: "json",
                        beforeSend: function () {
                            $('#loading-ocupacion').show();
                            $('#e_tipo').prop("disabled", true);
                            $('#e_fecha, #e_estudio, #e_lugar, #add-estudio').attr('disabled',true);
                        }
                    }).done(function(data){
                        if(data['response'] == 'exito'){
                            var html = '<tr>';
                                    html += '<td class="o_tipo">'+o_tipo+'</td>';
                                    html += '<td class="o_ocupacion">'+o_ocupacion+'</td>';
                                    html += '<td class="o_fecha">'+o_fecha+'</td>';
                                    html += '<td class="o_fecha_fin">'+o_fecha_fin+'</td>';
                                    html += '<td><button data-idocupacion="'+data['response']+'" type="button" class="btn btn-outline-danger btn-circle quitar-ocupacion"><i class="fa fa-trash-o"></i> </button></td>';
                            html += '</tr>';
                            $('#table-ocupacion').append(html);
                            eventos_ocupacion();

                            $('#o_ocupacion').val('');
                            $('#o_fecha').val('');
                            $('#o_fecha_fin').val('');
                        }else{
                            alert('Hubo un error, vuelva a intentarlo mas tarde.');
                        }
                    }).fail(function( jqXHR, textStatus, errorThrown ) {
                         if ( console && console.log ) {
                             console.log( "La solicitud a fallado: " +  textStatus);
                         }
                         alert('Fallo en la comunicación, compruebe su conexion a internet!');
                    }).always( function() {
                        $('#loading-ocupacion').hide();
                        $('#e_tipo').prop("disabled", false);
                        $('#e_fecha, #e_estudio, #e_lugar, #add-estudio').removeAttr('disabled');
                    });
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
            var idocupacion = boton.data('idocupacion');
            $.ajax({
                type: "POST",
                url: 'C/tercero_engine.php',
                data: {
                    opt: 'delete_ocupacion',
                    idocupacion: idocupacion
                },
                dataType: "json",
                beforeSend: function () {
                    $('#loading-ocupacion').show();
                    $('.quitar-ocupacion').attr('disabled',true);
                }
            }).done(function(data){
                if(data['response'] == 'exito'){
                    boton.parent().parent().remove();
                }else{
                    alert('Hubo un error, vuelva a intentarlo mas tarde.');
                }
            }).fail(function( jqXHR, textStatus, errorThrown ) {
                 if ( console && console.log ) {
                     console.log( "La solicitud a fallado: " +  textStatus);
                 }
                 alert('Fallo en la comunicación, compruebe su conexion a internet!');
            }).always( function() {
                $('#loading-ocupacion').hide();
                $('.quitar-ocupacion').removeAttr('disabled');
            });
        });
    }

    eventos_ocupacion();

    $('#form-registrar-ministro').submit(function(e){
        e.preventDefault();
        var opt = '&opt=edit_ministro';
        var dataString = $(this).serialize()+opt;

        var idtercero = $('input[name="idtercero"]').val();
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
              //enviar correo electronico
              email(idtercero);
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


    //envio de emails
  function email(idtercero){
    $.ajax({
        type: "POST",
        url: "C/email_gestor.php",
        data: {
            opt: 'email_editar_ministro',
            idtercero: idtercero
        },
        dataType: "json",
    }).done(function(data){
        if(data['response']){
            //swal("Exito!", "Email Enviado!", "success");
            console.log('Envio del Email Exitosamente!');
            return 1;
        }
    }).fail(function( jqXHR, textStatus, errorThrown ) {
         if ( console && console.log ) {
             console.log( "La solicitud a fallado: " +  textStatus);
         }
        return 0;
    });
  }
    
});