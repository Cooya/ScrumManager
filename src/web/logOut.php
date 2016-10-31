<?php
	session_start();
	session_destroy();
	echo 'You have been logged out, click <a href="index.html">here</a> to return to home page.';
?>