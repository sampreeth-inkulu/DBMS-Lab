<html>
<head>
	<title>
		Movie home
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
	if(!isset($_SESSION['email'])) {
		header("Location: index.php");
		exit();
	}

	require_once'dbconnect.php';
	
	$id = $_GET['id'];
	$query = "SELECT * FROM movie WHERE  movie_id ='$id'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);

	echo "<h2>".$row['title']."</h2>";	
	echo "<h5>language-".$row['lang']."</h5>";	
	echo "<h5>duration-".$row['duration']."</h5>";			
	
	$query = "SELECT * FROM part_of WHERE  movie_id ='$id'";
	$results = mysqli_query($con, $query);
	if($results)
	{
		echo '<table>
			<tr>
				<th>name</th>
				<th>role</th>
			</tr>';
		while ($row = mysqli_fetch_array($results)){
			$id = $row['id'];
			$role = $row['role'];
			$query = "SELECT * FROM cast_and_crew WHERE id ='$id'";
			$result = mysqli_query($con, $query);
			$row = mysqli_fetch_array($result);
			
			echo '
				<tr>
					<td>'.$row['name'].'</td>	
					<td>'.$role.'</td>
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
</body>
</html>