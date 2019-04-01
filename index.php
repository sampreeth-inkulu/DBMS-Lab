<html>
<head>
	<title>
		Moviepedia
	</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
	</br></br>
	<center>
		MoviePedia</br></br>
		<h3>Login</h3>
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				require_once 'dbconnect.php';

				$email = $_POST["email"];
				$password = $_POST["password"];

				$password = md5($password);

				$query = "SELECT * FROM User WHERE email='$email' AND password='$password'";


				$result = mysqli_query($con, $query);
				$row=mysqli_fetch_array($result);

				$numResults = mysqli_num_rows($result);

				if($numResults == 1){
					session_start();
					$_SESSION['email'] = $email;
					header("Location: user.php");
					exit();
				}else{	/* Expected num_results = 0 */
					echo "<h4>Invalid credentials!</h4>";
				}
			}
		?>
		<form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "POST">
			<input name = "email" type = "email" placeholder = "Email" required><br><br>
			<input name = "password" type = "password" placeholder = "Password" required><br><br>
			<button type = "submit">Submit</button>
		</form>
		</br>
		New User? <a href = "signup.php">SignUp!</a>
	</center>
</body>
</html>
