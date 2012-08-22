<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Error</title>
        <style>
            #aplication{
                position: relative;
                background: -webkit-linear-gradient(top, rgba(0,0,0,0.65) 0%,rgba(0,0,0,0.65) 100%);
                border: solid 1px seashell;
                box-shadow: 0px 0px 20px 5px #7E7E7D;
                border-radius: 10px;
                width: 1000px;
                text-align:center;
                font-size: x-large;
                height: auto;
                position: absolute;
                top: 10%;
                left: 50%;
                margin: -20px auto auto -500px;
            }
            body{
                background-color: #ECECEC;
                color: white;
                font-weight: bolder;
            }
            .button{
                color: white;
                font-size: 25px;
                padding: 5px 15px;
                cursor: pointer;
                border-radius: 5px;
                background:#586C83;
                margin-bottom: 10px;
            }
            .button:hover{
                opacity: 0.8;
                box-shadow: 0px 0px 3px 2px white;
            }
        </style>
    </head>
    <body>
        <div id="container" >
            <div id="aplication">
                <p>
                    ¡Error!
                </p>
                <p>
                    <?php if (isset($error)) echo $error ?>
                </p>
                <input type="button" value="Volver" onclick="location.href='<?php if (isset($location)) echo URL . $location ?>'" class="button" />
            </div>
        </div>
    </body>
</html>