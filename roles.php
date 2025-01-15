<?php
 include "koneksi.php";

 //querry ambil data roles
 $querryAmbilRole = "SELECT * FROM `roles`";

 //querry delete roles
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $roles_id = $_POST['roles_id'];
    $querydelete = "DELETE FROM `roles` WHERE `roles`.`roles_id` = $roles_id";
    if(mysqli_query($conn, $querydelete)){
        // komen sukses
        echo " data roles berhasil dihapus";
    }else{
        // komen error
        echo " data roles gagal dihapus" . mysqli_error($conn);
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

    <a href="createrole.php">Tambah Roles</a>

    <p>

    <table border="1">
        <tr>
            <th>Roles_Id</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>

        <?php $role = mysqli_query($conn, $querryAmbilRole);
        while($rowRole = mysqli_fetch_assoc($role)){ ?>
            <tr>
                <td><?= $rowRole['roles_id']?></td>
                <td><?= $rowRole['role']?></td>
                <td>
                    <form action="" method="POST">
                        <input type="hidden" name="roles_id" value="<?= $rowRole['roles_id']?>">
                        <button type="submit" onclick="return confirm('apakah anda yakin?')">Delete</button>
                    </form>
                    <a href="editrole.php?roles_id=<?= $rowRole['roles_id']?>"><button>Edit</button></a>
                </td>

            </tr>

        <?php }
        ?>
    </table>
    </p>
            <!-- kembali ke homepage -->
    <a href="homepage.php">kembali</a>
</body>
</html>