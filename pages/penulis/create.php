<?php
include '../../konek.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $alamat = $_POST['alamat'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $create_time = date("Y-m-d H:i:s");

    $stmt = $konek->prepare("INSERT INTO penulis (create_time, nama, deskripsi, alamat, tgl_lahir) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $create_time, $nama, $deskripsi, $alamat, $tgl_lahir);
    
    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Gagal tambah data";
    }
}
?>

<h2>Tambah Penulis</h2>
<form method="POST">
    Nama: <input type="text" name="nama" required><br>
    Deskripsi: <textarea name="deskripsi"></textarea><br>
    Alamat: <textarea name="alamat"></textarea><br>
    Tanggal Lahir: <input type="date" name="tgl_lahir"><br>
    <button type="submit" name="submit">Simpan</button>
</form>