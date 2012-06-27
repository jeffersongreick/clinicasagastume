<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="http://localhost/clinica/odontograma/public/css/estilo_escritorio.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="http://localhost/clinica/odontograma/public/css/estilo.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="http://localhost/clinica/odontograma/public/css/dark-hive/jquery-ui-1.8.21.custom.css" type="text/css" media="screen"/>
        <script type="text/javascript" src="http://localhost/clinica/odontograma/public/js/jquery.js"></script>
        <script type="text/javascript" src="http://localhost/clinica/odontograma/public/js/jquery-ui.js"></script>
        <script type="text/javascript" src="http://localhost/clinica/odontograma/public/js/escritorio_script.js"></script>
<!--        <link rel="shortcut icon" href="public/images/tooth.ico" type="image.ico"/>-->
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

<!-- panel de datos del paciente-->
                <div id="pnlData">
                    <p id="patientName">Paciente: <span>Marciano Durán</span></p> 
                    <a href="" id="idTreatment">Tratamiento: 16</a>
                    <p style="margin: 0;">Fecha:<time><?php echo date("d-m-Y"); ?></time></p>
                </div>


<!--menu funciones                -->
                <div class="function" id="registrosOdontogramas">
                    <ul>
                        <li>
                            <input type="button" id="btnEstadoInicial" class="button" value="Odontograma estado inicial"/>
                            <ul >
                                <li><a href="odontograma.php"><input type="button" id="btnNuevoEstadoInicial" class="button" value="Nuevo"/></a></li>
                                <li><a href="odontograma.php"><input type="button" id="btnEditarEstadoInicial" class="button" value="Editar"/></a></li>
                                <li><a href="odontograma.php"><input type="button" id="btnVisualizarEstadoInicial" class="button" value="Visualizar"/></a></li>
                            </ul>
                        </li>

                        <li>
                            <input type="button" id="btnOtrosOdontogramas" class="button" value="Otros odontogramas"/>
                            <ul >
                                <li><a href="odontograma.php"><input type="button" id="btnEstadoActual" class="button" value="Estado actual"/></a></li>
                                <li><input type="button" id="btnBuscarEstado" class="button" value="Buscar"/></li>
                            </ul>
                        </li>
                        <li>
                            <input type="button" id="btnCancelarAccion" class="button" value="Cancelar"/>
                        </li>
                    </ul>
                </div>
<!--menu busqueda de odontogramas-->
                <div id="buscarOdontograma" class="function">
                    <p>Desde:</p>
                    <input type="text" id="fromFecha" class="fieldText" value="Fecha" style="color: gray"/>
                    <p>Hasta:</p>
                    <input type="text" id="toFecha" class="fieldText" value="Fecha" style="color: gray" />
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
                    <a href="odontograma.php"><input type="button" id="btnAceptarBusqueda" class="button" value="Aceptar"/></a>
                    <input type="button" id="btnCancelarBusqueda" class="button" value="Cancelar"/>
                </div>


                <!-- iconos escritorio-->

                <div class="iconoContainer" id="btnRegistroPaciente">
                    <input type="image" src="<?php echo URL?>public/images/ico_escritorio/ico_registros.png" alt="odontograma"  class="iconos_escritorio" />
                    <div class="nombreFuncion">Registro pacientes</div>
                </div>
                <div class="iconoContainer" id="btnTratamiento">
                    <input type="image" src="<?php echo URL?>public/images/ico_escritorio/ico_tratamiento.png" alt="odontograma"  class="iconos_escritorio" />
                    <div class="nombreFuncion">Tratamientos</div>
                </div>
                <div class="iconoContainer" id="btnHistoria" >
                    <input type="image" src="<?php echo URL?>public/images/ico_escritorio/ico_historia.png" alt="odontograma" class="iconos_escritorio" />
                    <div class="nombreFuncion">Historia Clinica</div>
                </div>
                <div class="iconoContainer" id="btnOtros">
                    <input type="image" src="<?php echo URL?>public/images/ico_escritorio/ico_otros.png" alt="odontograma"  class="iconos_escritorio" />
                    <div class="nombreFuncion">Otros</div>
                </div>
                <div class="block"></div>
            </div>
        </div>
    </body>
</html>