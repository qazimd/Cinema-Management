<div class="navbar-brand">
    <a href="index.php">
        <h1 class="navbar-heading">Cinestar</h1>
    </a>
</div>
<div class="navbar-container">
    <nav class="navbar">
        <ul class="navbar-menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="contact-us.php">Contact</a></li>
            <?php
            session_start();
            if(isset($_SESSION['user'])){
                echo '<li><a href="user_bookings.php">My Bookings</a></li>';
                echo '
                <form method="post" action="logout.php">
                <button type="submit" value="Logout" class="logout-btn" name="logout_btn">Logout</button>
                </form>';
            } else {
                echo '<li><a href="login.php">Login</a></li>';
            }
            ?>
        </ul>
    </nav>
</div>