<?php
	session_start();

	if(!isset($_SESSION['login'])) {
	  	include('loginPage.php');
	  	exit;
	}
?>

<html>
  	<head>
  		<link rel="stylesheet" href="assets/css/navigationBar.css" />
  		<link rel="stylesheet" href="assets/css/loginSignin.css" />
		<title>ScrumManager</title>
 	</head>
	<body>
		<h1>Login</h1>
		<ul id="horiz_menu">
		  	<li class="bouton_menu"><a href="Logout.php"><img src="assets/images/logout.png" alt="logout" />Logout</a></li>
		  	<li class="bouton_menu"><a href="projectList.php"><img src="assets/images/list.png" alt="projectlist" />Project List</a></li>
		  	<li class="bouton_menu"><a href="newProject.html"><img src="assets/images/newproject.png" alt="newproject" />New Project</a></li>
		</ul>
		<input type="email" name="Developper" placeholder="add new contributor email"><button type="button" class="boutonCont">+</button>
		<input type="email" name="contributor" placeholder="add new contributor email"><button type="button" class="boutonCont">+</button>
		<input type="email" name="contributor" placeholder="add new contributor email"><button type="button" class="boutonCont">+</button>
	</body>
</html>