<?php 
include 'koneksi.php';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch($aksi){
    case 'list': 
?>
    <div class="row-mb-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Mahasiswa</h1>
    </div>
        <div class="col-2 mb-3">
            <a href="index.php?p=mhs&aksi=input" class="btn btn-primary"><i class="bi bi-person-plus"></i> Tambah Mahasiswa</a>
        </div>
        <div class="table-responsive small">
        <table class="table table-bordered" id="example">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Tanggal Lahir</th>
                <th>Email</th>
                <th>Prodi</th>
                <th>No Telp</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $stmt = $pdo->query("SELECT * FROM prodi INNER JOIN mahasiswa ON prodi.id=mahasiswa.prodi_id");
                $no = 1;
                while($data = $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($data['nama_mhs']) ?></td>
                <td><?= $data['tgl_lahir'] ?></td>
                <td><?= htmlspecialchars($data['email']) ?></td>
                <td><?= htmlspecialchars($data['nama_prodi']) ?></td>
                <td><?= $data['notelp'] ?></td>
                <td><?= htmlspecialchars($data['alamat']) ?></td>
                <td>
                    <a href="index.php?p=mhs&aksi=edit&nim=<?= $data['nim'] ?>" class="btn btn-success"><i class="bi bi-pencil"></i> Edit</a>
                    <a href="proses_mahasiswa.php?proses=delete&nim=<?= $data['nim'] ?>" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')"><i class="bi bi-trash"></i> Delete</a>
                </td>
            </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
        </div>
    </div>
    <?php
    break;

    case 'input':
    ?>
    <div class="row-mb-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Input Mahasiswa</h1>
    </div>
        <div class="col-6 mx-auto">
            <br>
            <form action="proses_mahasiswa.php?proses=insert" method="post">
            <div class="mb-3">
                    <label class="form-label">NIM</label>
                    <input type="number" class="form-control" name="nim">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="row">
                    <div class="mb-3 col-3">
                        <label class="form-label">Tgl</label>
                        <select select class="form-select" name="tgl">
                            <option selected>-Tgl-</option>
                            <?php
                                for($i=1; $i<=31; $i++){
                                    echo "<option value=".$i.">".$i."</option>";
                                }
                            ?>
                        </select> 
                    </div>
                    <div class="mb-3 col-3">
                        <label class="form-label">Bln</label>
                        <select select class="form-select" name="bln">
                            <option selected>-Bln-</option>
                            <?php
                                $bulan=[1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                                foreach($bulan as $indexbulan => $namabulan){
                                    echo "<option value=".$indexbulan.">".$namabulan."</option>";
                                }
                            ?>
                        </select> 
                    </div>
                    <div class="mb-3 col-3">
                        <label class="form-label">Thn</label>
                        <select select class="form-select" name="thn">
                            <option selected>-Thn-</option>
                            <?php
                                for($i=2024; $i>=1900; $i--){
                                    echo "<option value=".$i.">".$i."</option>";
                                }
                            ?>
                        </select> 
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="L" name="jekel">
                        <label class="form-check-label">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="P" name="jekel">
                        <label class="form-check-label">Perempuan</label>
                    </div>
                </div> 
                <div class="mb-3">
                    <label class="form-label">Hobi</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Membaca" name="hobi[]">
                        <label class="form-check-label">Membaca</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Olahraga" name="hobi[]">
                        <label class="form-check-label">Olahraga</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Travelling" name="hobi[]">
                        <label class="form-check-label">Travelling</label>
                    </div>
                </div>     
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
            <div class="mb-3">
                <label class="form-label">Prodi</label>
                <select class="form-select" name="id_prodi">
                    <option selected>-Pilih Prodi-</option>
                    <?php
                        $stmt = $pdo->query("SELECT * FROM prodi");
                        while ($data_prodi = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='{$data_prodi['id']}'>{$data_prodi['nama_prodi']}</option>";
                        }
                    ?>
                </select> 
            </div>
            <div class="mb-3">
                    <label class="form-label">No Telp</label>
                    <input type="number" class="form-control" name="notelp">
                </div>
                <div class="mb-3">
                    <label class="form-label" >Alamat</label>
                    <textarea class="form-control"  rows="3" name="alamat"></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    <button type="reset" class="btn btn-warning" name="reset">Reset</button>
                </div>
            <!-- Sisa form tetap sama seperti sebelumnya -->
            </form>
        </div>
    </div>
    <?php
    break;
    
    case 'edit':
        $nim = $_GET['nim'];
        $stmt = $pdo->prepare("SELECT * FROM mahasiswa WHERE nim = ?");
        $stmt->execute([$nim]);
        $data_mhs = $stmt->fetch(PDO::FETCH_ASSOC);
        $tgl = explode("-", $data_mhs['tgl_lahir']);
        $hobies = explode(",", $data_mhs['hobi']);
    ?>
    <div class="row-mb-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Mahasiswa</h1>
    </div>
        <div class="col-6 mx-auto">
            <br>
            <form action="proses_mahasiswa.php?proses=edit" method="post">
            <div class="mb-3">
                    <label class="form-label">NIM</label>
                    <input type="number" class="form-control" name="nim" value="<?=$data_mhs['nim']?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?=$data_mhs['nama_mhs']?>">
                </div>
                <div class="row">
                    <div class="mb-3 col-3">
                        <label class="form-label">Tgl</label>
                        <select select class="form-select" name="tgl">
                            <option selected>-Tgl-</option>
                            <?php
                                for($i=1; $i<=31; $i++){
                                    $selected=($tgl[2]==$i) ? 'selected':''; //ternary
                                    echo "<option value=".$i." $selected>".$i."</option>";
                                }
                            ?>
                        </select> 
                    </div>
                    <div class="mb-3 col-3">
                        <label class="form-label">Bln</label>
                        <select select class="form-select" name="bln">
                            <option selected>-Bln-</option>
                            <?php
                                $bulan=[1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                                foreach($bulan as $indexbulan => $namabulan){
                                    $selected=($tgl[1]==$indexbulan) ? 'selected':''; //ternary
                                    echo "<option value=".$indexbulan." $selected>".$namabulan."</option>";
                                }
                            ?>
                        </select> 
                    </div>
                    <div class="mb-3 col-3">
                        <label class="form-label">Thn</label>
                        <select select class="form-select" name="thn">
                            <option selected>-Thn-</option>
                            <?php
                                for($i=2024; $i>=1900; $i--){
                                    $selected=($tgl[0]==$i) ? 'selected':''; //ternary
                                    echo "<option value=".$i." $selected>".$i."</option>";
                                }
                            ?>
                        </select> 
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="L" name="jekel" <?= ($data_mhs['jekel']) == 'L' ? 'checked': '' ?> >
                        <label class="form-check-label">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="P" name="jekel" <?= ($data_mhs['jekel']) == 'P' ? 'checked': '' ?> >
                        <label class="form-check-label">Perempuan</label>
                    </div>
                </div> 
                <div class="mb-3">
                    <label class="form-label">Hobi</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Membaca" name="hobi[]" <?php if(in_array('Membaca',$hobies)) echo 'checked' ?> >
                        <label class="form-check-label">Membaca</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Olahraga" name="hobi[]" <?php if(in_array('Olahraga',$hobies)) echo 'checked' ?>>
                        <label class="form-check-label">Olahraga</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="Travelling" name="hobi[]" <?php if(in_array('Travelling',$hobies)) echo 'checked' ?>>
                        <label class="form-check-label">Travelling</label>
                    </div>
                </div>     
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="<?=$data_mhs['email']?>">
                </div>
            <!-- Form edit mahasiswa sama seperti sebelumnya -->
            <div class="mb-3">
                <label class="form-label">Prodi</label>
                <select class="form-select" name="id_prodi">
                    <option selected>-Pilih Prodi-</option>
                    <?php
                        $stmt = $pdo->query("SELECT * FROM prodi");
                        while ($data_prodi = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($data_prodi['id'] == $data_mhs['prodi_id']) ? 'selected' : '';
                            echo "<option value='{$data_prodi['id']}' $selected>{$data_prodi['nama_prodi']}</option>";
                        }
                    ?>
                </select> 
            </div>
            <div class="mb-3">
                    <label class="form-label">No Telp</label>
                    <input type="number" class="form-control" name="notelp" value="<?=$data_mhs['notelp']?>">
                </div>
                <div class="mb-3">
                    <label class="form-label" >Alamat</label>
                    <textarea class="form-control"  rows="3" name="alamat"><?= htmlspecialchars($data_mhs['alamat']) ?></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
                   
                </div>
            <!-- Sisa form tetap sama seperti sebelumnya -->
            </form>
        </div>
    </div>
    <?php 
    break;
}
?>