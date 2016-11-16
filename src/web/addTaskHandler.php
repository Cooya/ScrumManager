<?php


include 'databaseConnection.php';
		/*$message='';
		if(empty($_POST['project']) || empty( $_POST['description']) || empty($_POST['developer']) || empty($_POST['sprint']) || empty($_POST['status'])|| empty($_POST['duration'])) {
		
		else {*/
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