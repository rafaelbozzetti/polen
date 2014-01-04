<?php

error_reporting(E_ALL|E_STRICT);

defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../app'));

defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../lib'),
    get_include_path(),
)));

require_once 'Zend/Application.php';
require_once "Zend/Translate.php";

$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

// Arquivo de configuração, salva no Zend_Registry
$config = new Zend_Config_Ini( APPLICATION_PATH . '/configs/config.ini');
Zend_Registry::set('config', $config);

//date_default_timezone_set('America/Sao_Paulo');

$application->setAutoloaderNamespaces(array("Polen_"));


// tratamento do instalador
if($config->database_production->hostname == "") {
  echo 'O instalador deve ser chamado';
  exit;
}


$db = Zend_Db::factory('Pdo_Mysql',
            array('host'     => $config->database_production->hostname,
                  'username' => $config->database_production->username,
                  'password' => $config->database_production->password,
                  'dbname'   => $config->database_production->dbname));

Zend_Registry::set("db", $db);
Zend_Db_Table_Abstract::setDefaultAdapter($db);

$application->bootstrap()
            ->run();
