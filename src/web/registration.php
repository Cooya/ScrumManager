<?php
	include 'databaseConnection.php';

	if(empty($_POST['login'])||empty( $_POST['password'])||empty($_POST['name']) || empty($_POST['surname'])||empty($_POST['email'])) {
		echo '<p>An error has occured, please check all the fields </p><p>Click <a href="./signinPage.php">here</a> to go back.</p>';
	}
	else {
		$login = $_POST['login'];
		$password = md5($_POST['password']);
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];

		$data = $db->query("SELECT login FROM user WHERE login = '$login'");
		if($result = $data->fetch()){
			include "signinPage.php";
			echo '<p>This login has already been taken.</p>';
		}
		else {
			$data=$db->query("INSERT INTO user (login, password, name, surname, mail) VALUES ('$login', '$password', '$name', '$surname', '$email')");
			include "loginPage.php";
		}
	}
?>