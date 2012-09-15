var Pieza = function(numero,pos,posX,posY){
    this.grupo = new Kinetic.Group();
    this.Cara1 = new cara(1,numero, this.grupo);
    this.Cara2 = new cara(2,numero, this.grupo);
    this.Cara3 = new cara(3,numero, this.grupo);
    this.Cara4 = new cara(4,numero, this.grupo);
    this.Cara5 = new cara(5,numero, this.grupo);
    this.grupo.setScale(0.3);
    this.grupo.setX(posX);
    this.num = new Kinetic.Text({
        x: posX+10,
        text: numero.toString(),
        fontSize: 15,
        fontFamily: "Calibri",
        textFill: "black"
    });
    if(numero > 30 && numero < 49 | numero > 70 && numero < 86){
        this.num.setY(posY+45);
        this.grupo.setY(posY);
    }else{
        this.num.setY(posY-20);
        this.grupo.setY(posY);
    }
    this.selected = false;
    this.id = numero;
    this.pos =pos;
    layerOdontograma.add(this.num);
    layerOdontograma.add(this.grupo);
}
Image.prototype.cargar = function(){
    this.onload = function () {
        layerOdontograma.draw();
    }
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
var vacio = function(numero,pos,posX,posY){
    this.pos =pos;  
    this.selected = false;
    this.id = numero;
}
