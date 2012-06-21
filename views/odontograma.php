        <div id="contenedor">
<!--            cabecera-->
            <div id="header">
                <h1 id="titulo">Clinica Sagastume</h1>
                <a href="">Cerrar seccion</a>
                <p id="user" style="margin-right: 20px;">Gerardo Sagastume</p>
                <div class="clear"></div>
            </div>

            <div id="aplicacion">
<!--datos del paciente-->
                <div id="pnlDatos">
                    <p id="nombrePaciente">Paciente: <span>Marciano Durán</span></p> 
                    <a href="" id="idTratamiento">Tratamiento: 16</a>
                    <p style="margin: 0;">Fecha:<time><?php echo date("d-m-Y"); ?></time></p>
                </div>

                <div id="contenedorSlide">
<!--contenedor de las cajas de edicion (odontograma y editor de pieza)-->
                    <div id="slide">
<!--odontograma-->
                        <div id="odontograma">
                            <div id="canvasOdontograma"></div>
                            <input type="button" value="Editar pieza" id="btnEditarPieza" class="boton" />
                            <input type="button" value="Imprimir" id="btnImprimir" class="boton" />
                            <input type="button" value="Cambiar pieza" id="btnCambaiarPieza" class="boton" />
                            <input type="button" value="Extraer" id="btnExtraer" class="boton" />
                            <a href="index.php" class="descripcionIcono" >
                                <input type="button" value="Guardar" id="btnGuardarOdontograma" class="boton" />
                            </a>
                            <a href="index.php" class="descripcionIcono" >
                                <input type="button" value="Cancelar" id="btnCancelarOdontograma" class="boton" />
                            </a>
                            <div class="clear"></div>
                        </div>
<!--editor pieza-->
                        <div id="editor">
                            <div id="canvasPieza"></div>
                            <div id="items">
                                <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
                                <label for="tab-1" class="tab-label-1">Estados</label>
                                <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" />
                                <label for="tab-2" class="tab-label-2">Prestaciones</label>
                                <div class="clear"></div>
                                <div class="pestanas">
                                    <div class="estados">
                                        <?php
                                        $conexion = new mysqli('localhost', 'root', '', 'clinicadb');
                                        $consulta = "SELECT * FROM tbl_estados";
                                        $resultado = $conexion->query($consulta);
                                        while ($filas = $resultado->fetch_array(MYSQLI_ASSOC)) {
                                            $id = $filas['id'];
                                            ?>   
                                            <input type="checkbox" id="<?php echo $id; ?>" class="item" onclick="marcarPieza('<?php echo $id ?>',this)"/>
                                            <label for="<?php echo $id; ?>" >
                                                <img src="<?php echo URL.'public/'.$filas['url_img']; ?>" class="iconos" id="<?php echo $id; ?>" name="<?php echo $filas['estado']; ?>"/>
                                            </label>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="prestaciones">
                                        <input type="checkbox" id="p" class="item" />
                                        <label for="p" >
                                        </label>
                                    </div>
                                </div>
                                <div id="descripcion"></div>
                            </div>
                            <input type="button" value="Guardar" id="btnGuardar" class="boton" />
                            <input type="button" value="Cancelar" id="btnCancelar" class="boton" />
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
