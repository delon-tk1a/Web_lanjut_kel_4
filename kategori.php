<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kategori</h1>
</div>
<?php 
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
?>
    <div class="row">
        <div class="col-2 mb-3">
            <a href="index.php?p=kategori&aksi=input" class="btn btn-primary">Tambah kategori</a>
        </div>
        
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
            <?php
                include 'koneksi.php';
                try {
                    $stmt = $db->query("SELECT * FROM kategori");
                    while($data = $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr>
                <td><?=$data['id']?></td>
                <td><?=$data['nama_kategori']?></td>
                <td><?=$data['keterangan']?></td>
                <td>
                    <a href="index.php?p=kategori&aksi=edit&id=<?=$data['id']?>" class="btn btn-success">Edit</a>
                    <a href="proses_kategori.php?proses=delete&id=<?=$data['id']?>" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')">Delete</a>
                </td>
            </tr>
            <?php
                    }
                } catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            ?>
        </table>
    </div>    
   
<?php
    break;

    case 'input':    
?>
        <div class="row">
            <div class="col-6 mx-auto">
                <br>
                <h2>Data kategori</h2>
                <form action="proses_kategori.php?proses=insert" method="post">
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" name="nama_kategori">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <input type="text" class="form-control" name="keterangan">
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
        try {
            $stmt = $db->prepare("SELECT * FROM kategori WHERE id = :id");
            $stmt->execute([':id' => $_GET['id']]);
            $data_kategori = $stmt->fetch(PDO::FETCH_ASSOC);
?>
        <div class="row">
            <div class="col-6 mx-auto">
                <br>
                <h2>Data Kategori</h2>
                <form action="proses_kategori.php?proses=edit" method="post">
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="hidden" class="form-control" name="id" value="<?=$data_kategori['id']?>">
                    <input type="text" class="form-control" name="nama_kategori" value="<?=$data_kategori['nama_kategori']?>">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <input type="text" class="form-control" name="keterangan" value="<?=$data_kategori['keterangan']?>">
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
                </div>
                <hr>
                </form>
            </div>
        </div>

<?php
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        break;
}
?>