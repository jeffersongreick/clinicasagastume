$(document).ready(function(){
    $('#search_prestacion').keypress(function(event){
        if(event.keyCode == '13'){
            if($('#search_prestacion').attr("value") == ""){
                $(this).animate({
                    opacity: 0.25
                }, 200)       
                .animate({
                    opacity: 1
                }, 200);
            }else{
                cargarPrestaciones();
            }
        }
        event.stopPropagation();
    });
});
function cargarPrestaciones(){
//    $('#img_load').css('display','block');
    $('#search_prestacion').attr("disabled","disabled");
    var str= $('#search_prestacion').attr("value");
    $.ajax({
        type: 'POST',
        url: URL+"/tratamiento/listarPrestaciones/"+str,
        dataType: 'json',
        success: function(data){
            $('#option_list').append(data);
        }
        
    }).fail(function(error){
//        $('<p class="error_msg"  style="color: red;text-align: center">'+error.responseText+'</p>').insertBefore('#patient_data #patient_ci');
//        $("#patient_treatment").fadeIn(500);
//        $('#contenedor_botones').fadeIn(500);
    }).always(function() {
//        $('#img_load').css('display','none');
//        $('#search_ci').removeAttr('disabled');
//        $('#contenedor_botones').fadeIn(500);
    });
}
