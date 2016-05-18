<?php

	$host = "localhost";
	$dbname = "daniel_DB";
	$user = "root";
	$pass = "D4N13l!123";

	try{
		$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
   	 echo 'ERROR: ' . $e->getMessage();
	}

?>