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

<body>
    <?php
    include "connection.php";
    // select all records from movieTable and order by movieID in descending order

    $sql = "SELECT * FROM movieTable ORDER BY movieID desc";
    ?>
    <header></header>
    <div id="home-section-1" class="movie-show-container">
        <h1>Currently Showing</h1>
        <h3>Book a movie now</h3>

        <div class="movies-container">

            <?php
            // execute the SQL query and retrieve the result set

            if ($result = mysqli_query($con, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    for ($i = 0; $i <= 5; $i++) {
                        $row = mysqli_fetch_array($result);
                        // display the movie box with the movie image, title and a link to book a seat if the user is logged in
                        echo '<div class="movie-box">';
                        echo '<img src="' . $row['movieImg'] . '" alt=" ">';
                        echo '<div class="movie-info ">';
                        echo '<h3>' . $row['movieTitle'] . '</h3>';

                        if (isset($_SESSION['user'])){
                            echo '<a href="booking.php?id=' . $row['movieID'] . '"><i class="fas fa-ticket-alt"></i> Book a seat</a>';
                        } else {
                            echo '<a href="login.php"><i class="fas fa-ticket-alt"></i> Login first then book a seat</a>';
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                    mysqli_free_result($result);
                } else {
                    echo '<h4 class="no-annot">No Booking to our movies right now</h4>';
                }
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
            }

            // Close connection
            mysqli_close($con);
            ?>
        </div>
    </div>

    <div id="home-section-3" class="trailers-section">
        <h1 class="section-title">Explore new movies</h1>
        <h3>Now showing</h3>
        <!-- Display a grid of movie trailers -->

        <div class="trailers-grid">
            <div class="trailers-grid-item">
                <img src="img/movie-thumb-1.jpg" alt="">
                <div class="trailer-item-info" data-video="Z1BCujX3pw8">
                    <h3>Captain Marvel</h3>
                    <i class="far fa-3x fa-play-circle"></i>
                </div>
            </div>
            <div class="trailers-grid-item">
                <img src="img/movie-thumb-2.jpeg" alt="">
                <div class="trailer-item-info" data-video="sT7Wab-8QS8">
                    <h3>FAST X</h3>
                    <i class="far fa-3x fa-play-circle"></i>
                </div>
            </div>
            <div class="trailers-grid-item">
                <img src="img/movie-thumb-3.jpg" alt="">
                <div class="trailer-item-info" data-video="cksYkEzUa7k">
                    <h3>The Lego Movie</h3>
                    <i class="far fa-3x fa-play-circle"></i>
                </div>
            </div>
            <div class="trailers-grid-item">
                <img src="img/movie-thumb-4.jpeg" alt="">
                <div class="trailer-item-info" data-video="5lyTA6DkgSA">
                    <h3>The Flash</h3>
                    <i class="far fa-3x fa-play-circle"></i>
                </div>
            </div>
            <div class="trailers-grid-item">
                <img src="img/movie-thumb-5.jpeg" alt="">
                <div class="trailer-item-info" data-video="6ZfuNTqbHE8">
                    <h3>Marvel Studios' Avengers: Infinity War Official</h3>
                    <i class="far fa-3x fa-play-circle"></i>
                </div>
            </div>
            <div class="trailers-grid-item">
                <img src="img/movie-thumb-6.jpeg" alt="">
                <div class="trailer-item-info" data-video="AHmCH7iB_IM">
                    <h3>Creed III</h3>
                    <i class="far fa-3x fa-play-circle"></i>
                </div>
            </div>
        </div>
    </div>
    <footer></footer>
    <!-- JS script tag -->
    <script src="scripts/script.js "></script>
</body>

</html>