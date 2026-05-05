<?php
include '../../konek.php';

$id = $_GET['id'];
$data = mysqli_query($konek, "SELECT * FROM peminjaman WHERE id=$id");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $id_anggota = $_POST['id_anggota'];
    $tgl_pinjam = $_POST['tanggal_pinjam'];
    $tgl_kembali = $_POST['tanggal_kembali'];
    $status = $_POST['status'];

    $query = "UPDATE peminjaman SET 
              id_anggota='$id_anggota',
              tanggal_pinjam='$tgl_pinjam',
              tanggal_kembali='$tgl_kembali',
              status='$status'
              WHERE id=$id";

    mysqli_query($konek, $query);
    header("Location: index.php");
}
?>

<form method="POST">
    ID Anggota: <input type="number" name="id_anggota" value="<?= $row['id_anggota']; ?>"><br>
    Tanggal Pinjam: <input type="date" name="tanggal_pinjam" value="<?= $row['tanggal_pinjam']; ?>"><br>
    Tanggal Kembali: <input type="date" name="tanggal_kembali" value="<?= $row['tanggal_kembali']; ?>"><br>
    Status:
    <select name="status">
        <option value="dipinjam" <?= $row['status']=='dipinjam'?'selected':''; ?>>Dipinjam</option>
        <option value="dikembalikan" <?= $row['status']=='dikembalikan'?'selected':''; ?>>Dikembalikan</option>
    </select><br>
    <button type="submit" name="update">Update</button>
</form>