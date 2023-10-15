<?php
// Start the session
session_start();
if(isset($_SESSION['login'])){
    $_SESSION['login'] = '';
// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect or perform other actions after destroying the session
header("Location: index.php");
exit;
}else{
    if(isset($_SESSION['namaMeja']) || isset($_SESSION['idMeja'])){
        $_SESSION['namaMeja'] = '';
        $_SESSION['idMeja'] = '';
        session_unset();
        session_destroy();
        header('location:thanks.php');
    }else{
        header('location:index.php');
    }
}
