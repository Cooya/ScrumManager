<?php


include 'databaseConnection.php';
		
		
		
			$task = $_POST['taskid'];
			$project= $_POST['project'];
			$description = $_POST['description'];
			$developer = $_POST['developer'];
			$sprint = $_POST['sprint'];
			$status = $_POST['status'];
			$duration = $_POST['duration'];

			$sql = "SELECT id FROM user WHERE login='$developer'";
			$result =$db->query($sql);
			$data=$result->fetch();
			if($data)
				$developerID=$data['id'];

			$sql = "INSERT INTO task (id, projectId, description, developerId, sprint, status, duration) 
			VALUES ('$task', '$project', '$description','$developerID', '$sprint', '$status', '$duration')";
 			$db->query($sql);


?>