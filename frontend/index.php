<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Jurusan TI</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>

</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php?p=home">App TI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <?php
            $p=isset($_GET['p']) ? $_GET['p'] : 'home';
            ?>
            <li class="nav-item">
            <a class="nav-link <?= ($p == 'home') ? 'active' : '' ?> " aria-current="page" href="index.php?p=home">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link <?= ($p == 'mhs') ? 'active' : '' ?> " href="index.php?p=mhs">Mahasiswa</a>
            </li>
            <li class="nav-item">
            <a class="nav-link <?= ($p == 'prodi') ? 'active' : '' ?> " href="index.php?p=prodi">Prodi</a>
            </li>
            <li class="nav-item">
            <a class="nav-link <?= ($p == 'dosen') ? 'active' : '' ?> " href="index.php?p=dosen">Dosen</a>
            </li>
            <li class="nav-item">
            <a class="nav-link <?= ($p == 'matakuliah') ? 'active' : '' ?> " href="index.php?p=matakuliah">Mata Kuliah</a>
            </li>
            <li class="nav-item">
            <a class="nav-link <?= ($p == 'user') ? 'active' : '' ?> " href="index.php?p=user">User</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
            </li>
            <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
        </ul>
        
        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
            
            <a class="nav-link" href="login.php"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
  <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
</svg></i> Login</a>
            </li>
        </ul>

        </div>
    </div>
    </nav>

    <div class="container">
        <?php
            $page=isset($_GET['p']) ? $_GET['p'] : 'home';
            if($page=='home') include 'home.php';
            if($page=='mhs') include 'mahasiswa.php';
            if($page=='prodi') include 'prodi.php';
            if($page=='dosen') include 'dosen.php';
            if($page=='matakuliah') include 'matakuliah.php';
            if($page=='user') include 'user.php';
           
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        new DataTable('#example');
    </script>
</body>