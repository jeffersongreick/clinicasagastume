var URL = 'http://localhost/clinica/';
$(document).ready(function(){
    $('.tab[name$="antMedico"]').addClass("tabSelected");
    $(".tab").click(function(){
        if(!$(this).hasClass("tabSelected")){
            $(".tab").removeClass("tabSelected");
            $('.form').fadeOut("fast");
            $(this).addClass("tabSelected");
            $($(this).attr('name')).fadeIn("4000"); 
        }
    });
    $('#btnNuevoAntecedenteMedico').click(function(){
        $(".block").fadeIn("4000"); 
        $('#ventanaNuevoAntecedente').slideDown("4000");
    });
    $("#btn_cancel_antecedente").click(function(){
        $(".block").fadeOut("fast");
        $("#ventanaNuevoAntecedente").slideUp("fast");
    });
    $("#btn_cancel_antecedente").click(function(){
        $(".block").fadeOut("fast");
        $("#ventanaNuevoAntecedente").slideUp("fast");
    });
    $(".visualizarObservaciones").click(function(){
        if($(this).hasClass("button_down")){
            var p = $(this).parent().siblings(".observacionHistoria");
            $(this).toggleClass("button_down");
            $(p).fadeOut("fast");
        }else{
            var p = $(this).parent().siblings(".observacionHistoria");
            $(this).toggleClass("button_down");
            $(p).fadeIn("fast");
            $(p).css('display','block');
        }
    });
});
