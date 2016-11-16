<?php


include 'databaseConnection.php';
		
	$project = $_POST['project'];
			$description = $_POST['description'];
			$developer = $_POST['developer'];
			$sprint = $_POST['sprint'];
			$status = $_POST['status'];
			$duration = $_POST['duration'];
			$sql = "INSERT INTO task ( projectId, description, developerId, sprint, status, duration) 
			VALUES ('$project', '$description', '$developer', '$sprint', '$status', '$duration')";
 			$db->query($sql);


?>