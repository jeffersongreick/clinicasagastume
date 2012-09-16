var URL = 'http://localhost/clinica/';
$(document).ready(function(){
    $('#btnNuevoTratamiento').click(function(){
        $(".block").fadeIn("4000"); 
        $('#nuevoTratamiento').slideDown("4000");
    }); 
    $(".iconoContainer").mouseover(function(){
        $(this).addClass("enfoque");
    });
    $(".iconoContainer").mouseout(function(){
        $(this).removeClass("enfoque");
    });
    $("#buscarTratamiento .button_cancel").click(function(){
        $(".block").fadeOut("4000");
        $("#buscarTratamiento").slideUp("4000");
        $("tr").removeClass("selected");
        $('#listTratamientos table tbody').children().remove();
    }); 
   
   
});
function nuevo_tratamiento(){
    $('#img_load').css('display','block');
    var json = {
        ci:$('#patient_ci').attr("value"),
        observacion:$('#observacionTratamiento').val()
    };
    $.post(URL+"tratamiento/nuevoTratamiento/",json, function(data) {
        alert(data);
        $(".block").fadeOut("4000");
        $("#nuevoTratamiento").slideUp("4000");
        $('#nuevoTratamiento').children().remove();
    }).fail(function(error){
        alert(error.responseText);
    }).always(function() {
        $('#img_load').css('display','none');
    });
}
function ingresar_tratamiento(){
    if($('.selected').attr("value")){
        location.href=URL+'tratamiento/tratamiento/'+$('.selected').attr("value");
    }else{
        alert("No se ha seleccionado ningún tratamiento.");
    }
}
function mantenimiento_usuarios(){
    location.href=URL+'usuario/mantenimientoUsuarios/';
}
function loadTratamientos(){
    $(".block").fadeIn("4000"); 
    $('#buscarTratamiento').slideDown("4000");
    $('#img_load').css('display','block');
    $.ajax({
        type: 'POST',
        url: URL+"/tratamiento/getTratamientos/",
        success: function(tratamientos){
            $('#listTratamientos table tbody').append(tratamientos);
        }
    }).fail(function(error){
        alert(error.responseText);
    }).always(function() {
        $('#img_load').css('display','none');
    });
}
function abrirBuscadorPacientesTratamiento(){
    $('#nuevoTratamiento').children().remove();
    var b = "<div id='buscador'><h2 class='title3'>Seleccione el paciente</h2>"+
    "<input type='search' results='5' id='search' class='fieldText'"+  
    "placeholder='Nombre' pattern='[0-9]{4}' title='Filtro de busqueda'/>"+
    "<div class='table_list' id='listPacientes' style='overflow-y: auto;width: 480px;height: 400px;'>"+
    "<table><tbody></tbody></table></div></div>"+
    " <div id='contenedor_botones' ><input type='button' id='btnAceptarPaciente' "+
    "onclick='cargarTratamientoPaciente()' class='button' value='Aceptar'/>"+
    "<input type='button' id='btnBuscarPaciente' onclick='loadPacientes()' class='button' value='Buscar'/>"+
    "<input type='button' class='button_cancel' value='Cancelar'/></div>";
    $('#nuevoTratamiento').append(b);
    $(".block").fadeIn("4000"); 
    $('#nuevoTratamiento').slideDown("4000");

    $("#nuevoTratamiento .button_cancel").click(function(){
        $(".block").fadeOut("4000");
        $("#nuevoTratamiento").slideUp("4000");
        $('#nuevoTratamiento').children().remove();
    }); 
}
function loadPacientes(){
    var str = $('#search').attr("value");
    if(str){
        $('#search').attr('disabled');
        $('#listPacientes table tbody').children().remove();
        $('#img_load').css('display','block');
        $.ajax({
            type: 'POST',
            url: URL+"/paciente/getPacientes/"+str,
            success: function(pacientes){
                $('#listPacientes table tbody').append(pacientes);
            }
        }).fail(function(error){
            alert(error.responseText);
        }).always(function() {
            $('#img_load').css('display','none');
            $('#search').removeAttr('disabled');
        });
    }else{
        alert("Favor ingresar el nombre a buscar.");
    }
}
function cargarTratamientoPaciente(){
    var cedula = $('.selected').attr("value");
    if(cedula){
        $('#nuevoTratamiento').children().remove();
        $('#img_load').css('display','block');
        $.ajax({
            type: 'POST',
            url: URL+"/paciente/getTratamientoPaciente/"+cedula,
            success: function(paciente){
                $('#nuevoTratamiento').append(paciente);
                $("#generador").slideDown("4000");
                $("#nuevoTratamiento .button_cancel").click(function(){
                    $(".block").fadeOut("4000");
                    $("#nuevoTratamiento").slideUp("4000");
                    $('#nuevoTratamiento').children().remove();
                }); 
            }
        }).fail(function(error){
            alert(error.responseText);
        }).always(function() {
            $('#img_load').css('display','none');
        });
    }else{
        alert("No se ha seleccionado ningún paciente.");
    }
}
function seleccionar(row){
    $("tr").removeClass("selected");
    $(row).addClass("selected");
};