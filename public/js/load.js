window.onload = function(){
    stagePieza = new Kinetic.Stage({
        container: "canvasPieza",
        width: 200,
        height: 480
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
            cargarCaras.call();
            $('#slideContainer').animate({
                scrollLeft:1000
            },500);
        }else{
            alert("No ha seleccionado ninguna pieza");
        }
    });
    $('#btnCancelar_edicion_pieza').click(function(){ 
        $('.item').removeAttr('checked');
        posicion = 400;
        alert(piezaEditada.estados.toString());
        $('#slideContainer').animate({
            scrollLeft:0
        },500);
    });
    $('#btnGuardar_edicion_pieza').click(function(){    
        $('.item').removeAttr('checked');
        posicion = 400;
        $('#slideContainer').animate({
            scrollLeft:0
        },500);
    });
    cargarOdontograma();
    EditorGenerarCaras();
    
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
        stageOdontograma.add(p1);
        p1.draw();
        var p2 = new Pieza("4"+i,pos,300);
        stageOdontograma.add(p2);
        p2.draw();
        pos += 60;
    }
    for(var i=1;i<=8;i++){
        var p1 = new Pieza("2"+i,pos,0);
        stageOdontograma.add(p1);
        var p2 = new Pieza("3"+i,pos,300);
        stageOdontograma.add(p2);
        pos += 60;
    }
}
//funcion que dibuja una cara de la corona mediante las coordinadas pasadas por parametros(solamente caras de 1 a 4)
function  generadorCara(l1,l2,l3,l4,l5,l6,l7,l8,l9,l0,id){
    var cara = new Kinetic.Shape({
        drawFunc: function() {
            var context = this.getContext();
            context.beginPath();
            context.moveTo(l1, l2);
            context.quadraticCurveTo(l3, l4, l5, l6);
            context.lineTo(l7, l8);
            context.lineTo(l9, l0);
            context.closePath();
            this.fill();
            this.stroke();
        },
        stroke: "red",
        strokeWidth: 0.7,
        fill: "white",
        id:id
    });
    return cara;
}
//diseña en el canvas la pieza seleccionada a edita
function EditorGenerarCaras(){
    var cara1 = generadorCara(20, 20, 100, -15, 180, 20, 140, 60, 60, 60,1);
    var cara2 = generadorCara(180, 20, 215, 100, 180, 180, 140, 140, 140, 60,2);
    var cara3 = generadorCara(180, 180, 100, 215, 20, 180, 60, 140, 140, 140,3);
    var cara4 = generadorCara(20, 180, -15, 100, 20, 20, 60, 60, 60, 140,4);
    var cara5 = new Kinetic.Rect({
        x: 60,
        y: 60,
        width: 80,
        height: 80,
        id:"5",
        fill: "white",
        stroke: "red",
        strokeWidth: 0.5        
    });   
    cara1.on("click", seleccionarCara);
    cara2.on("click", seleccionarCara );
    cara3.on("click", seleccionarCara );
    cara4.on("click", seleccionarCara );
    cara5.on("click", seleccionarCara );
    layerPieza.add(cara1);
    layerPieza.add(cara2);
    layerPieza.add(cara3);
    layerPieza.add(cara4);
    layerPieza.add(cara5);
    stagePieza.add(layerPieza);
}
//evento asignado a marcar el area seleccionada de una pieza
function seleccionarCara(){
    if(this.getFill() == "white"){
        this.setFill("#D41820");
        this.setStroke("white");
        layerPieza.draw();
    }else{
        this.setFill("white");
        this.setStroke("red");
        layerPieza.draw();
    }       
    layerPieza.draw();
}