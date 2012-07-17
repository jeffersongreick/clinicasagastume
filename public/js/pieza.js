var Pieza = function(numero,posX,posY){
    this.layer = new Kinetic.Layer();
    this.layer.contenedor = this;
    this.grupo = new Kinetic.Group();
    this.Cara1 = new cara(1,numero, this.grupo);
    this.Cara2 = new cara(2,numero, this.grupo);
    this.Cara3 = new cara(3,numero, this.grupo);
    this.Cara4 = new cara(4,numero, this.grupo);
    this.Cara5 = new cara(5,numero, this.grupo);
    this.grupo.setScale(0.4);
    this.grupo.setX(posX);
    if(numero > 30 && numero < 49 | numero > 70 && numero < 85){
        this.grupo.setY(posY-70);
    }else{
        this.grupo.setY(posY+120);
    }
    this.layer.add(this.grupo);
    var imageObj = new Image();      
    var image = new Kinetic.Image({
        x: posX,
        y: posY,
        width: 50,
        height: 100,
        radius: 70,
        image: imageObj,
        id:numero
    });
    imageObj.src = URL+"public/img/img_piezas/cara1/"+numero+".png";
    this.layer.image = image;
    this.layer.add(image);
    this.selected = false;
    this.id = numero;

    this.layer.on('click dragstart',function(){
        if(this.contenedor.selected == true){
            this.desmarcar();
        }else{
            this.marcar();
        }
    });
    
}
Pieza.prototype.draw = function(){
    this.layer.draw();
}

Kinetic.Layer.prototype.marcar = function(){
    if(piezaEditada){
        piezaEditada.layer.desmarcar(piezaEditada);
    }
    piezaEditada = this.contenedor;
    caraEditada = piezaEditada.Cara1;
    this.image.setAlpha(0.5);
    this.image.setStroke("red");
    this.contenedor.selected = true;
    this.draw();
}
Kinetic.Layer.prototype.desmarcar = function(){
   
    piezaEditada = null;
    this.image.setAlpha(1);
    this.image.setStroke("none");
    this.contenedor.selected=false;
    this.draw();
}
//Pieza.prototype = new Kinetic.Layer();
//Pieza.prototype.on('click dragstart',function(evt){
//    var shape = evt.shape;
//    if(this.selected == true){
//        this.desmarcar(shape);
//    }else{
//        this.marcar(shape);
//    }
//});