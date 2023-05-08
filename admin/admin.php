<?php
include "config.php";

// Check user login or not
if (!isset($_SESSION['uname'])) {
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
    <?php
    // Database queries
    $sql = "SELECT * FROM orders";
    $bookingsNo = mysqli_num_rows(mysqli_query($con, $sql));
    $messagesNo = mysqli_num_rows(mysqli_query($con, "SELECT * FROM feedbacktable"));
    $moviesNo = mysqli_num_rows(mysqli_query($con, "SELECT * FROM movietable"));
    $userNo = mysqli_num_rows(mysqli_query($con, "SELECT * FROM users"));
    ?>

    <?php include('header.php'); ?>

    <div class="admin-container">

        <?php include('sidebar.php'); ?>
        <div class="admin-section admin-section2">
            <div class="admin-section-column">
                <!-- Display the statistics in the form of panels -->

                <div class="admin-section-panel admin-section-stats">
                    <div class="admin-section-stats-panel">
                        <i class="fa fa-ticket-alt" style="background-color: #cf4545"></i>
                        <h2 style="color: #cf4545"><?php echo $bookingsNo ?></h2>
                        <h3>Bookings</h3>
                    </div>
                    <div class="admin-section-stats-panel">
                        <i class="fas fa-film" style="background-color: #4547cf"></i>
                        <h2 style="color: #4547cf"><?php echo $moviesNo ?></h2>
                        <h3>Movies</h3>
                    </div>
                    <div class="admin-section-stats-panel">
                        <i class="fas fa-users" style="background-color: #000000"></i>
                        <h2 style="color: #bb3c95"><?php echo $userNo ?></h2>
                        <h3>Users</h3>
                    </div>
                    <div class="admin-section-stats-panel" style="border: none">
                        <i class="fas fa-envelope" style="background-color: #3cbb6c"></i>
                        <h2 style="color: #3cbb6c"><?php echo $messagesNo ?></h2>
                        <h3>Messages</h3>
                    </div>
                </div>
                <!-- Display a table of recent bookings -->

                <div class="admin-section-panel admin-section-panel1">
                    <div class="admin-panel-section-header">
                        <h2>Recent Bookings</h2>
                    </div>
                    <div class="admin-panel-section-content">
                        <table class="admin-table" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                <th>Theater</th>
                                <th>Movie</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                            <tbody>
                                <?php
                                // Query the database to get recent bookings and display them in the table
                                
                                $select = "SELECT o.*, m.movieTitle FROM orders o join movietable m on (o.movieId = m.movieID)";
                                $run = mysqli_query($con, $select);
                                while ($row = mysqli_fetch_row($run)) {
                                    echo '<tr>';
                                        echo '<td>'.$row[1].'</td>';
                                        echo '<td>'.$row[7].'</td>';
                                        echo '<td>'.$row[3].'</td>';
                                        echo '<td>'.$row[4].'</td>';
                                        echo '<td>'.$row[5].'</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script src="../scripts/script.js "></script>
</body>

</html>