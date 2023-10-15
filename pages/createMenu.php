<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] != 'admin') {
    header('location:logout.php');
}

if (isset($_POST['submit'])) {

    require_once '../source/koneksi.php';
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $level = $_POST['level'];
    $islevel = isset($_POST['isLevel']) ? $_POST['isLevel'] : '0' ;
    $ukuran = $_POST['ukuran'];
    $isUkuran = isset($_POST['isUkuran']) ? $_POST['isUkuran'] : '0' ;
    $gambar = $_FILES['gambar']['name'];
    $getId = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM menu"));
    $gambarSql = strval(($getId+1)) . $gambar;
    $jenis = $_POST['jenis'];

    $targetDir = "../source/img/";

    $targetFile = $targetDir . strval(($getId+1)) . basename($_FILES["gambar"]["name"] );
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
        echo "The file " . basename($_FILES["gambar"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    $sql2 = "INSERT INTO `menu` ( `Nama`, `Harga`, `Level`, `IsLevel`, `Porsi`, `IsSize`, `Gambar`, `Jenis`) VALUES ('$nama', '$harga', '$level', '$islevel', '$ukuran', '$isUkuran', '$gambarSql','$jenis')";
    mysqli_query($conn, $sql2);
    mysqli_close($conn);
    header("location:dashboard.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../source/css/style.css">
</head>

<body>
    <div class="container">
        <h1 align="center">Add New Menu</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-item">
                <label for="nama" class="form-label">Nama Makanan</label>
                <br>
                <input name="nama" type="text" class="form-control" value="<?php echo isset($_POST['nama']) ? $_POST['nama'] : ''; ?>">
                <br>
            </div>
            <div class="form-item">
                <label for="harga" class="form-label">Harga</label>
                <br>
                <span class="info-name info"><?php echo isset($infoPw) ? $infoPw : ''; ?></span>
                <input name="harga" type="text" class="form-control" placeholder="contoh : 10000">
                <br>
            </div>
            <div class="form-item">
                <label for="gambar" class="form-label">Gambar Makanan</label>
                <br>
                <input name="gambar" type="file" class="form-control">
                <br>
            </div>

            <div class="form-item">
                <label for="type" class="form-label">Level</label>
                <br>
                <div class="form-check form-switch">
                    <input name="isLevel" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Menggunakan Level Makanan</label>
                </div>
            </div>
            <div class="form-item">
                <label for="level" class="form-label">Max Level</label>
                <input type="number" name="level" id="level">
                <br>

            </div>
            <div class="form-item">

                <br>
                <div class="form-check form-switch">
                    <input name="isUkuran" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Menggunakan Ukuran Makanan</label>
                </div>
            </div>
            <div class="form-item">
                <label for="ukuran" class="form-label">Ukuran</label>
                <select name="ukuran" class="form-select" aria-label="Default select example">
                    <option value="Kecil">Kecil</option>
                    <option value="Sedang">Sedang</option>
                    <option value="Besar">Besar</option>
                </select>
                <br>

            </div>
            <div class="form-item">
                <label for="jenis" class="form-label">Jenis</label>
                <select name="jenis" class="form-select" aria-label="Default select example">
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                    <option value="Dessert">Dessert</option>
                </select>
                <br>

            </div>
            <button class="btn btn-primary form-control mt-5" type="submit" name="submit">Create</button>
        </form>

    </div>
    <script src="../source/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>