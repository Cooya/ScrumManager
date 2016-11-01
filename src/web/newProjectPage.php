<?php
	session_start();
	if(!isset($_SESSION['login'])) {
		header('Location: loginPage.php');
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
		<form method="post" action="newProject.php">
			<label for="name">Name : </label>
			<input type="name" id="name" name="name" /><br>

			<label for="link">Repository link : </label>
			<input type="link" id="link" name="link" /><br><br>

			<input type="submit" value="Create">
		</form>
	</body>
</html>