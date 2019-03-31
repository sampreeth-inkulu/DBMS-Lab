<?php
	session_start();
	unset($_SESSION['email']);
	echo "<center>Successfully logged out.</br>Go to <a href = 'index.php'>Home Page</a></center>"
?>
