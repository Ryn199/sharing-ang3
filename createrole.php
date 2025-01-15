<?php
include "koneksi.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $role = $_POST['role'];
    $queryTambahUser = "INSERT INTO `roles` (`roles_id`, `role`) VALUES (NULL, '$role');";
    if(mysqli_query($conn, $queryTambahUser)){
        echo " data roles berhasil ditambah";
    }else{
        echo " data roles gagal ditambah" . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah roles</title>
</head>
<body>
    <form action="" method="POST">
        <p>
        <input type="text" name="role" placeholder="Masukkan nama disini">
        </p>
        <button type="submit">Tambah roles</button>
    </form>
    
    <br>
    <a href="roles.php">Kembali</a>
</body>
</html>