<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="<?php echo URL ?>public/css/estilo_odontograma.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="<?php echo URL ?>public/css/estilo.css" type="text/css" media="screen"/>
        <script type="text/javascript" src="<?php echo URL ?>public/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo URL ?>public/js/kinetic.js"></script>
        <script type="text/javascript" src="<?php echo URL ?>public/js/load.js"></script>
        <script type="text/javascript" src="<?php echo URL ?>public/js/pieza.js"></script>
        <script type="text/javascript" src="<?php echo URL ?>public/js/functions.js"></script>
        <script type="text/javascript" src="<?php echo URL ?>public/js/cara.js"></script>
        <link rel="shortcut icon" href="public/images/tooth.ico" type="image.ico"/>
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
                <!-- panel de datos del paciente-->
                <div id="pnlData">
                    <p id="patientName">Paciente: <span>Marciano Durán</span></p> 
                    <a href="" id="idTreatment">Tratamiento: 16</a>
                    <p style="margin: 0;">Fecha:<time><?php echo date("d-m-Y"); ?></time></p>
                </div>
                <div id="slideContainer">
                    <!--contenedor de las cajas de edicion (odontograma y editor de pieza)-->
                    <div id="slide">
                        <!--odontograma-->
                        <div id="odontograma">
                            <div id="ventanaCambioPieza">

                                <p id="cambioPiezaTitulo">La informacion registrada en este odontograma sobre la pieza anterior sera borrada.
                                    Esta seguro del cambio?</p>
                                <div id="containerPiezas">
                                    <div class="descripcionPiezaCambiar">
                                        <img id="imgCambiar" class="imgPieza" alt="Imagen de prueba" src="<?php echo URL ?>public/img/img_piezas/cara1/11.png">
                                        <label for="imgCambiar">Pieza a cambiar</label>
                                    </div>
                                    <p style="display: inline;float: left;margin-top: 50%">>></p>
                                    <div class="descripcionPiezaCambiar">
                                        <img id="imgNueva" class="imgPieza" alt="Imagen de prueba" src="<?php echo URL ?>public/img/img_piezas/cara1/11.png">
                                        <label for="imgNueva">nueva pieza  </label>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="botonesCentrados">
                                        <input type="button" value="Cambiar" id="btnGuardarNuevaPieza" class="button" />
                                        <input type="button" value="Cancelar" id="btnCancelarNuevaPieza" class="button" />
                                    </div>
                                </div>





                            </div>
                            <div id="canvasOdontograma"></div>

                            <input type="button" value="Editar pieza" id="btnEditarPieza" class="button" />
                            <input type="button" value="Imprimir" id="btnImprimir" class="button" />
                            <input type="button" value="Cambiar pieza" id="btnCambiarPieza" class="button" />
                            <input type="button" value="Extraer" id="btnExtraer" class="button" />
                            <a href="index.php" class="descripcionIcono" >
                                <input type="button" value="Guardar" id="btnGuardarOdontograma" class="button" />
                            </a>
                            <a href="index.php" class="descripcionIcono" >
                                <input type="button" value="Cancelar" id="btnCancelarOdontograma" class="button" />
                            </a>
                            <div class="clear"></div>
                        </div>
                        <!--editor pieza-->
                        <div id="editor">
                            <div id="editorPieza">
                                <input type="button" class="cara" style="margin-left: 100px" value="1"/>
                                <br>
                                <input type="button" class="cara" style="margin-left: 35px" value="2"/>
                                <input type="button" class="cara" style="margin-left: 23px" value="5"/>
                                <input type="button" class="cara" style="margin-left: 20px" value="4"/>
                                <br>
                                <input type="button" class="cara" style="margin-left: 100px" value="3"/>
                                <div class="clear"></div>
                                <div id="canvasPieza"></div>
                            </div>

                            <div id="items">
                                <input id="tab_state" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
                                <label for="tab_state" class="tab-label">Estados</label>
                                <input id="tab_treatment" type="radio" name="radio-set" class="tab-selector-2" />
                                <label for="tab_treatment" class="tab-label">Prestaciones</label>
                                <div class="clear"></div>
                                <div class="tabs">
                                    <div class="state_items">
                                        <?php
                                        if (isset($listaEstados)) {
                                            echo $listaEstados;
                                        }
                                        ?>
                                    </div>
                                    <div class="treatment_items">
                                        <input type="checkbox" id="p" class="item" />
                                        <label for="p" >
                                        </label>
                                    </div>
                                </div>
                                <div id="item_description"></div>
                            </div>
                            <input type="button" value="Guardar" id="btnGuardar_edicion_pieza" class="button" />
                            <input type="button" value="Cancelar" id="btnCancelar_edicion_pieza" class="button" />
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>         
                <div class="block"></div>
            </div>
        </div>
    </body>
</html>