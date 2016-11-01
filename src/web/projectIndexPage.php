<!-- To do : Vérifier si l'utilisateur actuel est bien le master de ce projet. -->

<?php
	session_start();
	if(!isset($_SESSION['login'])) {
		header('Location: loginPage.php');
	}

	include 'databaseConnection.php';
	$message = "";

	function checkUsername($db, $user) {
		$sql = "SELECT id FROM user WHERE login = '$user'";
		try {
			$result = $db->query($sql);
		}
		catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
			return false;
		}
		return $result->fetch();
	}

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if(!isset($_POST['projectId'])) {
			$message = '<p style="color: red">Missing POST parameter.</p>';
		}
		else if(isset($_POST['clientUsername'])) {
			if(!$data = checkUsername($db, $_POST['clientUsername'])) {
				$message .= '<p style="color: red">Unknown user.</p>';
			}
			else {
				$sql = "UPDATE project SET owner = " . $data['id'] . " WHERE id = " . $_POST['projectId'];
				if(!$db->query($sql)) {
					$message .= '<p style="color: red">Setting client of the project has failed.</p>';
				}
				else {
					$message .= '<p style="color: green">The client has been set successfully.</p>';
				}
			}
		}
		else if(isset($_POST['devUsername'])) {
			if(!$data = checkUsername($db, $_POST['devUsername'])) {
				$message .= '<p style="color: red">Unknown user.</p>';
			}
			else {
				$sql = "INSERT INTO contributor (projectId, userId) VALUES (" . $_POST['projectId'] . ", " . $data['id'] . ")";
				if(!$db->query($sql)) {
					$message .= '<p style="color: red">Adding contributor has failed. Maybe it is already a contributor of this project.</p>';
				}
				else {
					$message .= '<p style="color: green">The contributor has been added successfully.</p>';
				}
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
		<?php 
			include 'navBar.php';
			if(!isset($_GET['projectId']))
				echo '<p style="color: red">Missing GET parameter.</p></body></html>';
			else {
				$sql = "SELECT * FROM project WHERE id = " . $_GET['projectId'];
				$data = $db->query($sql)->fetch();
				if(!$data) {
					die('<p style="color: red">Unknown project id.</p></body></html>');
				}
			}
		?>
		<h1>Project <?php echo $data['name']; ?></h1>
		<h3>Set client</h3>
		<form method="POST">
			<input hidden type="number" name="projectId" value=<?php echo $data['id']; ?>>
			<input type="text" name="clientUsername" size=20 placeholder="client username" required><button type="submit" class="boutonCont">Set</button>
		</form>
		<h3>Add new contributor</h3>
		<form method="POST">
			<input hidden type="number" name="projectId" value=<?php echo $data['id']; ?>>
			<input type="text" name="devUsername" size=20 placeholder="contributor username" required><button type="submit" class="boutonCont">Add</button>
		</form>
		<br>
		<div><?php echo $message ?></div>
	</body>
</html>