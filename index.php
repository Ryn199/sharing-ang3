<?php
 include "koneksi.php";

 //querry ambil data user
 $querryAmbilUser = "SELECT * FROM `users`";

 //querry delete user
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user_id = $_POST['user_id'];
    $querydelete = "DELETE FROM `users` WHERE `users`.`user_id` = $user_id";
    if(mysqli_query($conn, $querydelete)){
        echo " data berhasil dihapus";
    }else{
        echo " data gagal dihapus" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>

    <a href="create.php">Tambah User</a>

    <table border="1">
        <tr>
            <th>Id</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>

        <?php $user = mysqli_query($conn, $querryAmbilUser);
        while($rowUser = mysqli_fetch_assoc($user)){ ?>
            <tr>
                <td><?= $rowUser['user_id']?></td>
                <td><?= $rowUser['nama']?></td>
                <td><?= $rowUser['email']?></td>
                <td>
                    <form action="" method="POST">
                        <input type="hidden" name="user_id" value="<?= $rowUser['user_id']?>">
                        <button type="submit" onclick="return confirm('apakah anda yakin?')">Delete</button>
                    </form>
                    <a href="edit.php?user_id=<?= $rowUser['user_id']?>"><button>Edit</button></a>
                </td>

            </tr>

        <?php }
        ?>
    </table>
</body>
</html>