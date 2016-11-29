<?php
	session_start();
	if(!isset($_SESSION['login']))
		header('Location: login.php');
	include 'databaseConnection.php';
	include 'utilities.php';
	$message = "";

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST['projectName']) && $_POST['action'] == 'create') { // création d'un projet
			if(!$masterId = getIdByUsername($db, $_SESSION['login']))
				$message = '<p style="color: red">Unknown master username.</p>';
			else if(!empty($_POST['ownerUsername']) && !$ownerId = getIdByUsername($db, $_POST['ownerUsername']))
				$message = '<p style="color: red">Unknown owner username.</p>';
			else {
				if(!empty($_POST['projectName'])) {
					$projectName = $_POST['projectName'];
					$repositoryLink = !empty($_POST['repositoryLink']) ? $_POST['repositoryLink'] : '';
					$creationDate = date("Y-m-d H:i:s");
					$ownerId = isset($ownerId) ? $ownerId : 'NULL';
					$sql = "INSERT INTO project (name, master, creation_date, repository_link, owner) VALUES 
					('$projectName', " . $masterId . ", '$creationDate', '$repositoryLink', $ownerId)";
					if($db->query($sql)) 
						$message = '<p style="color:green">The project "' . $_POST['projectName'] . '" has been created successfully.</p>';
					else
						$message = '<p style="color:red">An error has occurred, please try again.</p>';
				}
				else
					$message = '<p style="color: red">The project name cannot be empty.</p>';
			}
		}
		else if(isset($_POST['projectId'])) { // mise à jour d'un projet existant
			$projectId = $_POST['projectId'];
			if(!isProjectMaster($db, $_SESSION['accountId'], $projectId)) // nécessite d'être le master du projet pour effectuer une modification
				$message = '<p style="color: red">You are not the master of this project.</p>';
			else if(isset($_POST['owner'])) { // modification du propriétaire d'un projet
				if(!$ownerId = getIdByUsername($db, $_POST['owner']))
					$message .= '<p style="color: red">Unknown user.</p>';
				else {
					$sql = "UPDATE project SET owner = $ownerId WHERE id = $projectId";
					if(!$db->query($sql))
						$message = '<p style="color: red">Setting client of the project has failed.</p>';
					else
						$message = '<p style="color: green">The client has been set successfully.</p>';
				}
			}
			else if(isset($_POST['contributor'])) { // ajout d'un contributeur à un projet
				if(!$contributorId = getIdByUsername($db, $_POST['contributor']))
					$message = '<p style="color: red">Unknown user.</p>';
				else {
					$sql = "INSERT INTO contributor (projectId, userId) VALUES ($projectId, $contributorId)";
					if(!$db->query($sql))
						$message = '<p style="color: red">Adding contributor has failed. Maybe it is already a contributor of this project.</p>';
					else
						$message = '<p style="color: green">The contributor has been added successfully.</p>';
				}
			}
			// modification du nom ou du dépôt d'un projet
			else if($_POST['action'] == 'modify' && isset($_POST['projectName']) && isset($_POST['repositoryLink'])) {
				if(!empty($_POST['projectName'])) {
					$sql = "UPDATE project SET name = \"" . $_POST['projectName'] . "\", repository_link = \"" . $_POST['repositoryLink'] . "\" WHERE id = $projectId";
					if(!$db->query($sql))
						$message = '<p style="color: red">Updating project has failed, please try again.</p>';
					else
						$message = '<p style="color: green">The project has been updated successfully.</p>';
				}
				else
					$message = '<p style="color: red">The project name cannot be empty.</p>';
			}
			else if($_POST['action'] == 'delete') { // suppression d'un projet
				$sql = "DELETE FROM project WHERE id = $projectId";
				if(!$db->query($sql))
					$message = '<p style="color:red">An error has occured when trying to delete this project.</p>';
				else
					$message = '<p style="color:green">The project has been deleted successfully.</p>';
			}
			else
				$message = '<p style="color: red">Missing POST parameter(s).</p>';
		}
		else
			$message = '<p style="color: red">Missing POST parameter(s).</p>';
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
		<?php include 'navBar.php'; ?>
		<h1>Projects List</h1>

		<?php
			echo '
				<table border="1">
					<tr>
						<td><b>Name</b></td><td><b>Owner</b></td><td><b>Master</b></td><td><b>Last update</b></td><td><b>Creation date</b></td><td><b>Repository Link</b></td><td><b>Add contributor</b></td><td><b>Set owner</b></td><td><b>Modify</b></td><td><b>Delete</b></td>
					</tr>
			';

			$id = $_SESSION['accountId'];
			$sql = "SELECT project.id AS projectId, project.name AS projectName, project.owner, project.master, user.id AS userId, user.surname, 
			user.name AS userName, project.last_update, project.creation_date, project.repository_link FROM project INNER JOIN user ON 
			(master = $id OR owner = $id) AND (project.master = user.id OR project.owner = user.id)";
			$data = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			$dataSize = count($data);
			$pass = false;
			for($i = 0; $i < $dataSize; $i++) {
				if($i + 1 < $dataSize && $data[$i]['projectName'] == $data[$i + 1]['projectName']) {
					if($data[$i]['userId'] == $data[$i]['master']) {
						$masterSurname = $data[$i]['surname'];
						$masterName = $data[$i]['userName'];
						$ownerSurname = $data[$i + 1]['surname'];
						$ownerName = $data[$i + 1]['userName'];
					}
					else {
						$masterSurname = $data[$i + 1]['surname'];
						$masterName = $data[$i + 1]['userName'];
						$ownerSurname = $data[$i]['surname'];
						$ownerName = $data[$i]['userName'];
					}
					$pass = true;
				}
				else {
					$masterSurname = $data[$i]['surname'];
					$masterName = $data[$i]['userName'];
					if($data[$i]['userId'] == $data[$i]['master']) {
						$ownerSurname = $masterSurname;
						$ownerName = $masterName;
					}
					else {
						$ownerSurname = NULL;
						$ownerName = NULL;
					}
				}

			    echo '
			    	<tr>
			    		<td><a href="backLog.php?projectId=' . $data[$i]['projectId'] . '"><b>' . $data[$i]['projectName'] . '</b></a></td>
			    		<td><b>' . $ownerSurname . ' ' . $ownerName . '</b></td>
			    		<td><b>' . $masterSurname . ' ' . $masterName . '</b></td>
			    		<td><b>' . $data[$i]['last_update'] . '</b></td>
			    		<td><b>' . $data[$i]['creation_date'] . '</b></td>
			    		<td><b><a href="http://' . $data[$i]['repository_link'] . '">' . $data[$i]['repository_link'] . '</a></b></td>	
			    ';
			    if(isProjectMaster($db, $_SESSION['accountId'], $data[$i]['projectId'])) echo '
						<td><img onclick="openContributorDialog(' . $data[$i]['projectId'] . ')" src="assets/images/add.png" 
							style="cursor:pointer" alt="update"/></td>
						<td><img onclick="openOwnerDialog({projectId:' . $data[$i]['projectId'] . ', ownerName:\'' . $ownerName . '\'})" 
							src="assets/images/update.png" style="cursor:pointer" alt="update"/></td>
						<td><img onclick="openModifyProjectDialog({
							projectId:' . $data[$i]['projectId'] . ', 
							projectName: \'' . $data[$i]['projectName'] . '\', 
							repositoryLink: \'' . $data[$i]['repository_link'] . '\'})"
							src="assets/images/update.png" style="cursor:pointer" alt="update"/>
						</td>
						<td><img onclick="openDeleteProjectDialog({projectId:' . $data[$i]['projectId'] . '})" 
							src="assets/images/delete.png" style="cursor:pointer" alt="update"/></td>
			    	</tr>
			    ';

			    if($pass) {
			    	$i++;
			    	$pass = false;
			    }
			} 
			echo '</table><br>';
			echo '<button onclick="newProjectDialog.dialog(\'open\')">Create a new project</button>';
			echo '<div id="message">' . $message . '</div>';
		?>
		<script>
			$(function() {
				newProjectDialog = $("#newProjectDialog").dialog({
					autoOpen: false,
					height: 500,
					width: 400,
					modal: true,
					buttons: {
						"Create": function() {
							newProjectDialog.find("form").submit();
							newProjectDialog.dialog("close");
						},
						Cancel: function() {
				  			newProjectDialog.dialog("close");
						}
					},
					close: function() {

					}
				});

				contributorDialog = $("#contributorDialog").dialog({
					autoOpen: false,
					height: 400,
					width: 400,
					modal: true,
					buttons: {
						"Add": function() {
							contributorDialog.find("form").submit();
							contributorDialog.dialog("close");
						},
						Cancel: function() {
				  			contributorDialog.dialog("close");
						}
					},
					close: function() {

					}
				});

				ownerDialog = $("#ownerDialog").dialog({
					autoOpen: false,
					height: 400,
					width: 400,
					modal: true,
					buttons: {
						"Set": function() {
							ownerDialog.find("form").submit();
							ownerDialog.dialog("close");
						},
						Cancel: function() {
				  			ownerDialog.dialog("close");
						}
					},
					close: function() {

					}
				});

				modifyProjectDialog = $("#modifyProjectDialog").dialog({
					autoOpen: false,
					height: 400,
					width: 400,
					modal: true,
					buttons: {
						"Confirm": function() {
							modifyProjectDialog.find("form").submit();
							modifyProjectDialog.dialog("close");
						},
						Cancel: function() {
							modifyProjectDialog.dialog("close");
						}
					},
					close: function() {

					}
				});

				deleteProjectDialog = $("#deleteProjectDialog").dialog({
					autoOpen: false,
					height: 300,
					width: 300,
					modal: true,
					buttons: {
						"Confirm": function() {
							deleteProjectDialog.find("form").submit();
							deleteProjectDialog.dialog("close");
						},
						Cancel: function() {
							deleteProjectDialog.dialog("close");
						}
					},
					close: function() {

					}
				});

				openContributorDialog = function(projectId) {
					$("#contributorDialog > form > fieldset > input[type='hidden']").val(projectId);
					contributorDialog.dialog('open');
				};

				openOwnerDialog = function(params) {
					$("#ownerDialog > form > fieldset > input[type='hidden']").val(params.projectId);
					if(params.ownerName != '')
						$("#ownerDialog > form > fieldset > input[type='text']").val(params.ownerName);
					ownerDialog.dialog('open');
				};

				openModifyProjectDialog = function(params) {
					$("#modifyProjectDialog > form > fieldset > input").each(function(index, elt) {
						if(elt.name != 'action')
							elt.value = params[elt.name];
					});
					modifyProjectDialog.dialog('open');
				};

				openDeleteProjectDialog = function(params) {
					$("#deleteProjectDialog > form > fieldset > input").each(function(index, elt) {
						if(elt.name != 'action')
							elt.value = params[elt.name];
					});
					deleteProjectDialog.dialog('open');
				};
			});
		</script>
	</body>

	<div id="contributorDialog" title="Add new contributor">
		<p class="validateTips"></p>
		<form method="POST">
			<fieldset>
				<label for="contributor">Contributor username</label>
				<input type="text" name="contributor" id="contributor" class="text ui-widget-content ui-corner-all" required>

				<input type="hidden" name="projectId">
				<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
			</fieldset>
		</form>
	</div>

	<div id="ownerDialog" title="Set owner">
		<p class="validateTips"></p>
		<form method="POST">
			<fieldset>
				<label for="owner">Owner username</label>
				<input type="text" name="owner" id="owner" class="text ui-widget-content ui-corner-all" required>

				<input type="hidden" name="projectId">
				<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
			</fieldset>
		</form>
	</div>

	<div id="newProjectDialog" title="Create new project">
		<p class="validateTips">Field "Project name" is required.</p>
		<form method="POST">
			<fieldset>
				<label for="projectName">Project name</label>
				<input type="text" name="projectName" id="projectName" class="text ui-widget-content ui-corner-all" required>

				<label for="repositoryLink">Repository link</label>
				<input type="link" name="repositoryLink" id="repositoryLink" class="text ui-widget-content ui-corner-all">

				<label for="ownerUsername">Owner username</label>
				<input type="text" name="ownerUsername" id="ownerUsername" class="text ui-widget-content ui-corner-all">

				<input type="hidden" type="text" name="action" value="create">
				<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
			</fieldset>
		</form>
	</div>

	<div id="modifyProjectDialog" title="Modify project">
		<p class="validateTips">Field "Project name" is required.</p>
		<form method="POST">
			<fieldset>
				<label for="projectName">Project name</label>
				<input type="text" name="projectName" id="projectName" class="text ui-widget-content ui-corner-all" required>

				<label for="repositoryLink">Repository link</label>
				<input type="link" name="repositoryLink" id="repositoryLink" class="text ui-widget-content ui-corner-all">

				<input type="hidden" type="text" name="action" value="modify">
				<input type="hidden" name="projectId">
				<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
			</fieldset>
		</form>
	</div>

	<div id="deleteProjectDialog" title="Delete project">
		<p class="validateTips">Delete this project ?</p>
		<form method="POST">
			<fieldset>
				<input type="hidden" type="text" name="action" value="delete">
				<input type="hidden" name="projectId">
				<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
			</fieldset>
		</form>
	</div>
</html>