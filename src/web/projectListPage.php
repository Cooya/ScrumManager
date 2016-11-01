<?php
	session_start();
	if(!isset($_SESSION['login'])) {
		header('Location: loginPage.php');
	}
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
		<?php include 'navBar.php'; ?>
		<h1>Projects List</h1>

		<?php
			$sql1 = "SELECT id, name, last_update, creation_date, repository_link FROM project"; 
			$sql2 = "SELECT login FROM user, project WHERE user.id = project.owner"; 

			$result1 = $db->query($sql1);
			$result2 = $db->query($sql2);
			$data2 = $result2->fetch();

			echo '
				<table  border="1">
					<tr>
						<td><b>Name</b></td><td><b>Owner</b></td><td><b>Last update</b></td><td><b>Creation date</b></td><td><b>Repository Link</b></td>
					</tr>
			';

			while($data1 = $result1->fetch()) {
			    echo '
			    	<tr>
			    		<td><a href="projectIndexPage.php?projectId=' . $data1['id'] . '"><b>' . $data1['name'] . '</b></a></td>
			    		<td><b>' . $data2['login'] . '</b></td>
			    		<td><b>' . $data1['last_update'] . '</b></td>
			    		<td><b>' . $data1['creation_date'] . '</b></td>
			    		<td><b>' . $data1['repository_link'] . '</b></td>
			    	</tr>
			    ';
			} 
			echo '</table>';
		?>
	</body>
</html>