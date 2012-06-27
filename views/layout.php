<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="http://localhost/clinica/odontograma/public/css/estilo_escritorio.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="http://localhost/clinica/odontograma/public/css/estilo.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="http://localhost/clinica/odontograma/public/css/dark-hive/jquery-ui-1.8.21.custom.css" type="text/css" media="screen"/>
        <script type="text/javascript" src="http://localhost/clinica/odontograma/public/js/jquery.js"></script>
        <script type="text/javascript" src="http://localhost/clinica/odontograma/public/js/jquery-ui.js"></script>
        <script type="text/javascript" src="http://localhost/clinica/odontograma/public/js/escritorio_script.js"></script>
<!--        <link rel="shortcut icon" href="public/images/tooth.ico" type="image.ico"/>-->
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
<!--menu funciones                -->
            </div>
        </div>
    </body>
</html>