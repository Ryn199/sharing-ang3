<?php
    $conn = mysqli_connect("192.168.1.2", "root", "HomeserverDatabase191205", "takumi");
    if(!$conn){
        die("koneksi database gagal: " . mysqli_connect_error());
    }
?>