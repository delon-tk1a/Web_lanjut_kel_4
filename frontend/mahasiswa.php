<h2>Data Mahasiswa</h2>
<table id="example" class="display">
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Email</th>
            <th>Prodi</th>
            <th>No Telp</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include 'admin/koneksi.php';
            try {
                $stmt = $db->query("SELECT m.*, p.nama_prodi 
                                   FROM mahasiswa m 
                                   INNER JOIN prodi p ON p.id = m.prodi_id");
                $no = 1;
                while ($data_mhs = $stmt->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
            <td><?= $no++?></td>
            <td><?= $data_mhs['nim']?></td>
            <td><?= $data_mhs['nama_mhs']?></td>
            <td><?= $data_mhs['email']?></td>
            <td><?= $data_mhs['nama_prodi']?></td>
            <td><?= $data_mhs['notelp']?></td>
            <td><?= $data_mhs['alamat']?></td>
        </tr>
        <?php
                }
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        ?>
    </tbody>
</table>