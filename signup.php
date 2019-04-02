<html>
<head>
	<title>
		Signup
	</title>
	<link rel="stylesheet" type="text/css" media="screen" href="style.css">
</head>
<body>
	<br><br>
	<center>
		<h3>SignUp!</h3>
		<form action = "signup-backend.php" method = "POST">
			<input name = "email" type = "email" placeholder = "Email" required><br><br>
			<input name = "password" type = "password" id = "password" placeholder = "Password" required><br><br>
			<input name = "confirm_password" type = "password" id = "confirm_password" placeholder = "Re-enter Password" required><br><br>
			<button type = "submit">Submit</button>
		</form>
	</center>
	<script src = "signup.js"></script>
</body>
</html>
