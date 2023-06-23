<?php
    include('config.php');
    
    $id=$_GET['id'];

    if(isset($_POST['submit']))
    {
        $name=$_POST['restaurant_name'];
        $email=$_POST['restaurant_email'];
        $number=$_POST['restaurant_number'];
        $address=$_POST['address'];
        $pin=$_POST['pincode'];

        $sql = "UPDATE restaurant SET restaurant_name='$name', restaurant_email='$email', restaurant_number='$number', 
           address='$address', pincode='$pin' WHERE id='$id'";
        $result = $conn->query($sql);
        header("location:main_admin_index.php");
    }
?>


<!DOCTYPE html>
<html>
<head>
 <title>CRUD</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" class="fw-bold">
      <div class="container-fluid">
        <a class="navbar-brand" href="main_admin_index.php">PHP CRUD OPERATION</a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="main_admin_index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="create.php">Add New</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

 <div class="col-lg-6 m-auto">
 
 <?php
      $fetch = "";
      $id = $_GET['id'];
      $select = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE id = '$id'") or die('query failed');
      if(mysqli_num_rows($select) > 0)
      {
         $fetch = mysqli_fetch_assoc($select);
      }
  ?>
 <form method="post">
 
    <br><br><div class="card">
    
    <div class="card-header bg-warning">
    <h1 class="text-white text-center">  Update Restaurant </h1>
    </div><br>

    <label> NAME: </label>
    <input type="text" name="restaurant_name" value="<?php echo $fetch['restaurant_name']; ?>" class="form-control"> <br>

    <label> EMAIL: </label>
    <input type="text" name="restaurant_email" value="<?php echo $fetch['restaurant_email']; ?>" class="form-control"> <br>

    <label> PHONE: </label>
    <input type="text" name="restaurant_number" value="<?php echo $fetch['restaurant_number']; ?>" class="form-control"> <br>

    <label> Address: </label>
    <input type="text" name="address" value="<?php echo $fetch['address']; ?>" class="form-control"> <br>

    <label> Pin: </label>
    <input type="text" name="pincode" value="<?php echo $fetch['pincode']; ?>" class="form-control"> <br>

    <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
    <a class="btn btn-info" type="submit" name="cancel" href="main_admin_index.php"> Cancel </a><br>

 </div>
 </form>
 </div>
</body>
</html>