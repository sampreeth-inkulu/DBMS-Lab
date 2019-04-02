<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Movie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="addMovie.js"> </script>
</head>
<body>
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
    ?>
    </br></br>
    <center>
        <form name = "addMovie" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "POST">
            <label for = "title">Title</label><br>
            <input name = "title" type = "text" placeholder = "Title" required><br><br>
            <label for = "duration">Duration</label><br>
            <input name = "duration" type = "time"><br><br>
            <label for = "language">Language</label><br>
            <input name = "language" type = "text" placeholder = "Language"><br><br>
            <div class="genre_fields">
                <button class="genre_add_field">Add Genre</button>
                <div><input name="genre[]" type="text" placeholder="Genre"></div>
            </div><br><br>
            <div class="link_fields">
                <button class="link_add_field">Add Link</button>
                <div><input name="link[]" type="text" placeholder="Link"></div>
            </div><br><br>
            <div class="collection_fields">
                <button class="collection_add_field">Add Collection Stats</button>
                <div><input name = "week[]" type = "number" placeholder = "No. of weeks"><input name="collection[]" type="number" placeholder="Rs"></div>
            </div><br><br>
            <div class="cast_fields">
                <button class="cast_add_field">Add Cast</button>
                <div><input name = "cast[]" type = "text" placeholder = "Cast Name"><input name="role[]" type="text" placeholder="Cast Role"></div>
            </div><br><br>
            <button type = "submit">Submit</button>
        </form>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $title = $_POST["title"];
                $duration = $_POST["duration"];
                $language = $_POST["language"];
                $genre = $_POST["genre"];
                $link = $_POST["link"];
                $week = $_POST["week"];
                $collection = $_POST["collection"];
                $cast = $_POST["cast"];
                $role = $_POST["role"];

                if(empty($title)) {
                    return;
                }
            
                require_once 'dbconnect.php';
                $i = 0;
                if( !(empty($cast) || empty($cast[0])) ) {
                    $cast_count = min(count($cast), count($role));
                    for( ; $i < $cast_count; ++$i) {       // check if cast is present in database
                        $query = "SELECT * FROM Cast_and_crew WHERE name = '$cast[$i]'";
                        $result = mysqli_query($con, $query);
                        $numResults = mysqli_num_rows($result);
                        if($numResults == 0) {
                            $i = $cast_count + 1;
                        }else {
                            $result_array = mysqli_fetch_array($result);
                            $cast_id[$i] = $result_array['id'];
                        }
                    }
                    if($i == $cast_count + 1) {
                        echo "<br><h4>Cast name is not there. Consider adding new cast.</h4><br>";
                        return ;
                    }
                }
                if(empty($duration)) {
                    $duration = NULL;
                }
                if(empty($language)) {
                    $language = NULL;
                }
            
                $query = "INSERT INTO Movie(movie_id, title, duration, lang) VALUES (NULL, '$title', '$duration', '$language')";
                if(! mysqli_query($con, $query) ) {
                    echo "<br>Could not add movie to database. ".mysqli_error($con);
                }else {
                    $query = "SELECT movie_id FROM Movie WHERE title = '$title' AND lang = '$language'"; // think
                    $result = mysqli_query($con, $query);
                    $result_array = mysqli_fetch_array($result);
                    $movie_id = $result_array['movie_id'];
                    if(! (empty($genre) || empty($genre[0])) ) {
                        $genre_query = "INSERT INTO Movie_genre(movie_id, genre) VALUES ";
                        foreach ($genre as $genre_val) {
                            $genre_query = $genre_query."('$movie_id','$genre_val'),";
                        }
                        $genre_query = trim($genre_query, ",");
                        if( !mysqli_query($con, $genre_query) ) {
                            echo "<br>Could not add genre to database. ".mysqli_error($con);
                        }
                    }
                    if(! (empty($link) || empty($link[0])) ) {
                        $link_query = "INSERT INTO Movie_links(movie_id, related_links) VALUES ";
                        foreach ($link as $link_val) {
                            $link_query = $link_query."('$movie_id','$link_val'),";
                        }
                        $link_query = trim($link_query, ",");
                        if( !mysqli_query($con, $link_query) ) {
                            echo "<br>Could not add link to database. ".mysqli_error($con);
                        }
                    }
                    if(! (empty($collection) || empty($collection[0])) ) { 
                        $collection_query = "INSERT INTO Movie_boxoffice(movie_id, no_of_weeks, collection) VALUES ";
                        $collection_length = min(count($week), count($collection));
                        for($i = 0; $i < $collection_length; $i++) {
                            $collection_query = $collection_query."('$movie_id', '$week[$i]', '$collection[$i]'),";
                        }
                        if($collection_length > 0) {
                            $collection_query = trim($collection_query, ",");
                            if( !mysqli_query($con, $collection_query) ) {
                                echo "<br>Could not add collection to database";
                            }
                        }
                    }
                    if(! (empty($cast) || empty($cast[0]))) {
                        $cast_query = "INSERT INTO Part_of(movie_id, id, role) VALUES ";
                        $cast_length = min(count($cast), count($role));
                        for($i = 0; $i < $cast_length; $i++) {
                            $cast_query = $cast_query."('$movie_id', '$cast_id[$i]', '$role[$i]'),";
                        }
                        if($collection_length > 0) {
                            $cast_query = trim($cast_query, ",");
                            if( !mysqli_query($con, $cast_query) ) {
                                echo "<br>Could not add cast to database. ".mysqli_error($con);
                            }
                        }
                    }
                }
            }
        ?>
        <br>
        <div>View all cast and crew <a href = "allActors.php">here</a></div>
        <br>
        <div>Add cast and crew <a href = "addCast.php">here</a></div>
    </center>
</body>
</html>