<?php 

    require '../source/koneksi.php';
    $id = $_GET['id'];
    $idMeja = $_GET['idMeja'];
    $nama = $_GET['nama'];

    $sql = "DELETE FROM pesanan WHERE pesanan.id = $id";
    if(mysqli_query($conn,$sql)){
        header("location:cart.php?id=$idMeja&nama=$nama");
    }


?>