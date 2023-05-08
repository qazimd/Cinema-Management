<?php 
    $id = $_GET['id'];
    include "config.php";
    // SQL query to delete the record with the given 'id'

    $sql = "DELETE FROM orders WHERE id = $id";
    // Execute the query and redirect to the view page if successful

    if ($con->query($sql) === TRUE) {
        header('Location: view.php');
        exit;
    } else {
        echo "Error deleting record: " . $link->error;
    }
?>