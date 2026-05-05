<?php
$anggota = mysqli_query($konek, "SELECT * FROM anggota ORDER BY nama ASC");
$buku = mysqli_query($konek, "SELECT * FROM buku WHERE stok > 0 ORDER BY judul ASC");
?>

<div class="card">
  <div class="card-body">
    <h4 class="card-title">Tambah Peminjaman</h4>

    <form method="POST">

      <!-- ANGGOTA -->
      <div class="form-group">
        <label>Anggota</label>
        <select name="id_anggota" class="form-control" required>
          <option value="">-- Pilih Anggota --</option>
          <?php while($a = mysqli_fetch_assoc($anggota)) : ?>
            <option value="<?= $a['id']; ?>">
              <?= $a['nama']; ?> - <?= $a['kelas']; ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <!-- TANGGAL -->
      <div class="form-group">
        <label>Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Batas Kembali</label>
        <input type="date" name="tanggal_kembali" class="form-control" required>
      </div>

      <hr>

      <h5>Data Buku</h5>

      <div id="buku-container">
        <div class="row mb-2">
          <div class="col-md-6">
            <select name="id_buku[]" class="form-control" required>
              <option value="">-- Pilih Buku --</option>
              <?php 
              mysqli_data_seek($buku, 0);
              while($b = mysqli_fetch_assoc($buku)) : ?>
                <option value="<?= $b['id']; ?>">
                  <?= $b['judul']; ?> (stok: <?= $b['stok']; ?>)
                </option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="col-md-4">
            <input type="number" name="jumlah[]" class="form-control" placeholder="Jumlah" required min="1">
          </div>
        </div>
      </div>

      <button type="button" onclick="tambahBuku()" class="btn btn-success mb-3">
        + Tambah Buku
      </button>

      <br>

      <button type="submit" name="simpan" class="btn btn-primary">
        Simpan
      </button>

      <a href="?page=peminjaman" class="btn btn-secondary">
        Kembali
      </a>

    </form>
  </div>
</div>

<script>
function tambahBuku(){
  let html = `
    <div class="row mb-2">
      <div class="col-md-6">
        <select name="id_buku[]" class="form-control">
          <?php 
          mysqli_data_seek($buku, 0);
          while($b = mysqli_fetch_assoc($buku)) : ?>
            <option value="<?= $b['id']; ?>">
              <?= $b['judul']; ?> (stok: <?= $b['stok']; ?>)
            </option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="col-md-4">
        <input type="number" name="jumlah[]" class="form-control" placeholder="Jumlah" min="1">
      </div>
    </div>
  `;
  document.getElementById('buku-container').insertAdjacentHTML('beforeend', html);
}
</script>

<?php
if(isset($_POST['simpan'])){
    $id_anggota = $_POST['id_anggota'];
    $tgl_pinjam = $_POST['tanggal_pinjam'];
    $tgl_kembali = $_POST['tanggal_kembali'];

    // simpan peminjaman
    mysqli_query($konek, "
        INSERT INTO peminjaman (id_anggota, tanggal_pinjam, tanggal_kembali, status)
        VALUES ('$id_anggota', '$tgl_pinjam', '$tgl_kembali', 'dipinjam')
    ");

    $id_peminjaman = mysqli_insert_id($konek);

    // simpan detail
    foreach($_POST['id_buku'] as $i => $id_buku){
        $jumlah = $_POST['jumlah'][$i];

        if($id_buku != "" && $jumlah > 0){

            mysqli_query($konek, "
                INSERT INTO detail_peminjaman (id_peminjaman, id_buku, jumlah)
                VALUES ('$id_peminjaman', '$id_buku', '$jumlah')
            ");

            mysqli_query($konek, "
                UPDATE buku SET stok = stok - $jumlah
                WHERE id='$id_buku'
            ");
        }
    }

    echo "<script>
      alert('Peminjaman berhasil');
      window.location='?page=peminjaman';
    </script>";
}
?>