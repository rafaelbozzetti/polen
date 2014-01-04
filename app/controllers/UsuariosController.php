<?php

class UsuariosController extends Zend_Controller_Action
{
    protected $userId;
    
    public function init()
    {
        
    }
    
    public function indexAction()
    {

        if(Zend_Auth::getInstance()->hasIdentity()) {
         //   $this->_redirect('/');
        }


        $form_xml = new Zend_Config_Xml('../app/forms/login.xml');
        $form = new Zend_Form($form_xml);

        $submit = new Zend_Form_Element_Submit('Entrar');
        $submit->setAttrib('class', 'btn btn-warning');
        $form->addElement($submit);

        
        if($this->_request->getPost()) {

            $isValid = $form->isValid($_POST);
            
            if($isValid) {

                $db = Zend_Registry::get('db');

                $usuario = $_POST['email'];
                $hash = $_POST['senha'];


/*
                $authAdapter = new Zend_Auth_Adapter_DbTable($db);
                $authAdapter->setTableName('usuarios');
                $authAdapter->setIdentityColumn('email');
                $authAdapter->setCredentialColumn('senha');

                $authAdapter->setIdentity($usuario);
                $authAdapter->setCredential($hash);
*/
                $polenAuth = new Polen_Auth($usuario, $hash);

                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($polenAuth);

                switch ($result->getCode()) {
                    case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
                    case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
                        $form->getElement('usuario')->addError('E-mail ou Senha inválidos');
                        break;
                    case Zend_Auth_Result::SUCCESS:
                        $auth->getStorage()->write($result->getIdentity());                        
                        $userId = Zend_Auth::getInstance()->getIdentity();
                        $this->_redirect('/');
                        break;
                    default:
                        $form->getElement('usuario')->addError('Falha na autenticação');
                        break;
                }                
                
            }

        }
        
        $this->view->form = $form;
    }
    
    public function logoffAction() {
        if(Zend_Auth::getInstance()->hasIdentity()) {
            Zend_Auth::getInstance()->clearIdentity();
        }
        $this->_redirect("/");
    }   
    
}