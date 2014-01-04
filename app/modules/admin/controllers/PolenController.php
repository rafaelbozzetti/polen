<?php

class Admin_PolenController extends Zend_Controller_Action
{
    protected $userId;
    
    public function init()
    {
        
        if(Zend_Auth::getInstance()->hasIdentity()) {
            
        }else{
            $this->_redirect('/');
        }

    }
    
    public function indexAction()
    {

    }   

}