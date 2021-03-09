<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<html>

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
        </div>
    </nav>

    <h1>Search results</h1>
    <?php

    $conn = mysqli_connect("localhost", "root", "", "website");
    // put your code here
    if (isset($_POST['submit-search'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT user.fname, user.lname, user.email, user.number, user.hometown, post.caption FROM user LEFT JOIN post ON user.email = post.email WHERE (user.fname = '$search'  OR user.email = '$search' OR user.hometown = '$search' OR user.number = '$search' OR user.lname = '$search' OR post.caption LIKE '%$search%')";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);
        echo "there are " . $queryResult . " results!";
        if ($queryResult > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='user-box'>
              <h3>" . $row['fname'] . " " . $row['lname'] . "</h3>
              <p>" . $row['email'] . "</p>
              <p>" . $row['number'] . "</p>
              <p>" . $row['hometown'] . "</p>
              <p>posted : " . $row['caption'] . "</p>
  

             </div>";
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