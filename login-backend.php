<?php
/*
$host = "localhost";
$user = "USER_NAME";
$dbpass = "PASSWORD";
$dbname = "DB_NAME";
$con = mysqli_connect($host,$user,$dbpass,$dbname);
*/
require_once 'dbconnect.php';

$email = $_POST["email"];
$password = $_POST["password"];

$password = md5($password);

$query = "SELECT * FROM User WHERE email='$email' AND password='$password'";


$result = mysqli_query($con, $query);
$row=mysqli_fetch_array($result);

$numResults = mysqli_num_rows($result);

if($numResults == 1)
{
	/* $query = "UPDATE users SET login_count = login_count + 1 WHERE email='$email'";
	mysqli_query($con, $query); */
	session_start();
	$_SESSION['email'] = $email;
	header("Location: user.php");
	exit();
}
else
{	/* Expected num_results = 0 */
	echo "<br><br><br><center><h1>Invalid credentials!</h1></center>";
}

?>
