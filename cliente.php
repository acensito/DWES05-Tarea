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

//Generamos las rutas del archivo de servicio y del espacio de nombres
$url = str_replace("cliente", "servicio", "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$uri = str_replace("/cliente.php", "", "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

//Creamos el cliente SOAP
$cliente = new SoapClient(null, array('location'=>$url, 'uri'=>$uri));
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>DWES - Tarea 5 - Servicios Web</title>
    <link type="text/css" href="estilos.css" rel="stylesheet" />
</head>

<body>
    <h1>DWES - Tarea 05</h1>
    <h2>Foreros registrados:</h2>
    <?php
    try {
        //Obtenemos los foreros mediante el cliente
       $usuarios = $cliente->getForeros();
       //Si existen usuarios mostramos una tabla con los datos
       if ($usuarios) {
           echo '<table>';
           echo '<tr><th>Usuario</th><th>e-mail</th></tr>';        
           foreach ($usuarios as $usuario) {
               echo '<tr><td>'.$usuario['login'].'</td><td>'.$usuario['email'].'</td></tr>';
           }
           echo '</table>';
       } else {
           //En caso de no existir usuarios, se muestra mensaje feedback
           echo '<p>No existen usuarios registrados en el sistema</p>';
       }
    } catch(Exception $ex) {
        //Se obtienen los mensajes de error y se para la ejecución
        die($ex->getMessage());
    }
    ?>
    
    <h2>Mensajes públicos:</h2>
    <?php
    try {
        //Obtenemos los mensajes publicos del foro
       $mensajes = $cliente->getMensajesPublicos();
       //Si existen mensajes, mostramos una tabla con los datos
       if ($mensajes) {
           echo '<table>';
           echo '<tr><th>Usuario</th><th>e-mail</th></tr>';
           foreach ($mensajes as $mensaje) {
               echo '<tr><td>'.$mensaje['fecha'].'</td><td>'.$mensaje['contenido'].'</td></tr>';
           }
           echo '</table>';
       } else {
           //En caso de no existir mensajes, se muestra mensaje feedback
           echo '<p>No existen mensajes registrados en el sistema</p>';
       }
    } catch(Exception $ex) {
        //Se obtienen los mensajes de error y se para la ejecucion
        die($ex->getMessage());
    }
    ?>
    
    <h2>Consulta de participación:</h2>
    <form action="cliente.php" method="POST">
        <input placeholder="Introduzca un usuario "type="text" name="campoLogin" value="" required />
        <input type="submit" value="Consulta Participación" name="enviar" />
    </form> 
    <?php
    //Si se ha presionado el boton de enviar
    if (filter_has_var(INPUT_POST, 'enviar')){
        //Se obtiene el dato introducido en el campo
        $login = filter_input(INPUT_POST, 'campoLogin');
        //Obtenemos el numero de mensajes de dicho forero introducido
        $contador = $cliente->getParticipacionForeros($login);

        //Si existen resultados para mostrar (existe el usuario), mostramos la
        //tabla con los resultados
        if ($contador) {
            echo '<table>';
            echo    '<tr><th colspan="2">Participación del forero '.$login.'</th></tr>';
            echo    '<tr><th>Públicos</th><th>Privados</th></tr>';
            echo    '<tr class="centro"><td>'.$contador['publicos'].'</td><td>'.$contador['privados'].'</td></tr>';
            echo '</table>';
        } else {
            //En el caso de no existir el usuario, se muestra mensaje feedback
            echo "<p>El usuario especificado no existe en la BD</p>";
        }
    }
    ?>
    <footer>DWES - Tarea 5 - Felipe Rodríguez Gutiérrez - 2016/2017</footer>
</body>
</html>

