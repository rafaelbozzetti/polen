<?php
/**
 * Polen_Config
 *
 * @author Rafael Bozzetti
 */
class Polen_Config {

    public static function get($key = false) {

        $db = Zend_Registry::get('db');
        $select = $db->select()
                     ->from('registro');

        if($key) {
            $select->where("registro.chave in (?)", array($key));
            $stmt = $db->query($select);
            $configs = $stmt->fetch();
        }else{
            $select->where("registro.chave in (?)", array('logo','titulo','descricao'));
            $stmt = $db->query($select);
            $configs = $stmt->fetchAll();
        }                     

        if($configs) {
            return $configs;
        }else{
            return false;
        }
        
    }

    public static function set($data) {

        $db = Zend_Registry::get('db');

        $db->beginTransaction();

        $insert = $db->insert('registro', $data);

        try {
            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
        }
    }
}