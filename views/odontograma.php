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
                                <input id="tab_state" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
                                <label for="tab_state" class="tab-label">Estados</label>
                                <input id="tab_treatment" type="radio" name="radio-set" class="tab-selector-2" />
                                <label for="tab_treatment" class="tab-label">Prestaciones</label>
                                <div class="clear"></div>
                                <div class="tabs">
                                    <div class="state_items">
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