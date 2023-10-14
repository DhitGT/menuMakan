<?php
session_start();
$info = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['nama'] != '' && $_POST['password'] != '') {
        require_once '../source/koneksi.php';

        $nama = $_POST['nama'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE Nama = '$nama'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Error in SQL query: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) < 1) {
            $info = 'Nama tidak ditemukan';
        } else {
            $user = mysqli_fetch_assoc($result);

            if ($user['Password'] == $password) {
                session_start();
                $_SESSION['login'] = $user['Role'];
                $_SESSION['loginName'] = $user['Nama'];

                if ($user['Role'] == 'admin') {
                    header('location:dashboard.php');
                    exit;
                } else {
                    header('location:index.php');
                    exit;
                }
            } else {
                $info = 'Password salah';
            }
        }
    } else {
        $info = 'data harus di isi';
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
        <h1 align="center">Welcome</h1>
        <div class="card d-flex">
            <h1 class="me-4">Login</h1>
            <form action="" method="post">
            <span class="info-name info"><?php echo isset($info) ? $info : ''; ?></span>
            <br>
                <label for="nama" class="form-label">Username</label>
                <input name="nama" type="text" class="form-control" value="<?php echo isset($_POST['nama']) ? $_POST['nama'] : ''; ?>">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control">
                <button class="btn btn-primary form-control mt-5" type="submit" name="submit">Login</button>
            </form>
        </div>
    </div>
    <script src="../source/js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>