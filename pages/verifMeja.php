<?php 
    session_start();
    $_SESSION['idMeja'] = $_GET['id']; 
    $info = '';
    $idMeja = $_GET['id'];
    if(isset($_POST['submit'])){
        require '../source/koneksi.php';
        $sql = "SELECT * FROM pelangan";
        $resPelangan = mysqli_query($conn,$sql);
        $nama = $_POST['nama'];
        $code = $_POST['code'];
        
        if(mysqli_num_rows($resPelangan)){
            foreach($resPelangan as $res){
                $id = $res['Id'];
                if($nama == $res['Nama']){
                    if($res['Meja'] == 0){
                        if($code == $res['Code']){
                            $sqlUpdate = "UPDATE `pelangan` SET `Status` = 'duduk', `Meja` = $idMeja WHERE `pelangan`.`Id` = $id";
                            mysqli_query($conn,$sqlUpdate);
                            $sqlSetMeja = "INSERT INTO meja VALUES ($idMeja, $id, $code, 'booked')";
                            mysqli_query($conn,$sqlSetMeja);
                            $_SESSION['namaMeja'] = $res['Nama'];
                            header("location:meja.php?id=$idMeja&nama=$nama");
                        }else{
                            $info = "Kode salah";
                        }
                    }else if($res['Meja'] == $idMeja){
                        $_SESSION['namaMeja'] = $res['Nama'];
                        header("location:meja.php?id=$idMeja&nama=$nama");
                    }else{
                        $info = "Anda sudah duduk di Meja {$res['Meja']}";
                    }
                }else{
                    $info = "Nama tidak di temukan";
                }
            }
        }else{
            $info = "tidak ada data pelangan";
        }
        

    }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../source/css/style.css">
  </head>
  <body>
    <div class="container">
        <h1 align="center">Verification</h1>
        <h5 align="center">Meja <?php echo $idMeja ?></h5>
        <div class="card form mt-3 w-auto">
            <form action="" method="POST">
                <table>
                    <th>
                        <td width="1%"></td>
                        <td width="100%"></td>
                        <td width="100%"></td>
                    </th>
                    <tr>
                        <td>
                            </td>
                            <td>
                                
                                </td>
                                <td>
                            <p class="form-label">Nama</p>
                            <input type="text" name="nama" class="form-control" value="<?php echo isset($_POST['nama'])? $_POST['nama'] : '' ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            </td>
                            <td>
                                </td>
                                <td>
                            <p class="form-label">Code</p>
                            <input type="text" name="code" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <span class="info"><?php echo isset($info)? $info : '' ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><button class="btn btn-primary w-100 mt-3" type="submit" name="submit">Submit</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>