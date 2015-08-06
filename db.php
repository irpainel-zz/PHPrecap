<?php

class DB {

	static public function connect() {
		$dsn = 'mysql:host=localhost;dbname=bbq';
		$username = 'root';
		$password = 'root';
		$options = array(
		    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		); 

		return new PDO($dsn, $username, $password, $options);
	}

}

?>