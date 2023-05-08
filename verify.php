<?php
include "connection.php";

$theatre = $_POST['theatre'];
$type = $_POST['type'];
$date = $_POST['date'];
$time = $_POST['hour'];
$movieId = $_POST['movie_id'];


// Check if ID parameter is not provided, redirect to index page

if ((!$_POST['submit'])) {
    echo "<script>alert('You are Not Supposed to come Here Directly');window.location.href='index.php';</script>";
}

if (isset($_POST['submit'])) {
    $qry = "INSERT INTO `orders` ( `theater`, `movieId`, `movieType`, `date`, `timeslot`, `userId`) VALUES ( '$theatre', '$movieId', '$type', '$date', '$time', '". $_SESSION["user"]->id ."');";

    $result = mysqli_query($con, $qry);
}
header("Location: user_bookings.php");
?>