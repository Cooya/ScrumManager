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

		<?php include 'navBar.php'; ?>

			<?php
			$reponse = $db->query('SELECT * FROM us WHERE project_Id = '. $_GET['projectId']);
			$reponse2 = $db->query('SELECT * FROM project WHERE id = '. $_GET['projectId']);
			$donnees = $reponse2->fetch() ?>

	<h1>Backlog du projet <?php echo $donnees['name']; ?></h1>


			<?php
					echo '
						<table  border="1">
					<tr>
						<td><b>ID</b></td><td><b>US</b></td><td><b>PRIORITY</b></td><td><b>COST</b></td><td><b>SPRINT</b></td>
					</tr>
						';
					     
					 while ($donnees = $reponse->fetch())
							{
					echo'
					<tr>
						<td><b>'.$donnees['id'].'</b></td>
						<td><b>'.$donnees['description'].'</b></td>
						<td><b>'.$donnees['priority'].'</b></td>
						<td><b>'.$donnees['cost'].'</b></td>
						<td><b>'.$donnees['sprint'].'</b></td>
					</tr>';
					
							}


					$reponse->closeCursor();

				echo '</table>';

			?>

			<FORM method="get" action="addUS.php">
		    <P>

			      <INPUT type="text" placeholder="Id"  id="id" name="id">


			      <INPUT type="text" placeholder="Us" id="us" name="us">


			      <INPUT type="text" placeholder="Priority" id="priority" name="priority">


			      <INPUT type="text" placeholder="Cost" id="cost" name="cost">


			      <INPUT type="text" placeholder="Sprint" id="sprint" name="sprint">


		    <INPUT type="submit" value="ADD"> 
		    </P>
 		</FORM>






		
	</body>
</html>
