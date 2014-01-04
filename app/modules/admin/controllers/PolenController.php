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
        $this->_redirect('/admin/polen/configurar');
    }   


    public function configurarAction()
    {
        $configs = Polen_Config::get();
        $this->view->configs = $configs;

        if($configs){
            foreach($configs as $config) {
                $this->view->{$config['chave']} = $config['value'];
            }            
        }

        //Zend_Debug::dump($this->view->configs);
    }       

    public function configurarCriarAction()
    {
        
        $form_xml = new Zend_Config_Xml('../app/modules/admin/forms/iniciativa.xml');
        $form = new Zend_Form($form_xml);

        $submit = new Zend_Form_Element_Submit('Cadastrar');
        $submit->setAttrib('class', 'btn btn-warning');
        $form->addElement($submit);


        if($this->_request->getPost()) {

            $isValid = $form->isValid($_POST);

            if($isValid) {

                // processamento da iamgem
                $adapter = new Zend_File_Transfer_Adapter_Http();
                $fileName = $adapter->getFileName();
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $file = explode("/", $fileName);
                $f = $file[count($file)-1];

                $command = "cp $fileName " . APPLICATION_PATH . '/../public/store/' . $f;
                //shell_exec($command);

                $titulo = array('chave' => 'titulo', 'tipo'=>'txt', 'value'=> $_POST['titulo']);
                $descricao = array('chave' => 'descricao', 'tipo'=>'txt', 'value'=> $_POST['descricao']);

                Polen_Config::set($titulo);
                Polen_Config::set($descricao);

                Zend_Debug::dump($titulo);
                Zend_Debug::dump($descricao);

            }

        }

        $this->view->form = $form;

    }

    public function configurarAlterarAction()
    {
        
        $form_xml = new Zend_Config_Xml('../app/modules/admin/forms/iniciativa.xml');
        $form = new Zend_Form($form_xml);

        $submit = new Zend_Form_Element_Submit('Cadastrar');
        $submit->setAttrib('class', 'btn btn-warning');
        $form->addElement($submit);


                $titulo = Polen_Config::get('titulo');
                $descricao = Polen_Config::get('descricao');

                Zend_Debug::dump($titulo);
                Zend_Debug::dump($descricao);        


        if($this->_request->getPost()) {

            $isValid = $form->isValid($_POST);

            if($isValid) {

                // processamento da iamgem
                $adapter = new Zend_File_Transfer_Adapter_Http();
                $fileName = $adapter->getFileName();
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $file = explode("/", $fileName);
                $f = $file[count($file)-1];

                $command = "cp $fileName " . APPLICATION_PATH . '/../public/store/' . $f;

                $titulo = array('chave' => 'titulo', 'tipo'=>'txt', 'value'=> $_POST['titulo']);
                $descricao = array('chave' => 'descricao', 'tipo'=>'txt', 'value'=> $_POST['descricao']);


            }

        }

        $this->view->form = $form;

    }



    public function modulosAction()
    {

    }


}