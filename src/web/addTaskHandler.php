<?php


include 'databaseConnection.php';
		
		
		
			$task = $_POST['taskid'];
			$description = $_POST['description'];
			//$developer = $_POST['developer'];
			$sprint = $_POST['sprint'];
			$status = $_POST['status'];
			$duration = $_POST['duration'];

			$sqli = "SELECT id FROM user WHERE login = '$developer'";
			//$result = $db->$query($sqli);
			//$data=$result->fetch();

		
			
			$sql = "INSERT INTO task (id, description, sprint, status, duration) 
			VALUES ('$task', '$description', '$sprint', '$status', '$duration')";
 			$db->query($sql);


?>