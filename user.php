<head>
	<title>
		User Home
	</title>
	<link rel="stylesheet" type="text/css" media="screen" href="style.css">
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
	echo "Email: ".$_SESSION['email']."</br>";

	$email = $_SESSION['email'];
	require_once'dbconnect.php';

	echo "<h2>Watchlist<h2>";
	
	$query = "SELECT * FROM Watchlist WHERE email ='$email'";
	$results = mysqli_query($con, $query);

	if($results)
	{
		echo '<table>
			<tr>
				<th>Title</th>
			</tr>';
		while ($row = mysqli_fetch_array($results)){
			$id = $row['movie_id'];
			$query = "SELECT * FROM Movie WHERE  movie_id ='$id'";
			$result = mysqli_query($con, $query);
			$row = mysqli_fetch_array($result);
			
			echo '
				<tr>
					<td>'.$row['title'].'</td>				
					<td>
						<a href="movie.php?id=',urlencode($id),'">
							<div style="height:100%;width:100%">
								view
							</div>
						</a>
					</td>
				</tr>';
		}
		echo '
		</table>';
	}
	echo "<h2>Favlist<h2>";
	
	$query = "SELECT * FROM Stanlist WHERE email ='$email'";
	$results = mysqli_query($con, $query);

	if($results)
	{
		echo '<table>
			<tr>
				<th>Name</th>
			</tr>';
		while ($row = mysqli_fetch_array($results)){
			$id = $row['id'];
			$query = "SELECT * FROM Cast_and_crew WHERE  id ='$id'";
			$result = mysqli_query($con, $query);
			$row = mysqli_fetch_array($result);			
			echo '
				<tr>
					<td>'.$row['name'].'</td>
					<td>
						<a href="celeb.php?id=',urlencode($id),'">
							<div style="height:100%;width:100%">
								view
							</div>
						</a>
					</td>					
				</tr>';
		}
		echo '
		</table>';
	}

?>
	<br>
	<!-- <form name = "addMoviesForm" action = "addMovie.php"> -->
	<button type = "submit" name = "allMovies" onclick = "window.open('allMovies.php')">View All Movies</button>
	<button type = "submit" name = "allActors" onclick = "window.open('allActors.php')">View All Actors</button>
	<br><br>
	<button type = "submit" name = "addMovie" onclick = "window.open('addMovie.php')">Add Movie</button>
	<!-- </form> -->
	<!-- <form name = "addCastForm" action = "addCast.php"> -->
	<button type = "submit" name = "addCast" onclick = "window.open('addCast.php')">Add Cast</button>
	<!-- </form> -->
</body>
</html>