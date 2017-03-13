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

/**
 * Montando el servicio web
 */
//Requermimos el archivo especificado.
require_once 'funciones.php';

//Obtenemos la ruta del archivo funciones.wdsl independiente de la ruta creada en el servidor
$uri = str_replace("servicio.php", "funciones.wsdl", filter_input(INPUT_SERVER, 'HTTP_HOST').filter_input(INPUT_SERVER, 'REQUEST_URI'));

//Creamos o instanciamos un nuevo servidor SOAP
$server = new SoapServer(null, array('uri'=>$uri));
//Indicamos las clases que deben utilizarse en el servidor
$server->setClass('Funciones');
//Indicamos que maneje las peticiones SOAP
$server->handle();



