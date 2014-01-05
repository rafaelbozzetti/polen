<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function indexAction()
    {


        $configs = Polen_Config::get();
        $this->view->configs = $configs;

        if($configs){
            foreach($configs as $config) {
                $this->view->{$config['chave']} = $config['value'];
            }            
        }
    
    }
}

