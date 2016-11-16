<?php 
	session_start();
	if(!isset($_SESSION['login'])) {
		header('Location: login.php');
	}
	include 'databaseConnection.php';
	$message = "";

	if(empty($_GET['projectId'] || empty($_GET['sprint'])))
		$message = '<p style="color:red">Missing GET parameter(s).</p>';
	else if(empty($_POST['id']) || empty($_POST['description']) || empty($_POST['sprint']))
		$message = '<p style="color: red">"Id", "Description" & "Sprint" fields are required.</p>';
	else {
		$id = $_POST['id'];
		$projectId = $_POST['projectId'];
		$description = $_POST['description'];
		$developer = $_POST['developer'];
		$sprint = $_POST['sprint'];
		$status = $_POST['status'];
		$duration = $_POST['duration'];

		$sql = "SELECT id FROM user WHERE login = '$developer'";
		$data = $db->$query($sql)->fetch;
		if(!$data)
			$message = '<p style="color:red">Unknown developer username.</p>';
		else {
			$sql = "INSERT INTO task (id, projectId, description, developerId, sprint, status, duration) 
			VALUES ('$project', '$description', '$developer', '$sprint', '$status', '$duration')";
			if(!$db->query($sql))
				$message = '<p style="color:red">Task id already used.</p>';
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
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	</head>
	<body>
		<?php include 'navBar.php'; ?>
		<section class="tableau">
			<div class="colgroupe">
				<div class="col"></div>
				<div class="col"></div>
			</div>
			<div class="legende">Kanban Sprint</div>
			<header class="tete">
				<div class="cellule">Task id</div>
				<div class="cellule">Developer</div>
				<div class="cellule">To do</div>
				<div class="cellule">On going</div>
				<div class="cellule">On testing</div>
				<div class="cellule">Done</div>
			</header>
			<div class="corp">
				<?php
					if(isset($projectId) && isset($sprint)) {
						$sql = "SELECT id, developerId, status FROM task WHERE projectId = '$projectId' AND sprint = '$sprint'"; 
						$result = $db->query($sql);
						while($data = $result->fetch()) {
							$a='';
							$b='';
							$c='';
							$d='';
							if($data['status']==0)
								$a='X';
							if($data['status']==1)
								$b='X';
							if($data['status']==2)
								$c='X';
							if($data['status']==3)
								$d='X';

							echo '
								<div class="ligne">
									<div class="cellule" ><p onclick="myFunction();this.onclick=null;" id="tmp">' . $data['id'] . '</p></div>
									<div class="cellule">' . $data['developerId'] . '</div>
									<div class="cellule">' . $a . '</div>
									<div class="cellule">' . $b . '</div>
									<div class="cellule">' . $c . '</div>
									<div class="cellule">' . $d . '</div>
								</div>
								<script>
									function myFunction() {
										document.getElementById("tmp").innerHTML ="<input type=\"text\" >";
									}
								</script>
							';
						}
					}
				?>
			</div>
		</section>
		<h2>User stories</h2>
		<ul>
			<?php
				$sql = "SELECT id, description FROM us"; 
				$result = $db->query($sql);
				while($data = $result->fetch())
					echo '<li> UserStorie '. $data['id'] . ' : '. $data['description'] .' </li>';
			?>
		</ul>
		<h2>Tasks</h2>
		<ul>
			<div id="task" class="corp">
				<?php
					$sql = "SELECT id, description FROM task"; 
					$result = $db->query($sql);
					include 'addTask.php';
					while($data = $result->fetch()) {
						echo '<li> Task '. $data['id'].' : '. $data['description'] .' </li>';
						echo '
							<a href="registration.php"><img src="assets/images/update.png"/></a>
							<a href="index.php"><img src="assets/images/delete.png" /></a>
						';
					}
				?>
			</div>
		</ul>
	</body>
</html>