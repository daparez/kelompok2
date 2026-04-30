<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "perpus02";

$konek = mysqli_connect($host, $user, $pass, $db);

if(!$konek){
  echo  "konek gagal";
}else {
    echo "konek berhasil";
}

?>  