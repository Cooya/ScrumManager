<?php
	session_start();
	if(!isset($_SESSION['login']))
		header('Location: login.php');
	include 'utilities.php';
	include 'databaseConnection.php';
$id=$_GET['projectId'];
$data = $db->query("SELECT * FROM updates where projectId='$id'  ");


echo '<ol>';

while($b=$data->fetch()){
	$des=$b['description'];
	$mod=$b['date_update'];

echo "<li>  $des on <b>$mod</b></li>";

}
echo '</ol>';

echo '<a href="projectList.php">Go back to the list here</a>'
?>


   