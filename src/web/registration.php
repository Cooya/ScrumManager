<?php
	include 'databaseConnection.php';

	if(empty($_POST['login']) || empty( $_POST['password']) || empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['email'])) {
		echo '<p style="color: red">Missing fields for creating an account. Click <a href="registrationPage.php">here</a> to go back.</p>';
	}
	else {
		$login = $_POST['login'];
		$password = md5($_POST['password']);
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];

		$result = $db->query("SELECT login FROM user WHERE login = '$login'");
		if($result->fetch()) {
			echo '<p style="color: red">This login has already been taken. Click <a href="registrationPage.php">here</a> to go back.</p>';
		}
		else {
			$result = $db->query("INSERT INTO user (login, password, name, surname, mail) VALUES ('$login', '$password', '$name', '$surname', '$email')");
			if(!$result) {
				echo '<p style="color: red">An error has occurred during the request. Please <a href="registrationPage.php">try again</a>.</p>';
			}
			else {
				$_SESSION['login'] = $data['login'];
				echo '
					<p style="color: green">Account created successfully. 
					Welcome <b>' . $login . '</b> ! <a href="./newProjectPage.php">Create a project now</a>.</p>
				';
			}
		}
	}
?>