<html>
<head>
	<title>
		Celeb Home
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
	echo "<a href = 'user.php'>My home</a></br>";
	echo "Email: ".$_SESSION['email']."</br>";

	$id = $_GET['id'];
	$movie_id = $id;
	
	require_once'dbconnect.php';
	$query = "SELECT * FROM Cast_and_crew WHERE  id ='$id'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);

	echo "<h2>".$row['name']."</h2>";	
	echo "<h4>Date of birth: ".$row['date_of_birth']."</h4>";	
	echo "<h4>".$row['bio']."</h4>";
	
	if(isset($_GET['add'])) {
        if($_GET['add'] == "yes") {
			$email = $_SESSION['email'];
			$query = "SELECT * FROM Stanlist WHERE id = '$id' AND email = '$email'";
			$result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) == 0) {
				$query = "INSERT INTO Stanlist(id, email) VALUES ('$id','$email')";
				if(mysqli_query($con, $query)) {
					// echo "<br>Added to Stanlist";
				}else {
					echo "<br>Error:".mysqli_error($con);
				}
			}
        }else if($_GET['add'] == "no"){
			$email = $_SESSION['email'];
			$query = "SELECT * FROM Stanlist WHERE id = '$id' AND email = '$email'";
			$result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) != 0) {
				$query = "DELETE FROM Stanlist WHERE id = '$id' AND email = '$email'";
				if(mysqli_query($con, $query)) {
					// echo "<br>Added to Stanlist";
				}else {
					echo "<br>Error:".mysqli_error($con);
				}
			}
		}
	}
	
	$email = $_SESSION['email'];
	$query = "SELECT * FROM Stanlist WHERE id = '$id' AND email = '$email'";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) == 0) {
        echo "<br><a href = 'celeb.php?id=".urlencode($id)."&add=".urlencode("yes")."'>Add to Stanlist</a>";
	}else {
        echo "<br><a href = 'celeb.php?id=".urlencode($id)."&add=".urlencode("no")."'>Remove from Stanlist</a>";
	}

	$query = "SELECT count(*) as cnt FROM Stanlist WHERE  id ='$id'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);
	echo mysqli_error($con);
	echo"<h4>Followed by ".$row['cnt']."</h4>";
	
	$query = "SELECT * FROM Part_of WHERE  id ='$id'";
	$results = mysqli_query($con, $query);
	if($results)
	{
		echo '<table>
			<tr>
				<th>Title</th>
				<th>Role</th>
			</tr>';
		while ($row = mysqli_fetch_array($results)){
			$id = $row['movie_id'];
			$role = $row['role'];
			$query = "SELECT * FROM Movie WHERE movie_id ='$id'";
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
	echo "<br>";
	$id = $movie_id;				
	$query = "SELECT * FROM Links WHERE  id ='$id'";
	$results = mysqli_query($con, $query);
	if($results)
	{
		echo '<table>
			<tr>
				<th>Related Links</th>
			</tr>';
		while ($row = mysqli_fetch_array($results)){
			$link = $row['related_links'];
			echo "
				<tr>
					<td>
						<a href='$link'>
							<div style=height:100%;width:100%>
								$link
							</div>
						</a>
					</td>
				</tr>";
		}
		echo '
		</table>';
	}		
?>
</body>
</html>

</html>
