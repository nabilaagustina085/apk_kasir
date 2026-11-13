<?php
include 'koneksi.php';
$role_pilih = isset($_GET['role']) ? $_GET['role'] : 'administrator';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role     = $_POST['role'];

    $sql = $conn->query("SELECT * FROM user WHERE Username='$username' AND Password='$password' AND Role='$role'");
    if ($sql->num_rows > 0) {
        $data = $sql->fetch_assoc();
        $_SESSION['UserID']   = $data['UserID'];
        $_SESSION['Username'] = $data['Username'];
        $_SESSION['Role']     = $data['Role'];

        if ($data['Role'] == 'administrator') {
            header("Location: admin.php");
            exit;
        } else {
            header("Location: petugas.php");
            exit;
        }
    } else {
        $error = "Username, Password, atau Role salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Aplikasi Kasir</title>
 
</head>
<body>
    <div class="login-box">
        <h2>Login <?= ucfirst($role_pilih); ?></h2>
        <?php if(isset($error)) echo "<p style='color:red; font-size:13px;'>$error</p>"; ?>
        
        <form method="POST">
            <input type="hidden" name="role" value="<?= $role_pilih; ?>">
            <label>Username</label>
            <input type="text" name="username" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit" name="login" style="width:100%;">Masuk</button>
        </form>
        <br>
        <a href="index.php" style="font-size: 13px; text-decoration: none; color: #8a34db;">&laquo; Kembali ke Menu Utama</a>
    </div>
</body>
</html>