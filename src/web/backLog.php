<?php
	session_start();
	if(!isset($_SESSION['login'])) {
		header('Location: login.php');
	}
	include 'databaseConnection.php';
	$message = "";

	if(empty($_GET['projectId']))
		$message = '<p style="color:red">Missing GET parameter.</p>';
	else {
		$projectId = $_GET['projectId'];
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			if(empty($_POST['action']))
				$message = '<p style="color:red">Missing POST parameter.</p>';
			else if(empty($_POST['id']) || empty($_POST['description']) || empty($_POST['sprint']))
				$message = '<p style="color:red">"Id", "Description" & "Sprint" fields are required.</p>';
			else {
				$id = $_POST['id'];
				$description = $_POST['description'];
				$sprint = $_POST['sprint'];
				$cost = !empty($_POST['cost']) ? $_POST['cost'] : 0;
				$priority = !empty($_POST['priority']) ? $_POST['priority'] : 0;
				if($_POST['action'] == 'create') {
					$sql = "INSERT INTO us VALUES('$id', '$projectId', '$description', '$priority', '$cost', '$sprint')";
					$result = $db->query($sql);
					if(!$result)
						$message = '<p style="color:red">This US id has already been taken by another US.</p>';
				}
				else if($_POST['action'] == 'modify') {
					$sql = "UPDATE us SET id = '$id', description = '$description', sprint = '$sprint', cost = '$cost', priority = '$priority' 
						WHERE id = '$id'";
					$result = $db->query($sql);
					if(!$result)
						$message = '<p style="color:red">This US id has already been taken by another US.</p>';
				}
				else
					$message = '<p style="color:red">Invalid POST parameter.</p>';
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
				while($data = $result->fetch(PDO::FETCH_ASSOC)) {
					echo'
						<tr>
							<td>' . $data['id'] . '</td>
							<td>' . $data['description'] . '</td>
							<td>' . $data['sprint'] . '</td>
							<td>' . ($data['cost'] != 0 ? $data['cost'] : "") . '</td>
							<td>' . ($data['priority'] != 0 ? $data['priority'] : "") . '</td>
							<td><button onclick="openModifyDialog(' . str_replace("\"", "'", json_encode($data)) . ')">Modify</button></td>
						</tr>
					';
				}
				$result->closeCursor();
				echo '</table>';
			}
		?>
		<br>
		<button id="createUS" onclick="createDialog.dialog('open')">Add new US</button>
		<br>
		<div id="message"><?php echo $message ?></div>
		<script>
			$(function() {
				createDialog = $("#createDialog").dialog({
					autoOpen: false,
					height: 570,
					width: 400,
					modal: true,
					buttons: {
						"Create a new US": function() {
							createDialog.find("form").submit();
							createDialog.dialog("close");
						},
						Cancel: function() {
				  			createDialog.dialog("close");
						}
					},
					close: function() {

					}
				});

				modifyDialog = $("#modifyDialog").dialog({
					autoOpen: false,
					height: 600,
					width: 400,
					modal: true,
					buttons: {
						"Modify US": function() {
							modifyDialog.find("form").submit();
							modifyDialog.dialog("close");
						},
						Cancel: function() {
				  			modifyDialog.dialog("close");
						}
					},
					close: function() {

					}
				});

				openModifyDialog = function(usObj) {
					$("#modifyDialog > form > fieldset > input, textarea").each(function(index, elt) {
						if(elt.name != 'action')
							elt.value = usObj[elt.name];
					});
					modifyDialog.dialog('open');
				}
			});
		</script>
	</body>

	<div id="createDialog" title="Create new US">
		<p class="validateTips">"Id", "Description" & "Sprint" fields are required.</p>
		<form method="POST">
			<fieldset>
				<input type="hidden" type="text" name="action" value="create">

				<label for="id">Id</label>
				<input type="number" name="id" id="id" class="text ui-widget-content ui-corner-all" required>

				<label for="description">Description</label>
				<textarea name="description" id="description" cols="44" rows="3" required></textarea>

				<label for="sprint">Sprint</label>
				<input type="number" name="sprint" id="sprint" class="text ui-widget-content ui-corner-all" required>				

				<label for="cost">Cost</label>
				<input type="number" name="cost" id="cost" class="text ui-widget-content ui-corner-all">
				
				<label for="priority">Priority</label>
				<input type="number" name="priority" id="priority" class="text ui-widget-content ui-corner-all">

				<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
			</fieldset>
		</form>
	</div>

	<div id="modifyDialog" title="Modify US">
		<p class="validateTips">"Id", "Description" & "Sprint" fields are required.</p>
		<form method="POST">
			<fieldset>
				<input type="hidden" type="text" name="action" value="modify">

				<label for="id">Id</label>
				<input type="number" name="id" id="id" class="text ui-widget-content ui-corner-all" required>

				<label for="description">Description</label>
				<textarea name="description" id="description" cols="44" rows="3" required></textarea>

				<label for="Sprint">Sprint</label>
				<input type="number" name="sprint" id="sprint" class="text ui-widget-content ui-corner-all" required>				

				<label for="Cost">Cost</label>
				<input type="number" name="cost" id="cost" class="text ui-widget-content ui-corner-all">
				
				<label for="Priority">Priority</label>
				<input type="number" name="priority" id="priority" class="text ui-widget-content ui-corner-all">

				<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
			</fieldset>
		</form>
	</div>
</html>