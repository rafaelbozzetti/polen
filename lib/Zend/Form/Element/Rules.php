<?php
class Zend_Form_Element_Rules extends Zend_Form_Element_Xhtml {

    public $helper='PlainTextElement';

    public function isValid($value){

        return true;
    }
}
?>