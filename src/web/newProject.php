<?php
	session_start();
	if(!isset($_POST['name']) || !isset($_POST['link'])) {
		echo '<p style="color:red;">Missing informations.</p>';
		exit;
	}

	include 'databaseConnection.php';

	$current_user = $_SESSION['login'];
	$sql = 'SELECT id FROM user WHERE login = "'.$current_user.'"'; 
	$result = $db->query($sql);
	$data = $result->fetch();
	$name = $_POST['name'];
	$link = $_POST['link'];
	$datetime = date("Y-m-d H:i:s");

	$sql = 'INSERT INTO project (name, master, creation_date, repository_link) VALUES 
	("' . $name . '", ' . $data['id'] . ', "'.$datetime.'" ,"' . $link . '")';

	$result = $db->query($sql);
	if($result) 
		echo '<p style="color:green">The project has been created successfully, <a href="./newProjectPage.php">click here </a> to go Back.</p>';
	else
		echo '<p style="color:red">An error has occurred, please <a href="./newProjectPage.php">try again</a>.</p>';
?>
