<?php
include '../../konek.php';

$id = $_GET['id'];

// ambil data
$stmt = $konek->prepare("SELECT * FROM penulis WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $alamat = $_POST['alamat'];
    $tgl_lahir = $_POST['tgl_lahir'];

    $stmt = $konek->prepare("UPDATE penulis SET nama=?, deskripsi=?, alamat=?, tgl_lahir=? WHERE id=?");
    $stmt->bind_param("ssssi", $nama, $deskripsi, $alamat, $tgl_lahir, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Gagal update data";
    }
}
?>

<h2>Edit Penulis</h2>
<form method="POST">
    Nama: <input type="text" name="nama" value="<?= $data['nama'] ?>" required><br>
    Deskripsi: <textarea name="deskripsi"><?= $data['deskripsi'] ?></textarea><br>
    Alamat: <textarea name="alamat"><?= $data['alamat'] ?></textarea><br>
    Tanggal Lahir: <input type="date" name="tgl_lahir" value="<?= $data['tgl_lahir'] ?>"><br>
    <button type="submit" name="update">Update</button>
</form>