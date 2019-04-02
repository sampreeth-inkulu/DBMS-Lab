<html>
<head>
	
	<title>
		All actors
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
	if(! isset($_SESSION['email'])) {
		header("Location: index.php");
		exit();
	}
	echo "<h2>Hello, User!</h2></br>";
	echo "<a href = 'user.php'>My home</a></br>";
	echo "Email: ".$_SESSION['email']."</br>";
	require_once 'dbconnect.php';
	$sql = "SELECT * FROM Cast_and_crew";

if ($result=mysqli_query($con,$sql))
  {
	echo "<table> <tr> <th>Person's Name</th> <th>Date of Birth</th> <th>Information about him(bio)</th> <th>Actor Home</th> </tr>";
  while ($obj=mysqli_fetch_object($result))
    {
		echo "<tr> <td>$obj->name</td> <td>$obj->date_of_birth</td> <td>$obj->bio</td> <td><a href='celeb.php?id=".urlencode($obj->id)."'>Link</a></td></tr>";
    }
	echo "</table>";
  // Free result set
  mysqli_free_result($result);
  
}

?>
</body>
</html>
