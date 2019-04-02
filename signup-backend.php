<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SignUp</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="style.css">
	<script src="main.js"></script>
</head>
<body>

<?php


/*$host = "localhost";
$user = "USER_NAME";
$dbpass = "PASSWORD";
$dbname = "DB_NAME";
$con = mysqli_connect($host,$user,$dbpass,$dbname);
*/
require_once 'dbconnect.php';

$email = $_POST["email"];
$password = $_POST["password"];

$password = md5($password);

$query = "SELECT * FROM User WHERE email='$email'";
$result = mysqli_query($con, $query);
$numResults = mysqli_num_rows($result);

if($numResults == 1)
{
	echo "<br><br><br><center><h1>Already registered!</h1>Go to <a href = 'index.php'>Home Page</a></center>";
}
else
{
	$query = "INSERT INTO User (email, password) VALUES ('$email', '$password')";
	mysqli_query($con, $query);
	session_start();
	$_SESSION['email'] = $email;
	echo "</br></br></br><center><h1>Successfully registered!</h1><a href = 'user.php'>Click here to enter your home page</a></center>";
}

?>
	
</body>
</html>
