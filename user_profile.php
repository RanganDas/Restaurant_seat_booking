<?php
    include 'config.php';
    session_start();
    $user_id = $_SESSION['user_id'];
    if(!isset($user_id))
    {
        header('location:user_login.php');
    }
    if(isset($_GET['logout']))
    {
        unset($user_id);
        session_destroy();
        header('location:user_login.php');
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="user_reg_log.css">
</head>
<body>
    <div class="container">
        <div class="profile">
            <?php
                $select = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($select) > 0)
                {
                    $fetch = mysqli_fetch_assoc($select);
                }
            ?>
            <img src="user_icon.png" alt="">
            <h2><center>Your Profile</center></h2>
            <h3><?php echo "Name : ".$fetch['name']; ?></h3>
            <h3><?php echo "Email : ".$fetch['email']; ?></h3>
            <h3><?php echo "Pasword : ".$fetch['password']; ?></h3>
            <a href="update_profile.php" class="btn">update profile</a>
            <a href="home_page.html?logout=<?php echo $user_id; ?>" class="delete-btn">logout</a>
            <a href="source1.html" class="delete-btn">Back</a>
            <p>new <a href="user_login.php">login</a> or <a href="user_signup.php">register</a></p>
        </div>
    </div>
</body>
</html>