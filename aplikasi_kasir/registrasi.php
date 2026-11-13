<?php
include 'koneksi.php';
if (!isset($_SESSION['Username']) || $_SESSION['Role'] != 'administrator') {
    header("Location: dashboard.php"); exit;
}

if (isset($_POST['daftar'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $role = $_POST['role'];

    $conn->query("INSERT INTO user (Username, Password, Role) VALUES ('$user', '$pass', '$role')");
    $pesan = "Registrasi user baru berhasil!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrasi User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <div><strong>Aplikasi Kasir - Maria</strong></div>
        <div><a href="dashboard.php">Kembali</a></div>
    </div>

    <div class="container">
        <h3>Form Registrasi User (Administrator Only)</h3>
        <?php if(isset($pesan)) echo "<p style='color:green;'>$pesan</p>"; ?>
        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <label>Role / Hak Akses</label>
            <select name="role">
                <option value="petugas">Petugas</option>
                <option value="administrator">Administrator</option>
            </select>
            <button type="submit" name="daftar">Daftarkan User</button>
        </form>
    </div>
</body>
</html>