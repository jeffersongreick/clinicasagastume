var URL = 'http://localhost/GitClinicaSagastume/';
$(document).ready(function(){
    $('#btnPacientes').click(function(){
        alert("En construccion...");
    });
    $('#btnPrestaciones').click(function(){
        alert("En construccion...");
    });
    $('#btnUsuarios').click(function(){
        alert("En construccion...");
    });
    $('#btnControlUsuarios').click(function(){
        alert("En construccion...");
    });
    $('#btnTratamientos').click(function(){
        $(".block").fadeIn("4000"); 
        $('#buscarPaciente').slideDown("4000");
    });
    $(".button_cancel").click(function(){
        $(".block").fadeOut("4000");
        $("#buscarPaciente").slideUp("4000",function(){
            $('#contenedor_botones .button').remove();
            $('#patient_treatment').children().remove();
            $('.error_msg').remove();
            $('#patient_ci').html('C.I.:');
            $('#patient_name').html('Nombre:');
            $('#search_ci').attr("value","");
        });
    }); 
    
    $(".iconoContainer").mouseover(function(){
        $(this).addClass("enfoque");
    });
    $(".iconoContainer").mouseout(function(){
        $(this).removeClass("enfoque");
    });
    $("#btn_treatment_accept").click(function(){
        
        });
    $('#search_ci').keypress(function(event){
        if(event.keyCode == '13'){
            if($('#search_ci').attr("value") == ""){
                $(this).animate({
                    opacity: 0.25
                }, 200)       
                .animate({
                    opacity: 1
                }, 200);
            }else{
                $("#patient_treatment").fadeOut(200,function(){
                    $('#contenedor_botones').fadeOut(200);
                    $('#contenedor_botones .button').remove();
                    $('.error_msg').remove();
                    $('#patient_treatment').children().remove();
                    $('#patient_ci').html('C.I.:');
                    $('#patient_name').html('Nombre:');
                    cargarPaciente();
                });
            }
        }
        event.stopPropagation();
    });
});
function cargarPaciente(){
    $('#img_load').css('display','block');
    $('#search_ci').attr("disabled","disabled");
    var cedula = $('#search_ci').attr("value");
    $.ajax({
        type: 'POST',
        url: URL+"/paciente/getTratamientoPaciente/"+cedula,
        dataType: 'json',
        success: function(paciente){
            $('#patient_ci').html('C.I.: '+paciente.ci);
            $('#patient_ci').attr("value",paciente.ci);
            $('#patient_name').html('Nombre: '+paciente.nombre);
            if(paciente.tratamientos == false){
                $('#patient_treatment').append('<p class="data">El paciente no tiene un tratamiento en curso.¿Desea empezar un nuevo tratamiento?</p>');
                $('<input type="submit" id="btn_treatment_new" onclick="nuevo_tratamiento()" class="button" value="Nuevo"/>').insertBefore('#contenedor_botones .button_cancel');
                $("#patient_treatment").fadeIn(500);
                $('#contenedor_botones').fadeIn(500);
            }else{
                var tratamiento = paciente.tratamientos;
                $('#patient_treatment').append('<p id="treatment_id" value="'+tratamiento.id+'" class="data">id: '+tratamiento.id+'</p>');
                $('#patient_treatment').append('<p id="Data_init" class="data">Fecha inicio: '+tratamiento.fecha_ins+'</p>');
                $('#patient_treatment').append('<p id="Data_fin" class="data">Ultimo registro: </p>');
                $('#patient_treatment').append('<p id="treatment_state" class="data">Estado: en curso</p>');
                $('<input type="submit" id="btn_treatment_accept" class="button" onclick="ingresar_tratamiento()" value="Ingresar"/>').insertBefore('#contenedor_botones .button_cancel');
                $("#patient_treatment").fadeIn(500);
                $('#contenedor_botones').fadeIn(500);
            }
        }
        
    }).fail(function(error){
        $('<p class="error_msg"  style="color: red;text-align: center">'+error.responseText+'</p>').insertBefore('#patient_data #patient_ci');
        $("#patient_treatment").fadeIn(500);
        $('#contenedor_botones').fadeIn(500);
    }).always(function() {
        $('#img_load').css('display','none');
        $('#search_ci').removeAttr('disabled');
        $('#contenedor_botones').fadeIn(500);
    });
}
function nuevo_tratamiento(){
    location.href=URL+'tratamiento/nuevoTratamiento/'+$('#search_ci').attr("value");
}
function ingresar_tratamiento(){
    location.href=URL+'tratamiento/tratamiento/'+$('#treatment_id').attr("value");
}
