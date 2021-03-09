<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <title>SEARCH BAR</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f3f3f3;
            font-family: arial;

        }

        .user-container {
            width: 900px;
            background-color: #fff;
            padding: 30px;
        }

        .user-box {
            padding-bottom: 30px;
            width: 100%
        }

        input {
            padding: 0px 20px;
            width: 300px;
            height: 40 px;
            font-size: 22px;
        }

        button {
            width: 100px;
            height: 42px;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Search LIST</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Friends
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="friends.php">Friend List</a>
                        <a class="dropdown-item" href="can_send_to.php">Available others</a>
                    </div>
                </li>
            </ul>
            <form action="searchPage.php" method="POST" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" name="submit-search" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <h1>Search results</h1>
    <?php
    session_start();
    $user_email = $_SESSION['user_email'];

    $conn = mysqli_connect("localhost", "root", "", "website");
    if (isset($_POST['submit-search'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "select email from user where email NOT IN ( SELECT friend_email from friends WHERE email = '$user_email' ) AND email <> '$user_email' AND email NOT IN (SELECT email from f_requests where f_request_email ='$user_email') AND (user.fname = '$search'  OR user.email = '$search' OR user.hometown = '$search' OR user.number = '$search' OR user.lname = '$search' )";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);
        echo "there are " . $queryResult . " results!" . '<br>';

        if ($queryResult > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                //check if already friends
                $email = $row['email'];
                $sql_2 = "SELECT email from friends where email='$email' AND friend_email = '$user_email'";
                $result_2 = mysqli_query($conn, $sql_2);
                $queryResult_2 = mysqli_num_rows($result_2);
                if ($queryResult_2 == 0) {
                    echo 'email: ' . $email .''. 'NOT FRIEND' . '<br>';
                    echo 'Do you want to add?<br>';
                    echo '
                    <a href="make_friend.php?make_friend=' .$email.' ">'.$email.'</a>'.'<br>';
                } else {
                    echo 'email: ' . $email . ' IS FRIEND' . '<br>';
                }
            }
        } else {
            echo "there are no matching results!";
        }
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>