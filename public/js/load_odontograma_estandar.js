var URL = "http://localhost/clinica/";
var layerOdontograma,stageOdontograma;
var piezaEditada;
//escena del canvas donde se agragara los layers
var odontograma = [];
//variable que guarda la imagen de la pieza y de los estados
var group;
//funcion de dibujo de odontogramas en canvas
window.onload = function(){
    cargarOdontograma();
};
function cargarOdontograma(){
    group = new Kinetic.Group({
        draggable: false
    });
    layerOdontograma = new Kinetic.Layer();

    asignarPosicionesIsquierda('1',90,18);
    asignarPosicionesDerecha('2',490,18);
    
    asignarPosicionesIsquierdaInf('5',240,80);
    asignarPosicionesDerechaInf('6',490,80);
    //
    asignarPosicionesIsquierdaInf('8',240,130);
    asignarPosicionesDerechaInf('7',490,130);

    asignarPosicionesIsquierda('4',90,195);
    asignarPosicionesDerecha('3',490,195);
    
    stageOdontograma = new Kinetic.Stage({
        container: "canvasOdontograma",
        width: 980,
        height: 265
    });
    var tabla = "#tb1";
    for(i in piezas){
        $(tabla).append("<tr><th class='colCara'>"+piezas[i].id_pieza+
            "</th><th class='colCara'>"+piezas[i].id_cara+
            "</th><th class='colFactor' >"+piezas[i].descripcion+"</th></tr>");
        cargarFactoresPieza(piezas[i].id_pieza,piezas[i].id_cara,{
            id:piezas[i].id_estado,
            descripcion:piezas[i].descripcion,
            activo:1
        });
        (Math.floor(piezas.length / 2) <= i)? tabla = "#tb2":tabla = "#tb1";
    }
    stageOdontograma.add(layerOdontograma);
    layerOdontograma.draw();
}

function cargarFactoresPieza(id,idCara,estados){
    switch(idCara){
        case '1':
            odontograma[id].Cara1.factores.push(estados);
            odontograma[id].Cara1.marcarCara();
            break;
        case '2':
            odontograma[id].Cara2.factores.push(estados);
            odontograma[id].Cara2.marcarCara();
            break;
        case '3':
            odontograma[id].Cara3.factores.push(estados);
            odontograma[id].Cara3.marcarCara();
            break;
        case '4':
            odontograma[id].Cara4.factores.push(estados);
            odontograma[id].Cara4.marcarCara();
            break;
        case '5':
            odontograma[id].Cara5.factores.push(estados);
            odontograma[id].Cara5.marcarCara();
            break;
    }
}
function asignarPosicionesDerecha(num,x,y){
    for(var i = 1;i<=8;i++){
        var pos = num+i;
        ps = new Pieza(pos,pos,x,y);
        odontograma[pos]= ps;
        x+=50;
    }
}
function asignarPosicionesIsquierda(num,x,y){
    for(var i = 8;i>=1;i--){
        var pos = num+i;
        ps = new Pieza(pos,pos,x,y);
        x+=50;
        odontograma[pos]=ps;
    }
}
function asignarPosicionesDerechaInf(num,x,y){
    for(var i = 1;i<=5;i++){
        var pos = num+i;
        ps = new Pieza(pos,pos,x,y);
        odontograma[pos]= ps;
        x+=50;
    }
}
function asignarPosicionesIsquierdaInf(num,x,y){
    for(var i = 5;i>=1;i--){
        var pos = num+i;
        ps = new Pieza(pos,pos,x,y);
        odontograma[pos]= ps;
        x+=50;
    }
}