<?php 

    if(isset($_POST['submit'])){
        $level = "level:{
            $_POST['level1'],
            $_POST['level2'],
            $_POST['level3']
        }"
        echo $level;
    }



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../source/css/style.css">
</head>

<body>
    <div class="container">
        <h1><?php echo isset($level) ?  $level: 'none' ?></h1>
        <form method="post">
            <div class="form-item">
                <label for="type" class="form-label">Level</label>
                <br>
                <div class="form-check form-switch">
                    <input name="isLevel" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Menggunakan Level Makanan</label>
                    <div class="multi-check">
                        <div class="form-check form-switch">
                            <input name="level1" type="text" class="form-control w-50" placeholder="contoh : Level 1">
                        </div>
                        <div class="form-check form-switch">
                            <input name="level2" type="text" class="form-control w-50" placeholder="contoh : Level 1">
                        </div>
                        <div class="form-check form-switch">
                            <input name="level3" type="text" class="form-control w-50" placeholder="contoh : Level 1">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
    <script src="../source/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>