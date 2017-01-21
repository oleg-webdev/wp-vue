<?php

namespace AlicelfMaterial\Helpers;

class AmFlash {

	private $__flash = 'am_flash_scope';

	protected $_flashclass;

	protected $_dismissable;

	protected $_message;

	protected $_scope; // front, system

	protected $_timeout;

	public function __construct( $dismissable, $flashclass, $message, $scope, $timeout )
	{
		$this->_flashclass  = $flashclass;
		$this->_dismissable = $dismissable;
		$this->_message     = $message;
		$this->_scope       = $scope;
		$this->_timeout     = $timeout;

		$this->appendFlash();
	}

	protected function appendFlash()
	{
		$_SESSION[ $this->__flash ][] = [
			'flashclass'  => $this->_flashclass,
			'dismissable' => $this->_dismissable,
			'message'     => $this->_message,
			'scope'       => $this->_scope,
			'timeout'     => $this->_timeout,
		];
	}

}