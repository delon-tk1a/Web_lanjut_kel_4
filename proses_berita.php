<?php
session_start(); // Pastikan session dimulai

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in. Please log in first.");
}

// Include database connection
include 'koneksi.php';

// Ambil parameter proses dari URL
$proses = $_GET['proses'];

if ($proses == 'edit') {
    // Ambil data dari form
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $isi_berita = $_POST['isi_berita'];
    $kategori_id = $_POST['kategori_id'];
    $file_upload = $_FILES['file_upload']['name'];

    // Jika ada file yang diupload
    if ($file_upload) {
        $target_dir = "uploads/"; // Pastikan folder ini ada dan dapat ditulis
        $target_file = $target_dir . basename($file_upload);
        move_uploaded_file($_FILES['file_upload']['tmp_name'], $target_file);
    } else {
        // Ambil nama file yang sudah ada jika tidak ada upload baru
        $stmt = $db->prepare("SELECT file_upload FROM berita WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $existing_file = $stmt->fetchColumn();
        $file_upload = $existing_file;
    }

    // Update data
    try {
        $stmt = $db->prepare("UPDATE berita SET user_id = :user_id, kategori_id = :kategori_id, judul = :judul, file_upload = :file_upload, isi_berita = :isi_berita WHERE id = :id");
        $stmt->execute([
            'user_id' => $_SESSION['user_id'], // Ambil user_id dari session
            'kategori_id' => $kategori_id,
            'judul' => $judul,
            'file_upload' => $file_upload,
            'isi_berita' => $isi_berita,
            'id' => $id
        ]);
        header("Location: index.php?p=berita");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} elseif ($proses == 'delete') {
    $id = $_GET['id'];

    // Hapus data
    try {
        $stmt = $db->prepare("DELETE FROM berita WHERE id = :id");
        $stmt->execute(['id' => $id]);
        header("Location: index.php?p=berita");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid process.";
}
?>