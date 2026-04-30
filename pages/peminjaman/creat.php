<?php
include 'konek.php';

if (isset($_POST['submit'])) {
    $id_anggota = $_POST['id_anggota'];
    $tgl_pinjam = $_POST['tanggal_pinjam'];
    $tgl_kembali = $_POST['tanggal_kembali'];
    $status = $_POST['status'];

    $query = "INSERT INTO peminjaman (id_anggota, tanggal_pinjam, tanggal_kembali, status)
              VALUES ('$id_anggota', '$tgl_pinjam', '$tgl_kembali', '$status')";

    if (mysqli_query($konek, $query)) {
        echo "Data berhasil ditambahkan";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<form method="POST">
    ID Anggota: <input type="number" name="id_anggota"><br>
    Tanggal Pinjam: <input type="date" name="tanggal_pinjam"><br>
    Tanggal Kembali: <input type="date" name="tanggal_kembali"><br>
    Status:
    <select name="status">
        <option value="dipinjam">Dipinjam</option>
        <option value="dikembalikan">Dikembalikan</option>
    </select><br>
    <button type="submit" name="submit">Simpan</button>
</form>