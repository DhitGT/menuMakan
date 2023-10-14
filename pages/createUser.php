<?php
session_start();

    if (!isset($_SESSION['login']) || $_SESSION['login'] != 'admin') {
        header('location:logout.php');
    }

    if(isset($_POST['submit'])){
        if($_POST['nama'] != '' && $_POST['password'] != '' && $_POST['role'] != ''){
            require_once '../source/koneksi.php';
            $nama = $_POST['nama'];
            $sql = "SELECT * FROM users WHERE Nama = '$nama'";
            $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result) > 0) {
                $infoNama = 'nama tidak tersedia';
            } else {
                if(strlen($_POST['password']) >= 8 ){
                    mysqli_query($conn, "INSERT INTO users ( `Nama`, `Password`, `Role`) VALUES ('" . $_POST['nama'] . "', '" . $_POST['password'] . "', '" . $_POST['role'] . "')");
                    mysqli_close($conn);
                    header('location:dashboard.php');
                }else{
                    $infoPw = 'password harus setidaknya 8 karakter';
                }
            }
            
        }else{
            if($_POST['nama'] == ''){
                $infoNama = 'Nama harus diisi';
            }
            if($_POST['password'] == ''){
                $infoPw = 'Password harus diisi';
            }
            if($_POST['role'] == ''){
                $infoRole = 'Role harus diisi';
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
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../source/css/style.css">
</head>

<body>
    <div class="container">
        <h1 align="center">Create User</h1>
        <form action="" method="post">
            <label for="nama" class="form-label">Username</label>
            <br>
            <span class="info-name info"><?php echo isset($infoNama) ? $infoNama : ''; ?></span>
            <input name="nama" type="text" class="form-control" value="<?php echo isset($_POST['nama']) ? $_POST['nama'] : ''; ?>">
            <label for="password" class="form-label">Password</label>
            <br>
            <span class="info-name info"><?php echo isset($infoPw) ? $infoPw : ''; ?></span>
            <input name="password" type="password" class="form-control">
            <label for="role" class="form-label">Role</label>
            <br>
            <span class="info-name info"><?php echo isset($infoRole) ? $infoRole : ''; ?></span>
            <select name="role" id="role" class="form-control">
                <option value="Staf">Staf</option>
                <option value="Satpam">Satpam</option>
                <option value="Admin">Admin</option>
            </select>
            <button class="btn btn-primary form-control mt-5" type="submit" name="submit">Create</button>
        </form>

    </div>
    <script src="../source/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>