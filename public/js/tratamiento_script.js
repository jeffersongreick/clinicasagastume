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
    //funcion no habilitada
    $("#btnHistoria").click(function(){
        alert("En construccion..");
    });
    //despliega el submenu del contenedor
    $(".button_menu").click(function(event){
        sliderMenuFuncion(event,$(this).parents().find('.function'));
    })
});

//abre una caja pasada por parametro
function abrirVentana(window){
    //Bloquea el uso del escritorio
    $(".block").fadeIn("4000"); 
    $(window).slideDown("4000");
}
//cierra una caja pasada por parametro
function cerrarVentana(window){
    //desbloquea el uso del escritorio
    $(".block").fadeOut("4000");
    $(window).slideUp("4000");
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
        F
    }   
}
function validarOdontogramaInicial(){
    $.get(URL+"odontograma/verifOdontInicial/",function(data){
        
        if(data==1){
            location.href=URL+'odontograma/visualizar_odontograma/inicial/';
        }else{
            if(confirm("Todavia no se ha creado un odontograma de estado inicial. ¿Desea crearlo ahora?")){
                location.href=URL+'odontograma/inicial/';
            }
        }
    });
}
function nuevoPlanTratamientoPropuesto(){
    $.get(URL+"odontograma/verifOdontInicial/",function(data){
        if(data==1){
            location.href=URL+'odontograma/planTratamiento/propuesto';
        }else{
            alert("¡Aun no se ha registrado un odontograma de estado inicial para el paciente en este tratamiento!");
        }
    });
}
function nuevoPlanTratamientoCompromiso(){
    $.get(URL+"odontograma/verifOdontInicial/",function(data){
        if(data==1){
            location.href=URL+'odontograma/planTratamiento/compromiso';
        }else{
            alert("¡Aun no se ha registrado un odontograma de estado inicial para el paciente en este tratamiento!");
        }
    });
}
function nuevoOdontogramaEstadoActual(){
    $.get(URL+"odontograma/verifOdontInicial/",function(data){
        if(data==1){
            location.href=URL+'odontograma/actual/';
        }else{
            alert("¡Aun no se ha registrado un odontograma de estado inicial para el paciente en este tratamiento!");
        }
    });
}

function visualizarEstadoActual(){
    $.get(URL+"odontograma/verifOdontInicial/",function(data){
        if(data==1){
            location.href=URL+'odontograma/visualizar_odontograma/actual';
        }else{
            alert("¡No se ha encontrado ningun odontograma para el paciente en este tratamiento!");
        }
    });
}
function visualizarPlanPropuesto(){
    $.get(URL+"odontograma/verifPlan/3",function(data){
        if(data==1){
            location.href=URL+'odontograma/visualizar_odontograma/propuesto';
        }else{
            alert("¡No se ha encontrado ningun odontograma para el paciente en este tratamiento!");
        }
    });
}
function visualizarPlanCompromiso(){
    $.get(URL+"odontograma/verifPlan/4",function(data){
        if(data==1){
            location.href=URL+'odontograma/visualizar_odontograma/compromiso';
        }else{
            alert("¡No se ha encontrado ningun odontograma para el paciente en este tratamiento!");
        }
    });
}

