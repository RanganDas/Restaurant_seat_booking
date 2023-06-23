<?php
    include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Non Prime Restaurants</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="Restaurant_list.css">

</head>
<body>
    
<div class="container">

    <h1 class="heading">Our Non Prime Restaurants</h1>

    <div class="box-container">

    <?php
        $sql_query = "select * from restaurant";
        $result = mysqli_query($conn, $sql_query);

        if(mysqli_num_rows($result)>0)
        {
            while($row = mysqli_fetch_assoc($result))
            { 
                if($row['restaurant_type']=="Non Prime")
                {
                    echo 
                    ' <div class="box">
                      <img src="plate1.png">
                     <h3>'.$row['restaurant_name'].'</h3>
                    <p>'.$row['address'].'</p>
                    <a href="Restaurant_booking_page.php?vname='.$row["restaurant_email"].'" class="btn">Book Now</a><br>
                    <a href="#" class="btn">read more</a></div>';
                }
            }
        }
    ?>

    </div>

</div>

</body>
</html>