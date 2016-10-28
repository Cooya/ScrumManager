<?php
session_start();
session_destroy();
echo 'You have been logged out, Click <a href="/ScrumManager/src/web/index.html">here</a> to return to home page';

exit();
?>
