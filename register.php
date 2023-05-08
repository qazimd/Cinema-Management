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
    ?>

    <style>
        /* Container */
        .container {
            width: 40%;
            margin: 0 auto;
        }

        /* Login */
        #div_login {
            border: 1px solid gray;
            border-radius: 3px;
            width: 470px;
            height: 270px;
            box-shadow: 0px 2px 2px 0px gray;
            margin: 0 auto;
        }

        #div_login h1 {
            margin-top: 0px;
            font-weight: normal;
            padding: 10px;
            background-color: cornflowerblue;
            color: white;
            font-family: sans-serif;
        }

        #div_login div {
            clear: both;
            margin-top: 10px;
            padding: 5px;
        }

        #div_login .textbox {
            width: 96%;
            padding: 7px;
        }

        #div_login .btn {
            padding: 7px;
            width: 100px;
            background-color: lightseagreen;
            border: 0px;
            color: white;
        }
    </style>

    <header></header>
    <!--HTML code for registration form-->

    <div class="container">
        <form method="post" action="">
            <div id="div_login">
                <h1>Register</h1>
                <div>
                    <input type="text" class="textbox" id="txt_uname" name="txt_uname" placeholder="Username" />
                </div>
                <div>
                    <input type="password" class="textbox" id="txt_uname" name="txt_pwd" placeholder="Password" />
                </div>
                <div style="display: flex; justify-content: space-between">
                    <div style="justify-content: end">
                        <button class="btn" type="button" onclick="window.location.href='login.php'">
                            Login now!
                        </button>
                    </div>
                    <div>
                        <input type="submit" value="Submit" name="but_submit" id="but_submit" class="btn"/>
                    </div>
                </div>
            </div>
        </form>
    </div>




    <footer></footer>

    <script src="scripts/script.js "></script>
</body>

<?php
//Check if the submit button has been clicked

if (isset($_POST['but_submit'])) {

    $uname = mysqli_real_escape_string($con, $_POST['txt_uname']);
    $password = mysqli_real_escape_string($con, $_POST['txt_pwd']);
    //Check if the input fields are not empty

    if ($uname != "" && $password != "") {
        //Select user with the given username and password

        $sql_query = "select * from users where username='" . $uname . "' and password='" . $password . "'";
        $result = mysqli_query($con, $sql_query);
        $row = mysqli_fetch_object($result);

        //If no such user is found, insert a new user into the database

        if (is_null($row)) {
            //Insert user into the database

            $sql_query = "INSERT INTO users (`username`, `name`, `password`) VALUES ('". $uname ."', '". $uname ."', '" . $password . "')";
            $data = mysqli_query($con, $sql_query);
            //Select newly inserted user from the database

            $sql_query = "select * from users where id = ". mysqli_insert_id($con);
            $result = mysqli_query($con, $sql_query);
            $row = mysqli_fetch_object($result);
            //If the new user is found, set session variables and redirect to appropriate page

            if (!is_null($row) && $row->id) {
                $_SESSION = null;
                $_SESSION['uname'] = $uname;
                $_SESSION['isAdmin'] = $row->isAdmin;
                $_SESSION['user'] = $row;

                if($_SESSION['isAdmin']) {
                    return header('Location: admin/admin.php');
                }

                header('Location: user_bookings.php');
            } else {
                echo "Invalid username and password";
            }
            header('Location: user_bookings.php');
        } else {
            //If a user with the same username and password already exists, display an error message

            $_SESSION = null;
            echo "Invalid username and password";
        }
    }
}
?>
</html>