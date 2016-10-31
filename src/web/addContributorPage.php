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
		<link rel="stylesheet" href="assets/css/navigationBar.css" />
	</head>
	<body>
		<?php include 'navBar.php'; ?>
		<h1>Add new contributors</h1>
		<input type="email" name="Developper" placeholder="add new contributor email"><button type="button" class="boutonCont">+</button>
		<input type="email" name="contributor" placeholder="add new contributor email"><button type="button" class="boutonCont">+</button>
		<input type="email" name="contributor" placeholder="add new contributor email"><button type="button" class="boutonCont">+</button>
	</body>
</html>