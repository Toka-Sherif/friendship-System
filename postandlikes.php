<?php
session_start();
$email = $_SESSION['user_email'];
$post_id = $_GET['isliked'];
echo $post_id;
$conn = mysqli_connect("localhost", "root", "", "website");
if ($conn->connect_error) {
    die('Connection failed : ' . $conn->connect_error);
}

$query_2 = "select * from postandlikes where email_liked ='$email' AND post_id='$post_id'";
$result_2 = mysqli_query($conn, $query_2);
$rows_2 = mysqli_num_rows($result_2);
if ($rows_2 == 1) {
    ?>
    <script>
        window.alert("you already liked this");
        window.location.href="home.php";
</script>
<?php
}
else{
    echo 'islikeeeeeeeddd******************';
            $stmt = $conn->prepare("insert into postandlikes(post_id,email_liked) values(?,?);");
            $stmt->bind_param("is", $post_id, $email);
            $stmt->execute();
            echo 'Done';
            header("location: home.php");

}
?>
