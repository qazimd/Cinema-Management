<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Cinestar</title>
</head>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: left;
        padding: 8px;
        border: 1px solid black;
    }

    th {
        background-color: #ddd;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>
<body>
<?php
include "connection.php";
// SQL query to select data from orders and movie table where user ID matches with session user's ID

$sql = "SELECT o.*, m.movieTitle FROM orders o join movietable m on (o.movieId = m.movieID)
WHERE userId =  ".$_SESSION['user']->id;


?>
<header></header>
    <div>
    <div style="text-align:center;">
        <h1>My Bookings:<br></br></h1>
    </div>
        <table>
            <thead>
            <tr>
                <th>Theater</th>
                <th>Movie</th>
                <th>Type</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
            </thead>
            <tbody>
            <?php
                // Execute the SQL query and check for successful execution of the query

                if ($result = mysqli_query($con, $sql)) {
                    // Get the number of rows in the query result

                    $resultRows = mysqli_num_rows($result);
                    if ($resultRows > 0) {
                        // Loop through all rows of the query result and display them in the table

                        for ($i = 0; $i < $resultRows; $i++) {
                            $row     = mysqli_fetch_row($result);
                            echo '<tr>';
                            echo '<td>'.$row[1].'</td>';
                            echo '<td>'.$row[7].'</td>';
                            echo '<td>'.$row[3].'</td>';
                            echo '<td>'.$row[4].'</td>';
                            echo '<td>'.$row[5].'</td>';
                            echo '</tr>';
                        }
                        mysqli_free_result($result);
                    } else {
                        // If no rows in the query result display a message indicating that there are no bookings

                        echo '<h4 class="no-annot">No Booking to our movies right now</h4>';
                    }
                } else {
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
                }
            ?>
            </tbody>
        </table>
    </div>
    <!-- Js script -->
    <script src="scripts/script.js "></script>
</body>

</html>