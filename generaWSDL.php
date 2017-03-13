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
 * Módulo: XXXX
 * Tema XX: 
 * Tarea X:
 * Alumno: Felipe Rodríguez Gutiérrez
 */

/**
 * Generando el documento WSDL del servicio correspondiente
 */
//Incluimos los archivos correspondientes
require 'funciones.php';
require 'WSDLDocument.php';

//Obtenemos las rutas del archivo del servicio y del espacio de nombres
$url = str_replace("generaWSDL", "servicio", $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$uri = str_replace("/generaWSDL.php", "", $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

//Llamamos al documento y especificamos las clases a utilizar
$wsdl = new WSDLDocument('Funciones', $url, $uri);

//Generamos el documento XML correspondiente
echo $wsdl->saveXML();