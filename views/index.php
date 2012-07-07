<!--menu funciones tratamiento-->
<div class="function" id="treatment_manager">
    <ul>
        <li>
            <input type="button" id="btnTratamiento_actual" class="button_menu" value="Tratamiento en curso"/>
            <ul >
                <li><a href=""><input type="button" id="btnOdontograma_estado_inicial" class="button_menu" value=" Estado inicial"/></a></li>
                <li><input type="button" id="btnOdontograma_estado_actual" class="button_menu" value="Estado actual"/></li>
                <li><a href=""><input type="button" id="btnPlan_tratamiento" class="button_menu" value="Plan de tratamiento"/></a></li>
            </ul>
        </li>
        <li>
            <input type="button" id="btnNuevo_tratamiento" class="button_menu" value="Nuevo tratamiento"/>
            <ul >
                <li><input type="button" id="btn_nuevo_estado_inicial" class="button_menu" value="Nuevo odontograma inicial"/></li>
                <li><input type="button" id="btn_nuevo_plan_tratamiento" class="button_menu" value="Nuevo plan tratamiento"/></li>
            </ul>
        </li>
        <li>
            <input type="button" class="button_cancel_menu" value="Cancelar"/>
        </li>
    </ul>
</div>
<!--menu busqueda de odontogramas-->
<div id="buscarOdontograma" class="function">
    <p>Desde:</p><input type="text" id="fromFecha" class="fieldText" value="Fecha" style="color: gray"/>
    <p>Hasta:</p><input type="text" id="toFecha" class="fieldText" value="Fecha" style="color: gray" />
    <div class="listado">
        <table class="tabla">
            <tr>
                <td scope="col" style="width: 20%; background-color: #A5DCFF">Id</td>
                <td scope="col" style="width: 40%; background-color: #A5DCFF">Fecha</td>
            </tr>
            <tr>
                <td scope="row" style="width: 20%">5</td>
                <td scope="row" style="width: 40%">15/02/11</td>
            </tr>
            <tr>
                <td scope="row" style="width: 20%">19</td>
                <td scope="row" style="width: 40%">18/02/11</td>
            </tr>
            <tr>
                <td scope="row" style="width: 20%">58</td>
                <td scope="row" style="width: 40%">25/02/11</td>
            </tr>
        </table>
    </div>
    <input type="button" id="btnEditar_tratamiento_actual" class="button_menu" value="Editar"/>
    <input type="button" id="btnVisualizar_tratamiento_actual" class="button_menu" value="Visualizar"/>
    <input type="button" id="btnNuevo_tratamiento_actual" class="button_menu" value="Nuevo"/>
    <input type="button" class="button_cancel_menu" value="Cancelar"/>
</div>
<!-- iconos escritorio-->
<div class="iconoContainer" id="btnTratamiento">
    <input type="image" src="<?php echo URL ?>public/img/ico_escritorio/ico_tratamiento.png" alt="odontograma"  class="iconos_escritorio" />
    <div class="nombreFuncion">Tratamientos</div>
</div>
<div class="iconoContainer" id="btnRegistroPaciente">
    <input type="image" src="<?php echo URL ?>public/img/ico_escritorio/ico_registros.png" alt="odontograma"  class="iconos_escritorio" />
    <div class="nombreFuncion">Registro pacientes</div>
</div>
<div class="iconoContainer" id="btnHistoria" >
    <input type="image" src="<?php echo URL ?>public/img/ico_escritorio/ico_historia.png" alt="odontograma" class="iconos_escritorio" />
    <div class="nombreFuncion">Historia Clinica</div>
</div>
<div class="iconoContainer" id="btnOtros">
    <input type="image" src="<?php echo URL ?>public/img/ico_escritorio/ico_otros.png" alt="odontograma"  class="iconos_escritorio" />
    <div class="nombreFuncion">Otros</div>
</div>
<div class="block"></div>