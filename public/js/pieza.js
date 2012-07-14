var Pieza = function(numero,posX,posY){
    this.add(new Cara(numero,posX,posY));
    
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
    //    var cara = new Cara(5).getImagen();
    this.image = image;
    this.add(image);
    this.selected = false;
    this.id = numero;
    //segun el numero de pieza posiciona las caras arriba o abajo de la imagen
   
    this.marcar = function(){
        if(piezaEditada){
            piezaEditada.desmarcar(piezaEditada);
        }
        piezaEditada = this;
        this.image.setAlpha(0.5);
        this.image.setStroke("red");
        this.selected = true;
        this.draw();
    }
    this.desmarcar = function(){
        piezaEditada = null;
        this.image.setAlpha(1);
        this.image.setStroke("none");
        this.selected=false;
        this.draw();              
    }
   
}
Pieza.prototype = new Kinetic.Layer();
Pieza.prototype.on('click', function(evt){
    var shape = evt.shape;
    if(this.selected == true){
        this.desmarcar(shape);
            
    }else{
        this.marcar(shape);
    }
});