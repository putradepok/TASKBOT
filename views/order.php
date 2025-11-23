<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Order - TaskBot</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }

    body {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(135deg, #4f8cff, #6dd5ed);
    }

    .form-container {
      width: 100%;
      max-width: 480px;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(15px);
      border-radius: 16px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
      padding: 35px 30px;
      color: white;
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      font-size: 26px;
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    label {
      font-size: 14px;
      margin-bottom: 6px;
      display: block;
      font-weight: 500;
    }

    .input-group {
      display: flex;
      align-items: center;
      background: rgba(255, 255, 255, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 10px;
      margin-bottom: 16px;
      padding: 10px 14px;
      transition: all 0.3s ease;
    }

    .input-group:hover {
      background: rgba(255, 255, 255, 0.25);
    }

    .input-group i {
      margin-right: 10px;
      font-size: 18px;
      opacity: 0.9;
    }

    input, select, textarea {
      background: transparent;
      border: none;
      outline: none;
      width: 100%;
      color: #fff;
      font-size: 14px;
      font-weight: 400;
    }

    input::placeholder, textarea::placeholder {
      color: rgba(255, 255, 255, 0.7);
    }

    select option {
      color: #333;
    }

    button {
      width: 100%;
      padding: 12px;
      border: none;
      background: linear-gradient(135deg, #ff6600, #ff9966);
      color: white;
      font-weight: 600;
      font-size: 16px;
      border-radius: 10px;
      cursor: pointer;
      transition: 0.3s;
      margin-top: 10px;
    }

    button:hover {
      background: linear-gradient(135deg, #e65c00, #ff8533);
      transform: translateY(-2px);
    }

    @media (max-width: 480px) {
      .form-container {
        padding: 25px 20px;
      }
    }
  </style>
  <script src="https://kit.fontawesome.com/a81368914c.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="form-container">
    <h2>Form Order</h2>
    <form action="simpan_order.php" method="POST" enctype="multipart/form-data">

      <label>Nama</label>
      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" name="nama" placeholder="Masukkan nama" required>
      </div>

      <label>Email</label>
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" placeholder="example@email.com" required>
      </div>

      <label>Nomor HP/WA</label>
      <div class="input-group">
        <i class="fas fa-phone"></i>
        <input type="tel" name="nomor" placeholder="08xxxx" required>
      </div>

      <label>Jenis Joki</label>
      <div class="input-group">
        <i class="fas fa-cogs"></i>
        <select name="jenis" required>
          <option value="">-- Pilih Jenis Layanan --</option>
          <option value="Website">Pembuatan Website</option>
          <option value="Design">Design Figma</option>
          <option value="Perancangan Database">Perancangan Database</option>
          <option value="Hosting Web">Hosting Web</option>
        </select>
      </div>

      <label>Deskripsi</label>
      <div class="input-group">
        <i class="fas fa-edit"></i>
        <textarea name="deskripsi" rows="4" placeholder="Tulis detail project kamu..." required></textarea>
      </div>

      <label>Deadline</label>
      <div class="input-group">
        <i class="fas fa-calendar-alt"></i>
        <input type="datetime-local" name="deadline" required>
      </div>

      <label>Upload Dokumen (Opsional)</label>
      <div class="input-group">
        <i class="fas fa-file-upload"></i>
        <input type="file" name="dokumen" accept=".pdf,.doc,.docx,.zip,.rar,.png,.jpg">
      </div>

      <button type="submit">Kirim Order</button>
    </form>
  </div>
</body>
</html>
