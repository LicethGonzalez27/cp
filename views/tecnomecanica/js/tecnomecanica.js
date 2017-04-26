$(document).ready(function(){

    $("#btn_nuevo_tecnomecanica").click(function(){
        $.post($("#BASE_URL").val() + 'tecnomecanica/crear_tecnomecanica',
        'consecutivo=' + $("[name=consecutivo]").val() +
        '&fec_expedicion=' + $("[name=fec_expedicion]").val() +
        '&fec_vencimiento=' + $("[name=fec_vencimiento]").val() +
        '&id_automotor=' + $("[name=automotor]").val() )

    });

});