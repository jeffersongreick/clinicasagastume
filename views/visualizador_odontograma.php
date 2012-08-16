<script type="text/javascript" >
<?php if (isset($JsonOdontograma)): echo $JsonOdontograma;
endif; ?>
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
            <p id="patientName">Paciente: <span><?php echo $_SESSION['nombre_paciente']?></span></p> 
                    <p  id="idTreatment">Tratamiento id: <?php echo $_SESSION['id_tratamiento']?></p>
                    <p style="margin: 0;">Fecha:<time><?php echo date("d-m-Y"); ?></time></p>
        </div>
        <div id="slideContainer">
            <!--contenedor de las cajas de edicion (odontograma y editor de pieza)-->
            <div id="slide">
                <!--odontograma-->
                <div id="odontograma">
                    <div id="canvasOdontograma"></div>
                    <input type="button" value="Detalles" id="btnDetalles" class="button" />
                    <input type="button" value="Imprimir" id="btnImprimir" class="button" />
                        <input type="button" value="Volver" onClick="history.go(-1)" id="btnVolver" class="button" />
                    <div class="clear"></div>
                </div>
            </div>
        </div>         
        <div class="block"></div>
    </div>
</div>