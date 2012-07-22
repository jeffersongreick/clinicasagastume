var URL = "http://localhost/clinica/";
var layerOdontograma , layerPieza;
//escena del canvas donde se agragara los layers
var stageOdontograma , stagePieza;
var odontograma = [];
//ayuda a establecer la posicion del ultimo item (estado o prestacion agregado a una pieza en edicion)
var posicion = 200;
var piezaEditada,historialPieza;
var caraEditada;
//variable que guarda la imagen de la pieza y de los estados
var group;
var cambios = false;
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
        if(piezaEditada && piezaEditada.id != 0){
            cargarCara("1");
            historialPieza = new Pieza('11',2000,2000);
            historialPieza.Cara1.estados = piezaEditada.Cara1.estados.slice(0);
            historialPieza.Cara2.estados = piezaEditada.Cara2.estados.slice(0);
            historialPieza.Cara3.estados = piezaEditada.Cara3.estados.slice(0);
            historialPieza.Cara4.estados = piezaEditada.Cara4.estados.slice(0);
            historialPieza.Cara5.estados = piezaEditada.Cara5.estados.slice(0);
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
        if (cambios == true){
            if (confirm("AVISO: ¿Desea borrar los cambios realizados en la pieza?")){
                $('.item').removeAttr('checked');
                posicion = 200;
                piezaEditada.Cara1.estados = historialPieza.Cara1.estados.slice(0);
                piezaEditada.Cara2.estados = historialPieza.Cara2.estados.slice(0);
                piezaEditada.Cara3.estados = historialPieza.Cara3.estados.slice(0);
                piezaEditada.Cara4.estados = historialPieza.Cara4.estados.slice(0);
                piezaEditada.Cara5.estados = historialPieza.Cara5.estados.slice(0);
                piezaEditada.Cara1.marcarCara();
                piezaEditada.Cara2.marcarCara();
                piezaEditada.Cara3.marcarCara();
                piezaEditada.Cara4.marcarCara();
                piezaEditada.Cara5.marcarCara();
                layerOdontograma.draw();
                historialPieza = null;
                cambios = false;
                $('#slideContainer').animate({
                    scrollLeft:0
                },500);
            }
        }else{
            $('.item').removeAttr('checked');
            posicion = 200;
            $('#slideContainer').animate({
                scrollLeft:0
            },500);
        }
    });
    $('#btnGuardar_edicion_pieza').click(function(){    
        $('.item').removeAttr('checked');
        posicion = 200;
        piezaEditada.Cara1.marcarCara();
        piezaEditada.Cara2.marcarCara();
        piezaEditada.Cara3.marcarCara();
        piezaEditada.Cara4.marcarCara();
        piezaEditada.Cara5.marcarCara();
        layerOdontograma.draw();
        historialPieza = null;
        cambios = false;
        $('#slideContainer').animate({
            scrollLeft:0
        },500);
    });
    $('#btnCambiarPieza').click(function(){
        if(piezaEditada && piezaEditada.id != 0){
            abrirVentanaCambiarPieza();
        }else{
            alert("No ha seleccionado ninguna pieza");
        }
    });
    $('#btnCancelarNuevaPieza').click(function(){
        cerrarVentana('#ventanaCambioPieza');
    });
    $('#btnExtraer').click(function(){
        //        alert(piezaEditada);
        
        if(piezaEditada && piezaEditada.id != 0){
            extraerPieza();
        }else if(piezaEditada){
            agregarPieza();
        }else{
            alert("No ha seleccionado ninguna pieza");
        }
    });
    $('#btnGuardarNuevaPieza').click(function(){
        cambiarPieza();
        cerrarVentana('#ventanaCambioPieza');
    });
    cargarOdontograma();
};
//funcion de dibujo de odontogramas en canvas
function cargarOdontograma(){
    stageOdontograma = new Kinetic.Stage({
        container: "canvasOdontograma",
        width: 980,
        height: 400
    });
    layerOdontograma = new Kinetic.Layer();
    var id;
    for(i in piezas){
        id = piezas[i].id_pieza;
        var ps;
        if(id == 0){
            ps = new vacio(id,piezas[i].faltante,piezas[i].posX,piezas[i].posY);
        }else{
            ps = new Pieza(id,piezas[i].posX,piezas[i].posY);
            var caras = piezas[i].caras;
            for(x in caras){
                var estados = caras[x].estados;
                for(y in estados){
                    cargarEstadosPieza(ps,caras[x].id,estados[y].id);
                }
            }
        }
        odontograma.push(ps);
    }
    stageOdontograma.add(layerOdontograma);
    layerOdontograma.draw();
}
function cargarEstadosPieza(pieza,idCara,estados){
    switch(idCara){
        case '1':
            pieza.Cara1.estados.push(estados);
            pieza.Cara1.marcarCara();
            break;
        case '2':
            pieza.Cara2.estados.push(estados);
            pieza.Cara2.marcarCara();
            break;
        case '3':
            pieza.Cara3.estados.push(estados);
            pieza.Cara3.marcarCara();
            break;
        case '4':
            pieza.Cara4.estados.push(estados);
            pieza.Cara4.marcarCara();
            break;
        case '5':
            pieza.Cara5.estados.push(estados);
            pieza.Cara5.marcarCara();
            break;
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