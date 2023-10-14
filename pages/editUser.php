<?php
    session_start();
    if(!isset($_SESSION['login']) || $_SESSION['login'] != 'admin'){
        header('location:logout.php');
    }
    require '../source/koneksi.php';
    $id = $_GET['Id'];
    $sqlGet = "SELECT * FROM users WHERE Id = $id";
    $result = mysqli_query($conn,$sqlGet);

    $row = mysqli_fetch_assoc($result);
    $role = $row['Role'];
    $nama = $row['Nama'];

    
    if(isset($_POST['submit'])){
        $newRole = $_POST['role'];
        $sqlUpdate = "UPDATE users SET role='$newRole' WHERE Id=$id";
        if(mysqli_query($conn,$sqlUpdate)){
            header('location:viewAllUser.php');
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
        <h1 align="center">Edit User</h1>
        <form action="" method="post">
            <label for="nama" class="form-label">Username</label>
            <br>
            <span class="info-name info"><?php echo isset($infoNama) ? $infoNama : ''; ?></span>
            <input name="nama" type="text" class="form-control" value="<?php echo isset($nama) ? $nama : ''; ?>">

            <label for="role" class="form-label">Role</label>
            <br>
            <span class="info-name info"><?php echo isset($infoRole) ? $infoRole : ''; ?></span>
            <select name="role" id="role" class="form-control">
                <option value="Staf">Staf</option>
                <option value="Satpam">Satpam</option>
                <option value="Admin">Admin</option>
            </select>
            <button class="btn btn-primary form-control mt-5" type="submit" name="submit">Edit</button>
        </form>

    </div>
    <script src="../source/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>