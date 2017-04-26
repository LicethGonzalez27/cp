$(document).ready(function(){

    $("#btn_nuevo_pasajero").click(function(){
        $.post($("#BASE_URL").val() + 'pasajeros/agregar_pasajero',
        'cedula=' + $("[name=cedula]").val() +
        '&nombres=' + $("[name=nombres]").val() +
        '&apellidos=' + $("[name=apellidos]").val() +
        '&direccion=' + $("[name=direccion]").val() +
        '&telefono=' + $("[name=telefono]").val())
        
        console.log('si');
    });

});