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
<?php
	
	session_start();
	echo "<h2>Hello, User!</h2></br>";
	echo "Email: ".$_SESSION['email']."</br>";
	require_once 'dbconnect.php';
	$sql = "SELECT * FROM Movie";

if ($result=mysqli_query($con,$sql))
  {
	echo "<table> <tr> <th>Movie Name</th> <th>Duration(hh:mm:ss)</th> <th>Language</th> <th>Movie Home</th> </tr>";
  while ($obj=mysqli_fetch_object($result))
    {
		echo "<tr> <td>$obj->title</td> <td>$obj->duration</td> <td>$obj->lang</td> <td><a href='movie.php?id=',".urlencode($obj->id).",'>Link</a></td> </tr>";
   // echo $obj->title."\t".$obj->duration."\t".$obj->lang."</br>";
    }
	echo "</table>";
  // Free result set
  mysqli_free_result($result);
  
}

?>
</body>
</html>
