var URL = "http://localhost/framework/public/";

var Pieza = function(numero){
    
    var imageObj = new Image();      
    imageObj.src = URL+"img/piezas/"+numero+".png";
   
    var image = new Kinetic.Image({
        image: imageObj,
        id:numero
    });
    var cara = new Cara(5).getImagen();
    this.add(image);
    this.add(cara);
    //Funcion para porbar cambiar la imagen al hacer click
    this.setImagen = function(){
        imageObj.src = URL+"img/piezas/45.png";
        image.setImage(imageObj);        
        this.draw();
    }
    image.on('click', function(evt){
        var shape = evt.shape;
       shape.getLayer().setImagen();      
        
      
       
    })   
   
}

var Cara = function (numero){
    var cara = new Kinetic.Polygon({
        points: [0,30,30,0,100,0,130,30],
        fill: "#00D2FF",
        stroke: "black",
        strokeWidth: 1,
        x:0,
        y:100,
        id:numero
    });
   
    var pi = Math.PI;
    switch(numero)
    {
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
    this.getImagen = function (){
        return cara;
    }
}


//asi se hace la herencia 
Pieza.prototype = new Kinetic.Layer();