var i = 0;
$(document).ready(function(){
    
    var getContratante = function(){
        $.post('/cp/planilla/getContratante','buscarContratante=' + $("#buscarContratante").val(),function(datos){
            
            if (datos==false) {
                $("#resultado").html('');
                $("#resultado").append('<label> No se encuentra registrado </label>');
                $("#resultado").append('<input type="hidden" name="contratante" value="" readonly>');
            }
            else{
                $("#resultado").html('');
                $("#resultado").append('<label>' + datos.nombres + ' '+ datos.apellidos +'</label>');
                $("#resultado").append('<input type="hidden" name="contratante" value="' + datos.id + '" readonly>');
                
            }
            
        }, 'json');
    }

    var getPasajero = function(){

        $.post('/cp/planilla/getPasajero','buscarPasajero=' + $("#buscarPasajero").val(),function(datos){
            
            if ((datos==false) || (i==5)) {
                cedula = $("#buscarPasajero").val();
                $("#resultadoPasajeros").html('');
                $("#resultadoPasajeros").append('<label > No se encuentra registrado <br> </label>');
                $("#resultadoPasajeros").append('<a href="#modal-nuevo" id="btn_agregar_pasajero" class="btn btn-primary btn-xs" data-toggle="modal" title="Agregar" data-whatever="'+cedula+'">Agregar Pasajero</a>');

                $('#modal-nuevo').on('show.bs.modal', function (event) {
                  var button = $(event.relatedTarget) // Button that triggered the modal
                  var recipient = button.data('whatever') // Extract info from data-* attributes
                  var modal = $(this)
                  modal.find('#cedula').val(recipient)
                })
            }
            else{
                repetido = false
                for (var j = 1; j <= i; j++) {
                    if ($("#buscarPasajero").val() == $("[name=pax"+j+"]").val()) {
                        repetido = true;
                        break;
                    }
                }

                if (repetido == true) {
                    $("#resultadoPasajeros").html('');
                    $("#resultadoPasajeros").append('<label > No puede agregar el mismo pasajero varias veces </label>');
                }else{
                    i++;
                    $("#resultadoPasajeros").html('');
                    pax = '<tr id="pax'+ i +'"> '+
                            '<td><input type="hidden" name="pax'+ i +'" value="' + datos.cedula + '"> '+ i +' </td>'+
                            '<td>' + datos.cedula + '</td>'+
                            '<td>' + datos.nombres + '</td>'+
                            '<td>' + datos.apellidos + '</td>'+
                          ' </tr>';
                    $("#datosPasajeros").append(pax);
                    $("#i").val(i);
                }
                
            }
            
        }, 'json');
    }
     
    $("#btn_nuevo_pasajero").click(function(){
        $.post($("#BASE_URL").val() + 'pasajeros/agregar_pasajero',
        'cedula=' + $("[name=cedula]").val() +
        '&nombres=' + $("[name=nombres]").val() +
        '&apellidos=' + $("[name=apellidos]").val() +
        '&direccion=' + $("[name=direccion]").val() +
        '&telefono=' + $("[name=telefono]").val())

        getPasajero();
    });

    $("#buscarContratante").blur(function(){
        if(!$("#buscarContratante").val()){
            $("#resultado").html('');
        }
        else{
           getContratante(); 
        }
    });

    $("#buscarPasajero").blur(function(){
        if(!$("#buscarPasajero").val()){
            //$("#datosPasajeros").html('');
        }
        else{
           //getPasajero();
        }
    });

    $("#btn_addPax").click(function(){
        if(!$("#buscarPasajero").val()){
            //$("#datosPasajeros").html('');
        }
        else{
           getPasajero();
        }
    });


    
    $("#btn_insertar").click(function(){
        $.post('/cp/planilla/getPasajero',
        'pais=' + $("#pais").val() + '&ciudad=' + $("#ins_ciudad").val())
        
        $("#ins_ciudad").val('');
        getCiudades();
    });


    var getDestino = function(){
        $.post('/cp/planilla/getDestinos','origen=' + $("#origen").val(),function(datos){
            $("#destino").html('');
            //$("#destino").append('<option value="0" disabled selected>Seleccione...</option>');
            for(var i = 0; i < datos.length; i++){
                $("#destino").append('<option value="' + datos[i].destino + '">' + datos[i].destino + '</option>');
            }
            
        }, 'json');
    }


    $("#origen").change(function(){
        if(!$("#origen").val()){
            $("#destino").html('');
            $("#destino").append('<option value="0" disabled selected>Seleccione...</option>');
            $("#recorrido").html('');
            $("#recorrido").append('<option value="0" disabled selected>Seleccione...</option>');
        }
        else{
           getDestino(); 
        }
    });

    var getRecorrido = function(){
        $.post('/cp/planilla/getRecorridos','origen=' + $("#origen").val() + '&destino=' + $("#destino").val(),function(datos){
            $("#recorrido").html('');
            $("#recorrido").append('<option value="0" disabled selected>Seleccione...</option>');
            for(var i = 0; i < datos.length; i++){
                $("#recorrido").append('<option value="' + datos[i].id + '">' + datos[i].recorrido + '</option>');
            }
            
        }, 'json');
    }


    $("#destino").click(function(){
        if(!$("#destino").val()){
            $("#recorrido").html('');
            $("#recorrido").append('<option value="0" disabled selected>Seleccione...</option>');
        }
        else{
           getRecorrido(); 
        }
    });
    
});

function RemoverUltimo(){
    if (i > 0){

        $("#pax"+i).remove(); 
        i--;
        $("#i").val(i);
    }
 
}