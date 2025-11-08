<?php
require '../../../db/koneksi.php';

if (isset($_POST['simpan'])) {

    $nama  = $_POST['nama'];
    $harga = preg_replace('/[^0-9]/', '', $_POST['harga']); // ✅ hanya angka

    // Upload file
    $file = $_FILES['gambar']['name'];
    $tmp  = $_FILES['gambar']['tmp_name'];

    $ext  = pathinfo($file, PATHINFO_EXTENSION);
    $nama_gambar = "produk_" . time() . "." . $ext;

    $path = "../../../assets/produk/" . $nama_gambar;
    move_uploaded_file($tmp, $path);

    $query = mysqli_query($koneksi, 
        "INSERT INTO produk (nama, harga, gambar) 
         VALUES ('$nama', '$harga', '$nama_gambar')"
    );

    if ($query) {
        header("Location: ../produk.php?sukses=1");
    } else {
        header("Location: ../produk.php?gagal=1");
    }
}
?>
