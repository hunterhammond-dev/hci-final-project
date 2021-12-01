<?php
	define('DB_SERVER', 'af-db.cgdl9talsrzb.us-east-2.rds.amazonaws.com:3306');
	define('DB_USERNAME', 'af_writer');
	define('DB_PASSWORD', 'QM43+TEc@->CK6Z*WHS2');
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