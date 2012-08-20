<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="<?php echo URL ?>public/img/tooth.ico" type="image/ico"/>
        <?php if (isset($css)) echo $css ?> 
        <?php if (isset($script)) echo $script ?> 
        <?php if (isset($JsonOdontograma)) echo $JsonOdontograma; ?>
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
                <?php if (isset($contenido)) echo $contenido ?>
            </div>
        </div>
    </body>