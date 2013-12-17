<?php 
ob_start();

/*$db = 'spacexstats';
$user = 'lukealization';
$pass = 'Skyfall007';

// Begin DB connection
	try {		
		// Create new DB Object 
		$dbh = new PDO('mysql:host=mysql.spacexstats.com;dbname='.$db,$user,$pass);	
		// Set the error mode
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
	} catch(PDOException $e) {	
		// Echo any errors. 
		echo $e->getMessage();		
	}*/

require_once 'php/database.class.php';
require_once 'php/mission.class.php';
require_once 'php/func.php';
?>