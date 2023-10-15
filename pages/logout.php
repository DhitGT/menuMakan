<?php
// Start the session
session_start();
if(isset($_SESSION['login'])){
    
// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect or perform other actions after destroying the session
header("Location: index.php");
exit;
}else{
    header('location:index.php');
}
?>
