<?php
if(isset($_POST['simpan'])){
  $nama = $_POST['nama'];
  $kelas = $_POST['kelas'];

  mysqli_query($konek, "
    INSERT INTO anggota (nama, kelas)
    VALUES ('$nama', '$kelas')
  ");

  echo "<script>
    alert('Berhasil ditambah');
    window.location='?page=anggota';
  </script>";
}
?>

<div class="card">
  <div class="card-body">
    <h4 class="card-title">Tambah Siswa</h4>

    <form method="POST">

      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Kelas</label>
        <input type="text" name="kelas" class="form-control" required>
      </div>

      <button type="submit" name="simpan" class="btn btn-primary">
        Simpan
      </button>

      <a href="?page=anggota" class="btn btn-secondary">
        Kembali
      </a>

    </form>
  </div>
</div>