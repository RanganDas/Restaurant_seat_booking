<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
 
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    
    include("config.php");
    // session_start();
    $message = "";
    if(isset($_POST['submit']))
    {
        $restaurant_email = $_POST['restaurant_email'];
        $restaurant_password = $_POST['restaurant_password'];

        $sql_query = mysqli_query($conn, "SELECT * FROM restaurant WHERE restaurant_email='$restaurant_email' AND restaurant_password='$restaurant_password'") OR die("query failed");
        if(empty($restaurant_email) OR empty($restaurant_password) )
        {
            $message = "Nothing can not be left blank";
        }
        else if( !filter_var($restaurant_email, FILTER_VALIDATE_EMAIL) )
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
                $mail->addAddress($restaurant_email);
        
                //Set email format to HTML
                $mail->isHTML(true);
        
                $device_info = $_SERVER['HTTP_USER_AGENT'];

                $mail->Subject = 'Security alert';
                $mail->Body    = 'Login request recived From : '.$device_info;
                //$mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
                $mail->send();
                // $row = mysqli_fetch_assoc($sql_query);
                // $_SESSION['user_id'] = $row['id'];
                header('location:Restaurant_admin_page.html');
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
    <title>Restaurant Login</title>
    <link rel="stylesheet" href="user_reg_log.css">
</head>

<body>
    <div class="form-container">
        <form action="" method="post">
            <?php
                 if(strlen($message)!=0)
                 echo '<div class="message">'.$message.'</div>';
            ?>
            <h3>Restaurant Login</h3>
            <label>Restaurant Email</label>
            <input type="email" name="restaurant_email" placeholder="E-mail" class="box">
            <label>Password</label>
            <input type="password" name="restaurant_password" placeholder="password" class="box">
            <input type="submit" name="submit"  value="Log in" class="btn">
            <p>Do not have an account? <a href="Restaurant_signup.php">SignUp now</a></p>
        </form>
    </div>
</body>
</html>