<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Registration</title>
        <style>
            .register{
                margin: 0 auto;
                margin-top: 40px;
                border: 2px solid #000000;
                width: 200px;padding:40px;
            }
            body{background:#EFEFEF;font-family:Arial,Tahoma}
            label,input,select{display: block}
            input{padding:10px;}

            fieldset{
                background: #FFF;
                border: 1px solid #CCC;
                padding: 10px;
                margin-bottom: 20px;
            }
            legend{
                background: #FFF;
                border: 1px solid #CCC;
                padding: 5px;
            }
            .error{
                color: #FF0000;
                margin-bottom: 5px;
            }
        </style>
    </head>

    <body>
        <form name="register" method="post" action="createUser.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Create account</legend>

                <label>First name</label>
                <input type="text" name="fname" required=>
                <br>
                <label>Last name</label>
                <input type="text" name="lname" required=>
                <br>
                <label>Email</label>
                <input type="email" name="email" required=>
                <br>
                <label>Password</label>
                <input type="password" name="password" required=>
                <br>
                <label>Phone number</label>
                <input type="number" name="number" >
                <br>
                <label>Gender</label>
                <select name="gender" required=>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
                <br>
                <label>Birthdate</label>
                <input type="date" name="bdate" required=>
                <br>
                <!--  <label>Profile picture</label>
                  <input type="image" name="pp">-->
                <label for="profileImage">Profile Image </label>
                <input type="file" name="pp" class="form-control">

                <br>
                <label>Hometowm</label>
                <input type="text" name="hometown">
                <br>
                <label>Marital status</label>
                <select name="mstatus">
                    <option value="1">single</option>
                    <option value="2">engaged</option>
                    <option value="3">married</option>
                </select>
                <br>
                <label>About me</label>
              <!--  <input type="text" name="about">
                -->
                <textarea name="about" rows="6" cols="60"></textarea>
                <br>
                <input type="submit" name='create' value="create">

            </fieldset>
        </form>


    </body>
</html>

<?php
/*            $filename = $_FILES["pp"]["name"];
  $tempname = $_FILES["pp"]["temp_name"];
  $folder = "uploads/" . $filename;
  move_uploaded_file($tempname, $folder);
  echo "<img src='$folder' height='100' width='100'/>";
 */
?>