$(document).ready(function(){
    //efectos de iconos de escritorio
    $(".iconoContainer").mouseover(function(){
        $(this).addClass("enfoque");
    }); 
    $(".iconoContainer").mouseout(function(){
        $(this).removeClass("enfoque");
    }); 
    //abre menu de seleccion de registro de odontogramas
    $("#btnRegistroPaciente").click(function(){
        abrirVentana("#registrosOdontogramas");
    });
    //cierra e menu de seleccion de registro de odontogramas
    $("#btnCancelarAccion").click(function(event){
        sliderMenuFuncion(event);
        cerrarVentana("#registrosOdontogramas");
    });
    //cierra la ventana de busqueda de odontogramas
    $("#btnCancelarBusqueda").click(function(event){
        cerrarVentana("#buscarOdontograma");
       
    });
    //asigna la aparicion del buscador de odontogramas
    $("#btnBuscarEstado").click(function(event){
        sliderMenuFuncion(event);
        $("#registrosOdontogramas").slideUp("4000",function(){
            $("#buscarOdontograma").slideDown("4000");
        });
    });
    //funcion no habilitada
    $("#btnTratamiento").click(function(){
        alert("En construccion..");
    });
    //funcion no habilitada
    $("#btnOtros").click(function(){
        alert("En construccion.");
    });
    //funcion no habilitada
    $("#btnHistoria").click(function(){
        alert("En construccion..");
    });
    //despliega el submenu del contenedor
    $("#btnEstadoInicial").click(function(event){
        sliderMenuFuncion(event);
    })
    //despliega el submenu del contenedor
    $("#btnOtrosOdontogramas").click(function(event){
        sliderMenuFuncion(event);
    })
    //abre el menu de seleccion de fecha    
    $("#fromFecha").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
       
        onSelect: function( selectedDate ) {
            $( "#toFecha" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    //abre el menu de seleccion de fecha    
    $( "#toFecha" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        onSelect: function( selectedDate ) {
            $( "#fromFecha" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
});
//Bloquea el uso del escritorio
function bloquearEscritorio(){
    $(".block").fadeIn("4000"); 
}
//desbloquea el uso del escritorio
function desbloquearEscritorio(){
    $(".block").fadeOut("4000"); 
}
//abre una caja pasada por parametro
function abrirVentana(window){
    bloquearEscritorio();
    $(window).slideDown("4000");
}
//cierra una caja pasada por parametro
function cerrarVentana(window){
    desbloquearEscritorio();
    $(window).slideUp("4000");
}
//se realiza el efecto para mostrar y cerrar el menu de funciones
function sliderMenuFuncion(event){
    var menu= $("#registrosOdontogramas");
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