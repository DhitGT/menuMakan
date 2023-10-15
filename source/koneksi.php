<?php 
    $conn = mysqli_connect('localhost','root','','db_menu') ;
    
    function ToIdr($number) {
        $rupiah = "Rp " . number_format($number, 0, ',', '.');
        return $rupiah;
    }
    
    function check(){
        $conn = mysqli_connect('localhost','root','','db_menu') ;
        $nama = $_SESSION['namaMeja'];
        $sql = "SELECT * FROM pelangan WHERE Nama = '$nama'";
        if(mysqli_num_rows(mysqli_query($conn,$sql))){
            return 1;
        }else{
            return 0;
        }
    }
?>