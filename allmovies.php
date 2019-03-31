<html>
<head>
	
	<title>
		User Home
	</title>
</head>
<body>
	</br>
	<form name = "logoutForm" action = "logout.php" method = "POST" align = "right">
		<button type = "submit" name = "Logout">Logout</button>
	</form>
<?php
	session_start();
	echo "<h2>Hello, User!</h2></br>";
	echo "Email: ".$_SESSION['email']."</br>";
	require_once 'dbconnect.php';
	$sql = "SELECT title,duration,lang FROM movie";
	echo "Movie List:</br></br>";
	echo "Movie Name"."|"."Duration";
	echo "\t";
	echo "|"."Language</br>";
if ($result=mysqli_query($con,$sql))
  {
  while ($obj=mysqli_fetch_object($result))
    {
    echo $obj->title."\t".$obj->duration."\t".$obj->lang."</br>";
    }
  // Free result set
  mysqli_free_result($result);
}

?>
</body>
</html>
