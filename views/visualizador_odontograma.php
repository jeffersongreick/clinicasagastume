<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="<?php echo URL ?>public/css/estilo_odontograma.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="<?php echo URL ?>public/css/estilo.css" type="text/css" media="screen"/>
        <script type="text/javascript" src="<?php echo URL ?>public/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo URL ?>public/js/kinetic.js"></script>
        <script type="text/javascript" src="<?php echo URL ?>public/js/load_view.js"></script>
        <script type="text/javascript" src="<?php echo URL ?>public/js/pieza.js"></script>
        <script type="text/javascript" src="<?php echo URL ?>public/js/cara.js"></script>
        <script type="text/javascript" >
         <?php if (isset($JsonOdontograma)): echo $JsonOdontograma; endif;?>
    </script>
        <link rel="shortcut icon" href="<?php echo URL ?>public/img/tooth.ico" type="image/ico"/>
<!--        <link rel="stylesheet" href="<?php echo URL ?>public/css/estilo_odontograma.css" type="text/css" media="screen"/>-->
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
                <div id="slideContainer">
                    <!--contenedor de las cajas de edicion (odontograma y editor de pieza)-->
                    <div id="slide">
                        <!--odontograma-->
                        <div id="odontograma">
                            <div id="canvasOdontograma"></div>
                            <input type="button" value="Detalles" id="btnDetalles" class="button" />
                            <input type="button" value="Imprimir" id="btnImprimir" class="button" />
                            <a href="<?php echo URL ?>odontograma/index/" class="descripcionIcono" >
                                <input type="button" value="Volver" id="btnVolver" class="button" />
                            </a>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>         
                <div class="block"></div>
            </div>
        </div>
    </body>
</html>