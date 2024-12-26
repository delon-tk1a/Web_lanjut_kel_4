<?php 
include 'koneksi.php';

$proses = isset($_GET['proses']) ? $_GET['proses'] : '';

switch ($proses) {
    case 'insert':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $stmt = $db->prepare("INSERT INTO kategori (nama_kategori, keterangan) VALUES (:nama_kategori, :keterangan)");
                
                $stmt->execute([
                    ':nama_kategori' => $_POST['nama_kategori'],
                    ':keterangan' => $_POST['keterangan']
                ]);

                header('Location: index.php?p=kategori');
                exit;
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
        }
        break;

    case 'edit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $stmt = $db->prepare("UPDATE kategori SET nama_kategori = :nama_kategori, keterangan = :keterangan WHERE id = :id");
                
                $stmt->execute([
                    ':nama_kategori' => $_POST['nama_kategori'],
                    ':keterangan' => $_POST['keterangan'],
                    ':id' => $_POST['id']
                ]);

                header('Location: index.php?p=kategori');
                exit;
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
        }
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            try {
                $stmt = $db->prepare("DELETE FROM kategori WHERE id = :id");
                $stmt->execute([':id' => $_GET['id']]);

                header('Location: index.php?p=kategori');
                exit;
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