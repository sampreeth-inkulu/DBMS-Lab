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
	$sql = "SELECT name,date_of_birth,bio FROM cast_and_crew";

if ($result=mysqli_query($con,$sql))
  {
	echo "<table> <tr> <th>Person's Name</th> <th>Date of Birth</th> <th>Information about him(bio)</th> </tr>";
  while ($obj=mysqli_fetch_object($result))
    {
		echo "<tr> <td>$obj->name</td> <td>$obj->date_of_birth</td> <td>$obj->bio</td> </tr>";
    }
	echo "</table>";
  // Free result set
  mysqli_free_result($result);
  
}

?>
</body>
</html>
