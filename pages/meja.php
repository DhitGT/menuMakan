<?php
session_start();
require '../source/koneksi.php';
if(check()){
    if (isset($_SESSION['idMeja'])) {
        $idMeja = $_SESSION['idMeja'];
        $userName = $_SESSION['namaMeja'];
    
        $sql  = "SELECT *, MIN(Porsi) AS Porsi, MIN(Harga) AS Harga
            FROM menu
            GROUP BY Nama;";
        $resultMakanan  = mysqli_query($conn, $sql);
    
        if (isset($_POST['submit'])) {
            $idMenu = 0;
            $namaMenu = $_POST['namaMenu'];
            $level = isset($_POST['Level']) ? $_POST['Level'] : '0';
            $porsi = isset($_POST['porsi']) ? $_POST['porsi'] : 'Kecil';
            $jumlah = $_POST['jumlah'];
    
            $getIdMenuSql = "SELECT Id FROM menu WHERE Nama = '$namaMenu' AND Porsi = '$porsi'";
            $idMenuRes = mysqli_fetch_assoc(mysqli_query($conn, $getIdMenuSql));
            $idMenu = $idMenuRes['Id'];
            $sqlAddToCart = "INSERT INTO pesanan VALUES ('','$idMeja','$idMenu','$jumlah','$level','cart')";
            if (mysqli_query($conn, $sqlAddToCart)) {
                echo "<script>alert('Makanan Ditambahkan Ke Cart')</script>";
            }
        }
    
        if (isset($_POST['pesan'])) {
            $sqlCheckout = "UPDATE `pesanan` SET `Status` = 'checkout' WHERE pesanan.IdMeja = '$idMeja' AND pesanan.Status = 'cart'";
            if (mysqli_query($conn, $sqlCheckout)) {
                header("location:waitpage.php");
            }
        }
    }else{
        header("location:verifmeja.php?id=1");
    }
}else{
    header("location:logout.php");
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../source/css/style.css">
</head>

<body>
    <div class="container">
        <h1 align="left">Menu</h1>
        <p align="left">Meja <?php echo $idMeja ?></p>
        Haii <?php echo $userName ?> Silahkan Di pilih :D</p>
        <hr>
        <div class="nav">
            <ul>
                <li>
                    <a href="#makanan">Makanan</a>
                </li>
                <li>
                    <a href="#minuman">Minuman</a>
                </li>
                <li>
                    <a href="#dessert">Dessert</a>
                </li>
            </ul>
        </div>
        <section id="makanan">
            <h4 class="mt-2">Makanan</h4>
            <div class="card menu mt-3 w-auto">
                <?php foreach ($resultMakanan as $res) : ?>
                    <?php
                    $nama = $res['Nama'];
                    $sqlk = "SELECT * FROM menu WHERE Nama = '$nama' ORDER BY Porsi ASC";
                    $resk = mysqli_query($conn, $sqlk);
                    $sqlQ = "SELECT Harga FROM menu WHERE Nama = '$nama' ORDER BY Harga DESC LIMIT 1;";
                    $resQ = mysqli_fetch_assoc(mysqli_query($conn, $sqlQ));

                    $nowPrice = $res['Harga'] . " - " . $resQ['Harga'];
                    ?>
                    <div class="card menu-item">
                        <div class="menu-item-head" id=<?php echo $res['Id'] ?>>
                            <div class="gradient">
                                <p class="menu-item-title"><?php echo $res['Nama'] ?></p>
                                <span>Rp.<?php echo $nowPrice ?></span>
                            </div>
                        </div>
                        <div class="menu-item-bottom">
                            <hr>
                            <div class="info-close">
                                <form method="post">
                                    <input type="hidden" name="idMenu" value="<?php echo $res['Id'] ?>">
                                    <input type="hidden" name="namaMenu" value="<?php echo $res['Nama'] ?>">
                                    <?php if ($res['IsLevel'] == 1) : ?>
                                        <label for="Level">Level</label>
                                        <select name="Level" id="Level" class="dropdown form-control">
                                            <?php for ($i = 1; $i <= $res['Level']; $i++) : ?>
                                                <option name="Level" value="<?php echo $i ?>">Level <?php echo $i ?></option>
                                            <?php endfor ?>
                                        </select>
                                    <?php endif ?>
                                    <?php if ($res['IsSize'] == 1) : ?>
                                        <label for="porsi">Porsi</label>
                                        <select name="porsi" id="porsi" class="dropdown form-control">
                                            <?php

                                            while ($rest = mysqli_fetch_assoc($resk)) {
                                                $price = $rest["Harga"];
                                                $porsi = $rest["Porsi"];
                                                echo "<option value='$porsi' name='porsi'>$porsi ( Rp.$price )</option>";
                                            }
                                            ?>
                                        </select>
                                    <?php endif ?>
                                    <label for="jumlah" class="form-label ">Jumlah</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control dropdown" value="1">
                                    <button name="submit" class="btn btn-success w-100">+</button>
                                </form>
                            </div>
                        </div>
                        <script>
                            var element = document.getElementById(<?php echo $res['Id'] ?>)
                            var url = '../source/img/<?php echo $res['Gambar'] ?>'
                            element.style.backgroundImage = 'url(' + url + ')'
                        </script>
                    </div>
                <?php endforeach ?>


        </section>
        <section id="minuman">
            <h4 class="mt-2">Minuman</h4>


        </section>
        <section id="dessert">
            <h4 class="mt-2">Dessert</h4>


        </section>



    </div>

    <div class="order d-flex w-100">
        <form action="cart.php?id=<?php echo $idMeja ?>&nama=<?php echo $userName ?>" method="post">
            <button class="btn btn-warning me-2" name='cart'>Cart</button>
        </form>
        <form action="" method="post">
            <button class="btn btn-success w-100" name="pesan">Pesan</button>
        </form>
    </div>

    <script src="../source/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>