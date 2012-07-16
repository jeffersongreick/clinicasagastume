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
            id : id_estado
        });
        group.add(image);
        image.transitionTo({
            x: 80,
            y: posicion,
            duration: 2,
            easing: "strong-ease-out"
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
        caraEditada.estados.splice(caraEditada.estados.indexOf(cb.value,1));
    }
}
function actualizarEstados(){
    for(i in caraEditada.estados){
        var id_estado = caraEditada.estados[i];
        $('.state_items #estado_'+id_estado).attr("checked","checked");
        agregarImagenEstado(id_estado);
    }
}
 
