<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
 
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    include("config.php");
    $message="";
    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if(empty($name) OR  empty($email) OR empty($password) OR empty($cpassword))
        {
            $message = "Please fill all the fields.......";
        }
        else if(!preg_match("/^[a-zA-z\s]+$/", $name)) 
        {
            $message = "Enter alphabets only for full name";
        }
        else if( !filter_var($email, FILTER_VALIDATE_EMAIL) )
        {
            $message = "Enter valid email";
        }
        else if(strlen($password)<6)
        {
            $message = "password must be at least 6 characters long. Fill again";
        }
        else if($password != $cpassword)
        {
            $message = "confirm password not matched";
        }
        else
        {
            $sql_query = mysqli_query($conn, "SELECT * FROM `users` WHERE email='$email' ") OR die("query failed");
            if(mysqli_num_rows($sql_query)>0)
            {
                $message = "Email is already registered.....";
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
                    $mail->setFrom('mondaltuhin532@gmail.com', 'Mailer');
        
                    //Add a recipient
                    $mail->addAddress($email, $name);
        
                    //Set email format to HTML
                    $mail->isHTML(true);
        
                    $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        
                    $mail->Subject = 'Email verification';
                    $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
        
                    $mail->send();

                    // insert in users table
                    $sql = "INSERT INTO users(name, email, password, verification_code, email_verified_at) VALUES ('" . $name . "', '" . $email . "', '" . $password . "',  '" . $verification_code . "', NULL)";
                    mysqli_query($conn, $sql);
                    
                    header("Location: email-verification.php?email=" . $email);
                    exit();
                } 
                catch (Exception $e) 
                {
                    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    $message = "Please fill the blanks";
                }
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>
    <link rel="stylesheet" href="user_reg_log.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Sign Up</h3>
            <?php
            if(strlen($message)!=0)
                 echo '<div class="message">'.$message.'</div>';
            ?>
            <label>Enter Full Name</label>
            <input type="text" placeholder="Full Name" name="name" class="box">
            <label>Enter Email</label>
            <input type="email" placeholder="E-mail" name="email" class="box">
            <label>Enter Password</label>
            <input type="password" placeholder="Password" name="password" class="box">
            <label>Confirm Password</label>
            <input type="password" placeholder="Confirm Password" name="cpassword" class="box">
            <input type="submit" name="submit"  value="Sign up" class="btn">
            <p>Already have an account? <a href="user_login.php">Login now</a></p>
        </form>
    </div>
</body>
</html>