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
    $('#btnVolverDetalles').click(function(){
        $('.table_container table tbody').children().remove();
        cerrarVentana('#windowDetail');
    });
    $('#btnDetalles').click(function(){
        if(piezaEditada && piezaEditada.id != 0){
            mostrarDetalles();
        }else{
            alert("No ha seleccionado ninguna pieza");
        }
    });
};
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

                var factores = caras[x].factores;
                
                for(y in factores){
                    cargarFactoresPieza(ps,caras[x].id,{
                        id:factores[y].id,
                        descripcion:factores[y].descripcion,
                        activo:factores[y].activo
                    });
                }
            }
        }
        odontograma[piezas[i].pos].pieza= ps;
    }
    stageOdontograma.add(layerOdontograma);
    layerOdontograma.draw();
}
function cargarFactoresPieza(pieza,idCara,estados){
    switch(idCara){
        case '1':
            pieza.Cara1.factores.push(estados);
            pieza.Cara1.marcarCara();
            break;
        case '2':
            pieza.Cara2.factores.push(estados);
            pieza.Cara2.marcarCara();
            break;
        case '3':
            pieza.Cara3.factores.push(estados);
            pieza.Cara3.marcarCara();
            break;
        case '4':
            pieza.Cara4.factores.push(estados);
            pieza.Cara4.marcarCara();
            break;
        case '5':
            pieza.Cara5.factores.push(estados);
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
    $(".block").fadeIn("fast"); 
    $(window).slideDown("fast");
}
//cierra una caja pasada por parametro
function cerrarVentana(window){
    //desbloquea el uso del escritorio
    $(".block").fadeOut("fast");
    $(window).slideUp("fast");
}
function mostrarDetalles(){
    $('.title3').html(function(){
        factoresCara(piezaEditada.Cara1);
        factoresCara(piezaEditada.Cara2);
        factoresCara(piezaEditada.Cara3);
        factoresCara(piezaEditada.Cara4);
        factoresCara(piezaEditada.Cara5);
        
    },"Detalles de pieza nº"+piezaEditada.id);
    abrirVentana('#windowDetail');
}
function factoresCara(cara){
    for(f in cara.factores){
        $('.table_container table tbody').append("<tr><td class='colCara'> "+cara.numero+" </td>"
            +"<td class='colFactor'>"+cara.factores[f].descripcion+"</td></tr>");
    }
}