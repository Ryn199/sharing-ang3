<?php
include "koneksi.php";

// Query untuk mengambil data user berdasarkan user_id
$querryAmbilUser = "SELECT * FROM users WHERE user_id = " . $_GET['user_id'];

// Query untuk mengambil data roles
$querryAmbilRoles = "SELECT * FROM roles";

// Proses update user
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $roles_id = $_POST['roles_id']; // Menangkap roles_id yang dipilih
    $user_id = $_POST['user_id'];
    // Query untuk update data user
    $queryEdit = "UPDATE users SET nama = '$nama', email = '$email', roles_id = $roles_id WHERE user_id = $user_id";
    
    if (mysqli_query($conn, $queryEdit)) {
        echo "Data user berhasil diubah";
    } else {
        echo "Data user gagal diubah: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>

<?php
$user = mysqli_query($conn, $querryAmbilUser);
$roles = mysqli_query($conn, $querryAmbilRoles);
while ($rowUser = mysqli_fetch_assoc($user)) { ?>
    <form action="" method="POST">
        <input type="hidden" name="user_id" value="<?= $rowUser['user_id'] ?>">
        <p>
        <input type="text" name="nama" value="<?= $rowUser['nama'] ?>" required>
        </p>
        <p>
        <input type="email" name="email" value="<?= $rowUser['email'] ?>" required>
        </p>

        <!-- Dropdown untuk memilih role -->
        <select name="roles_id">
            <?php while ($rowRole = mysqli_fetch_assoc($roles)) { ?>
                <option value="<?= $rowRole['roles_id'] ?>" <?= $rowUser['roles_id'] == $rowRole['roles_id'] ? 'selected' : '' ?>>
                    <?= $rowRole['role'] ?> <!-- Menampilkan kolom 'role' -->
                </option>
            <?php } ?>
        </select>
        
        <p>
        <button type="submit">Ubah</button>
        </p>
    </form>
<?php } ?>

<a href="user.php">Kembali</a>

</body>
</html>
