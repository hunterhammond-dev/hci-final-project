<?php
	define('DB_SERVER', 'localhost:3306');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'Configure32');
	define('DB_DATABASE', 'af_db');
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	
	#PDO
	$host       = DB_SERVER;
	$username   = DB_USERNAME;
	$password   = DB_PASSWORD;
	$dbname     = DB_DATABASE;
	$dsn        = "mysql:host=$host;dbname=$dbname";
	$options    = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);
?>