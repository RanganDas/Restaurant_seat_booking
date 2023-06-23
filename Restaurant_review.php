<?php
    include('config.php');
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reviews</title>
    <link rel="stylesheet" href="Restaurant_review.css" />
</head>

<body>
    <h3><center>Customer Reviews</center></h3>
    <div class="header_fixed">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql_query = "select * from contact";
                    $result = mysqli_query($conn, $sql_query);
                    if(mysqli_num_rows($result)>0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo "\t<tr>
                                <td>".$row['id']."</td>
                                <td>".$row['fullname']."</td>
                                <td>".$row['email']."</td>
                                <td>".$row['phone']."</td>
                                <td>".$row['message']."</td>
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>