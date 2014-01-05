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
        $submit->setAttrib('class', 'btn btn-success');
        $form->addElement($submit);


        if($this->_request->getPost()) {

            $isValid = $form->isValid($_POST);

            if($isValid) {

                $path = APPLICATION_PATH . '/../public/store/';

                $adapter = new Zend_File_Transfer_Adapter_Http();
                $adapter->setDestination($path);

                $f = $adapter->getFileName();
                $file = explode("/", $f);
                $file_name = $file[count($file)-1];

                $imagem = array('chave' => 'logo', 'tipo'=>'img', 'value'=> $file_name);
                $titulo = array('chave' => 'titulo', 'tipo'=>'txt', 'value'=> $_POST['titulo']);
                $descricao = array('chave' => 'descricao', 'tipo'=>'txt', 'value'=> $_POST['descricao']);

                Polen_Config::set($imagem);
                Polen_Config::set($titulo);
                Polen_Config::set($descricao);

                $this->_redirect('/admin/polen/configurar');

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

        $form->getElement('imagem')->setRequired(false);

        $titulo = Polen_Config::get('titulo');
        $descricao = Polen_Config::get('descricao');
        $this->view->logo = Polen_Config::get('logo');

        $form->getElement('titulo')->setValue($titulo['value']);
        $form->getElement('descricao')->setValue($descricao['value']);

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