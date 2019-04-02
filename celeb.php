<html>
<head>
	<title>
		celeb home
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

	$id = $_GET['id'];
	
	require_once'dbconnect.php';
	$query = "SELECT * FROM cast_and_crew WHERE  id ='$id'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);

	echo "<h2>".$row['name']."</h2>";	
	echo "<h5>date of birth-".$row['date_of_birth']."</h5>";	
	echo "<h5>".$row['bio']."</h5>";	

	$query = "SELECT count(*) as cnt FROM stanlist WHERE  id ='$id'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	echo mysqli_error($con);
	echo"<h5>followed by ".$row['cnt']."</h5>";
	
	$query = "SELECT * FROM part_of WHERE  id ='$id'";
	$results = mysqli_query($con, $query);
	if($results)
	{
		echo '<table>
			<tr>
				<th>title</th>
				<th>role</th>
			</tr>';
		while ($row = mysqli_fetch_array($results)){
			$id = $row['movie_id'];
			$role = $row['role'];
			$query = "SELECT * FROM movie WHERE movie_id ='$id'";
			$result = mysqli_query($con, $query);
			$row = mysqli_fetch_array($result);
			
			echo '
				<tr>
					<td>'.$row['title'].'</td>	
					<td>'.$role.'</td>
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
	
?>
</body>
</html>

</html>
