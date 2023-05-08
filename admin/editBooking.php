<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Admin Dashboard</title>
</head>

<body>
<?php

include "config.php";
$id = $_GET['id']; // get id through query string
$setting = "select * from orders where id='$id'";
$qry = mysqli_query($con, $setting); // select query

$data = mysqli_fetch_array($qry); // fetch data

if (isset($_POST['update'])) // when click on Update button
{
    $theater = $_POST['theater'];
    $movieType = $_POST['movieType'];
    $date = $_POST['date'];
    $timeslot = $_POST['timeslot'];

    $edit = mysqli_query($con, "update orders set `theater` = '$theater', `movieType` = '$movieType', `date` = '$date', `timeslot` = '$timeslot' where id='$id'");

    if ($edit) {
        mysqli_close($con); // Close connection
        header("location:view.php"); // redirects to all records page
        exit;
    } else {
        echo "error";
    }
}
?>
    <?php include('header.php'); ?>

    <div class="admin-container">
        <?php include('sidebar.php'); ?>
        <div class="admin-section admin-section2">
            <div class="admin-section-column">
                <div class="admin-section-panel admin-section-panel2">
                    <div class="admin-panel-section-header">
                        <h2>UPDATE DATA</h2>
                        <i class="fas fa-film" style="background-color: #4547cf"></i>
                    </div>
                        <form method="POST">
                            <input type="text" name="theater" value="<?php echo $data['theater'] ?>" placeholder="Theater" Required>
                            <input type="text" name="movieType" value="<?php echo $data['movieType'] ?>" placeholder="Movie type" Required>
                            <input type="text" name="date" value="<?php echo $data['date'] ?>" placeholder="Enter Last Name" Required>
                            <input type="text" name="timeslot" value="<?php echo $data['timeslot'] ?>" placeholder="Time slot" Required>
                             <input type="submit" name="update" class="update-btn" value="Update">
                             
                        </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>