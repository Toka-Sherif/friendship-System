<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        .container-fluid .search {
            background-image: url(C:\xampp\htdocs\website_mariem_final\alisonwright_fea45-1600x900.jpg);
            background-size: cover;

        }
    </style>
</head>

<body>

    <div class="container-fluid p-0">
    <h1>Welcome to our Website</h1>
        <div class="search p-0">
            <form name="register" method="post" action="check.php">
                <fieldset>
                    <legend>Log in</legend>
                    <label>Email</label>
                    <input type="email" name="email" required=>
                    <label>Password</label>
                    <input type="password" name="password" required=>
                    <br>
                    <input type="submit" name="login" value="Log in">
                </fieldset>
            </form>
            Not Register? <a href="register.php"> Sign up Here</a>
        </div>
    </div>
</body>

</html>