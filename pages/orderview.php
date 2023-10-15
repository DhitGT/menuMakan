<?php
require '../source/koneksi.php';
$sql = "SELECT pesanan.Id, meja.Id as MejaId, Pelangan.Nama, menu.Nama, pesanan.Level, menu.Porsi, menu.Harga, pesanan.Jumlah FROM pesanan INNER JOIN meja INNER JOIN menu INNER JOIN pelangan ON pesanan.IdMeja = meja.Id AND meja.IdPelangan = pelangan.Id AND pesanan.IdMenu = menu.Id WHERE pesanan.Status = 'checkout'";
$result = mysqli_query($conn, $sql);

// Inisialisasi array untuk menyimpan data berdasarkan IdMeja
$dataPerMeja = array();

// Loop through hasil kueri
while ($row = mysqli_fetch_assoc($result)) {
    $idMeja = $row['MejaId'];

    // Buat array untuk setiap IdMeja jika belum ada
    if (!isset($dataPerMeja[$idMeja])) {
        $dataPerMeja[$idMeja] = array();
    }

    // Tambahkan data ke array berdasarkan IdMeja
    $dataPerMeja[$idMeja][] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../source/css/style.css">
</head>

<body>
    <div class="container">
        <h1>Order View</h1>
        <div class="card card-order">
            <?php foreach ($dataPerMeja as $idMeja => $data) : ?>
                <div class="order-section">
                    <h1>Meja <?php echo $idMeja; ?></h1>
                    <hr>

                    <!-- Loop through data for each IdMeja to display OrderItems -->
                    <?php foreach ($data as $row) : ?>
                        <div class="order-item">
                            <div class="order-item-left">
                                <h5><?php echo $row['Nama']; ?></h5>
                            </div>
                            <div class="order-item-right">
                                <ul>
                                    <li>Level : <?php echo $row['Level']; ?></li>
                                    <li>Porsi : <?php echo $row['Porsi']; ?></li>
                                    <li>Jumlah : <?php echo $row['Jumlah']; ?></li>
                                </ul>
                                <div class="btninput d-flex">
                                    <a class="btn btn-outline-success" href="selesaiOrder.php?id=<?php echo $row['Id'] ?>">Selesai</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
    <script src="../source/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>