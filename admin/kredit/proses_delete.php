<?php
session_start();
include "../../config/koneksi.php";

$id=$_POST['id'];
$created_by = $_SESSION['username'];
$created_at = date("Y-m-d H:i:s");

mysql_query("
DELETE FROM permohonan_kredit
WHERE id='$id'
");

mysql_query("
    INSERT INTO logs (menu, referensi, aktifitas, data_awal, data_diperbaharui, created_by, created_at)
    VALUES('Permohonan Kredit','$id','DELETE',NULL,'".mysql_real_escape_string(json_encode($_POST))."','$created_by','$created_at')
");

echo "success";

?>