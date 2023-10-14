<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] != 'admin') {
    header('location:logout.php');
}
require '../source/koneksi.php';
$sql = "SELECT * FROM users ";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);

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
        <h1 align="center">View All User</h1>
        <table class="table table-info table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Role</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $res) : ?>
                    <tr>
                        <th scope="row"><?php echo $res['Id'] ?></th>
                        <td><?php echo $res['Nama'] ?></td>
                        <td><?php echo $res['Role'] ?></td>
                        <td>
                            <a href="deleteUser.php?Id=<?php echo $res['Id'] ?>" class="btn btn-danger">X</a>
                            <a href="editUser.php?Id=<?php echo $res['Id'] ?>" class="btn btn-warning">E</a>
                        </td>
                    </tr>
                <?php endforeach ?>
                <a href="dashboard.php" class="btn btn-primary">Back</a>
            </tbody>
        </table>

    </div>
    <script src="../source/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>