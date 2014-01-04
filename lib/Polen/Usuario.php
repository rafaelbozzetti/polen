<?php
/**
 * Projeto Pólen
 *
 * @author Rafael Bozzetti
 */
class Nex_Usuario {

    public static function add($usuario) 
    {
        $db = Zend_Registry::get('db');
        $db->insert('usuarios', $usuario);
        $idUsuario =  $db->lastInsertId();
        
        return $idUsuario;
    }

    public static function auth($usuario)
    {

    }    
}

?>
