<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit();
}

require 'functions.php';

$id = $_GET['id'];

// query data mhs berdasarkan id
$produk = query("SELECT * FROM produk Where id = $id")[0];
// var_dump($mahasiswa["nama"]);

if (isset($_POST['submit'])) {
    if (ubah($_POST) > 0) {
        echo "
        <script>
            alert('data BERHASIL di UBAH!');
            document.location.href = 'produk.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('data GAGAL di UBAH!');
            document.location.href = 'produk.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="produk.php">Produk</a>
                </li>
                <li class="nav-item">
                <a class="btn btn-danger align-items-end" href="logout.php">LOGOUT</a>
                </li>
            </ul>
            </div>
        </div>
        </nav>
    <!-- navbar -->



    <h1 class="text-center">UBAH Data Produk</h1>
    <br>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $produk['id'] ?>">
        <ul>
            <li>
                <label for="nama" class="mt-2">Nama</label>
                <input type="text" name="nama" id="nama" value="<?= $produk[
                    'nama'
                ] ?>">
            </li>
            <li>
                <label for="harga" class="mt-2">Harga</label>
                <input type="text" name="harga" id="harga" value="<?= $produk[
                    'harga'
                ] ?>">
            </li>
            <li>
                <button type="submit" name="submit" class="mt-2">Ubah Data</button>
            </li>
        </ul>
    </form>





</body>

</html>