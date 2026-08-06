<?php

if (session_id() == '') {
    session_start();
}

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location: ../../auth/login.php");
    exit();
}

$batas_waktu = 600; 

if (isset($_SESSION['terakhir_aktif'])) {
    $durasi_aktif = time() - $_SESSION['terakhir_aktif'];

    if ($durasi_aktif > $batas_waktu) {
        session_unset();
        session_destroy();
        echo "<script>alert('Sesi Anda telah habis. Silakan login kembali.'); window.location.href = '../../auth/login.php';</script>";
        exit();
    }
}

$_SESSION['terakhir_aktif'] = time();
?>
