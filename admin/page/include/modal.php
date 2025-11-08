<!-- Modal Edit Produk -->
<div class="modal fade" id="edit_produk" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Edit Produk</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <form method="POST" action="./include/edit-produk.php" enctype="multipart/form-data">
        <div class="modal-body">
          
          <input type="hidden" name="id" id="edit-id">

          <!-- Nama -->
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
              <input type="text" id="edit-nama" name="nama" class="form-control" required>
            </div>
          </div>

          <!-- Harga -->
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Harga</label>
            <div class="col-sm-9">
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">Rp.</span>
                  </div>
                  <input type="text" id="edit-harga" name="harga" class="form-control" required
                         oninput="this.value = this.value.replace(/[^0-9]/g, '')">
              </div>
            </div>
          </div>

          <!-- Gambar -->
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Gambar</label>
            <div class="col-sm-9">
              <input type="file" name="gambar" class="form-control-file">
              <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
              <br>
              <img id="preview-gambar" src="" width="100" class="mt-2 img-thumbnail">
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
        </div>

      </form>

    </div>
  </div>
</div>


<!-- Modal Tambah Produk -->
<div class="modal fade" id="tambah_produk" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <form method="POST" action="./include/simpan-produk.php" enctype="multipart/form-data">
        <div class="modal-body">

          <!-- Nama -->
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nama" placeholder="Nama produk" required>
            </div>
          </div>

          <!-- Harga -->
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Harga</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" class="form-control" name="harga"
                           placeholder="0" required
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
            </div>
          </div>

          <!-- Gambar -->
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Gambar (jpg,png)</label>
            <div class="col-sm-9">
              <input type="file" class="form-control-file" name="gambar" required>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" name="simpan" class="btn btn-primary px-4">Simpan</button>
        </div>

      </form>

    </div>
  </div>
</div>

