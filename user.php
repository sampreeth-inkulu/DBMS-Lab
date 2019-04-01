<html>
<head>
	<title>
		User Home
	</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
	</br>
	<form name = "logoutForm" action = "logout.php" method = "POST" align = "right">
		<button type = "submit" name = "Logout">Logout</button>
	</form>
	
	<form name = "watchlist" action = "watchlist.php" method = "POST" align = "list">
		<button type = "submit" name = "watchlist">To Watch Now!!!</button>
	</form>
	
<?php
	session_start();
	echo "<h2>Hello, User!</h2></br>";
	echo "Email: ".$_SESSION['email']."</br>";
?>

	<form name = "allMovieList" action = "allmovies.php" method = "POST" align = "left">
		<button type = "submit" name = "allmovies">View all the Movies</button>
	</form>
	
	<form name = "allActorList" action = "allactors.php" method = "POST" align = "left">
		<button type = "submit" name = "allActors">View all the Actors</button>
	</form>
	
</body>
</html>
