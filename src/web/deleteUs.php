<?php 

	session_start();
	if(!isset($_SESSION['login'])) {
		header('Location: login.php');
	}
	include 'databaseConnection.php';

?>



<!DOCTYPE html>
<html lang="en">
	<head>
		<title>ScrumManager</title>
		<meta charset="utf-8">
    		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="assets/css/style.css">
  	</head>
<body>



<?php

	include 'navBar.php';

	$projectId = $_GET['projectId'];
	$sprint = $_GET['sprint'];
	$specific_Id = $_GET['specific_Id'];

        $resultcond = $db->query('DELETE FROM us WHERE projectId="'.$projectId.'" AND sprint="'.$sprint.'" AND specific_Id="'.$specific_Id.'"');
	
	$resultcond->execute();

        echo '<p style="color:green;">The us has been successfully deleted click <a href=./backLog.php?projectId='.$projectId.'>here</a> to go back to the backlog.</p>'; 	

?>




</body>
</html>
