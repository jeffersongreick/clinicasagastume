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
            <div id="windowDetail">
                <p class="title3"></p>
                <div class="table_container">
                    <table>
                        <thead>
                            <tr>
                                <th class="colCara">Cara</th>
                                <th class="colFactor" >Prestacion</th>
                            </tr>       
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div id="contenedor_botones" >
                    <input type="button" value="Volver" id="btnVolverDetalles" class="button" />
                </div>
            </div>
            <div id="canvasOdontograma"></div>
            <div id="contenedor_botones" >
                <input type="button" value="Editar pieza" id="btnEditarPieza" class="button" />
                <input type="button" value="Detalles" id="btnDetalles" class="button" />
                <input type="button" value="Guardar" id="btnGuardarOdontograma" class="button" onclick="guardarOdontograma()" />
                <input type="button" value="Cancelar" onclick="location.href='<?php echo URL ?>tratamiento/tratamiento/'"  id="btnCancelarOdontograma" class="button" />
            </div>
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
                    <input type="search"  onkeyup="filtrarPrestacion(this.value)" results="5" id="search_prestacion" class="fieldText" placeholder=" prestacion" autocomplete = "on"/>
                    <div class="option_list">
                        <?php if (isset($prestaciones)) echo $prestaciones ?> 
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