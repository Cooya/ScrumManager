<?php
	session_start();
	if(isset($_SESSION['login']))
		header('Location: index.php');
	$message = "";

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		include 'databaseConnection.php';
		if(empty($_POST['login']) || empty($_POST['password'])) {
			$message = '<p style="color:red">Missing field(s).</p>';
		}
		else {
		    $login = $_POST['login']; 
			$password = md5($_POST['password']);
			$result = $db->query("SELECT id, surname, name  FROM user WHERE login = '$login' AND password = '$password'");
			$data = $result->fetch();
			if(!$data) {
				$message = '<p style="color:red">Invalid credentials.</p>';
			}
			else {
				$_SESSION['accountId'] = $data['id'];
				$_SESSION['login'] = $login;
				header('Location: projectList.php');
			}
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
		<h1 align ="center">Login</h1>

		<form method="POST">
			<table class="tablelog" align="center" cellspacing="2" cellpadding="2">
				<tr>
					<td class="noborder"> <label for="login">Login</label> <input type="text" id="login" name="login" placeholder="login"></td>
				</tr>
				<tr>
					<td class="noborder"> <label for="password">Password</label> <input type="password" id="password" name="password" placeholder="password"></td>
				</tr>
				<tr>
					<td class="noborder"><input type="submit" value="Log in" id="submit" class="myButton"></td> 
				</tr>
				<tr>
					<td class="noborder"> Or <a href="registration.php">Subscribe here</a></td>
				</tr>
			</table>
		</form>
		<br>
		<div id="message"><?php echo $message ?></div>
		<footer align="center">
			<p>
				By signing up, you agree to the Terms of Service and Privacy Policy, including Cookie Use.<br>
				Others will be able to find you by email or phone number when provided.
			</p>
		</footer>
	</body>
</html>
