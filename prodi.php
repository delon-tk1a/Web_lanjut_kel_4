<?php 
$aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
?>

    <div class="row-mb-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Prodi</h1>
    </div>
    <div class="col-2 mb-3">
                <a href="index.php?p=prodi&aksi=input" class="btn btn-primary"><i class="bi bi-person-plus"></i> Tambah Prodi</a>
            </div>
            <div class="table-responsive small">
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Nama Prodi</th>
                    <th>Jenjang</th>
                    <th>Aksi</th>
                    
                    
                </tr>
                <?php
                    include 'koneksi.php';
                    $stmt = $db->query("SELECT * FROM prodi");
                    $no = 1;
                    while($data = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                    <td><?=$no++?></td>
                    <td><?=$data['nama_prodi']?></td>
                    <td><?=$data['jenjang_prodi']?></td>
                    <td>
                        <a href="index.php?p=prodi&aksi=edit&id=<?=$data['id']?>" class="btn btn-success"><i class="bi bi-pencil"></i> Edit</a>
                        <a href="proses_prodi.php?proses=delete&id=<?=$data['id']?>" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')"><i class="bi bi-trash"></i> Delete</a>
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
        <div class="row-mb-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Prodi</h1>
        </div>
            <div class="col-6 mx-auto">
                <br>
                <form action="proses_prodi.php?proses=insert" method="post">
                <div class="mb-3">
                    <label class="form-label">Nama Prodi</label>
                    <input type="text" class="form-control" name="nama_prodi">
                </div>
                
              
                    <div class="mb-3">
                        <label class="form-label">Jenjang</label>
                        <select select class="form-select" name="jenjang">
                            <option selected>~ Pilih Jenjang ~</option>
                            <?php
                                $jenjang=['D3','D4','S1','S2'];
                                foreach($jenjang as $jenjangprodi){
                                    echo "<option value=".$jenjangprodi.">".$jenjangprodi."</option>";
                                }
                            ?>
                        </select> 
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
        include 'koneksi.php';
        $stmt = $db->prepare("SELECT * FROM prodi WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $data_prodi = $stmt->fetch(PDO::FETCH_ASSOC);
?>

        <div class="row-mb-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Prodi</h1>
        </div>
            <div class="col-6 mx-auto">
                <br>
                
                <form action="proses_prodi.php?proses=edit" method="post">
                <div class="mb-3">
                    <label class="form-label">Nama Prodi</label>
                    <input type="hidden" class="form-control" name="id" value="<?=$data_prodi['id'] ?>">
                    <input type="text" class="form-control" name="nama_prodi" value="<?=$data_prodi['nama_prodi'] ?>">
                </div>
                
              
                <div class="mb-3">
                    <label class="form-label">Jenjang</label>
                    <select select class="form-select" name="jenjang">
                        <option selected>~ Pilih Jenjang ~</option>
                        <?php
                            $jenjang=['D3','D4','S1','S2'];
                            foreach($jenjang as $jenjangprodi){
                            $selected=($data_prodi['jenjang_prodi']==$jenjangprodi) ? 'selected' : ''; 
                            echo "<option value=".$jenjangprodi." $selected>".$jenjangprodi."</option>";
                            }
                        ?>
                    </select> 
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
                </div>
                <hr>
                </form>
            </div>
        </div>

<?php
        break;

}
?>
        

