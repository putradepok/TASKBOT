<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_taskbot1");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$nama = $_POST['nama'];
$email = $_POST['email'];
$no_wa = $_POST['nomor'];
$jenis = $_POST['jenis'];
$deskripsi = $_POST['deskripsi'];
$deadline = $_POST['deadline'];
$deadline = date('Y-m-d', strtotime($deadline));

// --- Folder tujuan upload ---
$targetDir = __DIR__ . "/uploads/";

// Kalau folder belum ada, buat otomatis
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

$dokumen   = basename($_FILES["dokumen"]["name"]);
$targetFile = $targetDir . $dokumen;

// --- Proses upload file ---
if (move_uploaded_file($_FILES["dokumen"]["tmp_name"], $targetFile)) {
    $sql = "INSERT INTO orders (nama, email, nomor, jenis, deskripsi, dokumen, deadline) 
            VALUES ('$nama', '$email', '$no_wa', '$jenis', '$deskripsi', '$dokumen', '$deadline')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>
                alert('Order berhasil disimpan!');
                window.location.href='order.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Upload dokumen gagal!";
}

mysqli_close($koneksi);
?>
