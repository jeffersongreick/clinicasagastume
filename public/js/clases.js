var URL = "http://localhost/clinica/";
var layerPieza;
//escena del canvas donde se agragara los layers
var stageOdontograma , stagePieza;
//ayuda a establecer la posicion del ultimo item (estado o prestacion agregado a una pieza en edicion)
var posicion = 400;
var piezaEditada;
var caraEditada;
//variable que guarda la imagen de la pieza y de los estados
var group;
//    window.onbeforeunload = function(){
//        return "Esta a punto de descartar este odontograma";
//    }
function cargarCaras(){
    group.removeChildren();
    var imagenObj = new Image();
    imagenObj.onload = function() {
        var image = new Kinetic.Image({
            x: 60,
            y: 260,
            image: imagenObj,
            width: 80,
            height: 200
        });
        caraEditada = piezaEditada.cara1;
        alert(caraEditada.id);
        group.add(image);
        layerPieza.add(group);
        stagePieza.add(layerPieza);
    };
    imagenObj.src = URL+"public/img/img_piezas/cara1/"+piezaEditada.id+".png";      
}
//diseña en la imagen de la pieza editada la figura asignada el estado o prestacion
//si el item esta seleccionado marca, sino el contrario
function agregarEstado(id,cb){
    if(cb.checked){
        if(caraEditada.estados.length <=2){
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
                group.add(image);
                image.transitionTo({
                    x: 80,
                    y: posicion,
                    duration: 2,
                    easing: "strong-ease-out"
                });
                posicion -=50;
            };
            caraEditada.estados.push(cb.value);
            imagenObj.src = URL+"public/img/ico_prestaciones/img"+id+".png"; 
        }else{
            alert("Solamente puede ingresar hasta 3 patologias por cara de una pieza.");   
            $(cb).removeAttr('checked');
        }   
    }else{
        group.remove(stagePieza.get('#'+id)[0]);
        caraEditada.estados.splice(piezaEditada.estados.indexOf(cb.value,1));
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