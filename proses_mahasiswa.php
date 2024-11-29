<?php
include 'koneksi.php';

if($_GET['proses'] == 'insert'){
    try {
        $tgl = $_POST['thn'] . '-' . $_POST['bln'] . '-' . $_POST['tgl'];
        $hobies = implode(",", $_POST['hobi']);

        $stmt = $pdo->prepare("INSERT INTO mahasiswa 
            (nim, nama_mhs, tgl_lahir, jekel, hobi, email, prodi_id, notelp, alamat) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $result = $stmt->execute([
            $_POST['nim'], 
            $_POST['nama'], 
            $tgl, 
            $_POST['jekel'], 
            $hobies, 
            $_POST['email'], 
            $_POST['id_prodi'], 
            $_POST['notelp'], 
            $_POST['alamat']
        ]);

        if($result){
            header('Location: index.php?p=mhs');
            exit();
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if($_GET['proses'] == 'edit'){
    try {
        $tgl = $_POST['thn'] . '-' . $_POST['bln'] . '-' . $_POST['tgl'];
        $hobies = implode(",", $_POST['hobi']);

        $stmt = $pdo->prepare("UPDATE mahasiswa SET
            nama_mhs = ?,
            tgl_lahir = ?,
            jekel = ?,
            hobi = ?,
            email = ?,
            prodi_id = ?,
            notelp = ?,
            alamat = ? 
            WHERE nim = ?");
        
        $result = $stmt->execute([
            $_POST['nama'], 
            $tgl, 
            $_POST['jekel'], 
            $hobies, 
            $_POST['email'], 
            $_POST['id_prodi'], 
            $_POST['notelp'], 
            $_POST['alamat'],
            $_POST['nim']
        ]);

        if($result){
            header('Location: index.php?p=mhs');
            exit();
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if($_GET['proses'] == 'delete'){
    try {
        $stmt = $pdo->prepare("DELETE FROM mahasiswa WHERE nim = ?");
        $result = $stmt->execute([$_GET['nim']]);

        if($result){
            header('Location: index.php?p=mhs');
            exit();
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>