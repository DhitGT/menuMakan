<?php 
    session_start();
    require '../source/koneksi.php';
    $info = '';
    $kode;
    $status;
    function nameToNumber($name) {
        // Calculate the numeric representation of the name
        $crc32Value = crc32($name);
        $numericRepresentation = abs($crc32Value) % 10000; // Limit to 4 digits to make space for the random number
    
        // Generate a random number
        $randomNumber = mt_rand(0, 9999);
    
        // Combine the numeric representation and the random number
        $combinedNumber = ($numericRepresentation * 10000 + $randomNumber) % 100000; // Limit to 5 digits
    
        // Ensure the result is exactly 5 digits
        $result = str_pad($combinedNumber, 5, '0', STR_PAD_LEFT);
    
        return $result;
    }
    if(isset($_POST['generate']) && isset($_POST['nama']) != ''){
        $nama = $_POST['nama'];
        $sql = "SELECT * FROM pelangan WHERE Nama = '$nama'";
        
        if(mysqli_num_rows(mysqli_query($conn,$sql))){
            $info = 'Nama tidak tersedia';
            $status = 0;
        }else{
            $kode = nameToNumber($nama);
            $status = 1;
        }
    }

    if(isset($_POST['submit'])){
        $nama = $_POST['nama'];
        $kode = $_POST['kodes'];
        $sql = "SELECT * FROM pelangan WHERE Nama = '$nama'";
        
        if(mysqli_num_rows(mysqli_query($conn,$sql))){
            $info = "Gunakan Nama Yang lain";
        }else{
            if($kode == 0){
                $info = "Kode Belum Di Buat";
            }else{
                $sqlInsert = "INSERT INTO pelangan VALUES ('','$nama','$kode','masuk','0')";
                if(mysqli_query($conn,$sqlInsert)){
                    echo "<script>alert('Regist Selesai')</script>";
                }else{
                    echo "<script>alert('Regist Gagal')</script>";
                }
            }
        }
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../source/css/style.css">
</head>

<body>
    <div class="container">
        <h1 align="center">Selesai</h1>
        <form action="" method="post">
            <label for="nama" class="form-label">Nama</label>
            <br>
            <p class="info"><?php echo isset($info)? $info : '' ?></p>
            <input name="nama" type="text" class="form-control" value="<?php echo isset($_POST['nama'])?$_POST['nama'] : '' ?>">

            <button class="btn btn-info mt-3 mb-3 w-50" name="generate">Generate Code</button>
            <br>
            <label for="kode" class="form-label">Code</label>
            <br>
            <p name="kode" class="form-control" >
                <?php echo isset($kode)? $kode : 'XXXXX' ?>
            </p>
            <input type="hidden" name="status" value="<?php echo isset($status)? $status : 0  ?>">
            <input type="hidden" value="<?php echo isset($kode)? $kode : '00000' ?>" name="kodes">
            <button class="btn btn-primary form-control mt-5" type="submit" name="submit">Print</button>
        </form>

    </div>
    <script src="../source/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>