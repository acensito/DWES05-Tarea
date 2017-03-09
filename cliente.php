<?php

/* 
 * 2017 Felipe Rodríguez Gutiérrez
 *
 * CODIGO CREADO BAJO LICENCIA CREATIVE COMMONS
 *
 * Reconocimiento - NoComercial - CompartirIgual (by-nc-sa): 
 *
 * No se permite un uso comercial de la obra original ni de las posibles obras 
 * derivadas, la distribución de las cuales se debe hacer con una licencia igual
 * a la que regula la obra original.
 */

/* 
 * Módulo: Desarrollo Wef Entorno Servidor
 * Tema 05: Servicios Web
 * Tarea 5: Servicios Web
 * Alumno: Felipe Rodríguez Gutiérrez
 */

$url = str_replace("cliente", "servicio", "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$uri = str_replace("/cliente.php", "", "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

$cliente = new SoapClient(null, array('location'=>$url, 'uri'=>$uri));
?>

<html>
<head>
    <meta charset="utf-8">
    <title>DWES - Tarea 5 - Servicios Web</title>
    <link type="text/css" href="estilos.css" rel="stylesheet" />
</head>

<body>
    <h2>Foreros registrados:</h2>
    <?php
    try {
       $usuarios = $cliente->getForeros();
       if ($usuarios) {
           echo '<table>';
           echo '<tr><th>Usuario</th><th>e-mail</th></tr>';        
           foreach ($usuarios as $usuario) {
               echo '<tr><td>'.$usuario['login'].'</td><td>'.$usuario['email'].'</td></tr>';
           }
           echo '</table>';
       } else {
           echo 'No existen usuarios registrados en el sistema';
       }
    } catch(Exception $ex) {
        die($ex->getMessage());
    }
    
    ?>
    
    <h2>Mensajes públicos:</h2>
    <?php
    try {
       $mensajes = $cliente->getMensajesPublicos();
       if ($mensajes) {
           echo '<table>';
           echo '<tr><th>Usuario</th><th>e-mail</th></tr>';
           
           foreach ($mensajes as $mensaje) {
               echo '<tr><td>'.$mensaje['fecha'].'</td><td>'.$mensaje['contenido'].'</td></tr>';
           }
           echo '</table>';
       } else {
           echo 'No existen usuarios registrados en el sistema';
       }
    } catch(Exception $ex) {
        die($ex->getMessage());
    }
    ?>
    
    <h2>Consulta de participación:</h2>
    <form action="cliente.php" method="POST">
        <input type="text" name="campoLogin" value="" /> <input type="submit" value="Consulta Participación" name="enviar" />
    </form> 
    <?php
    if (filter_has_var(INPUT_POST, 'enviar')){
        $login = filter_input(INPUT_POST, 'campoLogin');
        
        $contador = $cliente->getParticipacionForeros($login);

        if ($contador) {
            echo '<table>';
            echo    '<tr><th colspan="2">Participación del forero '.$login.'</th></tr>';
            echo    '<tr><th>Publicos</th><th>Privados</th></tr>';
            echo    '<tr class="centro"><td>'.$contador['publicos'].'</td><td>'.$contador['privados'].'</td></tr>';
            echo '</table>';
        } else {
            echo "<p>El usuario especificado no existe en la BD</p>";
        }
    }
    ?>
    <footer>DWES - Tarea 5 - Felipe Rodríguez Gutiérrez - 2016/2017</footer>
</body>
</html>
