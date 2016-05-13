<?php

	$host = "localhost";
	$dbname = "daniel_DB";
	$user = "root";
	$pass = "Passw0rd!";

	try{
		$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
   	 echo 'ERROR: ' . $e->getMessage();
	}

?>