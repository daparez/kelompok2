<?php
$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($konek, "
  SELECT * FROM anggota WHERE id='$id'
"));

if(isset($_POST['update'])){
  $nama = $_POST['nama'];
  $kelas = $_POST['kelas'];

  mysqli_query($konek, "
    UPDATE anggota SET
    nama='$nama',
    kelas='$kelas'
    WHERE id='$id'
  ");

  echo "<script>
    alert('Berhasil diupdate');
    window.location='?page=anggota';
  </script>";
}
?>

<div class="card">
  <div class="card-body">
    <h4 class="card-title">Edit Siswa</h4>

    <form method="POST">

      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control"
               value="<?= $data['nama']; ?>" required>
      </div>

      <div class="form-group">
        <label>Kelas</label>
        <input type="text" name="kelas" class="form-control"
               value="<?= $data['kelas']; ?>" required>
      </div>

      <button type="submit" name="update" class="btn btn-primary">
        Update
      </button>

      <a href="?page=anggota" class="btn btn-secondary">
        Kembali
      </a>

    </form>
  </div>
</div>