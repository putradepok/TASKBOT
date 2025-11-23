<?php
session_start();
require "../dist/config/koneksi.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // prepared statement untuk menghindari SQL injection
    $stmt = $conn->prepare("SELECT id, username, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res && $res->num_rows === 1) {
        $admin = $res->fetch_assoc();
        // kalau belum hash, masih pakai plain text
        if ($password === $admin['password']) {
            $_SESSION['admin'] = $admin['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Username atau password salah.";
        }
    } else {
        $error = "Username atau password salah.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap');

    body {
      margin: 0;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: radial-gradient(circle at top, #0f0f1a, #000);
      font-family: 'Orbitron', sans-serif;
      color: #fff;
    }

    .auth-box {
      width: 400px;
      padding: 40px;
      background: rgba(15, 15, 30, 0.85);
      border-radius: 12px;
      border: 2px solid #00f0ff;
      box-shadow: 0 0 25px #00f0ff, 0 0 50px #005577 inset;
      text-align: center;
      animation: flickerBox 2s infinite alternate;
    }

    .auth-box h2 {
      margin-bottom: 20px;
      color: #00f0ff;
      text-shadow: 0 0 15px #00f0ff, 0 0 30px #005577;
      font-size: 24px;
      letter-spacing: 2px;
      animation: glowText 1.5s infinite alternate;
    }

    .auth-box label {
      display: block;
      text-align: left;
      font-size: 14px;
      margin: 8px 0 5px;
      color: #00f0ff;
    }

    .auth-box input {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 2px solid #00f0ff;
      border-radius: 8px;
      background: #0f0f1a;
      color: #fff;
      font-size: 14px;
      outline: none;
      transition: 0.3s;
      box-shadow: 0 0 10px #00f0ff inset;
    }

    .auth-box input:focus {
      border-color: #ff00ff;
      box-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff inset;
    }

    .auth-box button {
      width: 100%;
      padding: 14px;
      margin-bottom: 12px;
      background: linear-gradient(90deg, #00f0ff, #ff00ff);
      border: none;
      border-radius: 8px;
      color: #fff;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      box-shadow: 0 0 15px #00f0ff, 0 0 25px #ff00ff;
      text-transform: uppercase;
      transition: 0.3s;
      animation: glowBtn 1.5s infinite alternate;
    }

    .auth-box button:hover {
      transform: scale(1.05);
      box-shadow: 0 0 25px #ff00ff, 0 0 45px #00f0ff;
    }

    .switch-link {
      color: #00f0ff;
      font-size: 14px;
      cursor: pointer;
      display: block;
      margin-top: 10px;
      text-decoration: underline;
    }

    /* Animasi */
    @keyframes glowText {
      from { text-shadow: 0 0 5px #00f0ff, 0 0 15px #005577; }
      to { text-shadow: 0 0 15px #ff00ff, 0 0 35px #ff00ff; }
    }
    @keyframes glowBtn {
      from { box-shadow: 0 0 10px #00f0ff, 0 0 20px #ff00ff; }
      to { box-shadow: 0 0 25px #ff00ff, 0 0 50px #00f0ff; }
    }
    @keyframes flickerBox {
      0%, 100% { box-shadow: 0 0 25px #00f0ff, 0 0 50px #005577 inset; }
      50% { box-shadow: 0 0 35px #ff00ff, 0 0 70px #330033 inset; }
    }
  </style>
</head>
<body>
  <div class="auth-box" id="authBox">
    <h2 id="formTitle">Login Admin</h2>

    <!-- Form Login -->
    <form id="loginForm" method="POST" action="login.php">
      <label>Username</label>
      <input type="text" name="username" placeholder="Masukkan username" required>
      <label>Password</label>
      <input type="password" name="password" placeholder="Masukkan password" required>
      <button type="submit">Login</button>
    </form>

    <!-- Form Register -->
    <form id="registerForm" method="POST" action="register.php" style="display:none;">
      <label>Username</label>
      <input type="text" name="username" placeholder="Buat username" required>
      <label>Email</label>
      <input type="email" name="email" placeholder="Masukkan email" required>
      <label>Password</label>
      <input type="password" name="password" placeholder="Buat password" required>
      <label>Konfirmasi Password</label>
      <input type="password" name="confirm_password" placeholder="Ulangi password" required>
      <button type="submit">Daftar</button>
    </form>

    <span class="switch-link" id="switchLink">Belum punya akun? Daftar</span>
  </div>

  <script>
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const switchLink = document.getElementById('switchLink');
    const formTitle = document.getElementById('formTitle');

    switchLink.addEventListener('click', () => {
      if (loginForm.style.display === "none") {
        loginForm.style.display = "block";
        registerForm.style.display = "none";
        formTitle.innerText = "Login Admin";
        switchLink.innerText = "Belum punya akun? Daftar";
      } else {
        loginForm.style.display = "none";
        registerForm.style.display = "block";
        formTitle.innerText = "Daftar Akun";
        switchLink.innerText = "Sudah punya akun? Login";
      }
    });
  </script>
</body>
</html>
