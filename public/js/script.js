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
    $("#btnTratamiento").click(function(){
        abrirVentana("#treatment_manager");
    });
    
    //cierra el menu
    $(".button_cancel_menu").click(function(event){
        sliderMenuFuncion(event,$(this).parents().find('.function'));
        cerrarVentana($(this).parents().find('.function'));
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
    $(".button_menu").click(function(event){
        sliderMenuFuncion(event,$(this).parents().find('.function'));
    })
    $("#btnOdontograma_estado_actual").click(function(event){
        sliderMenuFuncion(event,$(this).parents().find('.function'));
        $("#treatment_manager").slideUp("4000",function(){
            $("#buscarOdontograma").slideDown("4000");
        });
    });
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
