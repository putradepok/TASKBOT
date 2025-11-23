<?php
include '../dist/config/koneksi.php'; // koneksi ke DB kamu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama      = $_POST['nama'];
    $email     = $_POST['email'];
    $jenis     = $_POST['jenis'];
    $deskripsi = $_POST['deskripsi'];
    $wa        = $_POST['nomor']; // nomor WA

    // pastikan format sesuai datetime MySQL
    $deadline = date('Y-m-d H:i:s', strtotime($_POST['deadline']));

    // handle upload dokumen
    $dokumen = null;
    if (isset($_FILES['dokumen']) && $_FILES['dokumen']['error'] == 0) {
        $targetDir = "../uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = time() . "_" . basename($_FILES["dokumen"]["name"]);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["dokumen"]["tmp_name"], $targetFile)) {
            $dokumen = $fileName;
        }
    }

    // query insert
    $query = "INSERT INTO orders (nama, email, jenis, deskripsi, nomor, dokumen, status, deadline)
              VALUES ('$nama', '$email', '$jenis', '$deskripsi', '$nomor', '$dokumen', 'pending', '$deadline')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Order berhasil dikirim!');
                window.location.href='order.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
