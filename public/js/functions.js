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
    
    actualizarEstados.call();   
}
//diseña en la imagen de la pieza editada la figura asignada el estado o prestacion
//si el item esta seleccionado marca, sino el contrario
function agregarImagenEstado(id_estado){
    var imagenObj = new Image();
    imagenObj.onload = function() {
        var image = new Kinetic.Image({
            x: 80,
            y: 210,
            image: imagenObj,
            width: 60,
            height: 60,
            name : "item",
            id : id_estado,
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
    imagenObj.src = URL+"public/img/ico_prestaciones/img"+id_estado+".png"; 
}
    
function quitarImagenEstado(id_estado){
    group.remove(stagePieza.get('#'+ id_estado)[0]);
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
function agregarEstado(cb){
    cambios = true;
    if(cb.checked){
        if(caraEditada.estados.length <=2){
            agregarImagenEstado(cb.value);
            caraEditada.estados.push(cb.value);
        }else{
            alert("Solamente puede ingresar hasta 3 patologias por cara de una pieza.");   
            $(cb).removeAttr('checked');
        }   
    }else{
        quitarImagenEstado(cb.value);
        caraEditada.estados.splice(caraEditada.estados.indexOf(cb.value),1);
    }
}
function actualizarEstados(){
    for(i in caraEditada.estados){
        var id_estado = caraEditada.estados[i];
        $('.state_items #estado_'+id_estado).attr("checked","checked");
        agregarImagenEstado(id_estado);
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
    var p1 = new Pieza($("#imgNueva").data("numPieza"),posX,posY);
    odontograma.push(p1);
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
//
function guardar(){
    var data = {
        piezas : []
    }  
    for(var i = 0; i<odontograma.length;i++){
        var pieza = odontograma[i]
        var p = {
            id:pieza.id,
            caras:[]
        }   
        if(pieza.id != 0){
            for(var j = 1;j<=5;j++){          
                //buena chanchada :D despues lo arreglo 
                var estados
                if(j==1){
                    estados = pieza.Cara1.estados;
                }
                if(j==2){
                     estados = pieza.Cara2.estados;
                }
                if(j==3){
                     estados = pieza.Cara3.estados;
                }
                if(j==4){
                     estados = pieza.Cara4.estados;
                }
                if(j==5){
                     estados = pieza.Cara5.estados;
                }
                if(estados.length>0){
                    var cara ={
                        id:j,
                        estados:[estados]
                    };
                    p.caras.push(cara);
                }    
            }
        }
        data.piezas.push(p);  
    }
  $.post(URL+"/odontograma/guardar", data);
}

function extraerPieza(){
    if (confirm("AVISO: ¿Esta cierto de que deseas eliminar esta pieza junto a su informacion?")){
        var posX = piezaEditada.image.getX();
        var posY = piezaEditada.image.getY();
        var p1 = new vacio(0,piezaEditada.id,posX,posY);
        //    odontograma.splice(caraEditada.estados.indexOf(cb.value),1);
        odontograma.push(p1);
        layerOdontograma.remove(piezaEditada.image);
        layerOdontograma.remove(piezaEditada.grupo);
        layerOdontograma.remove(piezaEditada.num);
        piezaEditada = null;
        stageOdontograma.add(layerOdontograma);
        layerOdontograma.draw();
    }
         
    
}
function agregarPieza(){
    if (confirm("AVISO: ¿Esta cierto de que deseas agregar la pieza "+piezaEditada.faltante+" al odontograma?")){
        var posX = piezaEditada.image.getX();
        var posY = piezaEditada.image.getY();
        var p1 = new Pieza(piezaEditada.faltante,posX,posY);
        //    odontograma.splice(caraEditada.estados.indexOf(cb.value),1);
        odontograma.push(p1);
        layerOdontograma.remove(piezaEditada.image);
        layerOdontograma.remove(piezaEditada.grupo);
        layerOdontograma.remove(piezaEditada.num);
        piezaEditada = null;
        stageOdontograma.add(layerOdontograma);
        layerOdontograma.draw();
    }
}

function cloneObject(source_) {
    for (var item in source_) {
        if (typeof source_[item] == 'object') {
            this[item] = new cloneObject(source_[item]);
        } else{
            this[item] = source_[item];
        }
    }
}
//var my_clon = new cloneObject (my_object);

function cargar_odontograma(data){
    
}
