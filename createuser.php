<?php
include "koneksi.php";

// Query untuk mengambil data roles
$querryAmbilRoles = "SELECT * FROM roles";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $roles_id = $_POST['roles_id']; // Menangkap roles_id yang dipilih

    // Query untuk tambah user termasuk roles_id
    $queryTambahUser = "INSERT INTO `users` (`user_id`, `nama`, `email`, `roles_id`) VALUES (NULL, '$nama', '$email', '$roles_id');";
    if (mysqli_query($conn, $queryTambahUser)) {
        echo "Data user berhasil ditambah";
    } else {
        echo "Data user gagal ditambah: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
</head>
<body>
    <form action="" method="POST">
        <p>
        <input type="text" name="nama" placeholder="Masukkan nama disini" required>
        </p>
        <p>
        <input type="email" name="email" placeholder="Masukkan email disini" required>
        </p>

        <!-- Dropdown untuk memilih role -->
        <select name="roles_id" required>
            <?php 
            $roles = mysqli_query($conn, $querryAmbilRoles);
            while ($rowRole = mysqli_fetch_assoc($roles)) { ?>
                <option value="<?= $rowRole['roles_id'] ?>"><?= $rowRole['role'] ?></option>
            <?php } ?>
        </select>
        
        <p>
        <button type="submit">Tambah User</button>
        </p>
    </form>

    <a href="user.php">Kembali</a>
</body>
</html>
