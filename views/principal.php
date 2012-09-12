<div id="buscarPaciente" class="function">
    <h2 id="title2">Buscar paciente</h2>

    <input type="search" results="5" id="search_ci" class="fieldText"  placeholder="Cedula" pattern="[0-9]{4}" title="Solo digitos"/>

    <div id="patient_data" >
        <p id="patient_ci" class="data">C.I.:</p>
        <p id="patient_name" class="data">Nombre:</p>
        <p class="data">Tratamiento:</p>
        <div id="patient_treatment" style="display: none;">
        </div>

    </div>

    <div id="contenedor_botones" >
        <input type="button" class="button_cancel" value="Cancelar"/>
    </div>
    <img id="img_load" src="<?php echo URL ?>public/img/loader.gif" style="display: none; margin:0 auto 0 auto;"/>
</div>
<!-- panel de datos del paciente-->
<div id="contenedor_iconos" style="width:370px;height: 520px; margin-top: 10px;">
    <div class="iconoContainer" id="btnTratamientos">
        <input type="image" src="<?php echo URL ?>public/img/ico_principal/ico_doctor.png" alt="tratamiento"  class="iconos_escritorio" />
        <div class="nombreFuncion">Tratamientos</div>
    </div>
    <div class="iconoContainer" id="btnPacientes">
        <input type="image" src="<?php echo URL ?>public/img/ico_principal/ico_paciente.png" alt="tratamiento"  class="iconos_escritorio" />
        <div class="nombreFuncion">Pacientes</div>
    </div>
    <div class="iconoContainer" id="btnPrestaciones">
        <input type="image" src="<?php echo URL ?>public/img/ico_principal/ico_prestacion.png" alt="tratamiento"  class="iconos_escritorio" />
        <div class="nombreFuncion">Prestaciones</div>
    </div>
    <div class="iconoContainer" id="btnUsuarios">
        <input type="image" onclick="mantenimiento_usuarios()" src="<?php echo URL ?>public/img/ico_principal/ico_usuario.png" alt="tratamiento"  class="iconos_escritorio" />
        <div class="nombreFuncion">Usuarios</div>
    </div>
    <div class="iconoContainer" id="btnControlUsuarios">
        <input type="image" src="<?php echo URL ?>public/img/ico_principal/ico_control.png" alt="tratamiento"  class="iconos_escritorio" />
        <div class="nombreFuncion">Control de usuarios</div>
    </div>
    <div class="iconoContainer" id="btnFormularios">
        <input type="image" src="<?php echo URL ?>public/img/ico_principal/ico_formularios_web.png" alt="tratamiento"  class="iconos_escritorio" />
        <div class="nombreFuncion">Formularios web</div>
    </div>
</div>
<div class="block"></div>