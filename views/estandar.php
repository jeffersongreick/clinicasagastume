<div style="    background-color: #ECECEC;border-bottom: dashed 1px #7E7E7D;">
    <p>Paciente: <span><?php echo $_SESSION['nombre_paciente'] ?></span></p> 
    <p style="display: inline">Tratamiento id: <?php echo $_SESSION['id_tratamiento'] ?></p>
    <p style="display: inline; float: right">Fecha:<time><?php echo date("d-m-Y"); ?></time></p>
</div>

<div id="canvasOdontograma" ></div>
<div class="contenedor_factores" >
    <table style="float: left;" >
        <thead>
            <tr>
                <th class="col1">Pieza</th>
                <th class="col1">Cara</th>
                <th class="col2">Descripcion</th>
            </tr>       
        </thead>
        <tbody style="height: 180px" id="tb1">
        </tbody>
    </table>

    <table >
        <thead>
            <tr>
                <th class="col1">Pieza</th>
                <th class="col1">Cara</th>
                <th class="col2">Descripcion</th>
            </tr>       
        </thead>
        <tbody style="height: 180px" id="tb2">
        </tbody>
    </table>
</div>
