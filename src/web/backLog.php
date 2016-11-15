<?php
	session_start();
	if(!isset($_SESSION['login'])) {
		header('Location: login.php');
	}
	include 'databaseConnection.php';
	$message = "";

	if(empty($_GET['projectId']))
		$message = '<p style="color:red">Missing GET parameter.</p>';
	else
		$projectId = $_GET['projectId'];
	
	if(isset($projectId) && $_SERVER["REQUEST_METHOD"] == "POST") {
		if(empty($_POST['id']) || empty($_POST['description']) || empty($_POST['sprint'])) {
			$message = '<p style="color:red">Fields "id", "description" and "sprint" are required.</p>';
		}
		else {
			$id = $_POST['id'];
			$description = $_POST['description'];
			$sprint = $_POST['sprint'];
			$cost = !empty($_POST['cost']) ? $_POST['cost'] : 0;
			$priority = !empty($_POST['priority']) ? $_POST['priority'] : 0;
			$sql = "INSERT INTO us VALUES('$id', '$projectId', '$description', '$priority', '$cost', '$sprint')";
			$result = $db->query($sql);
			if(!$result) {
				$message = '<p style="color:red">This US id has already been taken.</p>';
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
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	</head>
	<body>
		<?php 
			include 'navBar.php';
			if(isset($projectId)) {
				$result = $db->query("SELECT * FROM us WHERE projectId = '$projectId' ORDER BY id");
				$result2 = $db->query("SELECT * FROM project WHERE id = '$projectId'");
				$data = $result2->fetch();
				echo '<h2>Backlog du projet ' . $data['name'] . '</h2>';
				echo '
					<table border=1>
					<tr>
						<td><b>Id</b></td><td><b>US</b></td><td><b>Sprint</b></td><td><b>Cost</b></td><td><b>Priority</b></td><td><b></b></td>
					</tr>
				';
				while($data = $result->fetch()) {
					echo'
						<tr>
							<td>' . $data['id'] . '</td>
							<td>' . $data['description'] . '</td>
							<td>' . $data['sprint'] . '</td>
							<td>' . ($data['cost'] != 0 ? $data['cost'] : "") . '</td>
							<td>' . ($data['priority'] != 0 ? $data['priority'] : "") . '</td>
							<td><button onclick="">Modify</button></td>
						</tr>
					';
				}
				$result->closeCursor();
				echo '</table>';
			}
		?>
		<br>
		<button id="createUS" onclick='dialog.dialog("open")'>Add new US</button>
		<br>
		<div id="message"><?php echo $message ?></div>
		<script>
			$(function() {
				dialog = $("#dialogForm").dialog({
					autoOpen: false,
					height: 570,
					width: 400,
					modal: true,
					buttons: {
						"Create a new US": function() {
							form.submit();
							dialog.dialog("close");
						},
						Cancel: function() {
				  			dialog.dialog("close");
						}
					},
					close: function() {

					}
				});

				form = dialog.find("form").on("submit", function(event) {
					console.log(event);
				});
			});
		</script>
	</body>

	<div id="dialogForm" title="Create new US">
		<p class="validateTips"></p>
		<form method="POST">
			<fieldset>
				<label for="id">Id</label>
				<input type="number" name="id" id="id" class="text ui-widget-content ui-corner-all">

				<label for="description">Description</label>
				<textarea name="description" id="description" cols="44" rows="3"></textarea>

				<label for="Sprint">Sprint</label>
				<input type="number" name="sprint" id="sprint" class="text ui-widget-content ui-corner-all">				

				<label for="Cost">Cost</label>
				<input type="number" name="cost" id="cost" class="text ui-widget-content ui-corner-all">
				
				<label for="Priority">Priority</label>
				<input type="number" name="priority" id="priority" class="text ui-widget-content ui-corner-all">

				<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
			</fieldset>
		</form>
	</div>
</html>