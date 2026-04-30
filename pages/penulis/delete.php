<?php
include '../../konek.php';

$id = $_GET['id'];

$konek->query("DELETE FROM penulis WHERE id=$id");

header("Location: index.php");
?>