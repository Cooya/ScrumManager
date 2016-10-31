<?php
	include 'databaseConnection.php';

	if(empty($_POST['login']) || empty($_POST['password'])) {
		echo '<p style="color:red">Missing field(s). <a href="loginPage.php">Get back</a></p>';
	}
	else {
	    $login = $_POST['login']; 
		$password = md5($_POST['password']);
		$result = $db->query("SELECT login, password FROM user WHERE login = '$login' AND password = '$password'");
		if(!$result) {
			echo '<p style="color:red">Invalid login or password.</p>';
		}
		else {
			$data = $result->fetch();
			session_start();
			$_SESSION['login'] = $data['login'];
			echo '
				<p>Hi <b>' . $data['login'] . '</b> ! You are now connected.
				Click <a href="projectListPage.php">here</a> to browse your list of projects.</p>
			';
		}
	}
?>