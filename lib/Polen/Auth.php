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
		if($this->_email != 'rafaelbozzetti@gmail.com') {
			return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID,$this->_email,1);
		}

		if($this->_senha != 'sawa') {
			return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND, $this->_senha,1);
		}

		return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, 1);
	}
}