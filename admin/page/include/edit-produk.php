<?php
require '../../../db/koneksi.php';

if (isset($_POST['update'])) {

    $id    = $_POST['id'];
    $harga = preg_replace('/[^0-9]/', '', $_POST['harga']);
    $harga = $_POST['harga'];

    // Ambil gambar lama
    $query = mysqli_query($koneksi, "SELECT gambar FROM produk WHERE id='$id'");
    $row   = mysqli_fetch_assoc($query);
    $gambar_lama = $row['gambar'];

    // Jika upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {

        $file      = $_FILES['gambar']['name'];
        $tmp       = $_FILES['gambar']['tmp_name'];
        $ext       = pathinfo($file, PATHINFO_EXTENSION);

        $nama_baru = "produk_" . time() . "." . $ext;
        $path      = "../../../assets/produk/" . $nama_baru;

        move_uploaded_file($tmp, $path);

        // Hapus file lama
        unlink("../../../assets/produk/" . $gambar_lama);

    } else {
        $nama_baru = $gambar_lama;
    }

    $update = mysqli_query($koneksi, 
        "UPDATE produk SET 
            nama='$nama', 
            harga='$harga',
            gambar='$nama_baru'
        WHERE id='$id'"
    );

    if ($update) {
        header("Location: ../produk.php?sukses=1");
    } else {
        header("Location: ../produk.php?gagal=1");
    }
}
?>
