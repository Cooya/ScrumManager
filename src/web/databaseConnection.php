<?php
	try {
		$db = new PDO('mysql:host=localhost;dbname=Projectmanager;charset=utf8', 'root', 'root');
	}
	catch(Exception $e) {
	   	die('Database connection error : ' . $e->getMessage());
	}
?>