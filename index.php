<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] = 'POST') {
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$result = mysqli_query($conn, "SELECT * FROM tbl_users WHERE email='$email'");
if ($row = mysqli_fetch_assoc($result)) {
    if ($password = $row['password']) {
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Password salah.";
    }
    } else {
        $error = "Email tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan</title>
</head>
<body>
    <body>

<div class="login-card">
    <h2>POLGAN MART</h2>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="post">

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email anda" required>
        </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
    </div>

    <button type="submit" class="btn">Login</button>
    <button type="reset" class="btn-reset">Batal</button>

</form>

<div class="footer">

    <p>© 2026 POLGAN MART</p>

        </div>
    </div>
</body>
</html>
