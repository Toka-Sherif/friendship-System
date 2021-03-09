<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
        /* (plain) for tags like: p img a
        ( . ) for name of classes
        (#) for id names */
        th {
            border-bottom: 2px solid black;
            text-align: center;
            padding: 10 px;
        }

        hr.dashed {
            border-top: 3px dashed #00f;
        }

        img {
            border-radius: 50%;
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">HOME</a>
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
                <li class="nav-item active">
                    <a class="nav-link" href='log_out.php'>LOG OUT <span class="sr-only">(current)</span></a>
                </li>
            </ul>

            <form action="advancedSearchPage.php" method="POST" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Advanced Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" name="submit-search" type="submit">Search</button>
            </form>


        </div>
    </nav>
    <div class="row">
        <div class="col-8">

            <h1>Home Page</h1>
            <form action="" method="post" enctype="multipart/form-data">


                <textarea rows="10" cols="60" name="content" id="txt" placeholder="What's on your mind?" onKeyUp="manage()"></textarea>
                <select name="publicvalue">
                    <option value="public">public</option>
                    <option value="private">private</option>
                </select>


                <input type="file" name="image" id="file">
                <button type="submit" name="submit" value="post" id="submit" disabled>post</button>

            </form>

        </div>

        <div class="col-4">
            <?php
            session_start();
            $email = $_SESSION['user_email'];
            $conn = mysqli_connect("localhost", "root", "", "website");
            if ($conn->connect_error) {
                die('Connection failed : ' . $conn->connect_error);
            }
            $sql = "select fname,lname,pp from user where email='$email'";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_num_rows($result);
            if ($rows == 1) {
                while ($rs = mysqli_fetch_array($result)) {
                    $pp = $rs['pp'];
                    $fname = $rs["fname"];
                    $lname = $rs["lname"];
                }
            }
            echo "<img src='$pp' align='left' height='200' width='200'/>";
            echo '<h1>' . $fname . '  ' . $lname . '</h1>';

            echo '<br>';
            echo '**********FRIEND REQUESTS************<br>';
            $sql = "select email from f_requests where f_request_email='$email'";
            $result = mysqli_query($conn, $sql);
            $queryResult = mysqli_num_rows($result);
            echo 'There are ' . $queryResult . ' Friend Requets' . '<br>';
            echo '*************************************<br>';
            ?>
            <a href="friends.php">GO TO FRIEND REQUESTS</a>



        </div>
    </div>
    <div class="row">
        <div class="col m-12">
            <hr class="dashed">
            <hr class="dashed">

            <font size="5" face="Helvetica">
                <table align="center" style="border:5px double black;">
                    <h2 align='center'>NEWS FEEDS</h2>

                    <tr>
                        <th>Name</th>
                        <th>Post</th>
                    </tr>
                    <?php
                    //$email = $_GET['email'];
                    //$url = "profile.php?email=" . $email;
                    //echo "Welcome $email<a href='$url'> Profile</a>";


                    $email = $_SESSION['user_email'];
                    $conn = mysqli_connect("localhost", "root", "", "website");
                    view_public_pots($conn, $email);
                    view_private_posts($conn, $email);
                    ?>
                </table>

            </font>

            <script>
                var fileInput = document.getElementById('file');
                var bt = document.getElementById('submit');

                fileInput.onchange = function(e) {
                    if (e.target.files.length > 0)
                        bt.disabled = false;
                }

                function alert() {
                    alert("posts will be revealed after refresh");
                }
            </script>

            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </div>
    </div>
</body>

<script>
    function manage() {
        var bt = document.getElementById('submit');
        var file = document.getElementById("file");

        if (document.getElementById('txt').value != '') {
            bt.disabled = false;
        } else if (file.files.length != 0) {
            bt.disabled = false;
        } else {

            bt.disabled = true;

        }
    }
</script>

</html>


<?php

$email = $_SESSION['user_email'];
$conn = mysqli_connect("localhost", "root", "", "website");


$query = "SELECT * FROM user WHERE email='$email'";
$result = mysqli_query($conn, $query);
$rows = mysqli_num_rows($result);
if ($rows == 1) {
    while ($rs = mysqli_fetch_array($result)) {
        $fname = $rs["fname"];
    }

}


if (isset($_POST['submit'])) {
    $textareaValue = $_POST['content'];
    $publicValue = $_POST['publicvalue'];
    $email = $_SESSION['user_email'];
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = 'uploads/' . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $image = $target;
        $sql = "insert into post (caption,Image,ispublic,postername,email) values ('$textareaValue','$image','$publicValue','$fname','$email')";
        $stmt = mysqli_query($conn, $sql);
    } else {
        $empty_image = 'uploads/no-image.png';
        $sql = "insert into post (caption,Image,ispublic,postername,email) values ('$textareaValue','$empty_image','$publicValue','$fname','$email')";
        $stmt = mysqli_query($conn, $sql);
    }


    // $sql = "insert into posts (caption,Image,ispublic,postername) values ('$textareaValue','$image','$publicValue','$fname')";
    // $sql = "insert into post (caption,Image,ispublic,postername,email) values ('$textareaValue','$image','$publicValue','$fname','$email')";
    //$rs = mysqli_query($conn, $sql);
    /*  $affectedRows = mysqli_affected_rows($conn);

      if($affectedRows == 1)
      {
      $successMsg = "Record has been saved successfully";
      } */
}

function view_public_pots($conn, $email)
{
    $query = "select * from post where ispublic='public'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
    if ($rows >= 1) {
        while ($rs = mysqli_fetch_array($result)) {

            echo '<tr>';
            echo '<td>' . $rs['postername'] . '</td>';
            echo '<td>' . "<img src=" . $rs["Image"] . " style='width:500px;height:500px'; onerror=onerror='myerror()'/> </td>";
            echo '<tr>';
            echo '<td colspan=1> </td>';
            echo "<td style='background:mintcream;border-bottom:2px solid black;padding:10 px;'>";
            echo $rs['caption'];
            echo '<br>';
            echo $rs['postedtime'];
            echo '<br>';
            echo $rs['ispublic'];
            echo '<br>';
           /* $query_2 = "select * from postandlikes where email_liked <>'$email'";
            $result_2 = mysqli_query($conn, $query_2);
            $rows_2 = mysqli_num_rows($result_2);
            if ($rows_2 >= 1) {
                while ($rs_2 = mysqli_fetch_array($result_2)) {
                }
            }*/
            echo '
             <a href="postandlikes.php?isliked=' . $rs['post_id'] . ' ">LIKE</a>';
            // <form action='postandlikes.php?isliked=<?php $rs['post_id']' method='get'>
            //<button class="btn btn-outline-primary my-2 my-sm-0" name="isliked" type="submit" >LIKE</button>
            //</form>

        }
    }
}


function view_private_posts($conn, $email)
{

    $query = "select * from post where email IN (select email from friends where email='$email' or friend_email='$email') and ispublic='private'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
    if ($rows >= 1) {
        while ($rs = mysqli_fetch_array($result)) {

            $postername = $rs["postername"];
            $ispublic = $rs["ispublic"];
            $postedtime = $rs["postedtime"];
            $caption = $rs["caption"];
            $Image = $rs["Image"];
            echo '<tr>';
            echo '<td>' . $rs['postername'] . '</td>';
            echo '<td>' . "<img src=" . $rs["Image"] . " style='width:500px;height:500px'; onerror=onerror='myerror()'/> </td>";
            echo '<tr>';
            echo '<td colspan=1> </td>';
            echo "<td style='background:mintcream;border-bottom:2px solid black;padding:10 px;'>";
            echo $rs['caption'];
            echo '<br>';
            echo $rs['postedtime'];
            echo '<br>';
            echo $rs['ispublic'];
            echo '<br>';
            echo '
             <a href="postandlikes.php?isliked=' . $rs['post_id'] . ' ">LIKE</a>';
        }
    }
}
?>