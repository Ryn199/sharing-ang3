<?php
include "koneksi.php";

// Ambil kata kunci pencarian dan role yang dipilih dari form, defaultnya kosong
$search = isset($_POST['search']) ? $_POST['search'] : '';
$role_id = isset($_POST['role_id']) ? $_POST['role_id'] : '';

// Query ambil data user dengan pencarian berdasarkan nama dan filter berdasarkan role
$querryAmbilUser = "SELECT users.*, roles.* FROM users 
                    JOIN roles ON users.roles_id = roles.roles_id 
                    WHERE users.nama LIKE '%$search%'";

// Tambahkan filter berdasarkan role jika dipilih
if (!empty($role_id)) {
    $querryAmbilUser .= " AND users.roles_id = '$role_id'";
}

// Query untuk mengambil data roles untuk dropdown
$querryAmbilRole = "SELECT * FROM roles";

// Query delete user
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $querydelete = "DELETE FROM `users` WHERE `users`.`user_id` = $user_id";
    if (mysqli_query($conn, $querydelete)) {
        // komen sukses
        echo "Data user berhasil dihapus";
    } else {
        // komen error
        echo "Data user gagal dihapus: " . mysqli_error($conn);
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

    <!-- Form pencarian dengan filter berdasarkan role -->
    <form action="" method="POST">
        <input type="text" name="search" placeholder="Cari nama" value="<?= $search ?>">
        
        <!-- Dropdown filter role -->
        <select name="role_id">
            <option value="">Pilih Role</option>
            <?php
            $roles = mysqli_query($conn, $querryAmbilRole);
            while ($rowRole = mysqli_fetch_assoc($roles)) { ?>
                <option value="<?= $rowRole['roles_id'] ?>" <?= $role_id == $rowRole['roles_id'] ? 'selected' : '' ?>>
                    <?= $rowRole['role'] ?>
                </option>
            <?php } ?>
        </select>
        
        <button type="submit">Cari</button>
    </form>

    <br>
    <a href="createuser.php">Tambah User</a>

    <p>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Roles_Id</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>

        <?php
        $user = mysqli_query($conn, $querryAmbilUser);
        while ($rowUser = mysqli_fetch_assoc($user)) { ?>
            <tr>
                <td><?= $rowUser['user_id'] ?></td>
                <td><?= $rowUser['role'] ?></td>
                <td><?= $rowUser['nama'] ?></td>
                <td><?= $rowUser['email'] ?></td>
                <td>
                    <form action="" method="POST">
                        <input type="hidden" name="user_id" value="<?= $rowUser['user_id'] ?>">
                        <button type="submit" onclick="return confirm('Apakah Anda yakin?')">Delete</button>
                    </form>
                    <a href="edituser.php?user_id=<?= $rowUser['user_id'] ?>"><button>Edit</button></a>
                </td>
            </tr>
        <?php } ?>
    </table>
    </p>

    <br>

    <!-- kembali ke homepage -->
    <a href="homepage.php">Kembali</a>

</body>

</html>
