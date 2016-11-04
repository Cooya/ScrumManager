<?php
	session_start();
	if(!isset($_SESSION['login'])) {
		header('Location: loginPage.php');
	}

	include 'databaseConnection.php';
	$message = "";

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if(!isset($_POST['name']) || !isset($_POST['link'])) {
			$message = '<p style="color:red;">Missing informations.</p>';
		}
		else {
			$sql = 'SELECT id FROM user WHERE login = "' . $_SESSION['login'] . '"'; 
			$data = $db->query($sql)->fetch();

			$sql = 'INSERT INTO project (name, master, creation_date, repository_link) VALUES 
			("' . $_POST['name'] . '", ' . $data['id'] . ', "'. date("Y-m-d H:i:s") .'", "' . $_POST['link'] . '")';

			if($db->query($sql)) 
				$message = '<p style="color:green">The project "' . $_POST['name'] . '" has been created successfully.</p>';
			else
				$message = '<p style="color:red">An error has occurred, please try again.</p>';
		}
	}
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
		<h1>Create a new project</h1>
		<form method="post">
			<label for="name">Name : </label>
			<input type="name" id="name" name="name" /><br>

			<label for="link">Repository link : </label>
			<input type="link" id="link" name="link" /><br><br>

			<input type="submit" id="submit" value="Create">
		</form>
		<br>
		<div><?php echo $message ?></div>
	</body>
</html>