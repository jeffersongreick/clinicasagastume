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
window.onload = function(){
    cargarOdontograma();
};
//funcion de dibujo de odontogramas en canvas
function cargarOdontograma(){
    group = new Kinetic.Group({
        draggable: false
    });
    asignarPosicionesIsquierda('1',15,0);
    asignarPosicionesDerecha('2',495,0);
    asignarPosicionesIsquierda('4',15,270);
    asignarPosicionesDerecha('3',495,270);
    stageOdontograma = new Kinetic.Stage({
        container: "canvasOdontograma",
        width: 980,
        height: 400
    });
    layerOdontograma = new Kinetic.Layer();
    var id;
    for(i in piezas){
        id = piezas[i].id;
        var ps;
        var posX = odontograma[piezas[i].pos].posX;
        var posY = odontograma[piezas[i].pos].posY;
        if(id == 0){
            ps = new vacio(id,piezas[i].pos,posX,posY);
        }else{
            ps = new Pieza(id,piezas[i].pos,posX,posY);
            var caras = piezas[i].caras;
            for(x in caras){
                var estados = caras[x].estados;
                for(y in estados){
                 cargarEstadosPieza(ps,caras[x].id,{id:estados[y].id,activo:estados[y].activo});

                }
            }
        }
        odontograma[piezas[i].pos].pieza= ps;
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
function asignarPosicionesDerecha(num,x,y){
    for(var i = 1;i<=8;i++){
        var pos = num+i;
        var position = {
            id:pos,
            posX:x,
            posY:y,
            pieza:null
        };
        x+=60;
        odontograma[pos]=position;
    }
}
function asignarPosicionesIsquierda(num,x,y){
    for(var i = 8;i>=1;i--){
        var pos = num+i;
        var position = {
            id:pos,
            posX:x,
            posY:y,
            pieza:null
        };
        x+=60;
        odontograma[pos]=position;
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
