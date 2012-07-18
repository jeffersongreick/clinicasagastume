var Pieza = function(numero,posX,posY){
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
    var imageObj = new Image();      
    var image = new Kinetic.Image({
        x: posX,
        y: posY,
        width: 50,
        height: 100,
        radius: 70,
        id:numero,
        image: imageObj
        
    });
    imageObj.src = URL+"public/img/img_piezas/cara1/"+numero+".png";
    this.image = image;
    this.image.contenedor = this;
    this.selected = false;
    this.id = numero;
    layerOdontograma.add(this.image);
    layerOdontograma.add(this.grupo);
    this.image.on('click dragstart',function(){
        if(this.contenedor.selected == true){
            this.desmarcar();
        }else{
            this.marcar();
        }
    });
}
Kinetic.Image.prototype.marcar = function(){
    if(piezaEditada){
        piezaEditada.image.desmarcar(piezaEditada);
    }
    piezaEditada = this.contenedor;
    caraEditada = piezaEditada.Cara1;
    this.setAlpha(0.5);
    this.setStroke("red");
    this.contenedor.selected = true;
    layerOdontograma.draw();
}
Kinetic.Image.prototype.desmarcar = function(){
    piezaEditada = null;
    this.setAlpha(1);
    this.setStroke("none");
    this.contenedor.selected=false;
    layerOdontograma.draw();
}
