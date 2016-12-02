<?php
	session_start();
	if(!isset($_SESSION['login']))
		header('Location: login.php');
	include 'databaseConnection.php';
	include 'utilities.php';
	$projectId = $_GET['projectId'];
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>ScrumManager</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	</head>
	<body>
		<?php 
			include 'navBar.php';

			$sql = $db->query("SELECT name FROM project WHERE id = '$projectId'"); 
			$result = $sql->fetch();
			$projectname = $result['name'];

			$sql2 = $db->query("SELECT description FROM documentation WHERE projectId ='$projectId'"); 
			$result2 = $sql2->fetch();
			$documentation = $result2['description'];

			if(isset($_POST['modify'])) {
				$doc=$_POST['doc'];
				$sql3 = "UPDATE documentation SET description = '$doc'WHERE projectId = '$projectId'";
				if ($db->query($sql3)) {
					echo '<p style="color:green">The documentation has been modified successfully .</p>';
						}
				else echo'<p style="color:red">An error has occured when trying to modify this documentation. .</p>';
		
			}	
					
		?>

		<h1> Consult and modify documentation of <?php echo $projectname ?> </h1>

		<form method="post" action="consult&modifDoc.php?<?php echo 'projectId='.$projectId;?>">
			<p>
			<label for="doc">Please put your text below :</label>
				<textarea rows="20" cols="80" type="text" id="doc" name="doc" value="doc"> <?php echo $documentation; ?> </textarea>
				<input type="submit" name ="modify" value="Modify">
			</p>
		</form>
	</body>
</html>