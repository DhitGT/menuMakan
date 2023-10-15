<?php
session_start();
$nama = $_SESSION['namaMeja'];
$idMeja = $_SESSION['idMeja'];
require '../source/koneksi.php';
if(check()){
    $sql = "SELECT pesanan.*, menu.Gambar, menu.Nama, menu.Harga, menu.Porsi FROM pesanan INNER JOIN menu ON pesanan.IdMenu = menu.Id WHERE pesanan.IdMeja = '$idMeja' AND pesanan.Status = 'checkout' OR pesanan.Status = 'selesai'";
    
    $result = mysqli_query($conn,$sql);
    $totalBayar= 0;
}else{
    header("location:logout.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wait Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../source/css/style.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h1 align='center'>Wait Room</h1>
            <hr>
            <p>Hai <?php echo $nama ?> makanan kamu sedang di masak, Di tunggu yah :D</p>
            <b>
                <p>Kamu sudah bisa meninggalkan halaman ini Kok 😉</p>
            </b>
            <hr>
            <h5>Rincian Pesanan</h5>
            <?php foreach ($result as $res): ?>
                <?php $totalBayar += $res['Harga'] * $res['Jumlah']?>
                <div class="menu-item list-wait">
                    <div class="menu-item-left">
                        <img src="../source/img/<?php echo $res['Gambar'] ?>" alt="">
                    </div>
                    <div class="menu-item-right">
                        <p><?php echo $res['Nama'] ?> - <span><?php echo $res['Porsi'] ?></span></p>
                        <p>X<?php echo $res['Jumlah'] ?></p>
                        <p><?php echo ToIdr($res['Harga']) ?></p>
                    </div>
                </div>
            <?php endforeach ?>
            
            <hr>
            <h5>Total : <?php echo ToIdr($totalBayar) ?></h5>
        </div>
    </div>


    <script src="../source/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>