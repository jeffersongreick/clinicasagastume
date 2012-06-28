                <div id="slideContainer">
<!--contenedor de las cajas de edicion (odontograma y editor de pieza)-->
                    <div id="slide">
<!--odontograma-->
                        <div id="odontograma">
                            <div id="canvasOdontograma"></div>
                            <input type="button" value="Editar pieza" id="btnEditarPieza" class="button" />
                            <input type="button" value="Imprimir" id="btnImprimir" class="button" />
                            <input type="button" value="Cambiar pieza" id="btnCambaiarPieza" class="button" />
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
                            <div id="canvasPieza"></div>
                            <div id="items">
                                <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
                                <label for="tab-1" class="tab-label-1">Estados</label>
                                <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" />
                                <label for="tab-2" class="tab-label-2">Prestaciones</label>
                                <div class="clear"></div>
                                <div class="tabs">
                                    <div class="estados">
                                        <?php
                                        $conexion = new mysqli('localhost', 'root', '', 'clinicadb');
                                        $consulta = "SELECT * FROM tbl_estado";
                                        $resultado = $conexion->query($consulta);
                                        while ($filas = $resultado->fetch_array(MYSQLI_ASSOC)) {
                                            $id = $filas['id'];
                                            ?>   
                                            <input type="checkbox" id="<?php echo $id; ?>" class="item" onclick="marcarPieza('<?php echo $id ?>',this)"/>
                                            <label for="<?php echo $id; ?>" >
                                                <img src="<?php echo URL ;echo $filas['url_img']; ?>" class="iconos" id="<?php echo $id; ?>" name="<?php echo $filas['estado']; ?>"/>
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
                                <div id="description"></div>
                            </div>
                            <input type="button" value="Guardar" id="btnGuardar" class="button" />
                            <input type="button" value="Cancelar" id="btnCancelar" class="button" />
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>