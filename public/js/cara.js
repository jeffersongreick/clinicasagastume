var Cara = function (numero,posX,posY){
    this.cara1 = new creador (1,numero);
    this.cara2 = new creador (2,numero);
    this.cara3 = new creador (3,numero);
    this.cara4 = new creador (4,numero);
    this.cara5 = new creador (5,numero);
  
    this.add(this.cara1);
    this.add(this.cara2);
    this.add(this.cara3);
    this.add(this.cara4);
    this.add(this.cara5);
    this.setScale(0.4);
    this.setX(posX);
    if(numero > 30 && numero < 49){
        this.setY(posY-70); 
    }else{
        this.setY(posY+120);
    }
}
var creador = function (numero,pieza){
    var cara = new Kinetic.Polygon({
        points: [0,30,30,0,100,0,130,30],
        fill: "#00D2FF",
        stroke: "black",
        strokeWidth: 1,
        x:0,
        y:100,
        id:numero
    });
    this.estados=[];
    this.url_image = URL+"public/img/img_piezas/cara"+numero+"/"+pieza+".png";
    var pi = Math.PI;
    this.id = numero;
    switch(numero){
        case 2:
            cara.rotate(pi/2);
            cara.setX(30);
            cara.setY(0);
            break;
        case 3:
            cara.rotate(pi);
            cara.setX(130);
            cara.setY(30);
            break;
        case 4:
            cara.rotate(1.5 * pi);
            cara.setX(100);
            cara.setY(130);
            break;
        case 5:
            cara_centro();            
            break;
    }
    function cara_centro(){
        var rec = new Kinetic.Rect({
            width: 70,
            height: 70,
            fill: "#00D2FF",
            stroke: "black",
            strokeWidth: 1,
            x:30,
            y:30,
            id:numero
        })
        cara = rec;
    }
    function resaltar(){
        cara.setFill("red");
    }
    return cara;
}
Cara.prototype = new Kinetic.Group();