var url_img = "public/img/ico_prestaciones/";
function filtrarPrestacion(txt) {
    filas = $(".item_prestacion");
    for (i=0; ele=filas[i]; i++) {
        texto = ele.innerHTML.toUpperCase();
        posi = (texto.indexOf(txt.toUpperCase()) == 0);
        ele.style.display = (posi) ? '' : 'none';
    } 
}
function actualizarItems(){
    for(i in caraEditada.factores){
        if(caraEditada.factores[i].activo == 1){
            var id = caraEditada.factores[i].id;
            $('.option_list #prestacion_'+id).attr("checked","checked");
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
