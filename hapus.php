<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


require 'functions.php';

$id = $_GET["id"];

if (hapus($id) > 0) {
    echo "
        <script>
            alert('data BERHASIL dihapus!');
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
