<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit();
}

require 'functions.php';

if (isset($_POST['submit'])) {
    // var_dump($_POST);
    // var_dump($_FILES);
    // die();

    // cek data berhasil ditambah /tidak
    // var_dump(mysqli_affected_rows($conn));
    // if (mysqli_affected_rows($conn) > 0) {
    //     echo "berhasil";
    // } else {
    //     echo "gagal";
    //     echo "<br>";
    //     echo mysqli_error($conn);
    // }

    if (tambah($_POST) > 0) {
        echo "
        <script>
            alert('data BERHASIL ditambahkan!');
            document.location.href = 'produk.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('data GAGAL ditambahkan!');
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
    <title>Tambah Data - 157 Vapestore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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


    <h1 class="text-center">Tambah Data Produk</h1>
   

    <form action="" method="post" enctype="multipart/form-data" class="justify-content-center">
        <ul class="justify-content-center">
            <li class="mt-2">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama">
            </li>
            <li class="mt-2">
                <label for="harga">Harga</label>
                <input type="text" name="harga" id="harga">
            </li>
            <li class="mt-2">
                <button type="submit" name="submit">Tambah Data</button>
            </li>
        </ul>
    </form>
</body>

</html>