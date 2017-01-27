<?php

namespace AlicelfMaterial\Helpers;

class AmFlash {

	protected static $__flash = 'am_flash_scope';

	protected $_name;

	protected $_flashclass;

	protected $_dismissable;

	protected $_message;

	protected $_scope = 'system'; // front, system

	protected $_timeout = 5000;

	public function __construct( $name, $dismissable, $flashclass, $message, $timeout = 5000 )
	{
		$this->_name        = $name;
		$this->_flashclass  = $flashclass;
		$this->_dismissable = $dismissable;
		$this->_message     = $message;
		$this->_timeout     = $timeout;

		$this->appendFlash();
	}

	// Return custom session name
	public function flashscope()
	{
		return self::$__flash;
	}

	public static function all( $json = false )
	{
		if ( isset( $_SESSION[ self::$__flash ] ) )
			return $json ? json_encode( $_SESSION[ self::$__flash ] ) : $_SESSION[ self::$__flash ];

		return $json ? "{}" : null;
	}

	public function appendFlash()
	{
		$_SESSION[ self::$__flash ][ $this->_name ] = [
			'flashclass'  => $this->_flashclass,
			'dismissable' => $this->_dismissable,
			'message'     => $this->_message,
			'scope'       => $this->_scope,
			'timeout'     => $this->_timeout,
		];
	}

	public static function dismissFlashes()
	{
		$_SESSION[ self::$__flash ] = null;
	}

}