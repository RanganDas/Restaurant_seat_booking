<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Edit Details</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <p class="navbar-brand">Registered Restaurants</p>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="main_admin.php">Home</a>
            </li>
            <li class="nav-item">
              <a type="button" class="btn btn-primary nav-link active" href="main_admin_create.php">Add New</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container my-4">
    <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>NAME</th>
        <th>EMAIL</th>
        <th>PHONE</th>
        <th>Address</th>
        <th>Pin</th>
        <th>JOINING DATE</th>
        <th>ACTIONS</th>
      </tr>
    </thead>
    <tbody>
      <?php
        include "config.php";
        $sql = "select * from restaurant";
        $result = $conn->query($sql);
        if(!$result){
          die("Invalid query!");
        }
        while($row=$result->fetch_assoc()){
          echo "
      <tr>
        <th>$row[id]</th>
        <td>$row[restaurant_name]</td>
        <td>$row[restaurant_email]</td>
        <td>$row[restaurant_number]</td>
        <td>$row[address]</td>
        <td>$row[pincode]</td>
        <td>$row[email_verified_at]</td>
        <td>
                  <a class='btn btn-success' href='main_admin_update.php?id=$row[id]'>Edit</a>
                  <a class='btn btn-danger' href='main_admin_delete.php?id=$row[id]'>Delete</a>
                </td>
      </tr>
      ";
        }
      ?>
    </tbody>
  </table>
      </div>
    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>