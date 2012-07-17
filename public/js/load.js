var URL = "http://localhost/clinica/";
var layerPieza;
//escena del canvas donde se agragara los layers
var stageOdontograma , stagePieza;
//ayuda a establecer la posicion del ultimo item (estado o prestacion agregado a una pieza en edicion)
var posicion = 200;
var piezaEditada;
var caraEditada;
//variable que guarda la imagen de la pieza y de los estados
var group;
//window.onbeforeunload = function(){
//    return "Esta a punto de descartar este odontograma";
//}
window.onload = function(){
    stagePieza = new Kinetic.Stage({
        container: "canvasPieza",
        width: 200,
        height: 300
    });
    layerPieza = new Kinetic.Layer();
    group = new Kinetic.Group({
        draggable: false
    });
    //    efecto de enfoque en items de estado y prestacion
    $(" label img").mouseover(function(){
        $(this).addClass("enfoque");
        $('#item_description').html($(this).attr("name"));
    });
    $("label img").mouseout(function(){
        $(this).removeClass("enfoque");
    });
    //    cambia entre opciones de items estados o prestaciones
    $("#tab_state").click(function(){
        $(".treatment_items").fadeOut("2000",function(){
            $("#item_description").html("");
            $(".state_items").fadeIn("2000");
        });
    })
    $("#tab_treatment").click(function(){
        $(".state_items").fadeOut("2000",function(){
            $("#item_description").html("");
            $(".treatment_items").fadeIn("2000");    
        });
    })
    //    cambia de odontograma a edicion de pieza
    $('#btnEditarPieza').click(function(){ 
        if(piezaEditada){
            cargarCara("1");
            $('#slideContainer').animate({
                scrollLeft:1000
            },500);
        }else{
            alert("No ha seleccionado ninguna pieza");
        }
    });
    $('.cara').click(function(){
        cargarCara($(this).attr("value"));
    });
    
    $('#btnCancelar_edicion_pieza').click(function(){ 
        $('.item').removeAttr('checked');
        posicion = 200;
        
        $('#slideContainer').animate({
            scrollLeft:0
        },500);
    });
    $('#btnGuardar_edicion_pieza').click(function(){    
        $('.item').removeAttr('checked');
        posicion = 200;
        piezaEditada.draw();
        $('#slideContainer').animate({
            scrollLeft:0
        },500);
    });
    $('#btnCambiarPieza').click(function(){
        if(piezaEditada){
            abrirVentana('#ventanaCambioPieza');
        }else{
            alert("No ha seleccionado ninguna pieza");
        }
       
    });
    $('#btnCancelarNuevaPieza').click(function(){
        cerrarVentana('#ventanaCambioPieza');
    });
    $('#btnGuardarNuevaPieza').click(function(){
        cambiarPieza(51);
        cerrarVentana('#ventanaCambioPieza');
    });
    cargarOdontograma();
//    cambiarPieza(51);
};
//funcion de dibujo de odontogramas en canvas
function cargarOdontograma(){
    stageOdontograma = new Kinetic.Stage({
        container: "canvasOdontograma",
        width: 980,
        height: 400
    });
    //    carga el maxilar superior del odontograma
    var pos = 15;
    for(var i=8;i>=1;i--){
        var p1 = new Pieza("1"+i,pos,0);
        stageOdontograma.add(p1.layer);
        var p2 = new Pieza("4"+i,pos,270);
        stageOdontograma.add(p2.layer);
        pos += 60;
    }
    for(var i=1;i<=8;i++){
        var p1 = new Pieza("2"+i,pos,0);
        stageOdontograma.add(p1.layer);
        var p2 = new Pieza("3"+i,pos,270);
        stageOdontograma.add(p2.layer);
        pos += 60;
       
    }
}
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