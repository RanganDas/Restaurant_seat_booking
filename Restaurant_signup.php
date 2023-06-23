<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
     
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    include("config.php");
    $message = "";
    if(isset($_POST['submit']))
    {
        $restaurant_name = $_POST['restaurant_name'];
        $restaurant_email = $_POST['restaurant_email'];
        $restaurant_number = $_POST['restaurant_number'];
        $restaurant_type = $_POST['restaurant_type'];
        $address = $_POST['address'];
        $pincode = $_POST['pincode'];
        $owner_name = $_POST['owner_name'];
        $owner_email = $_POST['owner_email'];
        $owner_number = $_POST['owner_number'];
        $open_time = $_POST['open_time'];
        $close_time = $_POST['close_time'];
        $close_day = $_POST['close_day'];
        $restaurant_password = $_POST['restaurant_password'];
        $close_days = "";
        foreach($close_day as $data)
        {
            $close_days .= $data . ",";
        }
        // -------validating every things-------------
        
        // if(empty($restaurant_name) OR empty($restaurant_email) OR empty($restaurant_number) OR empty($address) 
        // OR empty($pincode) OR empty($owner_name) OR empty($owner_email) OR empty($owner_number) OR 
        // empty($open_time) OR empty($close_time) OR empty($close_day) OR empty($restaurant_password))
        // {
        //     $message = "Please fill all the blank fields";
        // }
        if(!preg_match("/^[a-zA-z\s]+$/", $restaurant_name)) 
        {
            $message = "Enter alphabets only for Restaurant name";
        }
        else if(!preg_match("/^[a-zA-z\s]+$/", $owner_name)) 
        {
            $message = "Enter alphabets only for Owner name";
        }
        else if( !filter_var($restaurant_email, FILTER_VALIDATE_EMAIL) )
        {
            $message = "Enter valid email for Restaurant";
        }
        else if( !filter_var($owner_email, FILTER_VALIDATE_EMAIL) )
        {
            $message = "Enter valid email for Owner";
        }
        else if(strlen($restaurant_number)>10 OR strlen($restaurant_number)<10)
        {
            $message =   "Restaurant number must 10 digits."; 
        }
        else if(strlen($owner_number)>10 OR strlen($owner_number)<10)
        {
            $message =  "Owner number must 10 digits."; 
        }
        else if(strlen($pincode)>6 OR strlen($pincode)<6)
        {
            $message =  "Pin Code Must Be 6 digits.";
        }
        else if(!preg_match("/^[0-9]{6}$/", $pincode)) 
        {
            $message = "Pin Code contains only numbers not other characters.";
        }
        else if(strlen($restaurant_password)<6)
        {
            $message = "password must be at least 6 characters long. Fill again";
        }
        else if($restaurant_name==$owner_name)
        {
            $message = "Owner Name and Restaurant Name Cannot be Same";
        }
        else if($restaurant_email==$owner_email)
        {
            $message = "Owner Email and Restaurant Email Cannot be Same";
        }
        else if($open_time==$close_time)
        {
            $message = "Opening and Closing time Cannon be same.";
        }
        else
        {
            $sql_query = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE restaurant_email='$restaurant_email' ") OR die("query failed");
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
                    $mail->addAddress($restaurant_email, $restaurant_name);
        
                    //Set email format to HTML
                    $mail->isHTML(true);
        
                    $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        
                    $mail->Subject = 'Email verification';
                    $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
        
                    $mail->send();

                    // insert in users table
                    // $sql = "INSERT INTO users(name, email, password, verification_code, email_verified_at) VALUES ('" . $name . "', '" . $email . "', '" . $password . "',  '" . $verification_code . "', NULL)";
                    $sql = "INSERT INTO restaurant(restaurant_name, restaurant_email, restaurant_number, restaurant_type, 
                            address, pincode, owner_name, owner_email, owner_number, open_time, close_time, close_day, 
                            restaurant_password, verification_code, email_verified_at) 
                            VALUES ('" . $restaurant_name . "', '" . $restaurant_email . "', '" . $restaurant_number . "', '" . $restaurant_type . "',
                            '" . $address . "', '" . $pincode . "', '" . $owner_name . "',  '" . $owner_email . "',
                            '" . $owner_number . "', '" . $open_time . "', '" . $close_time . "',  '" . $close_days . "', '" . $restaurant_password . "',
                            '" . $verification_code . "', NULL)";
                    mysqli_query($conn, $sql);
                    
                    header("Location: Restaurant_Email_verify.php?restaurant_email=" . $restaurant_email);
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
    <title>Restaurant SignUp</title>
    <link rel="stylesheet" href="user_reg_log.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <?php
                 if(strlen($message)!=0)
                 echo '<div class="message">'.$message.'</div>';
            ?>
<!-- ---------------------------------------------------------------- -->
            <h3>Restaurant Details</h3>
            <label>Restaurant Name</label>
            <input type="text" placeholder="Name" name="restaurant_name" class="box">
            <label>Restaurant Email</label>
            <input type="email" placeholder="E-mail" name="restaurant_email" class="box">
            <label>Restaurant Phone Number</label>
            <input type="number" placeholder="Phone Number" name="restaurant_number" class="box">
            <label>Restaurant Type</label>
            <select name="restaurant_type" id="" class="box">
                <option value="Prime">Prime</option>
                <option value="Non Prime">Non Prime</option>
            </select>
            <label>Restaurant Address</label>
            <input type="text" placeholder="Address" name="address" class="box">
            <label>Restaurant Pin Code</label>
            <input type="text" placeholder="pincode" name="pincode" class="box">
<!-- ------------------------------------------------------------------------------------>
            <h3>Owner Details</h3>
            <label>Owner Name</label>
            <input type="text" placeholder="Full-Name" name="owner_name" class="box">
            <label>Owner Email</label>
            <input type="email" placeholder="E-mail" name="owner_email" class="box">
            <label>Owner Phone Number</label>
            <input type="number" placeholder="Phone Number" name="owner_number" class="box">
<!-- --------------------------------------------------------------------------------------- -->
            <h3>Restaurant Operational Hours</h3>
            <label>Opening Time</label>
            <input type="time" placeholder="Full-Name" name="open_time" class="box">
            <label>Closing Time</label>
            <input type="time" placeholder="Full-Name" name="close_time" class="box">
            <br>
            <label> <b>Closed Day</b></label>
            <br>
            <b><input type="checkbox" value="Sunday" name="close_day[]">Sunday</b> 
            <b><input type="checkbox" value="Monday" name="close_day[]">Monday</b>
            <b><input type="checkbox" value="Tuesday" name="close_day[]">Tuesday</b>
            <b><input type="checkbox" value="Webnesday" name="close_day[]">Webnesday</b>
            <b><input type="checkbox" value="Thursday" name="close_day[]">Thursday</b>
            <b><input type="checkbox" value="Friday" name="close_day[]">Friday</b>
            <b><input type="checkbox" value="Saturday" name="close_day[]">Saturday</b>
<!-- -------------------------------------------------------------------------- -->
            <br><label>Create Password</label>
            <input type="password" name="restaurant_password" placeholder='Password' class="box">
            <input type="submit" name="submit"  value="Sign up" class="btn">
            <p>Already have an account? <a href="Restaurant_login.php">Login now</a></p>
        </form>
    </div>
</body>
</html>