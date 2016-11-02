<?php
	session_start();
	if(isset($_SESSION['login'])) {
		header('Location: index.php');
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
		<h1 align ="center">Registration</h1>
		<form name="SIGNIN" action="registration.php" method="POST">
			<table border="0" align="center" cellspacing="2" cellpadding="2">
				<tr align="center">
					<td><input type="text" name="login" placeholder="login"></td>
				</tr>
				<tr align="center">
					<td><input type="password" name="password" placeholder="password"></td>
				</tr>
				<tr align="center">
					<td><input type="text" name="name" placeholder="name"></td>
				</tr>
				<tr align="center">
					<td><input type="text" name="surname" placeholder="surname"></td>
				</tr>
				<tr align="center">
					<td><input type="email" name="email" placeholder="email"></td>
				</tr>
				<tr align="center">
					<td colspan="2"><input type="submit" id="submit" value="Sign in" class="myButton"></td> 
				</tr>
			</table>
		</form>
		<footer align="center">
			<p>
				By signing up, you agree to the Terms of Service and Privacy Policy, including Cookie Use.<br>
				Others will be able to find you by email or phone number when provided.
			</p>
		</footer>
	</body>
</html>