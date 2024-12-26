<h2>Data Mata Kuliah</h2>
<table id="example" class="display">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Mata Kuliah</th>
            <th>Nama Mata Kuliah</th>
            <th>Semester</th>
            <th>Jenis Mata Kuliah</th>
            <th>SKS</th>
            <th>Jam</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include 'admin/koneksi.php';
            try {
                $stmt = $db->query("SELECT * FROM matakuliah");
                $no = 1;
                while ($data_matkul = $stmt->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
            <td><?=$no++?></td>
            <td><?=$data_matkul['kode_matakuliah']?></td>
            <td><?=$data_matkul['nama_matakuliah']?></td>
            <td><?=$data_matkul['semester']?></td>
            <td><?=$data_matkul['jenis_matakuliah']?></td>
            <td><?=$data_matkul['sks']?></td>
            <td><?=$data_matkul['jam']?></td>
            <td><?=$data_matkul['keterangan']?></td>
        </tr>
        <?php
                }
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        ?>
    </tbody>
</table>