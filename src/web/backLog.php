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
			else if(empty($_POST['specificId']) || empty($_POST['description']) || empty($_POST['sprint']))
				$message = '<p style="color:red">"Id", "Description" & "Sprint" fields are required.</p>';
			else {
				$specificId = $_POST['specificId'];
				$description = $_POST['description'];
				$sprint = $_POST['sprint'];
				$cost = !empty($_POST['cost']) ? $_POST['cost'] : 0;
				$priority = !empty($_POST['priority']) ? $_POST['priority'] : 0;
				$result = $db->query("SELECT specificId FROM us WHERE projectId = '$projectId' AND specificId = '$specificId'"); 
				$data = $result->fetch();
				
				if(($_POST['action'] == 'create' && $specificId != $data['specificId'])) {
					$sql = "INSERT INTO us VALUES(NULL, '$specificId', '$projectId', '$description', '$priority', '$cost', '$sprint')";
					if(!$db->query($sql))
						$message = '<p style="color:red">This US id has already been taken by another US.</p>';
				}
				else if($_POST['action'] == 'modify') {
					$sql = "UPDATE us SET specificId = '$specificId', description = '$description', sprint = '$sprint', cost = '$cost', 
						priority = '$priority' WHERE specificId = '$specificId' AND projectId = '$projectId'";
					if(!$db->query($sql))
						$message = '<p style="color:red">This US id has already been taken by another US.</p>';
				}
				else
					$message = '<p style="color:red">This US id has already been taken by another US.</p>';
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
				$result = $db->query("SELECT * FROM us WHERE projectId = '$projectId' ORDER BY specificId");
				$result2 = $db->query("SELECT * FROM project WHERE id = '$projectId'");
				$data = $result2->fetch();
				echo '<h2>Backlog du projet : ' . $data['name'] . '</h2>';
				echo '
					<table border=1>
					<tr>
						<td><b>Id</b></td><td><b>US</b></td><td><b>Sprint</b></td><td><b>Cost</b></td><td><b>Priority</b></td><td><b>Actions</b></td>
					</tr>
				';
				while($data = $result->fetch(PDO::FETCH_ASSOC)) {
					echo'
						<tr>
							<td>' . $data['specificId'] . '</td>
							<td>' . $data['description'] . '</td>
							<td><a href="sprintDetails.php?projectId=' . $projectId . '&sprint=' . $data['sprint'] . '">' . $data['sprint'] . '</td>
							<td>' . ($data['cost'] != 0 ? $data['cost'] : "") . '</td>
							<td>' . ($data['priority'] != 0 ? $data['priority'] : "") . '</td>
							<td>
							<a onclick="openModifyDialog(' . str_replace("\"", "'", json_encode($data)) . ')">
								<img src="assets/images/update.png" alt="update"/>
							</a>
							<a href="deleteUs.php?specificId=' . $data['specificId'] . '&projectId=' . $projectId . '&sprint=' . $data['sprint'] . 							         '"><img src="assets/images/delete.png" alt="delete"/></a>
							</td>
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
					width: 700,
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
					width: 700,
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
				};
			});
		</script>
	</body>	
	<div id="createDialog" title="Create new US">
		<p class="validateTips">"Id", "Description" & "Sprint" fields are required.</p>
		<form method="POST">
			<fieldset>
				<input type="hidden" type="text" name="action" value="create">

				<label for="id">Id</label>
				<input type="number" name="specificId" id="specificId" class="text ui-widget-content ui-corner-all" required>

				<label for="description">Description</label>
				<textarea name="description" id="description" cols="51" rows="3" required></textarea>

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

				<label for="specificId">Id</label>
				<input type="number" name="specificId" id="specificId" class="text ui-widget-content ui-corner-all" required>

				<label for="description">Description</label>
				<textarea name="description" id="description" cols="51" rows="3" required></textarea>

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