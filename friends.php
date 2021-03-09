<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>Friends_interface</title>

    <link rel="stylesheet" href="css/bootstrap.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">FRIEND LIST</a>
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
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search Friends" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0"name="submit-search" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <?php
/*
session_start();
$email = $_SESSION['user_email'];
getting_realfriends($email);

function getting_realfriends($email)
{
   $conn = mysqli_connect("localhost", "root", "", "website");
   if ($conn->connect_error) {
      die('Connection failed : ' . $conn->connect_error);
  }
   echo 'Connected successfully<br>';
   $sql = "select friend_email from friends where email = '$email' ";
   $result = mysqli_query($conn, $sql);

   if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
         echo "friend email: ". $row["friend_email"]."<br> ";
         
      }
   }else {
      echo "No friends yet";
   }
   mysqli_close($conn);

}

include 'recieve_requests.php';

*/
    /*
     
     *  while($row = mysqli_fetch_assoc($result)) {
          echo '
          <a href="add_friend.php?accept=' .$row['email'].' ">'.$row['email'].'</a>';
          echo'<br>';
      }
     */
    session_start();
$email = $_SESSION['user_email'];
getting_realfriends($email);

function getting_realfriends($email)
{
   $conn = mysqli_connect("localhost", "root", "", "website");
   if ($conn->connect_error) {
      die('Connection failed : ' . $conn->connect_error);
  }
   $sql = "select friend_email from friends where email = '$email' ";
   $result = mysqli_query($conn, $sql);

   if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
       //  echo "friend email: ". $row["friend_email"]."<br> ";
          echo "friend email: ";
          echo '
          <a href="friend_profile.php?friend_email=' .$row["friend_email"].' ">'.$row["friend_email"].'</a>';
          echo'<br>';
         
      }
   }else {
      echo "No friends yet";
   }
   mysqli_close($conn);

}

include 'recieve_requests.php';
?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
  crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
  crossorigin="anonymous"></script>


</body>
</html>
