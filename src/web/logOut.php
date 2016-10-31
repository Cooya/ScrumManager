<?php
	session_start();
	session_destroy();
	echo 'You have been logged out, click <a href="index.php">here</a> to return to home page.';
?>