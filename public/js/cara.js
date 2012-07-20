var cara = function(numero,pieza,grp){
    this.numero = numero;
    this.estados = [];
    this.img= this.crearCara(numero);
    this.img_pieza = URL+"public/img/img_piezas/cara"+numero+"/"+pieza+".png";
    grp.add(this.img);
}

cara.prototype = new Kinetic.Layer();
cara.prototype.marcarCara= function (){
    if(this.estados.length ==0){
        if(this.numero == 5){
            this.img.setFill("#d5ebfb");  
        }else{
            this.img.setFill("#89c3eb");  
        }
    }else{
        this.img.setFill("bf6e4e");
    }
}
cara.prototype.crearCara = function (numero){
    var cara = new Kinetic.Polygon({
        points: [0,30,30,0,100,0,130,30],
        fill: "#89c3eb",
        stroke: "black",
        strokeWidth: 1,
        x:0,
        y:100,
        id:numero
    });
    var pi = Math.PI;
    switch(numero){
        case 2:
            cara.rotate(pi/2);
            cara.setX(30);
            cara.setY(0);
            break;
        case 1:
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
            fill: "#d5ebfb",
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
