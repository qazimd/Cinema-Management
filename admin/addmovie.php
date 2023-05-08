<?php
// include config file which contains database connection settings

include "config.php";

// Check user login or not
if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
}

// logout
if (isset($_POST['but_logout'])) {
    session_destroy();
    header('Location: index.php');
}


if (isset($_POST['submit'])) {

    $target_dir = "../img/"; // Directory where the file will be saved
    $target_file = $target_dir . basename($_FILES["movieImg"]["name"]); // Get the file name
    // Move the uploaded file to the target directory

    move_uploaded_file($_FILES["movieImg"]["tmp_name"], $target_file);
        // Insert new movie details into the 'movietable' table of the database

    $insert_query = "INSERT INTO 
                            movieTable (  movieImg,
                                            movieTitle,
                                            movieGenre,
                                            movieDuration,
                                            movieRelDate,
                                            movieDirector,
                                            movieActors)
                            VALUES (        'img/" . $_FILES["movieImg"]["name"] . "',
                                            '" . $_POST["movieTitle"] . "',
                                            '" . $_POST["movieGenre"] . "',
                                            '" . $_POST["movieDuration"] . "',
                                            '" . $_POST["movieRelDate"] . "',
                                            '" . $_POST["movieDirector"] . "',
                                            '" . $_POST["movieActors"] . "')";
    $rs = mysqli_query($con, $insert_query);

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
 
</head>

<body>
    <!-- Header -->
    <?php include('header.php'); ?>

    <div class="admin-container">
        <!-- sidebar -->
        <?php include('sidebar.php'); ?>
        <div class="admin-section admin-section2">
            <div class="admin-section-column">


                <div class="admin-section-panel admin-section-panel2">
                    <div class="admin-panel-section-header">
                        <h2>Movies</h2>
                    </div>
                    <!-- Form to add new movie details -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input placeholder="Title" type="text" name="movieTitle" required>
                        <input placeholder="Genre" type="text" name="movieGenre" required>
                        <input placeholder="Duration" type="number" name="movieDuration" required>
                        <input placeholder="Release Date" type="date" name="movieRelDate" required>
                        <input placeholder="Director" type="text" name="movieDirector" required>
                        <input placeholder="Actors" type="text" name="movieActors" required>
                        <br>
                        <label>Add Poster</label>
                        <input type="file" name="movieImg" accept="image/*">
                        <button type="submit" value="submit" name="submit" class="movie-btn">Add Movie</button>
                   </form>
                </div>
                <div class="admin-section-panel admin-section-panel2">
                    <div class="admin-panel-section-header">
                        <h2>Recent Movies</h2>
                    </div>
                    <!-- A table to display movie data fetched from the database -->
                    <table class="admin-table" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>MovieID</th>
                            <th>MovieTitle</th>
                            <th>Movie_Genre</th>
                            <th>Release_date</th>
                            <th>Director</th>
                            <th>More</th>
                            
                        </tr>
                        <tbody>
                            <?php
                            // Establish a database connection

                            $host = "localhost"; 
                            $user = "root"; 
                            $password = ""; 
                            $dbname = "cinema_db";

                            $con = mysqli_connect($host, $user, $password, $dbname);
                            $select = "SELECT * FROM `movietable`";
                            $run = mysqli_query($con, $select);
                            // Loop through each row of the result and output the data in the table

                            while ($row = mysqli_fetch_array($run)) {
                                $ID = $row['movieID'];
                                $title = $row['movieTitle'];
                                $genere = $row['movieGenre'];
                                $releasedate = $row['movieRelDate'];
                                $movieactor = $row['movieDirector'];
                            ?>
                                <tr align="center">
                                    <!-- Output each column of the current row -->

                                    <td><?php echo $ID; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $genere; ?></td>
                                    <td><?php echo $releasedate; ?></td>
                                    <td><?php echo $movieactor; ?></td>
                                    <!--<td><?php echo  "<a href='deletemovie.php?id=" . $row['movieID'] . "'>delete</a>"; ?></td>-->
                                    <td><button value="Book Now!" type="submit" onclick="" type="button" class="delete-btn"><?php echo  "<a href='deletemovie.php?id=" . $row['movieID'] . "'>delete</a>"; ?></button></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>

    <script src="../scripts/script.js "></script>
</body>

</html>