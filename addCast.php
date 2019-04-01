<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Cast</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="addCast.js"> </script>
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
    <center>
        <h2>Add Cast</h2><br><br>
        <form name = "addCastForm" id = "addCastForm" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "POST">
            <!-- <label for = "title">Title</label><br> -->
            <input name = "cast_name" type = "text" placeholder = "Name" required><br><br>
            <input name = "date_of_birth" type = "date" placeholder = "Date of Birth"><br><br>
            <textarea name = "bio" rows = "4" cols = "50" form = "addCastForm" placeholder = "Brief Bio"></textarea><br><br>
            <div class="link_fields">
                <button class="link_add_field">Add Link</button><br>
                <div><input name="link[]" type="text" placeholder="Link"></div>
            </div><br><br>
            <button type = "submit">Submit</button>
        </form>
    <?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['cast_name'];
            $dob = $_POST['date_of_birth'];
            $bio = $_POST['bio'];
            $link = $_POST['link'];
            if(empty($dob)) {
                $dob = NULL;
            }
            if(empty($bio)) {
                $dob = NULL;
            }
            require_once 'dbconnect.php';

            $query = "INSERT INTO Cast_and_crew(id, name, date_of_birth, bio) VALUES (NULL, '$name', '$dob', '$bio')";
            if( mysqli_query($con ,$query) ) {
                $query = "SELECT id FROM Cast_and_crew WHERE name = '$name'";
                $result = mysqli_query($con, $query);
                $result_array = mysqli_fetch_array($result);
                $id = $result_array['id'];
                if( !(empty($link) || empty($link[0])) ) {
                    $link_query = "INSERT INTO Links(id, related_links) VALUES ";
                    foreach ($link as $linkval) {
                        $link_query = $link_query."('$id', '$linkval'),";
                    }
                    $link_query = trim($link_query, ",");
                    if( mysqli_query($con, $link_query) ) {
                        echo "<br>Successfully, added links";
                    }else {
                        echo "<br>ERROR: Could not add cast to database. ".mysqli_error($con);
                    }
                }
                echo "<br>Successfully, added cast";
            }else {
                echo "<br>ERROR: Could not add cast to database. ".mysqli_error($con);
            }
        }
    ?>
    </center>
</body>
</html>