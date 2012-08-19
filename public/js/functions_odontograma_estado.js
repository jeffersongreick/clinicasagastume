var url_img = "public/img/ico_estados/img/";
$(document).ready(function(){
    //    efecto de enfoque en items de estado y prestacion
    $(" label img").mouseover(function(){
        $(this).addClass("enfoque");
        $('#item_description').html($(this).attr("name"));
    });
    $("label img").mouseout(function(){
        $(this).removeClass("enfoque");
    });
});

function actualizarItems(){
    for(i in caraEditada.factores){
        if(caraEditada.factores[i].activo == 1){
            var id = caraEditada.factores[i].id;
            $('.state_items #estado_'+id).attr("checked","checked");
            agregarImagenEstado(id);
        }
    }
}
function guardarOdontograma(){
    if (confirm("¿Cierto de finalizar la edicion y guardar el odontograma?")){
        var json = armarJSON();
        $.post(URL+"/odontograma/"+tipo, json ,function(data){
            if(data== true){
                alert("!El odontograma ha sido guardado con exito");
                location.href=URL+'tratamiento/tratamiento/';
            }else{
                alert(data);
            }
        });
    }
}