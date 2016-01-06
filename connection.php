<?php
	class Db{
		private static $instance = NULL;
		
		private function __construct(){}
		
		private function __clone(){}
		
		public static function getInstance(){
			if (!isset(self::$instance)){
				//Variables for PDO
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				$dsn = 'mysql:host=localhost; dbname=trunghil; charset=utf8';
				$db_user = 'root';
				$db_pass = '';
				
				//Using PDO
				self::$instance = new PDO($dsn, $db_user, $db_pass, $pdo_options);
				//self::$instance = new PDO('mysql:host=mysql.metropolia.fi;dbname=trunghil', 'trunghil', '123456', $pdo_options);
			}
			return self::$instance;
		}
	}
?>
