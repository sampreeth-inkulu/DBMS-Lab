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
	if(! isset($_SESSION['email'])) {
		header("Location: index.php");
		exit();
	}
	// echo "<h2>Hello, User!</h2></br>";
	echo "<a href = 'user.php'>My home</a></br>";
	echo "Email: ".$_SESSION['email']."</br>";

	require_once'dbconnect.php';
	
    $id = $_GET['id'];
    $movie_id = $id;
	$query = "SELECT * FROM Movie WHERE  movie_id ='$id'";
    $result = mysqli_query($con, $query);
    // echo mysqli_error($con);
	$row = mysqli_fetch_array($result);

	echo "<h2>".$row['title']."</h2>";	
	echo "<h4>Language-".$row['lang']."</h4>";	
	echo "<h4>Duration-".$row['duration']."</h4>";
	
	$query = "SELECT sum(collection) as s FROM Movie_boxoffice WHERE movie_id = '$id'";
	$result = mysqli_query($con, $query);
	if($result) {
		$result_array = mysqli_fetch_array($result);
		echo "Total Collection = ".$result_array['s'];
	}

    if(isset($_GET['add'])) {
        if($_GET['add'] == "yes") {
            $email = $_SESSION['email'];
			$query = "SELECT * FROM Watchlist WHERE movie_id = '$id' AND email = '$email'";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) == 0) {
                $email = $_SESSION['email'];
                $query = "INSERT INTO Watchlist VALUES ('$id','$email')";
                if(mysqli_query($con, $query)) {
                    // echo "<br><a href = 'movie.php?id=".urlencode($id)."&add=".urlencode("no")."'>Remove from watchlist</a>";
                }else {
                    echo "<br>Error:".mysqli_error($con);
                }
            }else {
                // echo "<br><a href = 'movie.php?id=".urlencode($id)."&add=".urlencode("no")."'>Remove from watchlist</a>";
            }
        }else if($_GET['add'] == "no"){
            $email = $_SESSION['email'];
			$query = "SELECT * FROM Watchlist WHERE movie_id = '$id' AND email = '$email'";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) != 0) {
                $email = $_SESSION['email'];
                $query = "DELETE FROM Watchlist WHERE movie_id = '$id' AND email = '$email'";
                if(mysqli_query($con, $query)) {
                    // echo "<br><a href = 'movie.php?id=".urlencode($id)."&add=".urlencode("yes")."'>Add to watchlist</a>";
                }else {
                    echo "<br>Error:".mysqli_error($con);
                }
            }else {
                // echo "<br><a href = 'movie.php?id=".urlencode($id)."&add=".urlencode("yes")."'>Add to watchlist</a>";
            }
        }
    }
    
    $email = $_SESSION['email'];
    $query = "SELECT * FROM Watchlist WHERE movie_id = '$id' AND email = '$email'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) == 0) {
        echo "<br><a href = 'movie.php?id=".urlencode($id)."&add=".urlencode("yes")."'>Add to watchlist</a>";
    }else {
        echo "<br><a href = 'movie.php?id=".urlencode($id)."&add=".urlencode("no")."'>Remove from watchlist</a>";
    }
	echo "<br><br>";
	$query = "SELECT * FROM Part_of WHERE  movie_id ='$id'";
	$results = mysqli_query($con, $query);
	if($results)
	{
		echo '<table>
			<tr>
				<th>Name</th>
				<th>Role</th>
			</tr>';
		while ($row = mysqli_fetch_array($results)){
			$id = $row['id'];
			$role = $row['role'];
			$query = "SELECT * FROM Cast_and_crew WHERE id ='$id'";
			$result = mysqli_query($con, $query);
			$row = mysqli_fetch_array($result);
			
			echo '
				<tr>
					<td>'.$row['name'].'</td>	
					<td>'.$role.'</td>
					<td>
						<a href="celeb.php?id='.urlencode($id).'">
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
	echo "<br><br>";
    $id = $movie_id;
	$query = "SELECT * FROM Movie_links WHERE  movie_id ='$id'";
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
