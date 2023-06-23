<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
 
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    
    include("config.php");
    session_start();
    $message = "";
    if(isset($_POST['submit']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql_query = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email' AND password='$password'") OR die("query failed");
        if(empty($email) OR empty($password) )
        {
            $message = "Nothing can not be left blank";
        }
        else if( !filter_var($email, FILTER_VALIDATE_EMAIL) )
        {
            $message = "Please Enter Valid Email.";
        }
        else if (mysqli_num_rows($sql_query) == 0)
        {
            $message = "Enter Correct email or password";
        }
        else
        {
            $mail = new PHPMailer(true);
 
            try 
            {
                //Enable verbose debug output
                $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;
        
                //Send using SMTP
                $mail->isSMTP();
        
                //Set the SMTP server to send through
                $mail->Host = 'smtp.gmail.com';
        
                //Enable SMTP authentication
                $mail->SMTPAuth = true;
        
                //SMTP username
                $mail->Username = 'mondaltuhin532@gmail.com';
        
                //SMTP password
                $mail->Password = 'ltzmmifabyukikkq';
        
                //Enable TLS encryption;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        
                //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                $mail->Port = 465;
        
                //Recipients
                $mail->setFrom('mondaltuhin532@gmail.com', 'Book In Time');
        
                //Add a recipient
                $mail->addAddress($email);
        
                //Set email format to HTML
                $mail->isHTML(true);
        
                $device_info = $_SERVER['HTTP_USER_AGENT'];

                $mail->Subject = 'Security alert';
                $mail->Body    = 'Login request recived From : '.$device_info;
                //$mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
                $mail->send();
                $row = mysqli_fetch_assoc($sql_query);
                $_SESSION['user_id'] = $row['id'];
                header('location:main_admin.php');
            } 
            catch (Exception $e) 
            {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            exit();
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="user_reg_log.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Admin Log In</h3>
            <?php
                 if(strlen($message)!=0)
                 echo '<div class="message">'.$message.'</div>';
            ?>
            <label>Enter Email</label>
            <input type="email" placeholder="E-mail" name="email" class="box" >
            <label>Enter Password</label>
            <input type="password" placeholder="Password" name="password" class="box">
            <input type="submit" name="submit"  value="Log in" class="btn">
            <p>Do not have an account? <a href="main_admin_signup.php">Signup now</a></p>
            <a href="user_forgot_password.php" class="btn">Forgot Password?</a>
        </form>
    </div>
</body>
</html>
