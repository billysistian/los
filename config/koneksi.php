<?php
date_default_timezone_set('Asia/Jakarta');

$host = "localhost";
$user = "root";
$pass = "";
$db   = "aplikasi_bantu";

$conn = mysql_connect($host,$user,$pass);

if(!$conn){
    die("Koneksi gagal : ".mysql_error());
}

mysql_select_db($db,$conn);

?>