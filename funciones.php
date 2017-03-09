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
 * Description of Funciones
 *
 * @author felipon
 */
class Funciones {
    /**
     * Clase conexión, que hace conexión a la base de datos
     * 
     * @return \PDO Objeto Conexión
     */
    private function accesoBD(){
        $db_host   = '192.168.0.250';    //  hostname por defecto: localhost/127.0.0.1 - 192.168.0.250 en red
        $db_name   = 'foro3';//  nombre base datos
        $db_user   = 'dwes';             //  usuario
        $user_pw   = 'dwes';             //  contraseña

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
            $con = self::accesoBD();
            $sql = "SELECT login, email FROM foreros";
            $rows = $con->prepare($sql);
            $rows->execute();
            
            return $rows->rowCount() > 0 ? $rows->fetchAll(PDO::FETCH_ASSOC) : false;
             
        } catch (PDOException $e) {
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
            $con = self::accesoBD();
            $sql = "SELECT fecha, contenido FROM mensajes WHERE privado=FALSE";
            $rows = $con->prepare($sql);
            $rows->execute();
            return $rows->rowCount() > 0 ? $rows->fetchAll(PDO::FETCH_ASSOC) : false;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    /**
     * Metodo getParticipacionForeros que recopila la suma de mensajes de tipo
     * privado y públicos que ha realizado un usuario enviado por parametros.
     * En el caso de no existir resultados devolverá un booleano false.
     * 
     * @param  string $login
     * @return array or boolean
     */
    public function getParticipacionForeros($login){
        try {
            $con = self::accesoBD();
            $sql = 'SELECT login FROM foreros WHERE login=:login';
            $rows = $con->prepare($sql);
            $rows->bindParam(":login", $login);
            $rows->execute();
            
            if ($rows->rowCount() > 0) {
                $publicos = self::contadorMensajes($login, FALSE);
                var_dump($publicos);
                $privados = self::contadorMensajes($login, TRUE);
                
                $resultado = array('publicos'=>$publicos['resultado'], 'privados'=>$privados['resultado']);
            } else {
                $resultado = false;
            }
            return $resultado;
        } catch (PDOException $e) {
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
        $con = self::accesoBD();
        $sql = 'SELECT COUNT(*) as resultado FROM mensajes WHERE autor=:login AND privado=:tipo';
        $rows = $con->prepare($sql);
        $rows->bindParam(':login', $login);
        $rows->bindParam(':tipo', $tipo);
        $rows->execute();
        return $rows->fetch();
    }

}
