<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit();
}

require 'functions.php';

$jumlahDataPerHalaman = 3;


$jumlahData = count(query('SELECT * FROM produk'));

$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
// var_dump($jumlahHalaman);

if (isset($_GET['halaman'])) {
    $halamanAktif = $_GET['halaman'];
} else {
    $halamanAktif = 1;
}
// var_dump($halamanAktif);
// klo pake operator ternary
// =
// $halamanAktif = ( isset('halaman')) ? $_GET['halaman] : 1;

// halaman = 2, awalData = 3
$awalData = $jumlahDataPerHalaman * $halamanAktif - $jumlahDataPerHalaman;

$produk = query(
    "SELECT * FROM produk LIMIT $awalData, $jumlahDataPerHalaman"
);

//tombol cari ditekan
if (isset($_POST['cari'])) {
    $mahasiswa = cari($_POST['keyword']);
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - 157 Vapestore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .loader {
            width: 100px;
            position: absolute;
            top: 170px;
            left: 330px;
            z-index: -1;
            display: none;
        }
    </style>




    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="js/script.js"></script>
</head>

<body>
   <!-- navbar -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <a class="navbar-brand" href="index.php">157 Vapestore</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="produk.php">Produk</a>
                </li>
                <li class="nav-item">
                <a class="btn btn-danger align-items-end" href="logout.php">LOGOUT</a>
                </li>
            </ul>
            </div>
        </div>
        </nav>
    <!-- navbar -->



    <div class="container">
        <!-- <a href="logout.php">LOGOUT</a> -->
    <br>

<h1>Produk</h1>
<a href="tambah.php" class="btn btn-primary">Tambah data</a>
<br><br>

<form action="" method="post">
    <input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword!" autocomplete="off" id="keyword">
    <button type="submit" name="cari" id="tombol-cari">Cari!</button>
    <img src="img/loader/loader1.gif" alt="" class="loader">
</form>















<br><br>
<!-- navigasi -->
<?php if ($halamanAktif > 1): ?>
    <a href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a>
<?php endif; ?>



<?php for ($i = 1; $i <= $jumlahHalaman; $i++): ?>
    <?php if ($i == $halamanAktif): ?>
        <a href="?halaman=<?= $i ?>" style="font-weight: bold; color: red;"><?= $i ?></a>
    <?php else: ?>
        <a href="?halaman=<?= $i ?>"><?= $i ?></a>
    <?php endif; ?>
<?php endfor; ?>


<?php if ($halamanAktif < $jumlahHalaman): ?>
    <a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
<?php endif; ?>

<!-- navigasi -->


<br>
<div id="container">
<table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <tr>
            <?php $i = 1; ?>
            <?php foreach ($produk as $row): ?>
                <td><?= $i ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['harga'] ?></td>
                <td>
                    <a href="ubah.php?id=<?= $row[
                        'id'
                    ] ?>" class="btn btn-warning">ubah</a> |
                    <a href="hapus.php?id=<?= $row[
                        'id'
                    ] ?>" class="btn btn-danger" onclick="return confirm('yakin?');">hapus</a>
                </td>
        </tr>
        <?php $i++; ?>
    <?php endforeach; ?>
    </table>
</div>
    </div>


</body>

</html>