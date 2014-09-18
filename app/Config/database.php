<?php
class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'prefix'     => '',
		'encoding'   => 'utf8',
	);

	public $test = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host'       => 'localhost',
		'login'      => 'root',
		'password'   => 'root',
		'database'   => 'PHPUnit_TestDB',
		'prefix'     => '',
		'encoding'   => 'utf8',
	);

	public $amazon = array();
	public $vriendenagenda = array();

	public function __construct() {
		$this->default = array_merge($this->default, Configure::read('App.database'));
		$this->amazon = array_merge($this->default, Configure::read('App.amazondatabase'));
	}
}