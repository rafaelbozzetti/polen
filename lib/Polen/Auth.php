<?php

class Polen_Auth implements Zend_Auth_Adapter_Interface
{

	protected $_email;
	protected $_senha;

    public function __construct($email, $senha)
	{
		$this->_email = $email;
		$this->_senha = $senha;
	
	}

	public function authenticate()
	{

		$client = new Zend_Http_Client();
		$client->setUri('http://coolmeia.local/services/api/rest/xml/');
		$client->setParameterPost('method', 'auth.gettoken');
		$client->setParameterPost('username', 'rafael');
		$client->setParameterPost('password', 'juazeir0');
		$ans = $client->request('POST');

		echo 'auth:';

		Zend_Debug::dump($ans);


		if($this->_email == '') {
			return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID,$this->_email,1);
		}

		if($this->_senha == '') {
			return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND, $this->_senha,1);
		}

		return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, 1);
	}
}