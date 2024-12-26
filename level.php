<?php
include 'koneksi.php';

// Cek akses user
if (!isset($_SESSION['level'])) {
    header('Location: ../index.php');
    exit;
}

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Level</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <a href="index.php?p=level&aksi=input" class="btn btn-success">
                    <i class="fas fa-plus-circle"></i> Tambah Level
                </a>
            </div>
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Level</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $stmt = $db->query("SELECT * FROM level");
                    $no = 1;
                    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($data['nama_level']) ?></td>
                            <td><?= htmlspecialchars($data['keterangan']) ?></td>
                            <td>
                                <a href="index.php?p=level&aksi=edit&id=<?= $data['id'] ?>" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="proses_level.php?proses=delete&id=<?= $data['id'] ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
break;

case 'input':
?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Input Level</h3>
        </div>
        <div class="card-body">
            <form action="proses_level.php?proses=insert" method="POST">
                <div class="form-group">
                    <label>Nama Level</label>
                    <input type="text" class="form-control" name="nama_level" required>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
        </div>
    </div>
<?php
break;

case 'edit':
    $stmt = $db->prepare("SELECT * FROM level WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Level</h3>
        </div>
        <div class="card-body">
            <form action="proses_level.php?proses=edit" method="POST">
                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                <div class="form-group">
                    <label>Nama Level</label>
                    <input type="text" class="form-control" name="nama_level" value="<?= htmlspecialchars($data['nama_level']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" rows="3"><?= htmlspecialchars($data['keterangan']) ?></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
        </div>
    </div>
<?php
break;
}
?> 