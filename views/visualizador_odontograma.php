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
                                <th class="colFactor" >Estado</th>
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
                <input type="button" value="Detalles" id="btnDetalles" class="button" />
                <input type="button" value="Imprimir" id="btnImprimir" class="button" />
                <input type="button" value="Volver" onclick="location.href='<?php echo URL ?>tratamiento/tratamiento/'" id="btnVolver" class="button" />
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>         
<div class="block"></div>