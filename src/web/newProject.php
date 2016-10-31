<?php
	session_start();
	if(!isset($_GET['name']) || !isset($_GET['link'])) {
		echo '<p style="color:red;">Missing informations.</p>';
		exit;
	}

	include 'databaseConnection.php';

	$current_user = $_SESSION['login'];
	$sql = 'SELECT id FROM user WHERE login = "'.$current_user.'"'; 
	$result = $db->query($sql);
	$data = $result->fetch();
	$name = $_GET['name'];
	$link = $_GET['link'];
	$datetime = date("Y-m-d H:i:s");

	$sql = 'INSERT INTO project (name, master, creation_date, repository_link) VALUES 
	("' . $name . '", ' . $data['id'] . ', "'.$datetime.'" ,"' . $link . '")';

	$result = $db->query($sql);
	if($result) 
		echo '<p style="color:green">The project has been created successfully.</p>';
	else
		echo '<p style="color:red">An error has occurred, please <a href="./newProjectPage.php">try again</a>.</p>';
?>