<?php 
include 'koneksi.php';

if ($_GET['proses'] == 'insert') {
    try {
        $stmt = $db->prepare("INSERT INTO prodi (nama_prodi, jenjang_prodi) VALUES (?, ?)");
        $stmt->execute([$_POST['nama_prodi'], $_POST['jenjang']]);
        
        echo "<script>window.location='index.php?p=prodi'</script>";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if ($_GET['proses'] == 'edit') {
    try {
        $stmt = $db->prepare("UPDATE prodi SET nama_prodi = ?, jenjang_prodi = ? WHERE id = ?");
        $stmt->execute([$_POST['nama_prodi'], $_POST['jenjang'], $_POST['id']]);
        
        echo "<script>window.location='index.php?p=prodi'</script>";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if ($_GET['proses'] == 'delete') {
    try {
        $stmt = $db->prepare("DELETE FROM prodi WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        
        header('location:index.php?p=prodi');
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>