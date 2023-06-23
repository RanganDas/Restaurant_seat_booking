<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Admin Page</title>
    <link rel="stylesheet" href="main_admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
</head>
<body>
      <!-- -----navbar---- -->
      <nav class="navbar">
           <h4>Dashboard</h4>
           <div class="profile">
                <img src="plate1.png" alt="" class="profile-image">
                <p class="profile-name">
                    Hello, Admin
                </p>
           </div>
      </nav>

      <!-- -----sidebar---- -->
      <input type="checkbox" id="toggle">
      <label class="side-toggle" for="toggle"><span class="fas fa-bars"></span></label>
      
      <div class="sidebar">
        <a href="main_adim_profile.php">
            <div class="sidebar-menu">
                    <span class="fas fa-user"></span>
                    <p>Update Profile</p>
            </div>
       </a>
       <a href="main_admin_index.php">
            <div class="sidebar-menu">
                    <span class="fas fa-chair"></span>
                    <p>Manage Restaurants</p>
            </div>
        </a>
        <a href="main_admin_users.php">
            <div class="sidebar-menu">
                    <span class="fas fa-users"></span>
                    <p>Manage Users</p>
            </div>
        </a>
        <a href="main_admin_show_review.php">
            <div class="sidebar-menu">
                    <span class="fas fa-comments"></span>
                    <p>Manage Reviews</p>
            </div>
        </a>
        <a href="home_page.html">
            <div class="sidebar-menu">
                    <span class="fas fa-home"></span>
                    <p>Log Out</p>
            </div>
        </a>
      </div>
      <!-- -----main dashboard---- -->
      <main>
           <div class="dashboard-container">
                <!-- -------------4 cards top------- -->
                <div class="card total1" >
                    <div class="info">
                        <div class="info-detail">
                            <h3>Total Prime Restaurant</h3>
                            <h2>
                            <?php
                                include('config.php');
                                $sql_query = "select * from restaurant";
                                $result = mysqli_query($conn, $sql_query);
                                $value = 0;
                                if(mysqli_num_rows($result)>0)
                                {
                                    while($row = mysqli_fetch_assoc($result))
                                    { 
                                        if($row['restaurant_type']=="Prime")
                                        {             
                                            $value = $value+1;
                                        }
                                    }
                                    echo $value;     
                                }
                            ?>
                            </h2>
                        </div>
                        <div class="info-image">
                            <i class="fas fa-chair"></i>
                        </div>
                    </div>
                </div>
                <div class="card total2" >
                    <div class="info">
                        <div class="info-detail">
                            <h3>Total Non Prime Restaurants</h3>
                            <h2>
                            <?php
                                include('config.php');
                                $sql_query = "select * from restaurant";
                                $result = mysqli_query($conn, $sql_query);
                                $value_np = 0;
                                if(mysqli_num_rows($result)>0)
                                {
                                    while($row = mysqli_fetch_assoc($result))
                                    { 
                                        if($row['restaurant_type']=="Non Prime")
                                        {             
                                            $value_np = $value_np+1;
                                        }
                                    }
                                    echo $value_np;     
                                }
                            ?>
                            </h2>
                        </div>
                        <div class="info-image">
                            <i class="fas fa-chair"></i>
                        </div>
                    </div>
                </div>
                <div class="card total3" >
                    <div class="info">
                        <div class="info-detail">
                            <h3>Total Reviews</h3>
                            <h2>
                            <?php
                                include('config.php');
                                $sql_query = "select * from contact";
                                $result = mysqli_query($conn, $sql_query);
                                $tot_rev = 0;
                                if(mysqli_num_rows($result)>0)
                                {
                                    while($row = mysqli_fetch_assoc($result))
                                    { 
                                        $tot_rev = $tot_rev+1;
                                    }
                                    echo $tot_rev;     
                                }
                            ?>
                            </h2>
                        </div>
                        <div class="info-image">
                            <i class="fas fa-message"></i>
                        </div>
                    </div>
                </div>
                <div class="card total4" >
                    <div class="info">
                        <div class="info-detail">
                            <h3>Total User</h3>
                            <h2>
                            <?php
                                include('config.php');
                                $sql_query = "select * from users";
                                $result = mysqli_query($conn, $sql_query);
                                $tot_user = 0;
                                if(mysqli_num_rows($result)>0)
                                {
                                    while($row = mysqli_fetch_assoc($result))
                                    { 
                                        $tot_user = $tot_user+1;
                                    }
                                    echo $tot_user;     
                                }
                            ?>
                            </h2>
                        </div>
                        <div class="info-image">
                            <i class="fas fa-user-friends"></i>
                        </div>
                    </div>
                </div>
                <!-- --------------2 cards bottom------ -->
                <div class="card detail">
                    <div class="detail-header">
                        <h2>All Reviews</h2>
                    </div>
                    <table>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                        </tr>
                        <?php
                            include('config.php');
                            $sql_query = "select * from contact";
                            $result = mysqli_query($conn, $sql_query);
                            $tot_user = 0;  
                            if(mysqli_num_rows($result)>0)
                            {
                                while($row = mysqli_fetch_assoc($result))
                                { 
                                    echo "<tr>
                                            <th>".$row['id']."</th>
                                            <th>".$row['fullname']."</th>
                                            <th>".$row['email']."</th>
                                            <th>".$row['phone']."</th>
                                            <th>".$row['message']."</th>
                                        </tr>";
                                }  
                            }
                        ?>
                    </table>
                </div>
           </div>
      </main>
</body>
</html>