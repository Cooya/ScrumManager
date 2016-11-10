<?php
	@session_start();
	if(isset($_SESSION['login'])) {
		echo '
			<ul id="horiz_menu">
				<li class="bouton_menu"><a href="logout.php"><img src="assets/images/logout.png" alt="logout" />Logout</a></li>
				<li class="bouton_menu"><a href="projectList.php"><img src="assets/images/list.png" alt="projectlist" />Project List</a></li>
				<li class="bouton_menu"><a href="newProject.php"><img src="assets/images/newproject.png" alt="newproject" />New Project</a></li>
				<li class="bouton_menu"><a href="index.php"><img src="assets/images/home.png" alt="home" />Home</a></li>
			</ul>
		';
	}
	else {
		echo '
			<ul id="horiz_menu">
				<li class="bouton_menu"><a href="login.php"><img src="assets/images/login.png" alt="Login" />Login</a></li>
				<li class="bouton_menu"><a href="registration.php"><img src="assets/images/register.png" alt="Sign in" />Sign in</a></li>
				<li class="bouton_menu"><a href="index.php"><img src="assets/images/home.png" alt="home" />Home</a></li>
			</ul>
		';
	}
?>
