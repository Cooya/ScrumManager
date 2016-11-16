<!-- To do : Afficher aussi les projets dont l'utilisateur courant est contributeur. -->

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
		<h1>Projects List</h1>

		<?php
			echo '
				<table border="1">
					<tr>
						<td><b>Name</b></td><td><b>Owner</b></td><td><b>Master</b></td><td><b>Last update</b></td><td><b>Creation date</b></td><td><b>Repository Link</b></td><td><b>Contributors & Owner management</b></td>
					</tr>
			';

			$id = $_SESSION['accountId'];
			$sql = "SELECT project.id AS projectId, project.name AS projectName, project.owner, project.master, user.id AS userId, user.surname, 
			user.name AS userName, project.last_update, project.creation_date, project.repository_link FROM project INNER JOIN user ON 
			(master = $id OR owner = $id) AND (project.master = user.id OR project.owner = user.id)";
			$data = $db->query($sql)->fetchAll();
			$dataSize = count($data);
			$pass = false;
			for($i = 0; $i < $dataSize; $i++) {
				if($i + 1 < $dataSize && $data[$i]['projectName'] == $data[$i + 1]['projectName']) {
					if($data[$i]['userId'] == $data[$i]['master']) {
						$masterSurname = $data[$i]['surname'];
						$masterName = $data[$i]['userName'];
						$ownerSurname = $data[$i + 1]['surname'];
						$ownerName = $data[$i + 1]['userName'];
					}
					else {
						$masterSurname = $data[$i + 1]['surname'];
						$masterName = $data[$i + 1]['userName'];
						$ownerSurname = $data[$i]['surname'];
						$ownerName = $data[$i]['userName'];
					}
					$pass = true;
				}
				else {
					$masterSurname = $data[$i]['surname'];
					$masterName = $data[$i]['userName'];
					$ownerSurname = NULL;
					$ownerName = NULL;
				}

			    echo '
			    	<tr>
			    		<td><a href="backlog.php?projectId=' . $data[$i]['projectId'] . '"><b>' . $data[$i]['projectName'] . '</b></a></td>
			    		<td><b>' . $ownerSurname . ' ' . $ownerName . '</b></td>
			    		<td><b>' . $masterSurname . ' ' . $masterName . '</b></td>
			    		<td><b>' . $data[$i]['last_update'] . '</b></td>
			    		<td><b>' . $data[$i]['creation_date'] . '</b></td>
			    		<td><b><a href="http://' . $data[$i]['repository_link'] . '">' . $data[$i]['repository_link'] . '</a></b></td>
			    		<td><b><a href="projectIndex.php?projectId=' . $data[$i]['projectId'] . '">Edit</a></b></td>

			    	</tr>
			    ';

			    if($pass) {
			    	$i++;
			    	$pass = false;
			    }
			} 
			echo '</table>';
		?>
	</body>
</html>