<?php
require 'db/koneksi.php';

if (isset($_POST['kirim'])) {
    $wa_penjual = $_POST['wa'];          // WhatsApp penjual
    $barang     = $_POST['barang'];      // Nama barang
    $pembeli    = $_POST['pembeli'];     // Nama pembeli
    $nowa       = $_POST['nowa'];        // WhatsApp pembeli
    $email      = $_POST['email'];
    $alamat     = $_POST['alamat'];
    $pesan      = $_POST['pesan'];
    $status     = $_POST['status'];

    // Cek apakah pesanan yang sama sudah pernah dikirim
    $cek = mysqli_query($koneksi, "SELECT * FROM pemesanan 
        WHERE barang = '$barang' AND pembeli = '$pembeli' AND nowa = '$nowa' AND email = '$email'");

    if (mysqli_num_rows($cek) == 0) {
        // Simpan ke database
        $query = "INSERT INTO pemesanan (wa_penjual, barang, pembeli, nowa, email, alamat, pesan)
                  VALUES ('$wa_penjual', '$barang', '$pembeli', '$nowa', '$email', '$alamat', '$pesan')";

        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Pesanan berhasil dikirim!'); window.location.href='index.php?sukses=1';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan pesanan: " . mysqli_error($koneksi) . "');</script>";
        }
    } else {
        // Pesanan sama sudah pernah dikirim
        echo "<script>alert('Pesanan ini sudah pernah dikirim!'); window.location.href='index.php?duplikat=1';</script>";
    }
}
?>


<!-- Modal Form -->
<div class="modal fade bd-example-modal-lg" id="pesan<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body pt-5 pb-5">
        <form method="post">
          <h2 class="mb-4">Buat Pesanan</h2>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="barang">Nama Barang</label>
              <input type="text" class="form-control" name="barang" value="<?php echo $data['nama']; ?>" readonly>
            </div>
            <div class="form-group col-md-6">
              <label for="wa">WhatsApp Penjual</label>
              <input type="text" class="form-control" name="wa" value="<?php echo $data['wa']; ?>" readonly>
            </div>
          </div>

          <label>Pesanan :</label>
          <div class="form-row">  
            <div class="form-group col-md-6">
              <input type="text" class="form-control" name="pembeli" placeholder="Nama Pembeli" required>
            </div>
            <div class="form-group col-md-6">
              <input type="text" class="form-control" name="email" placeholder="Email Pembeli" required>
            </div>
            <div class="form-group col-md-6">
              <input type="text" class="form-control" name="nowa" placeholder="Nomor WhatsApp Pembeli" required>
            </div>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" name="alamat" placeholder="Alamat" required>
          </div>

          <div class="form-group">
            <textarea class="form-control" name="pesan" placeholder="Pesan untuk penjual..." rows="3" required></textarea>
          </div>

          <button type="submit" name="kirim" class="btn btn-primary">Kirim</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </form>
      </div>
    </div>
  </div>
</div>
