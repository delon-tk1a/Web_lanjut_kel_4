<?php
include 'koneksi.php';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
?>

<div class="row">
    <div class="col-2 mb-3">
        <a href="index.php?p=matkul&aksi=input" class="btn btn-primary">
            <i class="bi bi-person-plus"></i> Tambah MataKuliah
        </a>
    </div>
    
    <div class="table-responsive small">
        <table class="table table-bordered table-striped table-sm" id="example">
            <tr>
                <th>ID</th>
                <th>Kode Matakuliah</th>
                <th>Nama Matakuliah</th>
                <th>Semester</th>
                <th>Jenis Matakuliah</th>
                <th>SKS</th>
                <th>Jam</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
            <?php
                $stmt = $db->query("SELECT * FROM matakuliah");
                $no = 1;
                while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($data['kode_matakuliah']) ?></td>
                <td><?= htmlspecialchars($data['nama_matakuliah']) ?></td>
                <td><?= htmlspecialchars($data['semester']) ?></td>
                <td><?= htmlspecialchars($data['jenis_matakuliah']) ?></td>
                <td><?= htmlspecialchars($data['sks']) ?></td>
                <td><?= htmlspecialchars($data['jam']) ?></td>
                <td><?= htmlspecialchars($data['keterangan']) ?></td>
                <td>
                    <div class="d-flex">
                        <a href="index.php?p=matkul&aksi=edit&id=<?= $data['id'] ?>" class="btn btn-success me-2">Edit</a>
                        <a href="proses_matkul.php?proses=delete&id=<?= $data['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')">Delete</a>
                    </div>
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
</div>

<?php
    break;

    case 'input':
?>

<div class="row">
    <div class="col-6 mx-auto">
        <br>
        <h2>Form Registrasi Matakuliah</h2>
        <form action="proses_matkul.php?proses=insert" method="post">
            <div class="mb-3">
                <label class="form-label">Kode Matakuliah</label>
                <input type="text" class="form-control" name="kode_matakuliah">
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Matakuliah</label>
                <input type="text" class="form-control" name="nama_matakuliah">
            </div>
            <div class="mb-3">
                <label class="form-label">Semester</label>
                <input type="number" class="form-control" name="semester">
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Matakuliah</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" value="Teori" name="jenis_matakuliah">
                    <label class="form-check-label">Teori</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" value="Praktek" name="jenis_matakuliah">
                    <label class="form-check-label">Praktek</label>
                </div>
            </div> 
            <div class="mb-3">
                <label class="form-label">SKS</label>
                <input type="number" class="form-control" name="sks">
            </div>
            <div class="mb-3">
                <label class="form-label">Jam</label>
                <input type="number" class="form-control" name="jam">
            </div>
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea class="form-control" rows="3" name="keterangan"></textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <button type="reset" class="btn btn-warning" name="reset">Reset</button>
            </div>
            <hr>
        </form>
    </div>
</div>

<?php
    break;

    case 'edit':
        $stmt = $db->prepare("SELECT * FROM matakuliah WHERE id = :id");
        $stmt->execute(['id' => $_GET['id']]);
        $data_matkul = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="row">
    <div class="col-6 mx-auto">
        <br>
        <h2>Edit Data Matakuliah</h2>
        <form action="proses_matkul.php?proses=edit" method="post">
            <div class="mb-3">
                <label class="form-label">ID</label>
                <input type="number" class="form-control" name="id" value="<?= $data_matkul['id'] ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Kode Matakuliah</label>
                <input type="text" class="form-control" name="kode_matakuliah" value="<?= $data_matkul['kode_matakuliah'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Matakuliah</label>
                <input type="text" class="form-control" name="nama_matakuliah" value="<?= $data_matkul['nama_matakuliah'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Semester</label>
                <input type="number" class="form-control" name="semester" value="<?= $data_matkul['semester'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Matakuliah</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" value="Teori" name="jenis_matakuliah" <?= ($data_matkul['jenis_matakuliah'] == "Teori") ? 'checked' : '' ?>>
                    <label class="form-check-label">Teori</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" value="Praktek" name="jenis_matakuliah" <?= ($data_matkul['jenis_matakuliah'] == "Praktek") ? 'checked' : '' ?>>
                    <label class="form-check-label">Praktek</label>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">SKS</label>
                <input type="number" class="form-control" name="sks" value="<?= $data_matkul['sks'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Jam</label>
                <input type="number" class="form-control" name="jam" value="<?= $data_matkul['jam'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea class="form-control" rows="3" name="keterangan"><?= $data_matkul['keterangan'] ?></textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <button type="reset" class="btn btn-warning" name="reset">Reset</button>
            </div>
            <hr>
        </form>
    </div>
</div>

<?php
    break;
}
?>
