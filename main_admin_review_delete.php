<?php   
 include 'config.php';  
 if (isset($_GET['id'])) {  
      $id = $_GET['id'];  
      $query = "DELETE FROM `contact` WHERE id = '$id'";  
      $run = mysqli_query($conn,$query);  
      if ($run) 
      {  
           header('location:main_admin_show_review.php');  
      }
      else
      {  
           echo "Error: ".mysqli_error($conn);  
      }  
 }  
 ?>  