<?php
include 'koneksi.php';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
        ?>

        <div class="row">

            <div class="table-responsive small">
                <table class="table table-bordered">
                    <tr>
                        <th>id</th>
                        <th>NIP</th>
                        <th>Nama Dosen</th>
                        <th>Email</th>
                        <th>Prodi</th>
                        <th>NO Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>

                    <?php
                    $stmt = $db->query("SELECT dosen.*, prodi.nama_prodi FROM dosen JOIN prodi ON dosen.prodi_id = prodi.id");
                    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <td><?= $data['id'] ?></td>
                            <td><?= $data['nip'] ?></td>
                            <td><?= $data['nama_dosen'] ?></td>
                            <td><?= $data['email'] ?></td>
                            <td><?= $data['nama_prodi'] ?></td>
                            <td><?= $data['notelp'] ?></td>
                            <td><?= $data['alamat'] ?></td>
                            <td>
                                <a href="index.php?p=dosen&aksi=edit&id=<?= $data['id'] ?>" class="btn btn-success">Edit</a>
                                <a href="proses_dosen.php?proses=delete&id=<?= $data['id'] ?>" class="btn btn-danger"
                                    onclick="return confirm('Yakin mau dihapus?')">Delete</a>
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

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Form Registrasi Dosen</h3>
            </div>
            <div class="card-body">
                <form action="proses_dosen.php?proses=insert" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <input type="number" class="form-control" name="nip" placeholder="NIP">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="nama_dosen" placeholder="Nama Dosen">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label>Prodi</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                            </div>
                            <select name="prodi_id" class="form-control">
                                <option value="">Pilih Prodi</option>
                                <?php
                                $stmt = $db->query("SELECT * FROM prodi");
                                while ($data_prodi = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value=" . $data_prodi['id'] . ">" . $data_prodi['nama_prodi'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="number" class="form-control" name="notelp" placeholder="No Telp">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                        </div>
                        <textarea class="form-control" rows="3" name="alamat" placeholder="Alamat"></textarea>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        <button type="reset" class="btn btn-warning" name="reset">Reset</button>
                    </div>
                </form>
            </div>            
        </div>

        <?php
        break;

    case 'edit':
        $stmt = $db->prepare("SELECT * FROM dosen WHERE id = :id");
        $stmt->execute(['id' => $_GET['id']]);
        $data_dosen = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Edit Data Dosen</h3>
            </div>
            <div class="card-body">
                <form action="proses_dosen.php?proses=edit" method="post">
                    <input type="hidden" class="form-control" name="id" value="<?= $data_dosen['id'] ?>">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <input type="number" class="form-control" name="nip" value="<?= $data_dosen['nip'] ?>"
                            placeholder="NIP">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="nama_dosen" value="<?= $data_dosen['nama_dosen'] ?>"
                            placeholder="Nama Dosen">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" name="email" value="<?= $data_dosen['email'] ?>"
                            placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label>Prodi</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                            </div>
                            <select name="prodi_id" class="form-control">
                                <option value="" selected>Pilih Prodi</option>
                                <?php
                                $stmt = $db->query("SELECT * FROM prodi");
                                while ($data_prodi = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $selected = ($data_dosen['prodi_id'] == $data_prodi['id']) ? 'selected' : '';
                                    echo "<option value='" . $data_prodi['id'] . "' $selected>" . $data_prodi['nama_prodi'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="number" class="form-control" name="notelp" value="<?= $data_dosen['notelp'] ?>"
                            placeholder="No Telp">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                        </div>
                        <textarea class="form-control" rows="3" name="alamat"
                            placeholder="Alamat"><?= htmlspecialchars($data_dosen['alamat']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <?php
        break;
}
?>