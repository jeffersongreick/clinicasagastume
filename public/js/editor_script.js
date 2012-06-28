//capas de odontogramas y editor de pieza
var layerPieza, layerOdontograma;
//escena del canvas donde se agragara los layers
var stageOdontograma , stagePieza;
//ayuda a establecer la posicion del ultimo item (estado o prestacion agregado a una pieza en edicion)
var posicion = 400;
var request_http  = XMLHttpRequest;

$(document).ready(function(){
    //al empezar se cargan los canvas del odontograma y del editor de piezas 
    cargarOdontograma();
    cargarPiezaEdicion();
    //    efecto de enfoque
    $("img").mouseover(function(){
        $(this).addClass("enfoque");
        $('#description').html($(this).attr("name"));
    });
    $("img").mouseout(function(){
        $(this).removeClass("enfoque");
    });
    //    cambia entre opciones de items estados o prestaciones
    $("#tab-1").click(function(){
        $(".prestaciones").fadeOut("2000",function(){
            $("#description").html("");
            $(".estados").fadeIn("2000");
        });
    })
    $("#tab-2").click(function(){
        $(".estados").fadeOut("2000",function(){
            $("#description").html("");
            $(".prestaciones").fadeIn("2000");    
        });
    })
    //    cambia de odontograma a edicion de pieza
    $('#btnEditarPieza').click(function(){       
        $('#slideContainer').animate({
            scrollLeft:1000
        },500);
    });
    $('#btnCancelar').click(function(){       
        $('#slideContainer').animate({
            scrollLeft:0
        },500);
    });
    $('#btnGuardar').click(function(){       
        $('#slideContainer').animate({
            scrollLeft:0
        },500);
    });
    
});
//funcion de dibujo de odontogramas en canvas
function cargarOdontograma(){
    stageOdontograma = new Kinetic.Stage({
        container: "canvasOdontograma",
        width: 980,
        height: 400
    });
    layerOdontograma = new Kinetic.Layer();
    //    carga el maxilar superior del odontograma
    var pos = 10;
    var idPieza = 1;
    for(var i=1;i<17;i++){
        var imag = new Image();
        imag.onload = function() {
            var image = new Kinetic.Image({
                x: pos,
                y: 0,
                image: imag,
                width: 50,
                height: 100,
                id : idPieza
            });
            generadorCoronasOdontograma(pos,110,layerOdontograma,stageOdontograma);
            layerOdontograma.add(image);
            stageOdontograma.add(layerOdontograma);
            pos += 60;
            idPieza +=1;
            
        }
        imag.src = "http://localhost/clinica/odontograma/public/img/img_pieza/pz_1.png";    
    }
    //    carga el maxilar inferioirdel odontograma
    var pos2 = 60;
    for(var i=1;i<17;i++){
        var imag = new Image();
        imag.onload = function() {
            var image = new Kinetic.Image({
                x: pos2,
                y: 360,
                image: imag,
                width: 50,
                height: 100,
                radius: 70,
                id : idPieza
            });
            image.rotate(3.14);
            generadorCoronasOdontograma(pos2-50,190,layerOdontograma,stageOdontograma);
            layerOdontograma.add(image);
            stageOdontograma.add(layerOdontograma);
            pos2 += 60;
            idPieza +=1;
        }
        imag.src = "http://localhost/clinica/odontograma/public/img/img_pieza/pz_1.png";      
    }
    //agregar el evento de seleccion de pieza al cliquear con el mouse
    layerOdontograma.on('click', function(evt) {
        var shape = evt.shape;
        if(shape.isSelected()){
            shape.setSelected(false);
            shape.setAlpha(1);
            shape.setStroke("none");
        }else{
            shape.setAlpha(0.5);
            shape.setStroke("white");
            shape.setSelected(true);
        }
        layerOdontograma.draw();
    });
    layerOdontograma.draw();
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
//diseña la referencia a las caras de cada pieza del odontograma. 
//Se rfeciben los parametros de la posicion de cada pieza y de que capa.
function generadorCoronasOdontograma(posX,posY, layer, stage){
    //    caras alrededor de la pieza
    var cara1 = generadorCara(posX, posY, posX + 20, posY - 10, posX + 40, posY, posX +28, posY +12, posX+12, posY+12,1);
    var cara2 = generadorCara(posX+40, posY, posX+50, posY+20, posX+40, posY+40, posX+28, posY+28, posX+28, posY+12,2);
    var cara3 = generadorCara(posX+40, posY+40, posX+20, posY+50, posX, posY+40, posX+12, posY+28, posX+28, posY+28,3);
    var cara4 = generadorCara(posX, posY + 40 , posX-10, posY+20, posX, posY, posX + 12, posY+12, posX+12,posY+28,4);
    //    parte central del diente
    var cara5 = new Kinetic.Rect({
        x: posX+12,
        y: posY+12,
        width: 16,
        height: 16,
        id:"5",
        fill: "white", 
        stroke: "red",
        strokeWidth: 0.3
    });
    //    periodonto
    var cara6 = new Kinetic.Shape({
        drawFunc: function() {
            var context = this.getContext();
            context.beginPath();
            context.moveTo(posX-5, posY+30);
            context.lineTo(posX-5,posY+55);
            context.lineTo(posX + 45, posY+55);
            context.lineTo(posX+45, posY+30);
            context.closePath();
            this.fill();
            this.stroke();
        },
        stroke: "red",
        strokeWidth: 0.7,
        fill: "white",
        id:"6"
    });
    layer.add(cara6);
    layer.add(cara1);
    layer.add(cara2);
    layer.add(cara3);
    layer.add(cara4);
    layer.add(cara5);
    stage.add(layer);
}
//diseña en el canvas la pieza seleccionada a edita
function cargarPiezaEdicion(){
    stagePieza = new Kinetic.Stage({
        container: "canvasPieza",
        width: 200,
        height: 480
    });
    layerPieza = new Kinetic.Layer();
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
    var cara6 = new Kinetic.Shape({
        drawFunc: function() {
            var context = this.getContext();
            context.beginPath();
            context.moveTo(5, 100);
            context.lineTo(5,240);
            context.lineTo(195, 240);
            context.lineTo(195, 100);
            context.closePath();
            this.fill();
            this.stroke();
        },
        stroke: "red",
        strokeWidth: 0.5,
        fill: "white",
        id:"6"
    });
    //    agrega al canvas la imagen del diente a personalizar
    var imagenObj = new Image();
    imagenObj.onload = function() {
        var image = new Kinetic.Image({
            x: 60,
            y: 260,
            image: imagenObj,
            width: 80,
            height: 200
        });
        layerPieza.add(image);
        stagePieza.add(layerPieza);
    };
    imagenObj.src = "http://localhost/clinica/odontograma/public/img/img_pieza/pz_1.png";      
    cara1.on("click", marcarCara );
    cara2.on("click", marcarCara );
    cara3.on("click", marcarCara );
    cara4.on("click", marcarCara );
    cara5.on("click", marcarCara );
    cara6.on("click", marcarCara );
    layerPieza.add(cara6);
    layerPieza.add(cara1);
    layerPieza.add(cara2);
    layerPieza.add(cara3);
    layerPieza.add(cara4);
    layerPieza.add(cara5);
    stagePieza.add(layerPieza);
}
//evento asignado a marcar el area seleccionada de una pieza
function marcarCara(){
    if(this.getFill() == "white"){
        this.get
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
//diseña en la imagen de la pieza editada la figura asignada el estado o prestacion
//si el item esta seleccionado marca, sino el contrario
function marcarPieza(id,cb){
    if(cb.checked){
        var imagenObj = new Image();
        imagenObj.onload = function() {
            var image = new Kinetic.Image({
                x: 80,
                y: 210,
                image: imagenObj,
                width: 60,
                height: 60,
                id : id,
                name: "item"
            });
            layerPieza.add(image);
            stagePieza.add(layerPieza);
            image.transitionTo({
                x: 80,
                y: posicion,
                duration: 2,
                easing: "strong-ease-out"
            });
            posicion -=50;
            
        };
        imagenObj.src = "http://localhost/clinica/odontograma/public/img/ico_prestaciones/img"+id+".png"; 
    }else{
        layerPieza.remove(stagePieza.get('#'+id)[0]);
        var items = layerPieza.get(".item");
        posicion = 400;
        for(var i = 0;i < items.length ;i++){
            var img = items[i];
            img.transitionTo({
                x: 80,
                y: posicion,
                duration: 2,
                easing: "strong-ease-out"
            }); 
            posicion -=50;   
        }
    }
}
