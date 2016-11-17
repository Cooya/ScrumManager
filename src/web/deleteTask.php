<?php
	include 'databaseConnection.php';
	$id = $_GET['id'];
	$sql = "DELETE FROM task WHERE id = '$id'";
 	$db->query($sql)
?>