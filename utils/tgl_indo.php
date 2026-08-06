<?php
date_default_timezone_set('Asia/Jakarta');

function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

// Fungsi untuk format tanggal Indonesia
function dateTimeIndo($waktu) {
    $hari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
    $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

    $tahun = date('Y', strtotime($waktu));
    $bulan_angka = date('n', strtotime($waktu)) - 1;
    $hari_angka = date('w', strtotime($waktu));
    $jam = date('H:i', strtotime($waktu));

    return $hari[$hari_angka] . ', ' . date('d', strtotime($waktu)) . ' ' . $bulan[$bulan_angka] . ' ' . $tahun . ' ' . $jam;
}

function terbilang($nilai) {
    $nilai = abs(floor($nilai));
    $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $temp = "";
    if ($nilai < 12) {
		$temp = " " . $huruf[$nilai];
	} else if ($nilai < 20) {
		$temp = terbilang($nilai - 10) . " Belas";
	} else if ($nilai < 100) {
		$temp = terbilang(floor($nilai / 10)) . " Puluh" . terbilang($nilai % 10);
	} else if ($nilai < 200) {
		$temp = " Seratus" . terbilang($nilai - 100);
	} else if ($nilai < 1000) {
		$temp = terbilang(floor($nilai / 100)) . " Ratus" . terbilang($nilai % 100);
	} else if ($nilai < 2000) {
		$temp = " Seribu" . terbilang($nilai - 1000);
	} else if ($nilai < 1000000) {
		$temp = terbilang(floor($nilai / 1000)) . " Ribu" . terbilang($nilai % 1000);
	} else if ($nilai < 1000000000) {
		$temp = terbilang(floor($nilai / 1000000)) . " Juta" . terbilang($nilai % 1000000);
	} else if ($nilai < 1000000000000) {
		$temp = terbilang(floor($nilai / 1000000000)) . " Miliar" . terbilang(fmod($nilai, 1000000000));
	} else if ($nilai < 1000000000000000) {
		$temp = terbilang(floor($nilai / 1000000000000)) . " Triliun" . terbilang(fmod($nilai, 1000000000000));
	}
    return $temp;
}

?>