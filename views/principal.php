<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="<?php echo URL ?>public/css/estilo_escritorio.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="<?php echo URL ?>public/css/estilo.css" type="text/css" media="screen"/>
        <script type="text/javascript" src="<?php echo URL ?>public/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo URL ?>public/js/principalScript.js"></script>
        <link rel="shortcut icon" href="<?php echo URL ?>public/img/tooth.ico" type="image/ico"/>
<!--        <link rel="stylesheet" href="<?php echo URL ?>public/css/estilo_odontograma.css" type="text/css" media="screen"/>-->
        <title>Clinica Sagastume</title>
    </head>
    <body>
        <div id="container" >
            <!--cabecera-->
            <div id="header">
                <h1 id="title">Clinica Sagastume</h1>
                <a href="">Cerrar seccion</a>
                <p id="user" style="margin-right: 20px;">Gerardo Sagastume</p>
                <div class="clear"></div>
            </div>
            <div id="aplication">
                <div id="buscarPaciente" class="function">
                    <h2 id="title2">Buscar paciente</h2>
                    <input type="text" id="text_ci" class="fieldText" placeholder="Cedula" />

                    <div class="listado">
                        <table class="tabla">
                            <tr>
                                <td scope="col" style="width: 20%; background-color: #A5DCFF">Ci</td>
                                <td scope="col" style="width: 40%; background-color: #A5DCFF">Nombre</td>
                            </tr>
                            <tr>
                                <td scope="row" style="width: 20%">455445554</td>
                                <td scope="row" style="width: 40%">Rodrigo Cotto barrios</td>
                            </tr>
                            <tr>
                                <td scope="row" style="width: 20%">4485693319</td>
                                <td scope="row" style="width: 40%">Diego Plada</td>
                            </tr>
                            <tr>
                                <td scope="row" style="width: 20%">447899665</td>
                                <td scope="row" style="width: 40%">Marciano Duran</td>
                            </tr>
                            
                        </table>
                    </div>
                    <div id="contenedor_botones">
                        <input type="button" id="btnAceptar_paciente" class="button_menu" value="Aceptar"/>
                            <input type="button" class="button_cancel_menu" value="Cancelar"/>
                    </div>
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
                        <input type="image" src="<?php echo URL ?>public/img/ico_principal/ico_usuario.png" alt="tratamiento"  class="iconos_escritorio" />
                        <div class="nombreFuncion">Usuarios</div>
                    </div>
                    <div class="iconoContainer" id="btnControlUsuarios">
                        <input type="image" src="<?php echo URL ?>public/img/ico_principal/ico_control.png" alt="tratamiento"  class="iconos_escritorio" />
                        <div class="nombreFuncion">Control de usuarios</div>
                    </div>
                </div>
                <div class="block"></div>
            </div>
        </div>
    </body>
</html>
