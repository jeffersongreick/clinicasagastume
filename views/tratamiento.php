<!-- panel de datos del paciente-->
<div id="pnlData">
    <p id="patientName">Paciente: <span><?php echo $_SESSION['nombre_paciente'] ?></span></p> 
    <p  id="idTreatment">Tratamiento id: <?php echo $_SESSION['id_tratamiento'] ?></p>
    <p style="margin: 0;">Fecha:<time><?php echo date("d-m-Y"); ?></time></p>

</div>
<!--menu funciones tratamiento-->
<div class="function" id="treatment_manager">
    <ul>
        <li>
            <input type="button" id="btnOdontograma_estado_actual" class="button_menu" value="Estados"/>
            <ul>
                <li><input type="button" id="btnNuevo_tratamiento_actual" onclick="nuevoOdontogramaEstados()" class="button_menu" value="Nuevo odontograma"/></li>
                <li><input type="button" id="btnVisualizar_tratamiento_actual" onclick="visualizarEstadoActual()" class="button_menu" value="Visualizar"/></li>
            </ul>
        </li>
        <li>
            <input type="button" id="btnOdontograma_tratamientos_realizados" class="button_menu" value="Tratamientos realizados"/>
            <ul>
                <li><input type="button" id="btnNuevo_tratamiento_realizado"  onclick="tratamientosRealizados()" class="button_menu" value="Nuevo odontograma"/></li>
                <li><input type="button" id="btnVisualizar_tratamiento_reslizado" onclick="visualizarTratamientoRealizado()" class="button_menu" value="Visualizar"/></li>
            </ul>
        </li>
        <li>
            <input type="button" id="btnOdontograma_tratamientos_curso" class="button_menu" value="Tratamientos en curso"/>
            <ul>
                <li><input type="button" id="btn_tratamiento_actual" onclick="tratamientoCurso()" class="button_menu" value="Nuevo odontograma"/></li>
                <li><input type="button" id="btnVisualizar_tratamiento_actual" onclick="visualizarTratamientoCurso()" class="button_menu" value="Visualizar"/></li>
            </ul>
        </li>

        <li>
            <input type="button" class="button_cancel_menu" value="Cancelar"/>
        </li>
    </ul>
</div>
<div class="function" id="treatment_plan">
    <ul>
        <li>
            <input type="button" id="btn_plan_propuesto"   class="button_menu" value="Plan propuesto"/>
            <ul>
                <li><input type="button" id="btn_nuevo_plan_propuesto" onclick="nuevoPlanTratamientoPropuesto()" class="button_menu" value="Nuevo odontograma"/></li>
                <li><input type="button" id="btnVisualizar_plan_propuesto" onclick="visualizarPlanPropuesto()" class="button_menu" value="Visualizar"/></li>
            </ul>

        </li>
        <li>
            <input type="button" id="btn_plan_compromiso" class="button_menu" value="Plan de compromiso"/>
            <ul>
                <li><input type="button" id="btn_nuevo_plan_compromiso" onclick="nuevoPlanTratamientoCompromiso()" class="button_menu" value="Nuevo odontograma"/></li>
                <li><input type="button" id="btnVisualizar_plan_compromiso" onclick="visualizarPlanCompromiso()" class="button_menu" value="Visualizar"/></li>
            </ul>
        </li>
        <li><input type="button" id="btn_plan_modo_textual" class="button_menu" value="Modo textual"/></li>
        <li><input type="button" class="button_cancel_menu" value="Cancelar"/></li>
    </ul>
</div>   
<!-- iconos escritorio-->
<div id="contenedor_iconos" style="width:370px;height: 520px">
    <div class="iconoContainer" id="btnOdontogramas">
        <input type="image" src="<?php echo URL ?>public/img/ico_escritorio/ico_tratamiento.png" alt="odontograma"  class="iconos_escritorio" />
        <div class="nombreFuncion">Odontogramas</div>
    </div>
    <div class="iconoContainer" onclick="odontogramaInicial()" id="btnOdontograma_inicial">
        <input type="image"  src="<?php echo URL ?>public/img/ico_escritorio/ico_odontograma_inicial.png" alt="odontograma"  class="iconos_escritorio" />
        <div class="nombreFuncion">Odontograma Inicial</div>
    </div>
    <div class="iconoContainer" id="btnPlanes">
        <input type="image" src="<?php echo URL ?>public/img/ico_escritorio/ico_otros.png" alt="odontograma"  class="iconos_escritorio" />
        <div class="nombreFuncion">Plan de tratamiento</div>
    </div>
    <div class="iconoContainer" id="btnHistoria" onclick="historiaClinica()">
        <input type="image" src="<?php echo URL ?>public/img/ico_escritorio/ico_historia.png" alt="odontograma" class="iconos_escritorio" />
        <div class="nombreFuncion">Historia Clinica</div>
    </div>
    <div class="iconoContainer" id="btnFinalizarTratamiento" >
        <input type="image" onclick="finalizarTratamiento()" src="<?php echo URL ?>public/img/ico_escritorio/ico_finalizar.png" alt="odontograma" class="iconos_escritorio" />
        <div class="nombreFuncion">Finalizar tratamiento</div>
    </div>
    <div class="iconoContainer" id="btnSalirTratamiento" >
        <a href="<?php echo URL ?>usuario/principal/" >
            <input type="image" src="<?php echo URL ?>public/img/ico_escritorio/ico_salir.png" alt="odontograma" class="iconos_escritorio" />
            <div class="nombreFuncion">Salir</div>
        </a>
    </div>
</div>
<div class="block"></div>