<?php
	try {
		$db = new PDO('mysql:host=localhost;dbname=scrummanager;charset=utf8', 'root', 'root');
	}
	catch(Exception $e) {
	   	die('Database connection error : ' . $e->getMessage());
	}
?>