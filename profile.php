<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<?php

//$email = $_GET['email'];
session_start();
$email = $_SESSION['user_email'];
$conn = mysqli_connect("localhost", "root", "", "website");

$query = "SELECT * FROM user WHERE email='$email'";
$result = mysqli_query($conn, $query);
$rows = mysqli_num_rows($result);
if ($rows == 1) {
    while ($rs = mysqli_fetch_array($result)) {
        $fname = $rs["fname"];
        $lname = $rs["lname"];
        $enc_password = $rs["password"];
        $password = base64_decode($enc_password);
        $number = $rs["number"];
        $gender = $rs["gender"];
        $bdate = $rs["bdate"];
        $pp = $rs["pp"];
        $hometown = $rs["hometown"];
        $mstatus = $rs["mstatus"];
        $about = $rs["about"];
    }
}
//$url1 = "home.php?email=" . $email;
//echo "<a href='$url1'> Back </a>";
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <style>
        body {
            background-color: whitesmoke;
        }

        input {
            width: 40%;
            height: 5%;
            border: 1px;
            border-radius: 05px;
            padding: 8px 15px 8px 15px;
            margin: 10px 0px 15px 0px;
            box-shadow: 1px 1px 2px 1px grey;
        }

        label {
            font-size: 30px;
            width: 40%;
            height: 5%;
            border: 1px;
            border-radius: 05px;
            padding: 8px 15px 8px 15px;
        }

        h1 {
            font-size: 70px
        }

        .pform {
            color: #FF0000
        }

        hr.dashed {
            border-top: 3px dashed #bbb;
        }
        img {
            border-radius: 50%;
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Profile</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href='profile.php'>Profile <span class="sr-only">(current)</span></a>
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

        </div>
    </nav>

    <div class="row">
        <div class="col-9">
            <center>
                <h1>Your profile</h1>
                <form name="register" method="post" action="" enctype="multipart/form-data">

                    <?php echo "<img src='$pp' height='200' width='200'/>"; ?>
                    <br>
                    <label>First name:</label>
                    <label class="pform"><?php echo "$fname"; ?></label>
                    <br>
                    <label>Last name:</label>
                    <label class="pform"><?php echo "$lname"; ?></label>
                    <br>
                    <label>Email:</label>
                    <label class="pform"><?php echo "$email"; ?></label>
                    <br>
                    <label>Password:</label>
                    <label class="pform"><?php echo "$password"; ?></label>
                    <br>
                    <label>Phone number:</label>
                    <label class="pform"><?php echo '0' . "$number"; ?></label>
                    <br>
                    <label>Gender:</label>
                    <label class="pform"><?php if ($gender == 1)
                                                echo "Male";
                                            else if ($gender == 2)
                                                echo 'Female';
                                            ?></label>
                    <br>
                    <label>Birthdate:</label>
                    <label class="pform"><?php echo "$bdate"; ?></label>
                    <br>
                    <label>Hometowm:</label>
                    <label class="pform"><?php echo "$hometown"; ?></label>
                    <br>
                    <label>Marital status:</label>
                    <label class="pform"><?php
                                            if ($mstatus == 1)
                                                echo "Single";
                                            else if ($mstatus == 2)
                                                echo 'Engaged';
                                            else if ($mstatus == 3)
                                                echo 'Married';
                                            ?></label>
                    <br>
                    <label>About me:</label>
                    <textarea name="about" rows="6" cols="60" readonly><?php echo "$about"; ?></textarea>
                    <br>

                    <?php
                    $url = "edit.php?email=" . $email;
                    echo "<a href='$url'> Edit account</a>";
                    ?>

                </form>
            </center>
        </div>
        <div class="col-3">
            <?php
            $conn = mysqli_connect("localhost", "root", "", "website");
            if ($conn->connect_error) {
                die('Connection failed : ' . $conn->connect_error);
            }
            echo '**********FRIEND REQUESTS*********<br>';
            $sql = "select email from f_requests where f_request_email='$email'";
            $result = mysqli_query($conn, $sql);
            $queryResult = mysqli_num_rows($result);
            echo 'There are ' . $queryResult . ' Friend Requets' . '<br>';
            echo '**********************************<br>';
            ?>
            <a href="friends.php">GO TO FRIEND REQUESTS</a>
        </div>
    </div>





    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>
<?php
//$email = $_GET['email'];
$email = $_SESSION['user_email'];
$conn = mysqli_connect("localhost", "root", "", "website");

$query = "SELECT * FROM post WHERE email='$email'";
$result = mysqli_query($conn, $query);
$rows = mysqli_num_rows($result);
if ($rows >= 1) {
    while ($rs = mysqli_fetch_array($result)) {

        $postername = $rs["postername"];
        $ispublic = $rs["ispublic"];
        $postedtime = $rs["postedtime"];
        $caption = $rs["caption"];
        $Image = $rs["Image"];
        $url1 = "profile.php?email=" . $email;
        echo "<a href='$url1' style='text-decoration: underline; font-size: 26px'>$postername $lname</a>";
        echo "$postedtime &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $ispublic";
        echo "<br />";
        echo '<div style="font-size:1.25em;color:#0e3c68;"><span style="font-size:1.25em;color:#000000">' . $caption . '</span></div>';


        echo "<img src='$Image' height='200' width='200'/>";
        echo "<br />";
        echo "<br />";
    }
}
?>
<hr class="dashed">
<hr class="dashed">
<h2> MY POSTS </h2>
<?php


$query = "SELECT * from post JOIN postandlikes ON post.post_id = postandlikes.post_id AND email='$email'";
$result = mysqli_query($conn, $query);
$rows = mysqli_num_rows($result);
if ($rows >= 1) {
    while ($rs = mysqli_fetch_array($result)) {
        echo "<img src=".$rs['Image']." height='200' width='200'/><br>";
        echo 'caption: '.$rs['caption'].'<br>';
        echo $rs['email_liked'] . 'liked your post' . '<br>';
    }
}
//$url1 = "home.php?email=" . $email;
//echo "<a href='$url1'> Back </a>";
?>