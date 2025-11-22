<?php
include '../../koneksi.php';
session_start();

$login_status = '';
$login_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  if (empty($email) || empty($password)) {
    $login_status = 'error';
    $login_message = 'Email dan Password tidak boleh kosong!';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $login_status = 'error';
    $login_message = 'Format email tidak valid!';
  } else {
    $query = "SELECT * FROM login WHERE email = ? AND password = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($data = mysqli_fetch_assoc($result)) {
      $_SESSION['email'] = $data['email'];
      $_SESSION['nama'] = $data['nama'];
      $_SESSION['role'] = $data['role'];
      $login_status = 'success';
      $login_message = "Selamat datang, " . htmlspecialchars($data['nama']) . "!";
    } else {
      $login_status = 'error';
      $login_message = 'Email atau Password salah!';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin - SD Inpres Maccini Sombala 1</title>
  <link rel="icon" href="../img/main/icon.png" />
  <link rel="stylesheet" href="../../bootstrap/dist/css/bootstrap.min.css" />
  <script src="../../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../jquery/dist/jquery.min.js"></script>
  <link rel="stylesheet" href="../../frontend/style.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
    rel="stylesheet">
</head>

<body style="background-image: url('../img/main/bg-login.svg');

 min-height: calc(100vh - 80px); 
">
  <div class="container">
    <div class="login-card">
      <h2>Login Admin</h2>

      <form method="POST" id="loginForm" novalidate>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input
            type="email"
            class="form-control"
            id="email"
            name="email"
            placeholder="Masukkan email"
            required>
          <div class="invalid-feedback">Masukkan email yang valid.</div>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Kata Sandi</label>
          <div class="input-group">
            <input
              type="password"
              class="form-control"
              id="password"
              name="password"
              placeholder="Masukkan kata sandi"
              required>
            <button type="button" class="btn btn-outline-secondary" id="togglePassword">👁️‍🗨️</button>
          </div>
          <div class="invalid-feedback">Kata sandi tidak boleh kosong.</div>
        </div>

        <button type="submit" class="btn btn-login mt-3 w-100">Masuk</button>
      </form>

      <div class="footer">© 2025 SD Inpres Maccini Sombala 1</div>
    </div>
  </div>

  <script>
    $("#togglePassword").on("click", function() {
      const pass = $("#password");
      const type = pass.attr("type") === "password" ? "text" : "password";
      pass.attr("type", type);
      $(this).text(type === "password" ? "👁️‍🗨️" : "🚫");
    });

    $("#loginForm").on("submit", function(e) {
      let valid = true;
      const email = $("#email").val().trim();
      const password = $("#password").val().trim();

      $("input").removeClass("is-invalid");

      if (email === "" || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        $("#email").addClass("is-invalid");
        valid = false;
      }

      if (password === "") {
        $("#password").addClass("is-invalid");
        valid = false;
      }

      if (!valid) e.preventDefault();
    });

    <?php if ($login_status === 'success'): ?>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil Login!',
        html: '<?= $login_message; ?><br><small>Mengarahkan ke dashboard...</small>',
        timer: 2000,
        timerProgressBar: true,
        showConfirmButton: false
      }).then(() => {
        window.location.href = "../dashboard/dashboard.php";
      });
    <?php elseif ($login_status === 'error'): ?>
      Swal.fire({
        icon: 'error',
        title: 'Gagal Login!',
        text: '<?= $login_message; ?>',
        confirmButtonText: 'Coba Lagi'
      });
    <?php endif; ?>
  </script>
</body>

</html>