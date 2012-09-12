$(document).ready(function(){
    $('#nuevoUsuario').click(function(){
        $(".block").fadeIn("4000"); 
        $('.form_usuario').slideDown("4000");
    });
    $("#cancelar").click(function(){
        $(".block").fadeOut("fast");
        $(".form_usuario").slideUp("fast");
    }); 
});
function mostrarDetalles(usr){
    $("#detail_name").val($(usr).text());
    $("tr").removeClass("selected");
    $(usr).addClass("selected");
};
function LimitAttach(tField) { 
    file=tField.value; 
    extArray = new Array(".gif",".jpg",".png"); 
    allowSubmit = false; 
    if (!file) return; 
    while (file.indexOf("\\") != -1) file = file.slice(file.indexOf("\\") + 1); 
    ext = file.slice(file.indexOf(".")).toLowerCase(); 
    for (var i = 0; i < extArray.length; i++) { 
        if (extArray[i] == ext) { 
            allowSubmit = true; 
            break; 
        } 
    } 
    if (!allowSubmit) { 
        tField.value=""; 
        alert("Usted sólo puede subir archivos con extensiones " + (extArray.join(" ")) + "\nPor favor seleccione un nuevo archivo"); 
    } 
}  