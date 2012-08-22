var url_img = "public/img/ico_estados/";
$(document).ready(function(){
    //    efecto de enfoque en items de estado y prestacion
    $(" label img").mouseover(function(){
        $(this).addClass("enfoque");
        $('#item_description').html($(this).attr("name"));
    });
    $("label img").mouseout(function(){
        $(this).removeClass("enfoque");
    });
    $('#btnCambiarPieza').click(function(){
        if(piezaEditada && piezaEditada.id != 0){
            abrirVentanaCambiarPieza();
        }else{
            alert("No ha seleccionado ninguna pieza");
        }
    });
    $('#btnCancelarNuevaPieza').click(function(){
        cerrarVentana('#ventanaCambioPieza');
    });
    $('#btnExtraer').click(function(){
        if(piezaEditada && piezaEditada.id != 0){
            extraerPieza();
        }else if(piezaEditada){
            agregarPieza();
        }else{
            alert("No ha seleccionado ninguna pieza");
        }
    });
    $('#btnGuardarNuevaPieza').click(function(){
        cambiarPieza();
        cerrarVentana('#ventanaCambioPieza');
    });
});

function actualizarItems(){
    for(i in caraEditada.factores){
        if(caraEditada.factores[i].activo == 1){
            var id = caraEditada.factores[i].id;
            $('.state_items #estado_'+id).attr("checked","checked");
            agregarImagen(id);
        }
    }
}
function guardarOdontograma(){
    if (confirm("¿Cierto de finalizar la edicion y guardar el odontograma?")){
        var metodo = "";
        var json = armarJSON();
        if(tipo == 1){
            metodo = "guardarOdontogramaInicial/";
        }else if(tipo == 2){
            metodo = "guardarOdontogramaActual/";
        }
        $.post(URL+"/odontograma/"+metodo, json ,function(data){
            if(data== true){
                alert("!El odontograma ha sido guardado con exito");
                finalizar = true;
                location.href=URL+'tratamiento/tratamiento/';
            }else{
                alert(data);
            }
        });
    }
}
function extraerPieza(){
    if (confirm("AVISO: ¿Esta cierto de que deseas eliminar esta pieza junto a su informacion?")){
        var posX = piezaEditada.image.getX();
        var posY = piezaEditada.image.getY();
        var p1 = new vacio(0,piezaEditada.pos,posX,posY);
        odontograma[piezaEditada.pos].pieza = p1;
        layerOdontograma.remove(piezaEditada.image);
        layerOdontograma.remove(piezaEditada.grupo);
        layerOdontograma.remove(piezaEditada.num);
        piezaEditada = null;
        stageOdontograma.add(layerOdontograma);
        layerOdontograma.draw();
    }
}
function agregarPieza(){
    if (confirm("AVISO: ¿Esta cierto de que deseas agregar la pieza "+piezaEditada.pos+" al odontograma?")){
        var posX = piezaEditada.image.getX();
        var posY = piezaEditada.image.getY();
        var p1 = new Pieza(piezaEditada.pos.toString(),piezaEditada.pos,posX,posY);
        odontograma[piezaEditada.pos].pieza = p1;
        layerOdontograma.remove(piezaEditada.image);
        layerOdontograma.remove(piezaEditada.grupo);
        layerOdontograma.remove(piezaEditada.num);
        piezaEditada = null;
        stageOdontograma.add(layerOdontograma);
        layerOdontograma.draw();
    }
}
function abrirVentanaCambiarPieza(){
    if((piezaEditada.id % 10)<=5){
        var nuevaPieza =calcularPieza().toString(); 
        $("#imgCambiar").attr("src",URL+"public/img/img_piezas/cara1/"+piezaEditada.id+".png");
        $("#imgNueva").attr("src",URL+"public/img/img_piezas/cara1/"+nuevaPieza+".png");
        $("#imgNueva").data("numPieza",nuevaPieza); 
        $("#lblPiezaCambiar").html("Pieza a cambiar: "+piezaEditada.id);
        $("#lblNuevaPieza").html("Nueva pieza: "+nuevaPieza);
        abrirVentana('#ventanaCambioPieza');
    }else{
        alert("La pieza seleccionada no puede ser cambiada a temporal");
    }
}
function cambiarPieza(){
    var posX = piezaEditada.image.getX();
    var posY = piezaEditada.image.getY();
    var p1 = new Pieza($("#imgNueva").data("numPieza"),piezaEditada.pos,posX,posY);
    odontograma[piezaEditada.pos].pieza = p1;
    layerOdontograma.remove(piezaEditada.image);
    layerOdontograma.remove(piezaEditada.grupo);
    layerOdontograma.remove(piezaEditada.num);
    piezaEditada = null;
    stageOdontograma.add(layerOdontograma);
    layerOdontograma.draw();
}
function calcularPieza(){
    var num = Math.floor(piezaEditada.id /10);
    switch(num){
        case 1:
            num = 50;
            break;
        case 2:
            num = 60;
            break;
        case 3:
            num = 70;
            break;
        case 4:
            num = 80;
            break;
        case 5:
            num = 10;
            break;
        case 6:
            num = 20;
            break;
        case 7:
            num = 30;
            break;
        case 8:
            num = 40;
            break;
    }
    num +=(piezaEditada.id % 10);
    return num;
}
