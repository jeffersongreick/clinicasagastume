var cara = function(numero,pieza,grp){
    this.numPieza = pieza;
    this.estados = [];
    this.img= this.crearCara(numero);
    this.img_pieza = URL+"public/img/img_piezas/cara"+numero+"/"+pieza+".png";
    grp.add(this.img);
}
cara.prototype = new Kinetic.Layer();
cara.prototype.crearCara = function (numero){
    var cara = new Kinetic.Polygon({
        points: [0,30,30,0,100,0,130,30],
        fill: "#00D2FF",
        stroke: "black",
        strokeWidth: 1,
        x:0,
        y:100,
        id:numero,
        draggable: true
    });
    var pi = Math.PI;
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
    return cara;
}
