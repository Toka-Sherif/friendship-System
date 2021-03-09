<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "website");

    if (isset($_POST['create'])) {


        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $bdate = mysqli_real_escape_string($conn, $_POST['bdate']);

        $hometown = mysqli_real_escape_string($conn, $_POST['hometown']);
        $mstatus = mysqli_real_escape_string($conn, $_POST['mstatus']);
        $about = mysqli_real_escape_string($conn, $_POST['about']);


        if ($_FILES['pp']['name']) {
            // $ppName = time() . '_' . $_FILES['pp']['name'];
            $ppName = $_FILES['pp']['name'];
            $target = 'uploads/' . $ppName;
            move_uploaded_file($_FILES['pp']['tmp_name'], $target);
            // echo "<img src='$target' height='100' width='100'/>";
        } else {
            //   $ppName = time() . '_' . $_FILES['pp']['name'];
            //echo "$ppName";
            if ($gender == 1) {
                $target = 'uploads/boy.jpg';
            } else {
                $target = 'uploads/girl.png';
            }
        }

        $pp = $target;

        $password = base64_encode($password);

        $stmt = $conn->prepare("select email from user where email='$email' Limit 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $num = mysqli_num_rows($result);
        if ($num == 0) {
            $stmt = $conn->prepare("insert into user(fname,lname,email,password,number,gender,bdate,pp,hometown,mstatus,about) values(?,?,?,?,?,?,?,?,?,?,?);");
            $stmt->bind_param("ssssissssss", $fname, $lname, $email, $password, $number, $gender, $bdate, $pp, $hometown, $mstatus, $about);
            $stmt->execute();
            //$url = "home.php?email=" . $email;
            // header('location: ' . $url);
            session_start();
            $_SESSION['user_email'] = $email;
            header('location: home.php');
            echo 'Done';
        } else {
            echo 'Someone else is already using this email';
        }
    }
    ?>
</body>

</html>