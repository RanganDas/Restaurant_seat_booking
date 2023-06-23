<?php
    $message="";
    if (isset($_POST["verify_email"]))
    {
        $restaurant_email = $_POST["restaurant_email"];
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
            $sql = "UPDATE restaurant SET email_verified_at = NOW() WHERE restaurant_email = '" . $restaurant_email . "' AND verification_code = '" . $verification_code . "'";
            $result  = mysqli_query($conn, $sql);
    
            if (mysqli_affected_rows($conn) == 0)
            {
                echo "<script>window.stop()</script>"; 
            }
            else
            {
                header( "refresh:3;url=Restaurant_login.php" );
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
    <title>Email-Verify</title>
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
            <p style="color:red; font-size: 18px; margin-bottom:10px">A 6-digit OTP has been sent to Restaurant mail.</p>
            <input type="hidden" name="restaurant_email" value="<?php echo $_GET['restaurant_email']; ?>" required>
            <label>Enter Otp</label>
            <input type="text" name="verification_code" class="box" placeholder="Enter verification code"/>
            <input type="submit" name="verify_email" value="Verify Email" class="btn">
        </form>
    </div>
</body>
</html>