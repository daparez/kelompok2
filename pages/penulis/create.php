<?php
if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $alamat = $_POST['alamat'];
    $tgl_lahir = $_POST['tgl_lahir'];

    mysqli_query($konek, "
        INSERT INTO penulis (nama, deskripsi, alamat, tgl_lahir)
        VALUES ('$nama', '$deskripsi', '$alamat', '$tgl_lahir')
    ");

    echo "<script>
        alert('Data berhasil ditambahkan');
        window.location='?page=penulis';
    </script>";
}
?>

<div class="card">
  <div class="card-body">
    <h4 class="card-title">Tambah Penulis</h4>

    <form method="POST">

      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control"></textarea>
      </div>

      <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control"></textarea>
      </div>

      <div class="form-group">
        <label>Tanggal Lahir</label>
        <input type="date" name="tgl_lahir" class="form-control">
      </div>

      <button type="submit" name="simpan" class="btn btn-primary">
        Simpan
      </button>

      <a href="?page=penulis" class="btn btn-secondary">
        Kembali
      </a>

    </form>
  </div>
</div>