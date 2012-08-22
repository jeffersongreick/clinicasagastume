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
            agregarImagen(id);
        }
    }
}
function guardarOdontograma(){
    if (confirm("¿Desea finalizar la edicion y guardar el odontograma?")){
        var metodo = "";
        var json = armarJSON();
        switch(tipo){
            case 3:
                metodo = "guardarPlanPropuesto/";
                break;
            case 4:
                metodo = "guardarPlanCompromiso/";
                break;
            case 5:
                metodo = "guardarTratamientoCurso/";
                break;
            case 6:
                metodo = "guardarTratamientoRealizado/";
                break;
            case 7:
                metodo = "actualizarTratamientoCurso/";
                break;

        }
        $.post(URL+"/odontograma/"+metodo, json ,function(data){
            if(data== true){
                alert("!El odontograma ha sido guardado con exito");
                location.href=URL+'tratamiento/tratamiento/';
            }else{
                alert(data);
            }
        });
    }
}
