<?php
$kategori = mysqli_query($konek, "SELECT * FROM kategori");
$penulis = mysqli_query($konek, "SELECT * FROM penulis");


?>

<div class="card">
  <div class="card-body">
    <h4 class="card-title">Tambah Buku</h4>

    <form method="POST">

      <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Kategori</label>
        <select name="id_kategori" class="form-control">
          <?php while($k = mysqli_fetch_assoc($kategori)) : ?>
            <option value="<?= $k['id']; ?>"><?= $k['Nama_kategori']; ?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Penulis</label>
        <select name="id_penulis" class="form-control">
          <?php while($p = mysqli_fetch_assoc($penulis)) : ?>
            <option value="<?= $p['id']; ?>"><?= $p['nama']; ?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Penerbit</label>
        <input type="text" name="penerbit" class="form-control">
      </div>

      <div class="form-group">
        <label>Tahun</label>
        <input type="date" name="tahun" class="form-control">
      </div>

      <div class="form-group">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control">
      </div>

      <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
      <a href="?page=buku" class="btn btn-secondary">Kembali</a>

    </form>

<?php
if(isset($_POST['simpan'])){
  mysqli_query($konek, "
    INSERT INTO buku 
    (judul, id_penulis, id_kategori, penerbit, tahun, stok)
    VALUES 
    ('$_POST[judul]','$_POST[id_penulis]','$_POST[id_kategori]',
     '$_POST[penerbit]','$_POST[tahun]','$_POST[stok]')
  ");

  echo "<script>alert('Berhasil');location='?page=buku';</script>";
}
?>

  </div>
</div>