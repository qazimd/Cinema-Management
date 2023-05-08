
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="icon" type="image/png" href="../img/logo.png">
    <link rel="stylesheet" href="../style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<body>
    <!-- Header -->
    <?php include('header.php'); ?>
    
    <div class="admin-container">
        
        <?php include('sidebar.php'); ?>
        <div class="admin-section-panel admin-section-panel1">
                    <div class="admin-panel-section-header">
                        <div class="admin-panel-section-content">
                                <h2>Costumer <b>Messages</b></h2>
                        </div>
                    </div>

                    <table class="admin-table" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>Message ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Feedback</th>
                            <th>More</th>
                        </tr>
                        <tbody>
                            <?php
                            include "config.php";
                            $select = "SELECT * FROM `feedbacktable`";
                            $run = mysqli_query($con, $select);
                            // storing into variables
                            while ($row = mysqli_fetch_array($run)) {
                                $id = $row['msgID'];
                                $firstname = $row['senderfName'];
                                $lastname = $row['senderlName'];
                                $email = $row['sendereMail'];
                                $message = $row['senderfeedback'];

                            ?>
                                <tr align="center">
                                <!-- Displaying the data -->
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $firstname; ?></td>
                                    <td><?php echo $lastname; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $message; ?></td>
                                    <!--<td><?php echo  "<a href='Deletecontact.php?id=" . $row['msgID'] . "'>delete</a>"; ?></td>-->
                                    <td><button value="Book Now!" type="submit" onclick="" type="button" class="delete-btn"><?php echo  "<a href='Deletecontact.php?id=" . $row['msgID'] . "'>delete</a>"; ?></button></td>
                                </tr>

                            <?php }
                            ?>
                        </tbody>

                    </table>
                </div>
        </div>
    </div>

    <script src="../scripts/script.js "></script>
</body>

</html>