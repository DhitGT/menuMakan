<?php
    session_start();    
    if(!isset($_SESSION['login']) || $_SESSION['login'] != 'admin'){
        header('location:logout.php');
    }
    require '../source/koneksi.php';
    $id = $_GET['Id'];
    $sql = "DELETE FROM users WHERE `id` = $id";
    mysqli_query($conn,$sql);
    header('location:viewAllUser.php');


?>