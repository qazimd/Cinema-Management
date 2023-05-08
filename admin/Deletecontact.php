<?php 
    $id = $_GET['id'];
    include "config.php";
    // SQL query to delete the message from the feedback table with the matching ID

    $sql = "DELETE FROM feedbackTable WHERE msgID = $id"; 
    // Execute the query and redirect if successful

    if ($con->query($sql) === TRUE) {
        header('Location: contactus.php');
        exit;
    } else {
        echo "Error deleting record: " . $con->error;
    }
?>