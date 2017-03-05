DWES - Tarea 05

Enunciado:
==========

Para realizar esta tarea vamos a utilizar la base de datos creada para la tarea
4 (su nombre era foro4).

Deberás utilizar PHP5 SOAP para crear un servicio web con las siguientes
funciones que presentan información de nuestra base de datos:

-   **accesoBD:** No recibe parámetros, establece la conexión a la BD y devuelve
    error en caso de no poder realizarse.

-   **getForeros:** No recibe parámetros y devuelve el listado con los login y
    correos electrónicos de los foreros registrados en la base de datos.

-   **getMensajesPublicos:** No recibe parámetros y devuelve el listado de la
    fecha y el contenido de los mensajes públicos de todos los foreros.

-   **getParticipacionForeros:** Recibe como parámetro el login del autor,
    comprueba su existencia y en caso de existir devuelve el número de mensajes
    públicos y el número de mensajes privados que ha creado.

Todas estas funciones deben estar declaradas como públicas en el fichero
llamado **funciones.php**. En el caso de necesitar más funciones, las
declararemos como privadas.

La declaración del servicio web se realizará en el
archivo **servicio.php** mediante el uso del
archivo **funciones.wsdl** previamente creado a partir de **funciones.php.**

Además, deberás crear el fichero **cliente.php**, haciendo uso del servicio
programado anteriormente, en el que se mostrará lo siguiente:

-   En primer lugar el texto "**Foreros registrados:**" y a continuación la
    tabla con la información de los comerciales (**login** y **email**). Usa
    para ello la función **getForeros**.

-   A continuación de esto, el texto " **Mensajes públicos:**" seguido de la
    tabla con la información de todos los mensajes públicos
    (**fecha** y **contenido**). Usa para ello la
    función**getMensajesPublicos**.

-   Por último, el texto " **Consulta de participación:**" seguido de un campo
    de texto para introducir el login del forero y un formulario que contendrá
    un botón "**Consulta participación**". Pulsando el botón, si el forero no
    existe se mostrará un mensaje de error, y si sí existe se mostrará una tabla
    con el título “**Participación del forero login:**” seguido de una tabla que
    muestre el número de mensajes públicos del forero y el número de mensajes
    privados del forero.

Como veis, la aplicación en sí es sencilla, pero la introducción del uso de
servicios web puede ser complicada. Por ello, a continuación os indico los pasos
que deberíais hacer para que el desarrollo de la tarea discurra sin problemas:

-   **Paso 1:** Desarrollo del archivo **funciones.php**, incluyendo las
    funciones anteriores y todas las que creamos necesarias. Añadiremos además
    la documentación de la funciones (recordad que si al inicio de la función
    ponéis /\*\* y clicáis Enter, os genera la estructura de comentarios de
    forma automática).

-   **Paso 2:** Generación del archivo **funciones.wsdl**. Para ello
    necesitaréis la clase **WDSLDocument.php** (que encontraréis por ejemplo en
    esta dirección:<https://github.com/sarcastron/wsdlDocument>); y además
    necesitaréis el código PHP de generación de wsdl que encontrarás en el
    último apartado de los apuntes de la unidad 6.  
    Una vez que ejecutéis el archivo de generación os aparecerá la documentación
    de las funciones públicas del archivo **funciones.php** y para ver el
    archivo **xml** debéis de pulsar botón derecho del ratón y seleccionar “Ver
    código fuente de la página”. Entonces copiáis todo el texto desde que pone
    \<?xml hasta el final y lo pegáis en el archivo **funciones.wsdl.**

-   **Paso 3:** Creáis el archivo **servicio.php** donde declaráis el servicio
    web a partir del archivo **funciones.wsdl**. Recordad usar rutas detectadas
    automáticamente (mediante las variables de \$\_SERVER) y no absolutas, ya
    que la corrección de la tarea se realiza en mi ordenador y la ruta
    seguramente varíe.

-   **Paso 4:** Creáis el archivo **cliente.php** donde solicitáis ser clientes
    del servicio web anteriormente declarado y realizáis los accesos a las
    funciones públicas necesarias.

Todos estos archivos deberán estar recogidos en la raíz de la carpeta con el
formato de nombre **Apellido1\_Apellido2\_Nombre\_DWESx\_Tarea\_Ex** (sin
espacios ni caracteres especiales).

Criterios de corrección:
========================

| La obtención de la nota de la tarea se hará según los siguientes criterios mostrados en la siguiente tabla: |                                                                                                                                                                                                                   |       |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
|-------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| **Puntuación Máxima**                                                                                       | **Criterio**                                                                                                                                                                                                      |       |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
| Sin calificación                                                                                            | Tarea no entregada o en borrador.                                                                                                                                                                                 |       |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
| 0                                                                                                           | La tarea entregada no se corresponde con lo que se pide. La tarea se ha entregado fuera de plazo. La tarea ha sido copiada. **La tarea no se ha resuelto usando servicios web.**                                  |       |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
| 3                                                                                                           | La tarea no se puede ejecutar, se ha modificado la estructura de la base de datos o no sigue el formato especificado. La tarea se realiza usando AJAX, Javascript, etc que se trabajarán en unidades posteriores. |       |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
| 10                                                                                                          | La tarea entregada y que funcione correctamente (que no corresponda a ninguno de los apartados mencionados anteriormente) será corregida según la siguiente valoración:                                           |       |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
| Se valorará con la puntuación señalada la consecución de cada uno de los siguientes ítems:                  |                                                                                                                                                                                                                   |       |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
| Paso 1                                                                                                      | Creación y correcta implementación del fichero funciones.php.                                                                                                                                                     |  0,25 |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
|                                                                                                             | \- accesoBD                                                                                                                                                                                                       | 0,25  |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
|                                                                                                             | \- getForeros                                                                                                                                                                                                     | 0,25  |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
|                                                                                                             | \- getMensajesPublicos                                                                                                                                                                                            | 0,25  |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
|                                                                                                             | \- getParticipacionForeros                                                                                                                                                                                        | 0,25  |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
|                                                                                                             | Documentación Javadoc.                                                                                                                                                                                            | 1     |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
| Paso 2                                                                                                      | Generación del archivo funciones.wsdl.                                                                                                                                                                            | 1,5   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
| Paso 3                                                                                                      | Creación y correcta implementación del fichero servicio.php.                                                                                                                                                      | 0,25  |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
|                                                                                                             | Servicio web a partir del archivo funciones.wsdl                                                                                                                                                                  | 1     |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
|                                                                                                             | Rutas automáticas                                                                                                                                                                                                 | 0,5   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
| Paso 4                                                                                                      | Creación y correcta implemtación del fichero cliente.php llamando al servicio creado anteriormente.                                                                                                               | 1     |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
|                                                                                                             | Visualización correcta de los datos de foreros.                                                                                                                                                                   | 0,25  |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
|                                                                                                             | Visualización correcta de los mensajes públicos.                                                                                                                                                                  | 0,25  |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
|                                                                                                             | Generación y correcta manipulación del formulario de participación.                                                                                                                                               | 0,25  |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
|                                                                                                             | Visualización correcta la participación de un forero en concreto.                                                                                                                                                 | 0,25  |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
|                                                                                                             | Introducir comentarios y estructurar el código adecuadamente.                                                                                                                                                     | 0,25  |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
| General                                                                                                     | Control de errores mediante excepciones.                                                                                                                                                                          | 0,5   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
|                                                                                                             | Estética y organización de la aplicación.                                                                                                                                                                         | 0,75  |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |
|                                                                                                             | Impresión general de la aplicación.                                                                                                                                                                               | 1     |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |

Recursos necesarios:
====================

-   Ordenador con PHP, servidor web Apache y entorno de desarrollo NetBeans,
    correctamente instalado y configurado o Notepad++.

-   Extensión de depuración Xdebug para PHP instalada y funcionando
    con NetBeans.

-   Tener instalado y correctamente configurado el motor de plantillas Smarty.

-   Script de la base de datos:  [Script para la base de
    datos](http://www.juntadeandalucia.es/educacion/gestionafp/datos/tareas/DAW/DWES_14076/2015-16/DAW_DWES_5_2015-16_Individual__757075/banca_electronica.zip) (zip
    - 638 B)  (fichero .zip Tamaño 1 KB)

-   [Manual de php.](http://es1.php.net/manual/es/index.php)

-   Ayuda para el uso de la[ función
    crypt() ](http://php.net/manual/es/function.crypt.php)para la generación de
    hash de contraseñas.

-   Ayuda para el uso de la [función
    password\_verify() ](http://php.net/manual/es/function.password-verify.php)para
    comprobar el hash de una contraseña.

Consejos y recomendaciones:
===========================

Se recomienda ir desarrollando cada una de las partes solicitadas hasta que se
obtenga toda la funcionalidad de la aplicación correctamente, comenzando por la
creación de los ficheros de clases (usuario.php y movimiento.php) y el fichero
index.php con su correspondiente plantila (login.tpl), y continuando con el
resto de funcionalidades.

Se aconseja hacer uso del manual de la página oficial de php y los recursos
indicados en el apartado "Recursos necesarios".

Una vez finalizada la tarea y antes de entregarla es necesario volver a leer el
enunciado y los criterios de corrección y puntuación para comprobar que se ha
realizado todo tal y como se solicita.
