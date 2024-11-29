<?php 
include 'koneksi.php';

if ($_GET['proses'] == 'insert') {
    // Ambil data dari POST
    $nip = $_POST['nip'];
    $nama_dosen = $_POST['nama_dosen'];
    $email = $_POST['email'];
    $prodi_id = $_POST['prodi_id'];
    $notelp = $_POST['notelp'];
    $alamat = $_POST['alamat'];

    // Cek apakah prodi_id sudah ada
    $stmt_check = $db->prepare("SELECT * FROM dosen WHERE prodi_id = :prodi_id");
    $stmt_check->execute(['prodi_id' => $prodi_id]);

    if ($stmt_check->rowCount() > 0) {
        echo "<script>alert('Prodi ID ini sudah digunakan oleh dosen lain!'); window.history.back();</script>";
    } else {
        $stmt = $db->prepare("INSERT INTO dosen (nip, nama_dosen, email, prodi_id, notelp, alamat) 
                              VALUES (:nip, :nama_dosen, :email, :prodi_id, :notelp, :alamat)");
        $result = $stmt->execute([
            'nip' => $nip,
            'nama_dosen' => $nama_dosen,
            'email' => $email,
            'prodi_id' => $prodi_id,
            'notelp' => $notelp,
            'alamat' => $alamat,
        ]);

        if ($result) {
            echo "<script>window.location='index.php?p=dosen'</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menambahkan data.'); window.history.back();</script>";
        }
    }
}

if ($_GET['proses'] == 'edit') {
    // Ambil data dari POST
    $nip = $_POST['nip'];
    $nama_dosen = $_POST['nama_dosen'];
    $email = $_POST['email'];
    $prodi_id = $_POST['prodi_id'];
    $notelp = $_POST['notelp'];
    $alamat = $_POST['alamat'];
    $id = $_POST['id'];

    $stmt = $db->prepare("UPDATE dosen SET
                            nip = :nip,
                            nama_dosen = :nama_dosen,
                            email = :email,
                            prodi_id = :prodi_id,
                            notelp = :notelp,
                            alamat = :alamat
                          WHERE id = :id");
    $result = $stmt->execute([
        'nip' => $nip,
        'nama_dosen' => $nama_dosen,
        'email' => $email,
        'prodi_id' => $prodi_id,
        'notelp' => $notelp,
        'alamat' => $alamat,
        'id' => $id,
    ]);

    if ($result) {
        echo "<script>window.location='index.php?p=dosen'</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat memperbarui data.'); window.history.back();</script>";
    }
}

if ($_GET['proses'] == 'delete') {
    $stmt = $db->prepare("DELETE FROM dosen WHERE id = :id");
    $result = $stmt->execute(['id' => $_GET['id']]);

    if ($result) {
        header('location:index.php?p=dosen'); // Redirect
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data.'); window.history.back();</script>";
    }
}
?>