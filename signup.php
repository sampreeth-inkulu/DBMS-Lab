<html>
<head>
	<title>
		Signup
	</title>
</head>
<body>
	<br><br>
	<center>
		<h3>Signup</h3>
		<form action = "signup-backend.php" method = "POST">
			<!-- <input name = "name" placeholder = "Name"><br><br> -->
			<input name = "email" type = "email" placeholder = "Email"><br><br>
			<input name = "password" type = "password" id = "password" placeholder = "Password" ><br><br>
			<input name = "confirm_password" type = "password" id = "confirm_password" placeholder = "Re-enter Password"><br><br>
			<button type = "submit">Submit</button>
		</form>
	</center>
	<script src = "signup.js"></script>
</body>
</html>
