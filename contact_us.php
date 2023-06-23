<?php
     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\SMTP;
     use PHPMailer\PHPMailer\Exception;
  
     require 'PHPMailer/src/Exception.php';
     require 'PHPMailer/src/PHPMailer.php';
     require 'PHPMailer/src/SMTP.php';
     //from here we start our journey
    if(isset($_POST['submit']))
    {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];

        if(empty($fullname) OR empty($email) OR empty($phone) OR empty($message))
        {
            echo "<script>alert('Please fill up the form.Nothing can be left blan.k')</script>";
        }
        else
        {
            $conn=mysqli_connect("localhost","root", "", "testing");
            if(!$conn)
            {
                die("Connect Error".mysqli_connect_error());
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
                    $mail->setFrom('mondaltuhin532@gmail.com', 'bookintime-customer-support');
        
                    //Add a recipient
                    $mail->addAddress($email, $fullname);
        
                    //Set email format to HTML
                    $mail->isHTML(true);
        
                    $mail->Subject = 'Help Time';
                    $mail->Body    = 'Our team will contact you soon...';
        
                    $mail->send();
                    // echo 'Message has been sent';
        
                    // insert in users table
                    $sql = "INSERT INTO contact(fullname, email, phone, message) VALUES ('" . $fullname . "', '" . $email . "', '" . $phone . "',  '" . $message . "')";
                    mysqli_query($conn, $sql);
                    if (mysqli_affected_rows($conn) == 0)
                    {
                        die("Not Submitted.");
                    }
                    else
                    {
                        header('Location:source1.html');
                    }
                    exit();
                } 
                catch (Exception $e) 
                {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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
    <title>Responsive Contact Us Page Design using Html CSS</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="contact_us.css">
</head>
<body>
    <section id="section-wrapper">
        <div class="box-wrapper">
            <div class="info-wrap">
                <h2 class="info-title">Contact Information</h2>
                <h3 class="info-sub-title">Fill up the form and our Team will get back to you within 24 hours</h3>
                <ul class="info-details">
                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <span>Phone:</span> <a href="tel:+ 1235 2355 98">+ 1235 2355 98</a>
                    </li>
                    <li>
                        <i class="fas fa-paper-plane"></i>
                        <span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a>
                    </li>
                    <li>
                        <i class="fas fa-globe"></i>
                        <span>Website:</span> <a href="#">yoursite.com</a>
                    </li>
                </ul>
                <ul class="social-icons">
                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                </ul>
                <a href="source1.html" class="back-btn">Go back to home page</a>
            </div>
            <div class="form-wrap">
                <form action="contact_us.php" method="POST">
                    <h2 class="form-title">Submit Your Review</h2>
                    <div class="form-fields">
                        <div class="form-group">
                            <input type="text" name="fullname" class="fullname" placeholder="Full Name">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="email" placeholder="Mail">
                        </div>
                        <div class="form-group">
                            <input type="number" name="phone" class="phone" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <textarea name="message" id="" placeholder="Write your message"></textarea>
                        </div>
                    </div>
                    <input type="submit" name="submit" value="Submit" class="submit-button">
                </form>
            </div>
        </div>
    </section>
</body>
</html>