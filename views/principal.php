<div id="buscarTratamiento" class="function">
    <h2 class="title3">Tratamientos activos</h2>
    <div class="table_list" id="listTratamientos" style="overflow-y: auto;width: 480px;height: 440px;">
        <table>
            <tbody>
            </tbody>
        </table>
    </div>
    <div id="contenedor_botones" >
        <input type="button" id="btn_treatment_accept" onclick="ingresar_tratamiento()" class="button" value="Ingresar"/>
        <input type="button" class="button_cancel" value="Cancelar"/>
    </div>
</div>
<div id="nuevoTratamiento" class="function">
</div>
<!-- panel de datos del paciente-->
<div id="contenedor_iconos" style="width:370px;height: 520px; margin-top: 10px;">
    <div class="iconoContainer" id="btnTratamientos" onclick=" loadTratamientos()">
        <input type="image" src="<?php echo URL ?>public/img/ico_principal/ico_doctor.png" alt="tratamiento"  class="iconos_escritorio" />
        <div class="nombreFuncion">Tratamientos</div>
    </div>
    <div class="iconoContainer" id="btnNuevoTratamiento" onclick="abrirBuscadorPacientesTratamiento()">
        <input type="image" src="<?php echo URL ?>public/img/ico_principal/ico_nuevo_tratamiento.png" alt="tratamiento"  class="iconos_escritorio" />
        <div class="nombreFuncion">Nuevo tratamiento</div>
    </div>
    <div class="iconoContainer" id="btnPacientes" onclick="alert('En construccion...')">
        <input type="image" src="<?php echo URL ?>public/img/ico_principal/ico_paciente.png" alt="tratamiento"  class="iconos_escritorio" />
        <div class="nombreFuncion">Pacientes</div>
    </div>
    <div class="iconoContainer" id="btnPrestaciones" onclick="alert('En construccion...')">
        <input type="image" src="<?php echo URL ?>public/img/ico_principal/ico_prestacion.png" alt="tratamiento"  class="iconos_escritorio" />
        <div class="nombreFuncion">Prestaciones</div>
    </div>
    <div class="iconoContainer" id="btnUsuarios">
        <input type="image" onclick="mantenimiento_usuarios()" src="<?php echo URL ?>public/img/ico_principal/ico_usuario.png" alt="tratamiento"  class="iconos_escritorio" />
        <div class="nombreFuncion">Usuarios</div>
    </div>
    <div class="iconoContainer" id="btnControlUsuarios" onclick="alert('En construccion...')">
        <input type="image" src="<?php echo URL ?>public/img/ico_principal/ico_control.png" alt="tratamiento"  class="iconos_escritorio" />
        <div class="nombreFuncion">Control de usuarios</div>
    </div>
    <div class="iconoContainer" id="btnFormularios">
        <input type="image" src="<?php echo URL ?>public/img/ico_principal/ico_formularios_web.png" alt="tratamiento"  class="iconos_escritorio" />
        <div class="nombreFuncion">Formularios web</div>
    </div>

</div>
<div class="block"><img id="img_load" src="<?php echo URL ?>public/img/loader.gif" style="position: absolute;display: none; top: 95%;left: 85%"/></div>