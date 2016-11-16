<?php 

	session_start();
	if(!isset($_SESSION['login'])) {
		header('Location: login.php');
	}
	include 'databaseConnection.php';

	

	$projectId = $_GET['projectId'];
	$sprint = $_GET['sprint'];

	$sql = "DELETE FROM us WHERE projectId= '.$projectId.' AND sprint= '.$sprint.'";
	$db->query($sql);




?>
