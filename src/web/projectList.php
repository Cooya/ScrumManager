<?php
	include 'databaseConnection.php';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>ScrumManager</title>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="assets/css/navigationBar.css" />
  	</head>
	<body>
		<ul id="horiz_menu">
			<li class="bouton_menu"><a href="loginPage.php"><img src="assets/images/login.png" alt="Login" />Login</a></li>
			<li class="bouton_menu"><a href="signinPage.php"><img src="assets/images/register.png" alt="Sign in" />Sign in</a></li>
			<li class="bouton_menu"><a href="index.html"><img src="assets/images/home.png" alt="home" />Home</a></li>
		</ul>
		<h1>Projects List</h1>

		<?php
			$sql1 = "SELECT id, name, contributors, last_update, creation_date, repository_link FROM project"; 
			$sql2 = "SELECT login FROM user, project WHERE user.id = project.owner"; 

			$result1 = $db->query($sql1);
			$result2 = $db->query($sql2);
			$data2 = $result2->fetch();

			echo '<table  border="1">'; 

			echo '<tr>';
			echo '<td>';
			echo '<b>Name</b>'; 
			echo '</td>';

			echo '<td>';
			echo '<b>Owner</b>'; 
			echo '</td>';

			echo '<td>';
			echo '<b>Last update</b>'; 
			echo '</td>';

			echo '<td>';
			echo '<b>Creation date</b>'; 
			echo '</td>';

			echo '<td>';
			echo '<b>Repository Link</b>'; 
			echo '</td>';
			echo '</tr>';

			while($data1 = $result1->fetch()) {
			    echo '<tr>';
			    echo '<td>';
			    echo '<b>'.$data1['name'].'</b>'; 
			    echo '</td>';
			 
			    echo '<td>';
			    echo '<b>'.$data2['login'].'</b>'; 
			    echo '</td>';

			    echo '<td>';
			    echo '<b>'.$data1['last_update'].'</b>'; 
			    echo '</td>';

			    echo '<td>';
			    echo '<b>'.$data1['creation_date'].'</b>'; 
			    echo '</td>';

			    echo '<td>';
			    echo '<b>'.$data1['repository_link'].'</b>'; 
			    echo '</td>';

			    echo '</tr>';
			} 
			echo '</table>';
			echo '<a href="newProject.html">Create a project</a>';
		?>
	</body>
</html>