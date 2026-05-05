<?php
$id = $_GET['id'];

// ambil data
$data = mysqli_fetch_assoc(mysqli_query($konek, "
    SELECT * FROM penulis WHERE id='$id'
"));

// proses update
if(isset($_POST['update'])){
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $alamat = $_POST['alamat'];
    $tgl_lahir = $_POST['tgl_lahir'];

    mysqli_query($konek, "
        UPDATE penulis SET
        nama='$nama',
        deskripsi='$deskripsi',
        alamat='$alamat',
        tgl_lahir='$tgl_lahir'
        WHERE id='$id'
    ");

    echo "<script>
        alert('Data berhasil diupdate');
        window.location='?page=penulis';
    </script>";
}
?>

<div class="card">
  <div class="card-body">
    <h4 class="card-title">Edit Penulis</h4>

    <form method="POST">

      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control"
               value="<?= $data['nama']; ?>" required>
      </div>

      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control"><?= $data['deskripsi']; ?></textarea>
      </div>

      <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control"><?= $data['alamat']; ?></textarea>
      </div>

      <div class="form-group">
        <label>Tanggal Lahir</label>
        <input type="date" name="tgl_lahir" class="form-control"
               value="<?= $data['tgl_lahir']; ?>">
      </div>

      <button type="submit" name="update" class="btn btn-primary">
        Update
      </button>

      <a href="?page=penulis" class="btn btn-secondary">
        Kembali
      </a>

    </form>
  </div>
</div>