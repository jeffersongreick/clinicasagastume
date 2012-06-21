<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="<?php echo URL ?>public/css/estilo_escritorio.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="<?php echo URL ?>public/css/estilo.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="<?php echo URL ?>public/css/dark-hive/jquery-ui-1.8.21.custom.css" type="text/css" media="screen"/>
        <script type="text/javascript" src="<?php echo URL ?>public/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo URL ?>public/js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo URL ?>public/js/escritorio_script.js"></script>
        <link rel="shortcut icon" href="<?php echo URL ?>public/img/tooth.ico" type="image.ico"/>
    </head>

    <body>
        <div id="contenedor" >
             <div id="header">
                <h1 id="titulo">Clinica Sagastume</h1>
                <a href="">Cerrar seccion</a>
                <p id="user" style="margin-right: 20px;">Gerardo Sagastume</p>
                <div class="clear"></div>
            </div>
             <div id="aplicacion">

<!-- panel de datos del paciente-->
                <div id="pnlDatos">
                    <p id="nombrePaciente">Paciente: <span>Marciano Durán</span></p> 
                    <a href="" id="idTratamiento">Tratamiento: 16</a>
                    <p style="margin: 0;">Fecha:<time><?php echo date("d-m-Y"); ?></time></p>
                </div>


<!--menu funciones                -->
                <div class="funcion" id="registrosOdontogramas">
                    <ul>
                        <li>
                            <input type="button" id="btnEstadoInicial" class="boton" value="Odontograma estado inicial"/>
                            <ul >
                                <li><a href="odontograma.php"><input type="button" id="btnNuevoEstadoInicial" class="boton" value="Nuevo"/></a></li>
                                <li><a href="odontograma.php"><input type="button" id="btnEditarEstadoInicial" class="boton" value="Editar"/></a></li>
                                <li><a href="odontograma.php"><input type="button" id="btnVisualizarEstadoInicial" class="boton" value="Visualizar"/></a></li>
                            </ul>
                        </li>

                        <li>
                            <input type="button" id="btnOtrosOdontogramas" class="boton" value="Otros odontogramas"/>
                            <ul >
                                <li><a href="odontograma.php"><input type="button" id="btnEstadoActual" class="boton" value="Estado actual"/></a></li>
                                <li><input type="button" id="btnBuscarEstado" class="boton" value="Buscar"/></li>
                            </ul>
                        </li>
                        <li>
                            <input type="button" id="btnCancelarAccion" class="boton" value="Cancelar"/>
                        </li>
                    </ul>
                </div>
            <?php if (isset($contenido)) echo $contenido; ?>
        </div>
    </body>

</html>