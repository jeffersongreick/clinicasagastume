var URL = 'http://localhost/clinica/';
//capas de odontogramas y editor de pieza
$(document).ready(function(){
    //efectos de iconos de escritorio
    $(".iconoContainer").mouseover(function(){
        $(this).addClass("enfoque");
    });
    $(".iconoContainer").mouseout(function(){
        $(this).removeClass("enfoque");
    }); 
    $("#btnOdontogramas").click(function(){
        abrirVentana("#treatment_manager");
    });
    $("#btnPlanes").click(function(){
        abrirVentana("#treatment_plan");
    });
    //cierra el menu
    $(".button_cancel_menu").click(function(event){
        sliderMenuFuncion(event,$(this).parents().find('.function'));
        cerrarVentana($(this).parents().find('.function'));
    });
    //despliega el submenu del contenedor
    $(".button_menu").click(function(event){
        sliderMenuFuncion(event,$(this).parents().find('.function'));
    })
});

//abre una caja pasada por parametro
function abrirVentana(window){
    //Bloquea el uso del escritorio
    $(".block").fadeIn("fast"); 
    $(window).slideDown("fast");
}
//cierra una caja pasada por parametro
function cerrarVentana(window){
    //desbloquea el uso del escritorio
    $(".block").fadeOut("fast");
    $(window).slideUp("fast");
}
//se realiza el efecto para mostrar y cerrar el menu de funciones
function sliderMenuFuncion(event,menu){
    var link=$(event.currentTarget);
    if (link.parent().find('ul.active').size()==1){
        link.parent().find('ul.active').slideUp('medium',function(){
            link.parent().find('ul.active').removeClass('active');
        });
    }else if (menu.find('ul li ul.active').size()==0){
        link.parent().find('ul').addClass('active');
        link.parent().find('ul').slideDown('medium');
    }else{
        menu.find('ul li ul.active').slideUp('medium',function(){
            menu.find('ul li ul').removeClass('active');
            link.parent().find('ul').addClass('active');
            link.parent().find('ul').slideDown('medium');
        });
    }  
}
function finalizarTratamiento(){
    if(confirm("¿Esta seguro que quiere finalizar el tratamiento?")){
        $.get(URL+"tratamiento/finalizarTratamiento/",function(data){
            if(data == true){
                alert("¡El tratamiento se ha finalizado exitosamente!");
                location.href=URL+'usuario/principal/';
            }else{
                alert(data);
            }
        });
    }   
}
function odontogramaInicial(){
    location.href=URL+'odontograma/inicial/';
}
function nuevoPlanTratamientoPropuesto(){
    location.href=URL+'odontograma/planTratamiento/3';
}
function nuevoPlanTratamientoCompromiso(){
    location.href=URL+'odontograma/planTratamiento/4';
}
function nuevoOdontogramaEstados(){
    location.href=URL+'odontograma/estados/';
}
function tratamientoCurso(){
    location.href=URL+'odontograma/tratamientoCurso/';
}
function tratamientosRealizados(){
    location.href=URL+'odontograma/tratamientoRealizado/';
}
function visualizarEstadoActual(){
    location.href=URL+'odontograma/visualizar_odontograma_estados/2';
}
function visualizarPlanPropuesto(){
    location.href=URL+'odontograma/visualizar_plan/3';
}
function visualizarPlanCompromiso(){
    location.href=URL+'odontograma/visualizar_plan/4';
}
function visualizarTratamientoCurso(){
    location.href=URL+'odontograma/visualizar_tratamiento/5';
}
function visualizarTratamientoRealizado(){
    location.href=URL+'odontograma/visualizar_tratamiento/6';
}
function historiaClinica(){
    location.href=URL+'historia/index/';
}




