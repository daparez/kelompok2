<?php
include 'konek.php';

$id = $_GET['id'];

mysqli_query($konek, "DELETE FROM peminjaman WHERE id=$id");

header("Location: index.php");
?>