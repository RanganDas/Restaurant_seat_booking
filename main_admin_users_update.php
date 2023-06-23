<?php
    include('config.php');
    
    $id=$_GET['id'];

    if(isset($_POST['submit']))
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];

        $sql = "UPDATE users SET name='$name', email='$email', password='$password' WHERE id='$id'";
        $result = $conn->query($sql);
        header("location:main_admin_users.php");
    }
?>


<!DOCTYPE html>
<html>
<head>
 <title>Update Users</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" class="fw-bold">
      <div class="container-fluid">
        <a class="navbar-brand" href="main_admin_index.php">Registered Users</a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="main_admin_users.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="main_admin_create.php">Add New</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

 <div class="col-lg-6 m-auto">
 
 <?php
      $fetch = "";
      $id = $_GET['id'];
      $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$id'") or die('query failed');
      if(mysqli_num_rows($select) > 0)
      {
         $fetch = mysqli_fetch_assoc($select);
      }
  ?>
 <form method="post">
 
    <br><br><div class="card">
    
    <div class="card-header bg-warning">
    <h1 class="text-white text-center">  Update User Details </h1>
    </div><br>

    <label> NAME: </label>
    <input type="text" name="name" value="<?php echo $fetch['name']; ?>" class="form-control"> <br>

    <label> EMAIL: </label>
    <input type="text" name="email" value="<?php echo $fetch['email']; ?>" class="form-control"> <br>

    <label> PASSWORD: </label>
    <input type="text" name="password" value="<?php echo $fetch['password']; ?>" class="form-control"> <br>

    <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
    <a class="btn btn-info" type="submit" name="cancel" href="main_admin_users.php"> Cancel </a><br>

 </div>
 </form>
 </div>
</body>
</html>