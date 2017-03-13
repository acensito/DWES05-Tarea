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
 * Clase Funciones. Recopila todas las funciones del servicio web.
 *
 * @author Felipe Rodriguez Gutiérrez
 */
class Funciones {
    /**
     * Clase conexión, que hace conexión a la base de datos
     * 
     * @return \PDO Objeto Conexión
     */
    private function accesoBD(){
        $db_host   = 'localhost';     //  hostname por defecto: localhost/127.0.0.1 - 192.168.0.250 en red
        $db_name   = 'foro3';         //  nombre base datos
        $db_user   = 'dwes';          //  usuario
        $user_pw   = 'dwes';          //  contraseña

        try {
            $con = new PDO('mysql:host='.$db_host.'; dbname='.$db_name, $db_user, $user_pw);
            $con->exec("set names utf8");
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    /**
     * Clase getForeros que devuelve un array con el listado de logins y mails
     * y en el caso de no existir, el booleano false.
     * 
     * @return array or boolean
     */
    public function getForeros(){
        try {
            //Creamos la conexion
            $con = self::accesoBD();
            //Creamos la sentencia SQL (todos los login y email de la tabla foreros)
            $sql = "SELECT login, email FROM foreros";
            //Preparamos la consulta
            $rows = $con->prepare($sql);
            //Ejecutamos la consulta
            $rows->execute();
            //En el caso de tener resultados se devuelven en un array, caso contrario
            //se devuelve el booleano False.
            return $rows->rowCount() > 0 ? $rows->fetchAll(PDO::FETCH_ASSOC) : false;
        } catch (PDOException $e) {
            //Capturamos los mensajes de error y paramos.
            die($e->getMessage());
        }
    }
    
    /**
     * Metodo getMensajesPublicos que recopila y devuelve un array de mensajes de
     * tipo publico y sus fechas de publicación. En el caso de no existir resultados
     * devolverá un booleano false.
     * 
     * @return array or boolean
     */
    public function getMensajesPublicos(){
        try {
            //Creamos la conexión
            $con = self::accesoBD();
            //Creamos la sentencia SQL (fecha y contenido de los mensajes que no sean privados)
            $sql = "SELECT fecha, contenido FROM mensajes WHERE privado=FALSE";
            //Preparamos la consulta
            $rows = $con->prepare($sql);
            //Ejecutamos la consulta
            $rows->execute();
            //En el caso de tener resultados se devuelven en un array, caso contrario
            //se devuelve el booleano False.
            return $rows->rowCount() > 0 ? $rows->fetchAll(PDO::FETCH_ASSOC) : false;
        } catch (PDOException $e) {
            //Capturamos los mensajes de error y paramos
            die($e->getMessage());
        }
    }
    
    /**
     * Metodo getParticipacionForeros que recopila la suma de mensajes de tipo
     * privado y públicos que ha realizado un usuario enviado por parametros.
     * En el caso de no existir el usuario devolverá un booleano false.
     * 
     * @param  string $login
     * @return array or boolean
     */
    public function getParticipacionForeros($login){
        try {
            //Creamos la conexion
            $con = self::accesoBD();
            //Creamos la sentencia SQL (selecciona login indicado de la tabla foreros)
            $sql = 'SELECT login FROM foreros WHERE login=:login';
            //Preparamos la consulta
            $rows = $con->prepare($sql);
            //Pasamos los parametros de la consulta
            $rows->bindParam(":login", $login);
            //Ejecutamos la consulta
            $rows->execute();
            
            //Si existe el usuario que se ha pasado
            if ($rows->rowCount() > 0) {
                //Llamamos a la funcion contadorMensajes para ver cuantos mensajes
                //publicos posee
                $publicos = self::contadorMensajes($login, FALSE);
                //Llamamos a la funcion contadorMensajes para ver cuantos mensajes
                //privados posee
                $privados = self::contadorMensajes($login, TRUE);
                //Dichos resultados los introducimos en un array asociativo 
                $resultado = array('publicos'=>$publicos['resultado'], 'privados'=>$privados['resultado']);
            //En el caso de no existir el usuario, el resultado sera el booleano false
            } else {
                $resultado = false;
            }
            //Devolvemos el resultado correspondiente
            return $resultado;
        } catch (PDOException $e) {
            //Capturamos los mensajes de error y paramos
            die($e->getMessage());
        }
    }
    
    /**
     * Método contadorMensajes que devuelve la cantidad de mensajes de un tipo
     * especificado de un usuario especificado
     * 
     * @param string $login
     * @param boolean $tipo publico/false ó privado/true
     * 
     * @return string con el numero de mensajes.
     */
    private static function contadorMensajes($login, $tipo){
        //Creamos la conexion
        $con = self::accesoBD();
        //Creamos la sentencia SQL (Contar el campo mensajes como resultado del usuario X y de tipo Y)
        $sql = 'SELECT COUNT(*) as resultado FROM mensajes WHERE autor=:login AND privado=:tipo';
        //Preparamos la consulta
        $rows = $con->prepare($sql);
        //Pasamos los parametros de la consulta
        $rows->bindParam(':login', $login);
        $rows->bindParam(':tipo', $tipo);
        //Ejecutamos la consulta
        $rows->execute();
        //Devolvemos los resultados obtenidos
        return $rows->fetch();
    }

}
