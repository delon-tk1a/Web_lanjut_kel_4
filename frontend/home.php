<h1>Berita</h1>

<div class="row">
    <?php
        include 'admin/koneksi.php';
        try {
            $stmt = $db->query("SELECT * FROM berita ORDER BY id DESC");
            $select_berita = isset($_GET['id']) ? $_GET['id'] : null;
            
            while($berita = $stmt->fetch(PDO::FETCH_ASSOC)){ 
                if ($select_berita == null || $berita['id'] != $select_berita) {
    ?>
    <div class="col-4">
        <div class="card" style="width: 18rem;">
            <img src="admin/uploads/<?= $berita['file_upload']?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $berita['judul'] ?></h5>
                <p class="card-text"><?= substr($berita['isi_berita'],0,150) ?></p>
                <a href="index.php?p=home&id=<?=$berita['id']?>" class="btn btn-primary">Readmore...</a>
            </div>
        </div>
    </div>
    <?php
                } else {
    ?>
    <div class="card">
        <img src="admin/uploads/<?= $berita['file_upload']?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?= $berita['judul'] ?></h5>
            <p class="card-text"><?= $berita['isi_berita'] ?></p>
            <a href="index.php?p=home" class="btn btn-primary">Back</a>
        </div>
    </div>
    <?php
                }
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    ?>
</div>