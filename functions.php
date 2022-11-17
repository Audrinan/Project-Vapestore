<?php
//1.koneksi db
$conn = mysqli_connect('localhost', 'root', '', 'phpdasar-16');

//2. ambil data dari tabel produk / query data produk
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $harga = htmlspecialchars($data['harga']);


    // <div style=position:absolute;top:0;bottom:0;left:0;right:0;background-color:black;font-size:100px;color:red;text-align:center;>HAHAHA DI HACK</div

    $query = "INSERT INTO produk 
                VALUES 
                ('','$nama','$harga')
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpNama = $_FILES['gambar']['tmp_name'];

    // 1. cek tidak ada gambar
    if ($error === 4) {
        echo "<script>
            alert('pilih gambar DAHULU!');
        </script>";

        return false;
    }

    // 2. cek gambar atau bukan
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('yang anda upload BUKAN gambar!');
    </script>";

        return false;
    }

    // 3. cek size img kebesaran
    if ($ukuranFile > 50000000) {
        echo "<script>
        alert('ukuran gambar terlalu besar!');
    </script>";

        return false;
    }

    // 4. lolos pengecekan, gambar siap diupload
    // generate nama img baru

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpNama, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM produk WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;

    $id = $data['id'];
    $nama = htmlspecialchars($data['nama']);
    $harga = htmlspecialchars($data['harga']);


    $query = "UPDATE produk SET 
                nama = '$nama',
                harga = '$harga',
                WHERE id = $id
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM produk WHERE
            nama LIKE '%$keyword%' OR
            harga LIKE '%$keyword%' OR
    ";
    return query($query);
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    // username udh ada/blm
    $result = mysqli_query(
        $conn,
        "SELECT username FROM user WHERE username = '$username'"
    );

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('username sudah ada!');
        </script>";

        return false;
    }

    // cek confirm password
    if ($password !== $password2) {
        echo "<script>
            alert('password 1 dan 2 tidak sesuai');
        </script>";
        return false;
    }

    // return 1;
    // enkripsi password dlu
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambah user baru ke database
    mysqli_query(
        $conn,
        "INSERT INTO user VALUES('', '$username', '$password')"
    );

    return mysqli_affected_rows($conn);
    // menyatakan jika ada yang 1/-1 berhasil/gagal, adayang berubah didatabase
}
