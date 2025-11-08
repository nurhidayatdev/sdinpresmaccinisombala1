<?php
include '../koneksi.php';
session_start();

$login_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  $query = "SELECT * FROM login WHERE email = ? AND password = ?";
  $stmt = mysqli_prepare($koneksi, $query);
  mysqli_stmt_bind_param($stmt, "ss", $email, $password);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($data = mysqli_fetch_assoc($result)) {
    $_SESSION['email'] = $data['email'];
    $_SESSION['nama'] = $data['nama'];

    header("Location: dashboard.php");
    exit;
  } else {
    $login_error = "NISN atau Password salah!";
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Siswa - SD Inpres Maccini Sombala 1</title>
  <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../style.css" />
</head>

<body>

  <div class="container">
    <div class="login-card">
      <h2>Login Admin</h2>

      <?php if ($login_error): ?>
        <div class="alert alert-danger text-center"><?= $login_error; ?></div>
      <?php endif; ?>

      <form method="POST" novalidate>
        <div class="mb-3 position-relative">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
        </div>

        <div class="mb-3 position-relative">
          <label for="password" class="form-label">Kata Sandi</label>
          <div class="input-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi" required>
            <button type="button" class="btn btn-outline-secondary" id="togglePassword">👁️‍🗨️</button>
          </div>
        </div>

        <button type="submit" class="btn btn-login mt-3 w-100">Masuk</button>
      </form>

      <div class="footer">© 2025 SD Inpres Maccini Sombala 1</div>
    </div>
  </div>

  <script src="../jquery/dist/jquery.min.js"></script>
  <script>
    $("#togglePassword").on("click", function() {
      const pass = $("#password");
      const type = pass.attr("type") === "password" ? "text" : "password";
      pass.attr("type", type);
      $(this).text(type === "password" ? "👁️‍🗨️" : "🚫");
    });
  </script>

</body>
</html>