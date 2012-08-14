<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="<?php echo URL ?>public/css/estilo_login.css" type="text/css" media="screen"/>
        <script type="text/javascript" src="<?php echo URL ?>public/js/jquery.js"></script>
        <link rel="shortcut icon" href="<?php echo URL ?>public/img/tooth.ico" type="image/ico"/>
        <title>Clinica Sagastume</title>
    </head>
    <body>
        <div id="container" >
            <!--cabecera-->
            <div id="header">
                <h1 id="title1">Clinica Sagastume</h1>
            </div>
            <div id="wrap">
                <h1 id="title2">Login</h1>
                <form action="usuario/principal" autocomplete="on">
                    <label for="user_name">Usuario</label>
                    <input type="text" id="user_name" placeholder="username">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="pass">
                    <br/>
                    <input type="submit" id="submit" value="Ingresar">
                </form>
            </div>
        </div>
    </body>
</html>
