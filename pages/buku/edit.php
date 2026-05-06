<?php
$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($konek, "
SELECT * FROM buku WHERE id='$id'
"));

$kategori = mysqli_query($konek, "SELECT * FROM kategori");
$penulis = mysqli_query($konek, "SELECT * FROM penulis");


?>

<div class="card">
  <div class="card-body">
    <h4 class="card-title">Edit Buku</h4>

    <form method="POST">

      <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" value="<?= $data['judul']; ?>">
      </div>

      <div class="form-group">
        <label>Kategori</label>
        <select name="id_kategori" class="form-control">
          <?php while($k = mysqli_fetch_assoc($kategori)) : ?>
            <option value="<?= $k['id']; ?>" 
              <?= $k['id']==$data['id_kategori']?'selected':'' ?>>
              <?= $k['Nama_kategori']; ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Penulis</label>
        <select name="id_penulis" class="form-control">
          <?php while($p = mysqli_fetch_assoc($penulis)) : ?>
            <option value="<?= $p['id']; ?>" 
              <?= $p['id']==$data['id_penulis']?'selected':'' ?>>
              <?= $p['nama']; ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Penerbit</label>
        <input type="text" name="penerbit" class="form-control" value="<?= $data['penerbit']; ?>">
      </div>

      <div class="form-group">
        <label>Tahun</label>
        <input type="date" name="tahun" class="form-control" value="<?= $data['tahun']; ?>">
      </div>

      <div class="form-group">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" value="<?= $data['stok']; ?>">
      </div>

      <button type="submit" name="update" class="btn btn-success">Update</button>
      <a href="?page=buku" class="btn btn-secondary">Kembali</a>

    </form>

<?php
if(isset($_POST['update'])){
  mysqli_query($konek, "
    UPDATE buku SET
    judul='$_POST[judul]',
    id_penulis='$_POST[id_penulis]',
    id_kategori='$_POST[id_kategori]',
    penerbit='$_POST[penerbit]',
    tahun='$_POST[tahun]',
    stok='$_POST[stok]'
    WHERE id='$id'
  ");

  echo "<script>alert('Update berhasil');location='?page=buku';</script>";
}
?>

  </div>
</div>