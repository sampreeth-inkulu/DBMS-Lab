<html>
<head>
	<title>
		Watchlist
	</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
	</br>
	
<?php
	require_once 'dbconnect.php';
	
	session_start();
	$email=$_SESSION['email'];
	echo "<h2>Hello, User!</h2></br>";
	echo "Email: ".$email."</br>";
	
	$sql = "SELECT * FROM watchlist inner join movie on movie.movie_id=watchlist.movie_id where watchlist.email ='$email'";
	
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
