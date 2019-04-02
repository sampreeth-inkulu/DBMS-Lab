<html>
<head>
	<title>
		celeb home
	</title>
	<link rel="stylesheet" type="text/css" media="screen" href="style.css">
</head>

<body>
	</br>
	<form name = "logoutForm" action = "logout.php" method = "POST" align = "right">
		<button type = "submit" name = "Logout">Logout</button>
	</form>
	
<?php
	session_start();
	if(! isset($_SESSION['email'])) {
		header("Location: index.php");
		exit();
	}

	$id = $_GET['id'];
	
	require_once'dbconnect.php';
	
	
?>
</body>
</html>

</html>