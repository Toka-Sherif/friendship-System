<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
session_start();
$email=$_SESSION['user_email'];
//$email = $_GET['email'];
$conn = mysqli_connect("localhost", "root", "", "website");
//echo "$email" . "  ";

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
//$url1 = "profile.php?email=" . $email;
//echo "<a href='$url1'> Back </a>";
?>
<?php
if (isset($_POST['remove'])) {
    if ($gender == 1) {
        $pp = 'uploads/boy.jpg';
    } else {
        $pp = 'uploads/girl.png';
    }
    echo '<script type="text/javascript">alert("Image Removed")</script>';
    $sql = "UPDATE user SET pp='$pp' where email='$email'";
    $conn->query($sql);
}

if (isset($_POST['save'])) {
    //echo "$pp";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $bdate = mysqli_real_escape_string($conn, $_POST['bdate']);
    $hometown = mysqli_real_escape_string($conn, $_POST['hometown']);
    $mstatus = mysqli_real_escape_string($conn, $_POST['mstatus']);
    $about = mysqli_real_escape_string($conn, $_POST['about']);

    if ($_FILES['pp']['name']) {
        $ppName = $_FILES['pp']['name'];
        $target = 'uploads/' . $ppName;
        move_uploaded_file($_FILES['pp']['tmp_name'], $target);
        $pp = $target;
        //$sql1 = "INSERT INTO posts (caption,Image,ispublic,postername) values ('user $fname changed their profile picture','$pp','private','$fname')";
        $sql1 = "INSERT INTO post (caption,Image,ispublic,postername,email) values ('user $fname changed their profile picture','$pp','private','$fname','$email')";
    }

    $password = base64_encode($password);
    // $sql = "insert into posts (caption,Image,ispublic,postername) values ('user $fname changed their profile picture','$pp','private','$fname')";
    //$sql = "UPDATE user SET fname='$fname', lname='$lname', password='$password',number='$number',gender='$gender',bdate='$bdate',pp='$pp',hometown='$hometown',mstatus='$mstatus',about='$about' where email='$email'";
    //$sql1 = "INSERT INTO posts (caption,Image,ispublic,postername) values ('user $fname changed their profile picture','$pp','private','$fname')";
    $sql2 = "UPDATE user SET fname='$fname', lname='$lname', password='$password',number='$number',gender='$gender',bdate='$bdate',pp='$pp',hometown='$hometown',mstatus='$mstatus',about='$about' where email='$email'";


    if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
    if ($conn->query($sql2) === TRUE) {
        //$url = "home.php?email=" . $email;
        //header('location: ' . $url);
        header('location: home.php');
        echo 'Done';
    } else {
        echo 'Error updating record: ' . $conn->error;
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit</title>
        <style>
            body{
                background-color: whitesmoke;
            }
            input{
                width: 40%;
                height: 5%;
                border: 1px;
                border-radius: 05px;
                padding: 8px 15px 8px 15px;
                margin: 10px 0px 15px 0px;
                box-shadow: 1px 1px 2px 1px grey;
            }
            label{
                width: 40%;
                height: 5%;
                border: 1px;
                border-radius: 05px;
                padding: 8px 15px 8px 15px;
            }
        </style>
    </head>
    <body>
    <center>
        <h1>Edit profile</h1>
        <form name="register" method="post" action="" enctype="multipart/form-data">

            <label>First name</label>
            <input type="text" name="fname" value="<?php echo "$fname"; ?>" required>
            <br>
            <label>Last name</label>
            <input type="text" name="lname" value="<?php echo "$lname"; ?>" required>
            <br>
            <label>Email</label>
            <input type="email" name="email" value="<?php echo "$email"; ?>" readonly>
            <br>
            <label>Password</label>
            <input type="text" name="password" value="<?php echo "$password"; ?>" required>
            <br>
            <label>Phone number</label>
            <input type="number" name="number" value="<?php echo '0' . "$number"; ?>">
            <br>
            <label>Gender</label>
            <select name="gender" required=>
                <option <?php if ($gender == 1) echo 'selected'; ?> value="1">Male</option>
                <option <?php if ($gender == 2) echo 'selected'; ?> value="2">Female</option>
            </select>
            <br>
            <label>Birthdate</label>
            <input type="date" name="bdate" value="<?php echo "$bdate"; ?>" required>
            <br>
            <!--  <label>Profile picture</label>
              <input type="image" name="pp">-->

            <label for="profileImage">Profile Picture </label>
            <?php echo "<img src='$pp' height='200' width='200'/>"; ?>
            <input type="file" name="pp"  class="form-control">
            <br>
            <input type="submit" name='remove' value="Remove Picture">
            <br>
            <label>Hometowm</label>
            <input type="text" name="hometown" value="<?php echo "$hometown"; ?>">
            <br>
            <label>Marital status</label>
            <select name="mstatus" value="<?php echo "$mstatus"; ?>">
                <option <?php if ($mstatus == 1) echo 'selected'; ?> value="1">single</option>
                <option <?php if ($mstatus == 2) echo 'selected'; ?> value="2">engaged</option>
                <option <?php if ($mstatus == 3) echo 'selected'; ?> value="3">married</option>
            </select>
            <br>
            <label>About me</label>
          <!--  <input type="text" name="about">
            -->
            <textarea name="about" rows="6" cols="60"><?php echo "$about"; ?></textarea>
            <br>
            <input type="submit" name='save' value="Save">

        </form>


    </center>

</body>
</html>
