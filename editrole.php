<?php
include "koneksi.php";

 //querry ambil data user
 $querryAmbilRole = "SELECT * FROM `roles` WHERE `roles_id` = " . $_GET['roles_id'] ;


 //query update user
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $role = $_POST['role'];
    $roles_id = $_POST['roles_id'];
    $queryEdit = "UPDATE `roles` SET `role` = '$role' WHERE `roles`.`roles_id` = $roles_id;";
    if(mysqli_query($conn, $queryEdit)){
        echo " data roles berhasil diubah";
    }else{
        echo " data roles gagal diubah" . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Roles</title>
</head>
<body>

<?php $role = mysqli_query($conn, $querryAmbilRole);
        while($rowRole = mysqli_fetch_assoc($role)){ ?>
    <form action="" method="POST">
        <input type="hidden" name="roles_id" value="<?= $rowRole['roles_id']?>">
        <p>
        <input type="text" name="role" value="<?= $rowRole['role']?>">
        </p>
        <button type="submit">Ubah Roles</button>
    </form>

    <?php }?>
    br
    <a href="roles.php">Kembali</a>
</body>
</html>