//ayuda a establecer la posicion del ultimo item (estado o prestacion agregado a una pieza en edicion)
var posicion = 200;
var historialPieza;
var caraEditada;
var cambios = false;
var layerPieza,stagePieza;
window.onbeforeunload = function(){
    return "!ADVERTENCIA! Esta a punto de descartar este odontograma.";
}
$(document).ready(function(){
    stagePieza = new Kinetic.Stage({
        container: "canvasPieza",
        width: 200,
        height: 300
    });
    layerPieza = new Kinetic.Layer();
    //    cambia de odontograma a edicion de pieza
    
    $('#btnEditarPieza').click(function(){ 
        if(piezaEditada && piezaEditada.id != 0){
            cargarCara("1");
            historialPieza = new Pieza('11',0,2000,2000);
            historialPieza.Cara1.factores = piezaEditada.Cara1.factores.slice(0);
            historialPieza.Cara2.factores = piezaEditada.Cara2.factores.slice(0);
            historialPieza.Cara3.factores = piezaEditada.Cara3.factores.slice(0);
            historialPieza.Cara4.factores = piezaEditada.Cara4.factores.slice(0);
            historialPieza.Cara5.factores = piezaEditada.Cara5.factores.slice(0);
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
                piezaEditada.Cara1.factores = historialPieza.Cara1.factores.slice(0);
                piezaEditada.Cara2.factores = historialPieza.Cara2.factores.slice(0);
                piezaEditada.Cara3.factores = historialPieza.Cara3.factores.slice(0);
                piezaEditada.Cara4.factores = historialPieza.Cara4.factores.slice(0);
                piezaEditada.Cara5.factores = historialPieza.Cara5.factores.slice(0);
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
});
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

function cargarCara(numPieza){
    group.removeChildren();
    $('.item').removeAttr('checked');
    posicion = 200;
    var imagenObj = new Image();
    imagenObj.onload = function() {
        var image = new Kinetic.Image({
            x: 20,
            y: 5,
            image: imagenObj,
            width: 150,
            height: 270
        });
        group.add(image);
        layerPieza.add(group);
        stagePieza.add(layerPieza);
    };
    switch(numPieza){
        case "1":
            caraEditada = piezaEditada.Cara1;
            break;
        case "2":
            caraEditada = piezaEditada.Cara2;
            break;
        case "3":
            caraEditada = piezaEditada.Cara3;
            break;
        case "4":
            caraEditada = piezaEditada.Cara4;
            break;
        case "5":
            caraEditada = piezaEditada.Cara5;       
            break;
        default:
            alert("ninguno");
            console.log("igual a"+numPieza+"?");
    }
    imagenObj.src = caraEditada.img_pieza; 
    actualizarItems.call();   
}
//diseña en la imagen de la pieza editada la figura asignada el estado o prestacion
//si el item esta seleccionado marca, sino el contrario
function agregarImagen(id_item){
    var imagenObj = new Image();
    imagenObj.onload = function() {
        var image = new Kinetic.Image({
            x: 80,
            y: 210,
            image: imagenObj,
            width: 60,
            height: 60,
            name : "item",
            id : id_item,
            draggable:true
        });
        group.add(image);
        image.transitionTo({
            x: 80,
            y: posicion,
            duration: 1,
            easing: "strong-ease-out"
        });
        image.on("mouseover", function() {
            document.body.style.cursor = "pointer";
        });
        image.on("mouseout", function() {
            document.body.style.cursor = "default";
        });
        posicion -=50;
    };
    imagenObj.src = URL+url_img+id_item+".png"; 
}
    
function quitarImagen(id){
    group.remove(stagePieza.get('#'+ id)[0]);
    var items = layerPieza.get(".item");
    posicion = 200;
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
function agregar(cb){
    cambios = true;
    if(cb.checked){
        if(contarItems() <4){
            borrarItem(cb.value);
            agregarImagen(cb.value);
            caraEditada.factores.push({
                id:cb.value,
                activo:1
            });
        }else{
            alert("Solamente puede ingresar hasta 4 patologias por cara de una pieza.");   
            $(cb).removeAttr('checked');
        }   
    }else{
        quitarImagen(cb.value);
        borrarItem(cb.value);
        caraEditada.factores.push({
            id:cb.value,
            activo:0
        });
        
    }
}

function contarItems(){
    var count = 0
    for(var i = 0; i < caraEditada.factores.length ; i++){
        if(caraEditada.factores[i].activo == 1){
            count +=1;
        }
    }
    return count;
}
function borrarItem(id){
    for(var i = 0; i < caraEditada.factores.length ; i++){
        if(caraEditada.factores[i].id == id){
            caraEditada.factores.splice(i,1);
            break;
        }
    }
}
function abrirVentanaCambiarPieza(){
    if((piezaEditada.id % 10)<=5){
        var nuevaPieza =calcularPieza().toString(); 
        $("#imgCambiar").attr("src",URL+"public/img/img_piezas/cara1/"+piezaEditada.id+".png");
        $("#imgNueva").attr("src",URL+"public/img/img_piezas/cara1/"+nuevaPieza+".png");
        $("#imgNueva").data("numPieza",nuevaPieza); 
        $("#lblPiezaCambiar").html("Pieza a cambiar: "+piezaEditada.id);
        $("#lblNuevaPieza").html("Nueva pieza: "+nuevaPieza);
        abrirVentana('#ventanaCambioPieza');
    }else{
        alert("La pieza seleccionada no puede ser cambiada a temporal");
    }
}
function cambiarPieza(){
    var posX = piezaEditada.image.getX();
    var posY = piezaEditada.image.getY();
    var p1 = new Pieza($("#imgNueva").data("numPieza"),piezaEditada.pos,posX,posY);
    odontograma[piezaEditada.pos].pieza = p1;
    layerOdontograma.remove(piezaEditada.image);
    layerOdontograma.remove(piezaEditada.grupo);
    layerOdontograma.remove(piezaEditada.num);
    piezaEditada = null;
    stageOdontograma.add(layerOdontograma);
    layerOdontograma.draw();
}
function calcularPieza(){
    var num = Math.floor(piezaEditada.id /10);
    switch(num){
        case 1:
            num = 50;
            break;
        case 2:
            num = 60;
            break;
        case 3:
            num = 70;
            break;
        case 4:
            num = 80;
            break;
        case 5:
            num = 10;
            break;
        case 6:
            num = 20;
            break;
        case 7:
            num = 30;
            break;
        case 8:
            num = 40;
            break;
    }
    num +=(piezaEditada.id % 10);
    return num;
}
function armarJSON(){
    var data = {
        piezas : []
    }  
    for(var i in odontograma){
        var pieza = odontograma[i].pieza;
        var p = {
            id:pieza.id,
            pos:pieza.pos,
            caras:[]
        }   
            
        if(pieza.id != 0){
            for(var j = 1;j<=5;j++){          
                var factores;
                if(j==1){
                    factores = pieza.Cara1.factores;
                }
                if(j==2){
                    factores = pieza.Cara2.factores;
                }
                if(j==3){
                    factores = pieza.Cara3.factores;
                }
                if(j==4){
                    factores = pieza.Cara4.factores;
                }
                if(j==5){
                    factores = pieza.Cara5.factores;
                }
                if(factores.length>0){
                    var cara ={
                        id:j,
                        factores:[factores]
                    };
                    p.caras.push(cara);
                }    
            }
        }
        data.piezas.push(p);  
    }
  return data;
    
}
function extraerPieza(){
    if (confirm("AVISO: ¿Esta cierto de que deseas eliminar esta pieza junto a su informacion?")){
        var posX = piezaEditada.image.getX();
        var posY = piezaEditada.image.getY();
        var p1 = new vacio(0,piezaEditada.pos,posX,posY);
        odontograma[piezaEditada.pos].pieza = p1;
        layerOdontograma.remove(piezaEditada.image);
        layerOdontograma.remove(piezaEditada.grupo);
        layerOdontograma.remove(piezaEditada.num);
        piezaEditada = null;
        stageOdontograma.add(layerOdontograma);
        layerOdontograma.draw();
    }
}
function agregarPieza(){
    if (confirm("AVISO: ¿Esta cierto de que deseas agregar la pieza "+piezaEditada.pos+" al odontograma?")){
        var posX = piezaEditada.image.getX();
        var posY = piezaEditada.image.getY();
        var p1 = new Pieza(piezaEditada.pos.toString(),piezaEditada.pos,posX,posY);
        odontograma[piezaEditada.pos].pieza = p1;
        layerOdontograma.remove(piezaEditada.image);
        layerOdontograma.remove(piezaEditada.grupo);
        layerOdontograma.remove(piezaEditada.num);
        piezaEditada = null;
        stageOdontograma.add(layerOdontograma);
        layerOdontograma.draw();
    }
}