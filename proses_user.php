<?php
include 'koneksi.php'; // Pastikan koneksi database sudah benar

$proses = isset($_GET['proses']) ? $_GET['proses'] : '';

if ($proses == 'insert') {
    // Ambil data dari form
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $nama_lengkap = $_POST['nama_lengkap'];
    $level_id = $_POST['level_id'];
    $notelp = $_POST['notelp'];
    $alamat = $_POST['alamat'];
    $photo = '';

    if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 0) {
        $target_dir = "upload/";
        $photo = basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . $photo;
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    }

    // Simpan data ke database
    $query = "INSERT INTO user (email, password, level_id, nama_lengkap, notelp, alamat, photo) VALUES (:email, :password, :level_id, :nama_lengkap, :notelp, :alamat, :photo)";
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':level_id', $level_id);
    $stmt->bindParam(':nama_lengkap', $nama_lengkap);
    $stmt->bindParam(':notelp', $notelp);
    $stmt->bindParam(':alamat', $alamat);
    $stmt->bindParam(':photo', $photo);

    if ($stmt->execute()) {
        header("Location: index.php?p=user&aksi=list");
    } else {
        echo "Error: " . implode(" ", $stmt->errorInfo());
    }

} elseif ($proses == 'edit') {
    // Ambil data dari form
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null;
    $level_id = $_POST['level_id'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $notelp = $_POST['notelp'];
    $alamat = $_POST['alamat'];
    $photo = '';

    // Proses upload file jika ada
    if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 0) {
        $target_dir = "upload/";
        $photo = basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . $photo;
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    }

    // Update data ke database
    if ($photo) {
        $query = "UPDATE user SET email = :email, password = :password, level_id = :level_id, nama_lengkap = :nama_lengkap, notelp = :notelp, alamat = :alamat, photo = :photo WHERE id = :id";
    } else {
        $query = "UPDATE user SET email = :email, level_id = :level_id, nama_lengkap = :nama_lengkap, notelp = :notelp, alamat = :alamat" .
                 ($password ? ", password = :password" : "") . " WHERE id = :id";
    }

    $stmt = $db->prepare($query);

    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':level_id', $level_id);
    $stmt->bindParam(':nama_lengkap', $nama_lengkap);
    $stmt->bindParam(':notelp', $notelp);
    $stmt->bindParam(':alamat', $alamat);
    $stmt->bindParam(':id', $id);

    if ($photo) {
        $stmt->bindParam(':photo', $photo);
    }
    if ($password) {
        $stmt->bindParam(':password', $password);
    }

    if ($stmt->execute()) {
        header("Location: index.php?p=user&aksi=list");
    } else {
        echo "Error: " . implode(" ", $stmt->errorInfo());
    }

} elseif ($proses == 'delete') {
    $id = $_GET['id'];

    // Hapus file jika ada
    $query = "SELECT photo FROM user WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['photo']) {
        unlink("upload/" . $user['photo']);
    }

    // Hapus data dari database
    $query = "DELETE FROM user WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: index.php?p=user&aksi=list");
    } else {
        echo "Error: " . implode(" ", $stmt->errorInfo());
    }
}
?>
