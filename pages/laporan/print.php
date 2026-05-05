<?php
include 'konek.php';

$query = mysqli_query($konek, "
SELECT 
    p.*, a.nama, a.kelas
FROM peminjaman p
JOIN anggota a ON p.id_anggota = a.id
ORDER BY p.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Print Laporan</title>
  <style>
    body { font-family: Arial; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid black; padding: 8px; }
    th { background: #eee; }
  </style>
</head>
<body>

<h2 style="text-align:center;">LAPORAN PEMINJAMAN BUKU</h2>

<table>
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>Kelas</th>
    <th>Buku</th>
    <th>Tgl Pinjam</th>
    <th>Kembali</th>
    <th>Status</th>
    <th>Denda</th>
  </tr>

<?php $no=1; while($d = mysqli_fetch_assoc($query)) : ?>
<tr>
  <td><?= $no++; ?></td>
  <td><?= $d['nama']; ?></td>
  <td><?= $d['kelas']; ?></td>

  <td>
    <?php
    $detail = mysqli_query($konek, "
      SELECT b.judul, dp.jumlah
      FROM detail_peminjaman dp
      JOIN buku b ON dp.id_buku = b.id
      WHERE dp.id_peminjaman = '{$d['id']}'
    ");

    while($b = mysqli_fetch_assoc($detail)){
      echo "- {$b['judul']} ({$b['jumlah']})<br>";
    }
    ?>
  </td>

  <td><?= $d['tanggal_pinjam']; ?></td>
  <td><?= $d['tanggal_kembali']; ?></td>
  <td><?= $d['status']; ?></td>
  <td>Rp <?= number_format($d['denda']); ?></td>
</tr>
<?php endwhile; ?>

</table>

<script>
window.print();
</script>

</body>
</html>