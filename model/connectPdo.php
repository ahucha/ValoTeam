<?php

class connectPdo 
{
	private static $db; 
	
	private function __construct(){} 
	
	static function getObjPdo() 
	{
		 
		if(!isset(self::$db))
		{ 
			self::$db = new PDO('mysql:Host=127.0.0.1;dbname=valoteam;port:3306', 'root', 'root');
			self::$db ->query('SET NAMES utf8');
			self::$db->query('SET CHARACTER SET utf8');
		} 
		return self::$db;
    }
}

// include 'config.php';

// class ConnectPdo
// {
// 	private static $db;
	
// 	private function __construct(){}
	
// 	static function getObjPdo()
// 	{
// 		if(!isset(self::$db))
// 		{
// 			try {
// 				self::$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
// 				self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 			} catch(PDOException $e) {
// 				die("Erreur de connexion à la base de données : " . $e->getMessage());
// 			}
// 		}
// 		return self::$db;
//     }
// } 
?>
