<?php 
    require '../source/koneksi.php';
    $idPesanan = $_GET['id'];
    $sql = "UPDATE `pesanan` SET `Status` = 'selesai' WHERE `pesanan`.`Id` = '$idPesanan'";
    if(mysqli_query($conn,$sql)){
        header("location:orderView.php");
    }



?>