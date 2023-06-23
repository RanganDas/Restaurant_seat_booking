<?php
    include("config.php");
    $message = "";
    $database_email = "";
    $database_password = "";
    if(isset($_POST['submit']))
    {
        $email = $_POST['email'];
        $newpassword = $_POST['newpassword'];
        $sql_query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'") OR die("query failed");
        if(empty($email) OR empty($newpassword) )
        {
            $message = "Nothing can not be left blank";
        }
        else if( !filter_var($email, FILTER_VALIDATE_EMAIL) )
        {
            $message = "Please Enter Valid Email.";
        }
        else if(mysqli_num_rows($sql_query) > 0)
        {
            mysqli_query($conn, "UPDATE `users` SET password = '$newpassword' WHERE email = '$email'") or die('query failed');
            $message = 'password updated successfully! You can log in now';
        }
        else if(mysqli_num_rows($sql_query) == 0)
        {
            $message = "Enter correct Email or Password.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forgot password?</title>
    <link rel="stylesheet" href="user_reg_log.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Update Password</h3>
            <?php
                 if(strlen($message)!=0)
                 echo '<div class="message">'.$message.'</div>';
            ?>
            <label>Enter Email</label>
            <input type="email" placeholder="E-mail" name="email" class="box" >
            <label>Enter New Password</label>
            <input type="password" placeholder="New Password" name="newpassword" class="box">
            <input type="submit" name="submit"  value="Submit" class="btn">
            <p>If you know your password. <a href="user_login.php">Login now</a></p>
        </form>
    </div>
</body>
</html>