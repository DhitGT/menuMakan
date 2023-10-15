<?php 
    session_start();
    $idMeja = $_GET['id'];
    $namaMeja = $_SESSION['namaMeja']; 
    require '../source/koneksi.php';
    if(check()){
        $sqlCart = "SELECT pesanan.Id, meja.Id as MejaId, Pelangan.Nama, menu.Nama, pesanan.Level, menu.Porsi, menu.Harga, pesanan.Jumlah FROM pesanan INNER JOIN meja INNER JOIN menu INNER JOIN pelangan ON pesanan.IdMeja = meja.Id AND meja.IdPelangan = pelangan.Id AND pesanan.IdMenu = menu.Id WHERE pesanan.idMeja = $idMeja AND pesanan.Status = 'cart'" ;
        
        $resultCart = mysqli_query($conn,$sqlCart);
        $totalharga= 0;

    }else{
        header('location:logout.php');
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../source/css/style.css">
</head>

<body>
    <div class="container">
        <div class="cart">
            <h1>Cart</h1>
            <p>Meja <?php echo $idMeja ?></p>
            <hr>
            <div class="card card-menu">
                <?php foreach ($resultCart as $resC) : ?>
                    <?php $totalharga += $resC['Harga'] * $resC['Jumlah'] ?>
                    <div class="card-menu-item bo-1">
                        <div class="card-menu-bottom">
                            <h4><?php echo $resC['Nama']  ?><span> | <?php echo ToIdr($resC['Harga']) ?></span> </h4>
                            
                            <hr>
                            <ul>
                                <li>Level : <?php echo $resC['Level'] ?></li>
                                <li>Ukuran : <?php echo $resC['Porsi'] ?></li>
                                <li>Jumlah : <?php echo $resC['Jumlah'] ?></li>
                            </ul>
                            <?php $total = $resC['Harga'] * $resC['Jumlah'] ?>
                            <p>total : <?php echo ToIdr($total) ?></p>
                            <?php $idPesanan = $resC['Id'] ?>
                            <a href="deletePesanan.php?id=<?php echo $idPesanan ?>&nama=<?php echo $namaMeja ?>&idMeja=<?php echo $idMeja ?>" class="btn btn-danger">Hapus</a>
                        </div>
                    </div>
                <?php endforeach ?>

                <h5>Total Harga :<span><?php echo ToIdr($totalharga) ?></span></h5>
                <a class="btn btn-warning" href="meja.php?id=<?php $idMeja ?>&nama=<?php $namaMeja ?>">Back</a>
            </div>
        </div>
    </div>



    <script src="../source/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>