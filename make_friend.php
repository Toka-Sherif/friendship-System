<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>Friends REQUEST</title>

    <link rel="stylesheet" href="css/bootstrap.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">ADD/REJECT FRIEND</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <?php


    session_start();

    $user_email = $_SESSION['user_email'];
    $friend_email = $_GET['make_friend'];
    ?>

    <form  method="POST" >
    <button class="btn btn-outline-success my-2 my-sm-0" name="add" type="submit">ADD</button>
    </form>
    <form  method="POST" >
    <button class="btn btn-outline-success my-2 my-sm-0" name="reject" type="submit">REJECT</button>
    </form>


    <?php


    $conn = mysqli_connect("localhost", "root", "", "website");
    if ($conn->connect_error) {
        die('Connection failed : ' . $conn->connect_error);
    }

    if(isset($_POST['add']))
    {
    $stmt = $conn->prepare("insert into friends(email,friend_email) values(?,?);");
    $stmt->bind_param("ss", $user_email, $friend_email);
    $stmt->execute();
    echo 'Done';
    $stmt = $conn->prepare("insert into friends(email,friend_email) values(?,?);");
    $stmt->bind_param("ss", $friend_email, $user_email);
    $stmt->execute();
    echo 'Done';


    $sql = "DELETE FROM `f_requests` WHERE email='$friend_email' AND f_request_email='$user_email' limit 1";
    $result = mysqli_query($conn, $sql);
    header("location:home.php");

    $stmt->close();
    $conn->close();

    }
    if(isset($_POST['reject']))
    {
     $sql = "DELETE FROM `f_requests` WHERE email='$friend_email' AND f_request_email='$user_email' limit 1";
    $result = mysqli_query($conn, $sql);
    header("location:home.php");
    }

    

    ?>
</body>

</html>