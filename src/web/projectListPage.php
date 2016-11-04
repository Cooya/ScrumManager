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
  		<link rel="stylesheet" href="assets/css/style.css">
  	</head>
	<body>
		<?php include 'navBar.php'; ?>
		<h1>Projects List</h1>

		<?php
			$sql = 'SELECT id FROM user WHERE login = "' . $_SESSION['login'] . '"';
			$id = $db->query($sql)->fetch()['id'];

			$sql = "SELECT id, name, owner, master, last_update, creation_date, repository_link FROM project WHERE master = $id OR owner = $id";
			$result = $db->query($sql);

			echo '
				<table  border="1">
					<tr>
						<td><b>Name</b></td><td><b>Owner</b></td><td><b>Master</b></td><td><b>Last update</b></td><td><b>Creation date</b></td><td><b>Repository Link</b></td>
					</tr>
			';

			while($data = $result->fetch()) {
			    echo '
			    	<tr>
			    		<td><a href="projectIndexPage.php?projectId=' . $data['id'] . '"><b>' . $data['name'] . '</b></a></td>
			    		<td><b>' . $data['owner'] . '</b></td>
			    		<td><b>' . $data['master'] . '</b></td>
			    		<td><b>' . $data['last_update'] . '</b></td>
			    		<td><b>' . $data['creation_date'] . '</b></td>
			    		<td><b>' . $data['repository_link'] . '</b></td>
			    	</tr>
			    ';
			} 
			echo '</table>';
		?>
	</body>
</html>