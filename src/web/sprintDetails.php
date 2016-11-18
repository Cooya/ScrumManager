<?php 
	session_start();
	if(!isset($_SESSION['login'])) {
		header('Location: login.php');
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

	if(empty($_GET['projectId'] || empty($_GET['sprint'])))
		$message = '<p style="color:red">Missing GET parameter(s).</p>';
	else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
		if($_POST['action'] == "create") {
			if(empty($_POST['id']) || empty($_POST['description']))
				$message = '<p style="color: red">"Id" & "Description" fields are required.</p>';
			else {
				if(!empty($_POST['developerUsername']) && !$developer = checkUsername($db, $_POST['developerUsername']))
					$message = '<p style="color: red">Unknown developer username.</p>';
				else {
					$projectId = $_POST['projectId'];
					$sprint = $_POST['sprint'];
					$id = $_POST['id'];
					$description = $_POST['description'];
					$developerId = isset($developer) ? $developer['id'] : 'NULL';
					$status = !empty($_POST['status']) ? $_POST['status'] : 'NULL';
					$duration = !empty($_POST['duration']) ? $_POST['duration'] : 'NULL';

					$sql = "INSERT INTO task (id, projectId, description, developerId, sprint, status, duration) 
					VALUES ($id, $projectId, '$description', $developerId, $sprint, $status, $duration)";
					if(!$db->query($sql))
						$message = '<p style="color:red">Task id already used.</p>';
					else
						$message = '<p style="color:green">The task has been created successfully.</p>';
				}
			}
		}
		else if($_POST['action'] == "modify") {
			if(empty($_POST['id']) || empty($_POST['description']))
				$message = '<p style="color: red">"Id" & "Description" fields are required.</p>';
			else {
				$projectId = $_POST['projectId'];
				$sprint = $_POST['sprint'];
				$id = $_POST['id'];
				$description = $_POST['description'];
				$developerId = isset($developer) ? $developer['id'] : 'NULL';
				$status = !empty($_POST['status']) ? $_POST['status'] : 'NULL';
				$duration = !empty($_POST['duration']) ? $_POST['duration'] : 'NULL';
			}
		}
		else if($_POST['action'] == "delete") {

		}
		else
			$message = '<p style="color: red">Invalid action.</p>';
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
		<h1>Sprint <?php echo $_GET['sprint'] ?> </h1>
		<h2>Kanban</h2>
		<table class="tableau">
			<thead class="header">
				<th class="cell">Task id</th>
				<th class="cell">Description</th>
				<th class="cell">Developer</th>
				<th class="cell">To do</th>
				<th class="cell">On going</th>
				<th class="cell">On testing</th>
				<th class="cell">Done</th>
				<th class="cell">Modify</th>
				<th class="cell">Delete</th>
			</thead>
			<tbody>
				<?php
					$sprint = $_GET['sprint'];
					$projectId = $_GET['projectId'];
					$result = $db->query("SELECT id, description, developerId, status FROM task WHERE projectId = $projectId AND sprint = $sprint");
					while($data = $result->fetch()) {
						echo '
							<tr class="row">
								<td class="cell">' . $data['id'] . '</td>
								<td class="cell">' . $data['description'] . '</td>
								<td class="cell">' . $data['developerId'] . '</td>
								<td class="cell">' . ($data['status'] == 0 ? 'X' : '') . '</td>
								<td class="cell">' . ($data['status'] == 1 ? 'X' : '') . '</td>
								<td class="cell">' . ($data['status'] == 2 ? 'X' : '') . '</td>
								<td class="cell">' . ($data['status'] == 3 ? 'X' : '') . '</td>
								<td><img onclick="" src="assets/images/add.png" 
									style="cursor:pointer" alt="update"/></td>
								<td><img onclick="" 
									src="assets/images/update.png" style="cursor:pointer" alt="update"/></td>
							</tr>
						';
					}
				?>
			</tbody>
		</table>
		<h2>User stories</h2>
		<ul>
			<?php
				$sql = "SELECT id, description FROM us WHERE sprint = $sprint AND projectId = $projectId"; 
				$result = $db->query($sql);
				while($data = $result->fetch())
					echo '<li><b>US#' . $data['id'] . '</b> : '. $data['description'] .' </li>';
			?>
		</ul>
		<h2>Tasks</h2>
		<ul>
			<div id="task" class="body">
				<?php
					$sql = "SELECT * FROM task WHERE sprint = $sprint AND projectId = $projectId ORDER BY id"; 
					$result = $db->query($sql);
					while($data = $result->fetch()) {
						echo '<li> Task '. $data['id'].' : '. $data['description'] .' </li>';
						echo '
							<a onclick="openModifyDialog(' . str_replace("\"", "'", json_encode($data)) . ')"><img src="assets/images/update.png" alt="update"/></a>
							<a href="deleteTask.php?id=' . $data['id']. '"><img src="assets/images/delete.png" alt="delete"/></a>
						';
					}
				?>
			</div>
		</ul>
		<button onclick="createDialog.dialog('open')">Create new task</button>
		<?php echo '<div id="message">' . $message . '</div>'; ?>
		<script>
			$(function() {
				createDialog = $("#createDialog").dialog({
					autoOpen: false,
					height: 600,
					width: 700,
					modal: true,
					buttons: {
						"Create a new task": function() {
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
			});
		</script>
	</body>

	<div id="createDialog" title="Create new task">
		<p class="validateTips">"Id" & "Description" fields are required.</p>
		<form method="POST">
			<fieldset>
				<input type="hidden" name="projectId" value= <?php echo $_GET['projectId']; ?> >
				<input type="hidden" name="sprint" value= <?php echo $_GET['sprint']; ?> >
				<input type="hidden" name="action" value="create">

				<label for="id">Id</label>
				<input type="number" name="id" id="id" class="text ui-widget-content ui-corner-all" required>

				<label for="description">Description</label>
				<input type="text" name="description" id="description" class="text ui-widget-content ui-corner-all" required>

				<label for="developerUsername">Developer username</label>
				<input type="text" name="developerUsername" id="developerUsername" class="text ui-widget-content ui-corner-all">

				<label for="status">Status</label>
				<input type="number" name="status" id="status" class="text ui-widget-content ui-corner-all">

				<label for="duration">Duration</label>
				<input type="number" name="duration" id="duration" class="text ui-widget-content ui-corner-all">

				<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
			</fieldset>
		</form>
	</div>
</html>