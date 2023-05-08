<?php
session_start();
// logout
if (isset($_POST['logout_btn'])) {
    session_destroy();
}
    header('Location: index.php');
?>