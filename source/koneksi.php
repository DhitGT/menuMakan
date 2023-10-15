<?php 
    $conn = mysqli_connect('localhost','root','','db_menu') ;

    function ToIdr($number) {
        $rupiah = "Rp " . number_format($number, 0, ',', '.');
        return $rupiah;
    }
?>