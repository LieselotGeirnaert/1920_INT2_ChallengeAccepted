<?php

class DAO {

	// Properties
	// private static $dbHost = "mysql";
	// private static $dbName = "kampioenen";
	// private static $dbUser = "root";
	// private static $dbPass = "devine4life";

	private static $sharedPDO;
	protected $pdo; 

  // Constructor
	function __construct() {

		if(empty(self::$sharedPDO)) {
			$dbHost = getenv('PHP_DB_HOST');
			$dbName = getenv('PHP_DB_DATABASE');
			$dbUser = getenv('PHP_DB_USERNAME');
			$dbPass = getenv('PHP_DB_PASSWORD');


			// self::$sharedPDO = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUser, self::$dbPass);
      self::$sharedPDO = new PDO("mysql:host=" . $dbHost . ";dbname=" . $dbName, $dbUser, $dbPass);
			self::$sharedPDO->exec("SET CHARACTER SET utf8");
			self::$sharedPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			self::$sharedPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		}

		$this->pdo =& self::$sharedPDO;

	}

  // Methods

}
