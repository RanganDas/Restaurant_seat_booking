<?php
    include "config.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE from `restaurant` where id=$id";
        $conn->query($sql);
    }
    header('location:main_admin_index.php');
    exit;
?>
