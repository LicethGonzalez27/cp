$(document).ready(function(){
    
    var getRoles = function(){
        $.post($("#BASE_URL").val() + 'acl/getRoles', function(datos){
            $("#roles").html('');
            
            for(var i = 0; i < datos.length; i++){
                active = '';
                if (i == 0) {
                    active = 'active';
                }
                $("#roles").append('<li role="presentation" class="' + active + '"><a href="#' + datos[i].rol + '" aria-controls="'+ datos[i].rol +'" role="tab" data-toggle="tab">'+ datos[i].rol +'</a></li>');
                $("#tab_permisos").append('<div role="tabpanel" class="tab-pane" id="'+datos[i].rol+'">Debe asignar los permisos</div>');
            }
            
        }, 'json');
    }
    
    $("#btn_nuevo_usuario").click(function(){
        if ($("#pass").val() == $("#confirmar_pass").val()) {
            $.post($("#BASE_URL").val() + 'usuarios/crear_usuario',
            'usuario=' + $("#usuario").val() +
            '&pass=' + $("#pass").val() +
            '&id_rol=' + $("#rol").val())
        }else{
            alert($("#usuario").val()+$("#pass").val()+$("#idRol").val());
        }
        //getRoles();
        //$('#myModal').modal('hide');
    });

    
    $("#btn_nuevo_permiso").click(function(){
        $.post($("#BASE_URL").val() + 'acl/crear_permiso',
        'modulo=' + $("#modulo").val() +
        '&permiso=' + $("#permiso").val() +
        '&key=' + $("#key").val())
    });

    $("[data-permiso]").click(function(){
        if ($(this).prop("checked")) {
            $("[name="+$(this).val()+"ag]").prop("checked", true);
            $("[name="+$(this).val()+"co]").prop("checked", true);
            $("[name="+$(this).val()+"mo]").prop("checked", true);
            $("[name="+$(this).val()+"el]").prop("checked", true);
            $("[name="+$(this).val()+"im]").prop("checked", true);
            $("[name="+$(this).val()+"ex]").prop("checked", true);
        }else{
            $("[name="+$(this).val()+"ag]").prop("checked", false);
            $("[name="+$(this).val()+"co]").prop("checked", false);
            $("[name="+$(this).val()+"mo]").prop("checked", false);
            $("[name="+$(this).val()+"el]").prop("checked", false);
            $("[name="+$(this).val()+"im]").prop("checked", false);
            $("[name="+$(this).val()+"ex]").prop("checked", false);
        }
    });

    $("#check_agregar").click(function(){
        if ($('#check_agregar').prop("checked")) {
            $( "[data-agregar]" ).prop("checked", true);
        }else{
            $( "[data-agregar]" ).prop("checked", false);
        }
    });

    $("#check_consultar").click(function(){
        if ($('#check_consultar').prop("checked")) {
            $( "[data-consultar]" ).prop("checked", true);
        }else{
            $( "[data-consultar]" ).prop("checked", false);
        }
    });

    $("#check_modificar").click(function(){
        if ($('#check_modificar').prop("checked")) {
            $( "[data-modificar]" ).prop("checked", true);
        }else{
            $( "[data-modificar]" ).prop("checked", false);
        }
    });

    $("#check_eliminar").click(function(){
        if ($('#check_eliminar').prop("checked")) {
            $( "[data-eliminar]" ).prop("checked", true);
        }else{
            $( "[data-eliminar]" ).prop("checked", false);
        }
    });

    $("#check_imprimir").click(function(){
        if ($('#check_imprimir').prop("checked")) {
            $( "[data-imprimir]" ).prop("checked", true);
        }else{
            $( "[data-imprimir]" ).prop("checked", false);
        }
    });

    $("#check_exportar").click(function(){
        if ($('#check_exportar').prop("checked")) {
            $( "[data-exportar]" ).prop("checked", true);
        }else{
            $( "[data-exportar]" ).prop("checked", false);
        }
    });

    
});