<?php
session_start();

    // if (!isset($_SESSION['login']) || $_SESSION['login'] != 'admin') {
    //     header('location:logout.php');
    // }

    require '../source/koneksi.php';
    if(isset($_POST['cek'])){
        $nama = $_POST['nama'];
        $totalBayar = 0;
        $sql = "SELECT * FROM pelangan WHERE Nama = '$nama'";
        $res = mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)){
            $idMeja = mysqli_fetch_assoc($res)['Meja'];
            $sqlHarga = "SELECT menu.Harga, pesanan.Jumlah FROM pesanan INNER JOIN menu ON pesanan.IdMenu = menu.Id WHERE pesanan.IdMeja = '$idMeja'";
            $resHarga = mysqli_query($conn,$sqlHarga);
            foreach($resHarga as $resH){
                $totalBayar += $resH['Harga'] * $resH['Jumlah'];
            }
        }
    }

    if(isset($_POST['submit'])){
        $nama = $_POST['nama'];
        $sql = "DELETE meja, pesanan, pelangan FROM meja JOIN pesanan JOIN pelangan ON meja.Id = pesanan.IdMeja AND pelangan.Meja = meja.Id WHERE pelangan.Nama = '$nama'";
        if(mysqli_query($conn,$sql)){
            $nama = '';
            echo "<script>alert('Pesanan Selesai')</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../source/css/style.css">
</head>

<body>
    <div class="container">
        <h1 align="center">Selesai</h1>
        <form action="" method="post">
            <label for="nama" class="form-label">Nama</label>
            <br>
            <input name="nama" type="text" class="form-control" value="<?php echo isset($_POST['nama'])?$_POST['nama'] : '' ?>">

            <button class="btn btn-info mt-3 mb-3 w-50" name="cek">Cek</button>
            <br>
            <label for="total" class="form-label">Total</label>
            <br>
            <p name="total" class="form-control" value="">
                <?php echo isset($totalBayar)?ToIdr($totalBayar) : 'Rp. 0' ?>
            </p>
            <button class="btn btn-primary form-control mt-5" type="submit" name="submit">Selesai</button>
        </form>

    </div>
    <script src="../source/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>