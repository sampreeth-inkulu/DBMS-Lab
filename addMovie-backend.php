<?php
    $title = $_POST["title"];
    $duration = $_POST["duration"];
    $language = $_POST["language"];
    $genre = $_POST["genre"];
    $link = $_POST["link"];
    $week = $_POST["week"];
    $collection = $_POST["collection"];
    $cast = $_POST["cast"];
    $role = $_POST["role"];

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
?>