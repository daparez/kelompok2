<?php
$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($konek, "
SELECT * FROM kategori WHERE id='$id'
"));
?>

<div class="card">
  <div class="card-body">
    <h4 class="card-title">Edit Kategori</h4>

    <form method="POST">

      <div class="form-group">
        <label>Nama Kategori</label>
        <input type="text" name="Nama_kategori" class="form-control" 
               value="<?= $data['Nama_kategori']; ?>">
      </div>

      <button type="submit" name="update" class="btn btn-success">
        Update
      </button>
      <a href="?page=kategori" class="btn btn-secondary">Kembali</a>

    </form>

<?php
if(isset($_POST['update'])){
  mysqli_query($konek, "
    UPDATE kategori SET
    nama='$_POST[nama_kategori]'
    WHERE id='$id'
  ");

  echo "<script>alert('Update berhasil');location='?page=kategori';</script>";
}
?>

  </div>
</div>