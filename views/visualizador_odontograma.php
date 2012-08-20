<!-- panel de datos del paciente-->
<div id="pnlData">
    <p id="patientName">Paciente: <span><?php if(isset ($_SESSION['nombre_paciente']))echo $_SESSION['nombre_paciente'] ?></span></p> 
    <p  id="idTreatment">Tratamiento id: <?php if(isset($_SESSION['id_tratamiento']))echo $_SESSION['id_tratamiento'] ?></p>
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