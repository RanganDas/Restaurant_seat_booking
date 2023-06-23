<?php
    $message="";
    if (isset($_POST["verify_email"]))
    {
        $email = $_POST["email"];
        $verification_code = $_POST["verification_code"];
 
        if(empty($verification_code))
        {
            $message = "Please fill all fields";
        }
        else if(strlen($verification_code)>6 OR strlen($verification_code)<6)
        {
            $message = "Enter Valid OTP.";
        }
        else if(!preg_match("/^[0-9]{6}$/", $verification_code)) 
        {
            $message = "OTP contains only numbers not other characters.";
        }
        else
        {
            $conn = mysqli_connect("localhost", "root", "", "testing");
            $sql = "UPDATE users SET email_verified_at = NOW() WHERE email = '" . $email . "' AND verification_code = '" . $verification_code . "'";
            $result  = mysqli_query($conn, $sql);
    
            if (mysqli_affected_rows($conn) == 0)
            {
                // // echo "<h3>Invalid Otp.<br><a href='email-verification.php' style='background-color:blue;
                // // text-decoration:none; color:white; font-size:18px; '> Click Here</a> to verify again</h3>"; 
                // header( "refresh:3;url=email-verification.php" );
                // echo '<script>alert("\nRegistration Successfull.\n\nYou will be redirected in Login Page withing 3 seconds.\n\n\t\tClick on ok.")</script>';
                $message = "Invalid OTP";
            }
            if (mysqli_affected_rows($conn) > 0)
            {
                header( "refresh:3;url=user_login.php" );
                echo '<script>alert("\nRegistration Successfull.\n\nYou will be redirected in Login Page withing 3 seconds.\n\n\t\tClick on ok.")</script>';
            }
            exit();
        }
    }
 
?>
<!DOCTYPE html>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="user_reg_log.css">
</head>
<body>
    <div class="form-container">
        <form  method="post">
            <?php
                if(strlen($message)!=0)
                echo '<div class="message">'.$message.'</div>';
            ?>
            <h3>Verify Account</h3>
            <p style="color:red; font-size: 18px; margin-bottom:10px">A 6-digit OTP has been sent into your mail.</p>
            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required>
            <label>Enter Otp</label>
            <input type="text" name="verification_code" class="box" placeholder="Enter verification code"/>
            <input type="submit" name="verify_email" value="Verify Email" class="btn">
        </form>
    </div>
</body>
</html>