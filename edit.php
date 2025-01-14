<?php
include "koneksi.php";

 //querry ambil data user
 $querryAmbilUser = "SELECT * FROM `users` WHERE `user_id` = " . $_GET['user_id'] ;


 //query update user
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $user_id = $_POST['user_id'];
    $queryEdit = "UPDATE `users` SET `nama` = '$nama', `email` = '$email' WHERE `users`.`user_id` = $user_id;";
    if(mysqli_query($conn, $queryEdit)){
        echo " data berhasil diubah";
    }else{
        echo " data gagal iubah" . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit user</title>
</head>
<body>

<?php $user = mysqli_query($conn, $querryAmbilUser);
        while($rowUser = mysqli_fetch_assoc($user)){ ?>
    <form action="" method="POST">
        <input type="hidden" name="user_id" value="<?= $rowUser['user_id']?>">
        <input type="text" name="nama" value="<?= $rowUser['nama']?>">
        <input type="email" name="email" value="<?= $rowUser['email']?>">
        <button type="submit">Ubah</button>
    </form>

    <?php }?>
    <a href="index.php">Kembali</a>
</body>
</html>