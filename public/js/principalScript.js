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
    $(".button_cancel_menu").click(function(){
        $(".block").fadeOut("4000");
        $("#buscarPaciente").slideUp("4000");
    });
    
    $(".iconoContainer").mouseover(function(){
        $(this).addClass("enfoque");
    });
    $(".iconoContainer").mouseout(function(){
        $(this).removeClass("enfoque");
    }); 
});