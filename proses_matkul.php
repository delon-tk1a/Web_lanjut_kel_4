<?php
include 'koneksi.php';

$proses = isset($_GET['proses']) ? $_GET['proses'] : '';

switch ($proses) {
    case 'insert':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $stmt = $db->prepare("INSERT INTO matakuliah (kode_matakuliah, nama_matakuliah, semester, jenis_matakuliah, sks, jam, keterangan) VALUES (:kode_matakuliah, :nama_matakuliah, :semester, :jenis_matakuliah, :sks, :jam, :keterangan)");

                $stmt->execute([
                    ':kode_matakuliah' => $_POST['kode_matakuliah'],
                    ':nama_matakuliah' => $_POST['nama_matakuliah'],
                    ':semester' => $_POST['semester'],
                    ':jenis_matakuliah' => $_POST['jenis_matakuliah'],
                    ':sks' => $_POST['sks'],
                    ':jam' => $_POST['jam'],
                    ':keterangan' => $_POST['keterangan'],
                ]);

                header('Location: index.php?p=matkul&aksi=list');
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
        }
        break;

    case 'edit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $stmt = $db->prepare("UPDATE matakuliah SET kode_matakuliah = :kode_matakuliah, nama_matakuliah = :nama_matakuliah, semester = :semester, jenis_matakuliah = :jenis_matakuliah, sks = :sks, jam = :jam, keterangan = :keterangan WHERE id = :id");

                $stmt->execute([
                    ':kode_matakuliah' => $_POST['kode_matakuliah'],
                    ':nama_matakuliah' => $_POST['nama_matakuliah'],
                    ':semester' => $_POST['semester'],
                    ':jenis_matakuliah' => $_POST['jenis_matakuliah'],
                    ':sks' => $_POST['sks'],
                    ':jam' => $_POST['jam'],
                    ':keterangan' => $_POST['keterangan'],
                    ':id' => $_POST['id'],
                ]);

                header('Location: index.php?p=matkul&aksi=list');
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            try {
                $stmt = $db->prepare("DELETE FROM matakuliah WHERE id = :id");

                $stmt->execute([':id' => $_GET['id']]);

                header('Location: index.php?p=matkul&aksi=list');
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
        }
        break;

    default:
        echo "Proses tidak dikenali.";
        break;
}
?>
