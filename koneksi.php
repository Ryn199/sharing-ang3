<?php
    $conn = mysqli_connect("localhost", "root", "", "takumi");
    if(!$conn){
        die("koneksi database gagal: " . mysqli_connect_error());
    }
?>