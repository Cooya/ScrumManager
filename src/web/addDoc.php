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
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	</head>
	<body>
		<?php 

			include 'navBar.php';

			$sql = $db->query("SELECT name FROM project WHERE id = '$projectId'"); 
			$result = $sql->fetch();
			$projectname = $result['name'];

			if(isset($_POST['add'])) {
				$doc=$_POST['doc'];
				$sql2 ="INSERT INTO documentation VALUES (NULL,'$projectId', '$doc')"; 

				if ($db->query($sql2)) {
					echo '<p style="color:green">The documentation has been added successfully .</p>';
						}
				else echo'<p style="color:red">This project has already a documentation you can consult it or modify it in backlog page .</p>';
		
			}	
					
		?>




			
		<H1> Add a new documentation for <?php echo $projectname ?> </H1>

		<FORM method="post" action="addDoc.php?<?php echo 'projectId='.$projectId;?>">
		    <P>
			<LABEL for="doc">Please put your text below :</LABEL>
			      <textarea rows="20" cols="80" type="text" id="doc" name="doc"> </textarea>
			      <INPUT type="submit" name ="add" value="Add">
		    </P>
		 </FORM>


	</body>





</html>
