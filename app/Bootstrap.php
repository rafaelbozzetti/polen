<?php

require_once '../app/model/AclPlugin.php';

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
        protected function _initAcl() {

        $acl = new Zend_Acl();

        // Main roles
        $acl->addRole(new Zend_Acl_Role('all')); // Everyone
        $acl->addRole(new Zend_Acl_Role('users'),'all'); // Users
        $acl->addRole(new Zend_Acl_Role('guest'),'all'); // Non authenticated users

        // Dynamic roles
        $auth = Zend_Auth::getInstance();
        if($auth->hasIdentity()) {
            // Already authenticated user
            $acl->addRole(new Zend_Acl_Role($auth->getIdentity()),'users');
        }

        // System resources
        $acl->add(new Zend_Acl_Resource('usuarios'));
        $acl->add(new Zend_Acl_Resource('error'));
        $acl->add(new Zend_Acl_Resource('index'));
        $acl->add(new Zend_Acl_Resource('admin'));
        $acl->add(new Zend_Acl_Resource('auth'));
        $acl->add(new Zend_Acl_Resource('installer'));
        $acl->add(new Zend_Acl_Resource('unknown'));

        // Default permissions
        $acl->deny('all');
        $acl->allow('users');

        $acl->allow(null,'usuarios');
        $acl->allow(null,'error');
        $acl->allow(null,'installer');

        $this->acl = $acl;

        $front = Zend_Controller_Front::getInstance();

        // Defining Role
        $auth = Zend_Auth::getInstance();
        if($auth->hasIdentity()) {
            $role = $auth->getIdentity();
        }
        else {
            $role = 'guest';
        }

        $front->registerPlugin(new AclPlugin($this->acl, $role));

		}
}
