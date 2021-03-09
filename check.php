<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<div>
    <?php
    ?>

</div>
<body>
    <?php
    include 'index.php';
    $email = $_POST["email"];
    $enc_password = $_POST["password"];
    session_start();
    $_SESSION['user_email'] = $email;

    $password = base64_encode($enc_password);

    $conn = mysqli_connect("localhost", "root", "", "website");
    $stmt = $conn->prepare("select email from user WHERE email='$email' AND password='$password'");
    $stmt->execute();
    $result = $stmt->get_result();
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        $url = "home.php?email=" . $email;
       header('location: ' . $url);
      // header("location: home.php");

    } else {
        echo '<script type="text/javascript">alert("Invalid email or password")</script>';
        //   echo 'Invalid email or password';
    }
    ?>
</body>

</html>