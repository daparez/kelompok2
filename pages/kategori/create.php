<div class="card">
  <div class="card-body">
    <h4 class="card-title">Tambah Kategori</h4>

    <form method="POST">

      <div class="form-group">
        <label>Nama Kategori</label>
        <input type="text" name="Nama_kategori" class="form-control" required>
      </div>

      <button type="submit" name="simpan" class="btn btn-primary">
        Simpan
      </button>
      <a href="?page=kategori" class="btn btn-secondary">Kembali</a>

    </form>

<?php
if(isset($_POST['simpan'])){
  mysqli_query($konek, "
    INSERT INTO kategori (Nama_kategori)
    VALUES ('$_POST[Nama_kategori]')
  ");

  echo "<script>alert('Berhasil');location='?page=kategori';</script>";
}
?>

  </div>
</div>