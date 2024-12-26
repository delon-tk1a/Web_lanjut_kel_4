<h2>Data User</h2>
<table id="example" class="display">
    <thead>
        <tr>
            <th>No</th>
            <th>Email</th>
            <th>Level</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include 'admin/koneksi.php';
            try {
                $stmt = $db->query("SELECT * FROM user");
                $no = 1;
                while ($data_user = $stmt->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
            <td><?= $no++?></td>
            <td><?= $data_user['email']?></td>
            <td><?= $data_user['level_id']?></td>
        </tr>
        <?php
                }
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        ?>
    </tbody>
</table>