<?php
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
    
    <?php include('header.php'); ?>

    <div class="admin-container">

        <?php include('sidebar.php'); ?>
        <div class="admin-section-panel admin-section-panel1">
                    <div class="admin-panel-section-header">
                        <div class="admin-panel-section-content">
                                <h2>Booking <b>Details</b></h2>
                        </div>
                    </div>

                    <table class="admin-table" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>Theater</th>
                            <th>Movie</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>More</th>

                        </tr>
                        <tbody>
                            <?php
                            // connect to the database using credentials from config.php

                            $con = mysqli_connect($host, $user, $password, $dbname);
                            // select data from orders table and join it with movietable table

                            $select = "SELECT o.*, m.movieTitle FROM orders o join movietable m on (o.movieId = m.movieID)";
                            $run = mysqli_query($con, $select);
                            // loop through the results and display them in a table

                            while ($row = mysqli_fetch_row($run)) {
                                echo '<tr>';
                                    echo '<td>'.$row[1].'</td>';
                                    echo '<td>'.$row[7].'</td>';
                                    echo '<td>'.$row[3].'</td>';
                                    echo '<td>'.$row[4].'</td>';
                                    echo '<td>'.$row[5].'</td>';
                                    ?>

                            <td><button type="submit" type="button" class="booking-btn"><?php echo  "<a href='deleteBooking.php?id=" . $row[0] . "' >delete</a>"; ?></button><button name="update"  type="submit" onclick="" type="button" class="booking-btn"><?php echo  "<a href='editBooking.php?id=" . $row[0] . "'>update</a>"; ?></button></td>
                            <?php    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>

            </div>
        </div>
    </div>
    <script src="../scripts/script.js "></script>
</body>

</html>