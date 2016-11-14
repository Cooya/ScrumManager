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

$id=$_GET['id'];
$us=$_GET['us'];
$priority=$_GET['priority'];
$cost=$_GET['cost'];
$sprint=$_GET['sprint'];
$project_id= $_GET['project_id']; 

$condition = $db->query('SELECT DISTINCT id FROM us WHERE project_Id = "'.$project_id.'" AND id="'.$id.'"');
$donnees = $condition->fetch();


	if( empty($id) or empty($us) or empty($priority) or empty($cost) or empty($sprint)){


		echo '<p style="color:red;">Some fields are empty please click <a href=./backLog.php?projectId='.$project_id.'>here</a> to resume </p>';

		 	}elseif ($id != $donnees['id']){

					$sql = $db->prepare('INSERT INTO us VALUES("'.$id.'","'.$project_id.'","'.$us.'","'.$priority.'","'.$cost.'","'.$sprint.'")'); 
					$sql->execute();
					echo '<p style="color:green;">The US has been successfully added to your Backlog please click <a href=./backLog.php?projectId='.$project_id.'>here</a> to back </p>';

							}

				else{

					echo '<p style="color:red;">The US ID has already been taken please click <a href=./backLog.php?projectId='.$project_id.'>here</a> to resume </p>';
			        	}		
?>
		
</body>
</html>
