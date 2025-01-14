<?php
include "koneksi.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $queryTambahUser = "INSERT INTO `users` (`user_id`, `nama`, `email`) VALUES (NULL, '$nama', '$email');";
    if(mysqli_query($conn, $queryTambahUser)){
        echo " data berhasil ditambah";
    }else{
        echo " data gagal ditambah" . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah user</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="nama" placeholder="Masukkan nama disini">
        <input type="email" name="email" placeholder="Masukkan email disini">
        <button type="submit">Tambah user</button>
    </form>

    <a href="index.php">Kembali</a>
</body>
</html>