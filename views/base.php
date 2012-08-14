<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="<?php echo URL ?>public/img/tooth.ico" type="image/ico"/>
        <?php if (isset($css)) echo $css ?> 
        <?php if (isset($script)) echo $script ?> 
        <title>Clinica Sagastume</title>
    </head>
    <body>
        <?php if (isset($contenido)) echo $contenido ?>
    </body>