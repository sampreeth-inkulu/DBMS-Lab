<html>
<head>
	<title>
		User Home
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
		echo "<h2>Hello, User!</h2></br>";
		echo "Email: ".$_SESSION['email']."</br>";
	?>
	<!-- <form name = "addMoviesForm" action = "addMovie.php"> -->
		<button type = "submit" name = "addMovie" onclick = "window.open('addMovie.php')">Add Movie</button>
	<!-- </form> -->
	<!-- <form name = "addCastForm" action = "addCast.php"> -->
		<button type = "submit" name = "addCast" onclick = "window.open('addCast.php')">Add Cast</button>
	<!-- </form> -->
</body>
</html>
