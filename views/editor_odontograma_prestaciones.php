<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="<?php echo URL ?>public/css/estilo_odontograma.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="<?php echo URL ?>public/css/estilo.css" type="text/css" media="screen"/>
        <script type="text/javascript" src="<?php echo URL ?>public/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo URL ?>public/js/kinetic.js"></script>
        <script type="text/javascript" src="<?php echo URL ?>public/js/load_odontograma.js"></script>
        <script type="text/javascript" src="<?php echo URL ?>public/js/pieza.js"></script>
        <script type="text/javascript" src="<?php echo URL ?>public/js/functions_odontograma.js"></script>
        <script type="text/javascript" src="<?php echo URL ?>public/js/cara.js"></script>
        <script type="text/javascript" src="<?php echo URL ?>public/js/load_odontograma_tratamiento.js"></script>
        <link rel="shortcut icon" href="<?php echo URL ?>public/img/tooth.ico" type="image/ico"/>
<!--        <link rel="stylesheet" href="<?php echo URL ?>public/css/estilo_odontograma.css" type="text/css" media="screen"/>-->
        <title>Clinica Sagastume</title>
    </head>
    <body>
        <script type="text/javascript" >
<?php
if (isset($JsonOdontograma)): echo $JsonOdontograma;
endif;
?>
        </script>
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
                    <p id="patientName">Paciente: <span><?php echo $_SESSION['nombre_paciente'] ?></span></p> 
                    <p  id="idTreatment">Tratamiento id: <?php echo $_SESSION['id_tratamiento'] ?></p>
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
                                        <img id="imgCambiar" class="imgPieza" alt="Imagen de prueba" src="">
                                        <label id="lblPiezaCambiar" for="imgCambiar"></label>
                                    </div>
                                    <p style="display: inline;float: left;margin-top: 50%">>></p>
                                    <div class="descripcionPiezaCambiar">
                                        <img id="imgNueva" class="imgPieza" alt="Imagen de prueba" src="">
                                        <label id="lblNuevaPieza" for="imgNueva">nueva pieza  </label>
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
                            <input type="button" value="Cambiar pieza" id="btnCambiarPieza" class="button" />
                            <input type="button" value="Agregar/Extraer" id="btnExtraer" class="button" />
                            <input type="button" value="Imprimir" id="btnImprimir" class="button" />
                            <input type="button" value="Guardar" id="btnGuardarOdontograma" class="button" onclick="guardarOdontograma()" />
                            <input type="button" value="Cancelar" onClick="history.go(-1)"  id="btnCancelarOdontograma" class="button" />

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
                                <h1 id="title_state"  class="tab-selector-1">Prestaciones</h1>
                                <div class="clear"></div>
                                <div class="treatments_items" style="overflow-y: auto;">
                                    <input type="search"  results="5" id="search_prestacion" class="fieldText" placeholder=" prestacion" autocomplete = "on"/>
                                    <select class="option_list" size="7">
                                        <option class="option_item">1</option>
                                        <option class="option_item">2</option>
                                        <option class="option_item">3</option>
                                        <option class="option_item">4</option>
                                        <option class="option_item">5</option>
                                        <option class="option_item">6</option>
                                        <option class="option_item">7</option>
                                        <option class="option_item">8</option>
                                        <option class="option_item">9</option>
                                        <option class="option_item">10</option>
                                    </select>
                                    <div id="contenedor_botones" >
                                        <input type="button" class="button_cancel" style="margin-top: 0px;" value="Buscar"/>
                                    </div>
                                </div>

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