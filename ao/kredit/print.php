<?php

include "../../config/koneksi.php";
include "../../utils/tgl_indo.php";

$id=$_GET['id'];

$d=mysql_fetch_array(
  mysql_query("
  select * from permohonan_kredit
  where id='$id'
  ")
);

$agunan = mysql_query("
    SELECT * FROM agunan_kredit
    WHERE
    id_permohonan_kredit='$id'
");

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../../assets/img/favicon.ico" type="image/x-icon" />
  <title>Formulir Permohonan Kredit - Bank Utomo</title>
  <!-- Tailwind CSS CDN -->
  <script src="../../assets/js/tailwindcss-v3.4.17.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    body {
      font-family: 'Inter', sans-serif;
    }

    /* Print Specific Styles */
    @media print {
      body {
        background-color: #ffffff;
        color: #000000;
        font-size: 10px;
      }
      .print-container {
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        box-shadow: none !important;
        border: none !important;
      }
      .page-break {
        page-break-before: always;
      }
      * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
      }
    }

    .chk-box {
      width: 13px;
      height: 13px;
      border: 1px solid #1e293b;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      vertical-align: middle;
      margin-right: 4px;
      font-weight: bold;
      font-size: 10px;
      line-height: 1;
      background-color: #fff;
    }

    .dotted-line {
      border-bottom: 1px dotted #64748b;
      display: inline-block;
      min-width: 100px;
    }
  </style>
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen pb-12">

  <!-- CONTAINER UTAMA FORM (DI-SET UKURAN A4/F4) -->
  <div class="print-container max-w-[210mm] mx-auto bg-white border border-slate-300 shadow-xl p-8 text-[11px] leading-normal">
    
    <!-- HEADER FORM -->
    <div class="flex justify-between items-start border-b-2 border-double border-slate-800 pb-3 mb-3">
      <div class="pt-1">
        <img src="../../assets/img/logo.png" alt="Logo Bank Utomo" class="w-25 h-5">
        <p class="text-[9px] text-slate-500 mt-1">Jl. Raden Intan No.93, Enggal, Kota Bandar Lampung, Lampung 35118</p>
      </div>
      <div class="text-right">
        <h2 class="text-base font-bold text-slate-950 tracking-tighter uppercase">Permohonan Kredit</h2>
        <div class="mt-1 flex gap-4 text-[9px] text-slate-700 font-mono">
          <div>
            <span class="chk-box">
              <?php if($d['jenis_pemohon']=="perorangan"){echo "✓";}?>
            </span>
            PERORANGAN
          </div>
          <div>
            <span class="chk-box">
              <?php if($d['jenis_pemohon']=="badan_usaha"){echo "✓";}?>
            </span>
            BADAN USAHA
          </div>
        </div>
      </div>
    </div>

    <!-- PETUNJUK & AO -->
    <table class="w-full mb-3 text-[10px]">
      <tr>
        <td class="w-2/3 italic text-slate-500 text-[9px]">
          * Isi dengan huruf cetak/kapital atau berikan tanda check (✓) pada kotak pilihan yang tersedia.
        </td>
        <td class="w-1/3 text-right">
          <table class="inline-block border border-slate-400">
            <tr>
              <td class="bg-slate-100 px-2 py-0.5 border-r border-slate-400 font-semibold text-[9px]">Account Officer (AO):</td>
              <td class="px-2 py-0.5 font-mono min-w-[120px] text-left text-slate-900"><?= ucwords($d['nama_ao']) ?></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <?php if($d['jenis_pemohon']=="perorangan"){ ?>
    <!-- SECTION A: DATA PRIBADI (PERORANGAN) -->
    <div class="mb-1">
      <div class="bg-slate-800 text-white px-2 py-0.5 font-bold tracking-wider text-[10px] uppercase mb-1 flex justify-between">
        <span>Data Pribadi</span>
        <span class="text-[8px] font-normal italic">Wajib diisi oleh Pemohon perorangan</span>
      </div>
      <table class="w-full border-collapse border border-slate-300">
        <tbody>
          <!-- NIK & NPWP -->
          <tr class="border-b border-slate-300">
            <td class="w-1/4 bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Nomor Identitas</td>
            <td class="px-2 py-1" colspan="3">
              <span class="chk-box"><?php if ($d['nik']) { echo "✓"; } ?></span> <span class="mr-2">NIK:</span>
              <span class="font-mono tracking-wider mr-6 text-slate-950 font-semibold"><?=$d['nik']?></span>
              <span class="chk-box"><?php if ($d['npwp']) { echo "✓"; } ?></span> <span class="mr-2">NPWP:</span>
              <span class="font-mono tracking-wider text-slate-950 font-semibold"><?=$d['npwp']?></span>
            </td>
          </tr>
          <!-- Nama Lengkap & Jenis Kelamin -->
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Nama (Sesuai Identitas)</td>
            <td class="px-2 py-1 w-4/12 border-r border-slate-300 font-bold text-slate-950"><?= ucwords($d['nama_identitas'])?></td>
            <td class="bg-slate-50 px-2 py-1 w-1/6 font-semibold border-r border-slate-300">Jenis Kelamin</td>
            <td class="px-2 py-1 w-1/4">
              <span class="chk-box">
                <?php if($d['jenis_kelamin']=="Pria"){echo "✓";}?>
              </span>
              <span class="mr-3">
                Pria
              </span>
              <span class="chk-box">
                <?php if($d['jenis_kelamin']=="Wanita"){echo "✓";}?>
              </span>
              <span>
                Wanita
              </span>
            </td>
          </tr>
          <!-- Tempat Lahir & Kewarganegaraan -->
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Tempat, Tanggal Lahir</td>
            <td class="px-2 py-1 border-r border-slate-300 text-slate-900"><?= ucwords($d['tempat']). ", " . tgl_indo($d['tanggal_lahir']) ?></td>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Kewarganegaraan</td>
            <td class="px-2 py-1">
              <span class="chk-box">
                <?php if($d['kewarganegaraan']=="WNI"){echo "✓";}?>
              </span>
              <span class="mr-3">
                WNI
              </span>
              <span class="chk-box">
                <?php if($d['kewarganegaraan']=="WNA"){echo "✓";}?>
              </span>
              <span>
                WNA
              </span>
            </td>
          </tr>
          <!-- Pendidikan Terakhir -->
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Pendidikan Terakhir</td>
            <td class="px-2 py-1" colspan="3">
              <span class="chk-box">
                <?php if($d['pendidikan_terakhir']=="SMP"){echo "✓";}?>
              </span><span class="mr-3">SMP</span>
              <span class="chk-box">
                <?php if($d['pendidikan_terakhir']=="SMA"){echo "✓";}?>
              </span><span class="mr-3">SMA</span>
              <span class="chk-box">
                <?php if($d['pendidikan_terakhir']=="Diploma"){echo "✓";}?>
              </span> <span class="mr-3">Diploma</span>
              <span class="chk-box">
                <?php if($d['pendidikan_terakhir']=="S1"){echo "✓";}?>
              </span><span class="mr-3">S1</span>
              <span class="chk-box">
                <?php if($d['pendidikan_terakhir']=="S2"){echo "✓";}?>
              </span><span class="mr-3">S2</span>
              <span class="chk-box">
                <?php if($d['pendidikan_terakhir']=="Lainnya"){echo "✓";}?>
              </span> <span class="mr-1">Lainnya:</span>
              <span class="dotted-line min-w-[80px]"><?= ucwords($d['pendidikan_lain']) ?></span>
            </td>
          </tr>
          <!-- Alamat Sesuai Identitas -->
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Alamat Rumah <div>(Sesuai Identitas)</div></td>
            <td class="px-2 py-1 border-r border-slate-300 text-slate-900"><?= ucwords($d['alamat_ktp']) ?></td>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Kode Pos</td>
            <td class="px-2 py-1 font-mono text-slate-900 font-semibold"><?= $d['kode_pos_ktp'] ?></td>
          </tr>
          <!-- Alamat Domisili -->
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Alamat Rumah <div>(Sesuai Domisili)</div></td>
            <td class="px-2 py-1 border-r border-slate-300 text-slate-900"><?= ucwords($d['alamat_domisili']) ?></td>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Kode Pos</td>
            <td class="px-2 py-1 font-mono text-slate-900 font-semibold"><?=$d['kode_pos_domisili']?></td>
          </tr>
          <!-- Status Rumah -->
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Status Rumah</td>
            <td class="px-2 py-1" colspan="3">
              <span class="chk-box">
                <?php if($d['status_rumah']=="Milik Sendiri"){echo "✓";}?>
              </span><span class="mr-3">Milik Sendiri</span>
              <span class="chk-box">
                <?php if($d['status_rumah']=="Milik Keluarga"){echo "✓";}?>
              </span> <span class="mr-3">Milik Keluarga</span>
              <span class="chk-box">
                <?php if($d['status_rumah']=="Kost/Kontrak"){echo "✓";}?>
              </span> <span class="mr-3">Kost/Kontrak</span>
              <span class="chk-box">
                <?php if($d['status_rumah']=="Milik Perusahaan"){echo "✓";}?>
              </span> <span class="mr-3">Milik Perusahaan</span>
              <span class="chk-box">
                <?php if($d['status_rumah']=="Kredit"){echo "✓";}?>
              </span> <span class="mr-0">Kredit</span>
              <div>
              <span class="chk-box">
                <?php if($d['status_rumah']=="Lainnya"){echo "✓";}?>
              </span><span class="mr-1">Lainnya:</span>
              <span class="dotted-line min-w-[80px]"><?= ucwords($d['status_rumah_lain']) ?></span>
              </div>
            </td>
          </tr>
          <!-- Nomor Telepon -->
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Nomor Telepon</td>
            <td class="px-2 py-1 font-mono text-slate-900" colspan="3">
              <span class="chk-box"><?php if ($d['selular_perorangan']) { echo "✓"; } ?></span> <span class="mr-1 text-slate-700">Seluler:</span>
              <span class="mr-4 font-semibold text-slate-950"><?= $d['selular_perorangan'] ?></span>
              <span class="chk-box"><?php if ($d['no_rumah_perorangan']) { echo "✓"; } ?></span> <span class="mr-1 text-slate-700">Rumah:</span>
              <span class="mr-4 font-semibold text-slate-950"><?= $d['no_rumah_perorangan'] ?></span>
              <span class="chk-box"><?php if ($d['no_kantor_perorangan']) { echo "✓"; } ?></span> <span class="mr-1 text-slate-700">Kantor:</span>
              <span class="mr-4 font-semibold text-slate-950"><?= $d['no_kantor_perorangan'] ?></span>
              <span class="chk-box"><?php if ($d['no_fax_perorangan']) { echo "✓"; } ?></span> <span class="mr-1 text-slate-700">Fax:</span>
              <span class="font-semibold text-slate-950"><?= $d['no_fax_perorangan'] ?></span>
            </td>
          </tr>
          <!-- Ibu Kandung -->
          <tr>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Nama Gadis Ibu Kandung</td>
            <td class="px-2 py-1 font-medium text-slate-900" colspan="3"><?= ucwords($d['nama_gadis_ibu_kandung']) ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- SECTION B: DATA PEKERJAAN -->
    <div class="mb-1">
      <div class="bg-slate-800 text-white px-2 py-0.5 font-bold tracking-wider text-[10px] uppercase mb-1">
        Data Pekerjaan
      </div>
      <table class="w-full border-collapse border border-slate-300">
        <tbody>
          <tr class="border-b border-slate-300">
            <td class="w-1/4 bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Pekerjaan</td>
            <td class="px-2 py-1" colspan="3">
              <span class="chk-box">
                <?php if($d['pekerjaan']=="Karyawan"){echo "✓";}?>
              </span> <span class="mr-3">Karyawan</span>
              <span class="chk-box">
                <?php if($d['pekerjaan']=="Wirausaha"){echo "✓";}?>
              </span> <span class="mr-3">Wirausaha</span>
              <span class="chk-box">
                <?php if($d['pekerjaan']=="Profesi"){echo "✓";}?>
              </span> <span class="mr-3">Profesi</span>
              <span class="chk-box">
                <?php if($d['pekerjaan']=="Lainnya"){echo "✓";}?>
              </span> <span class="mr-1">Lainnya:</span>
              <span class="dotted-line min-w-[120px]"><?= ucwords($d['pekerjaan_lain']) ?></span>
            </td>
          </tr>
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Nama Perusahaan/Usaha</td>
            <td class="px-2 py-1 w-32 border-r border-slate-300 font-bold text-slate-900"><?= ucwords($d['nama_perusahaan']) ?></td>
          </tr>
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 w-20 font-semibold border-r border-slate-300">Jabatan</td>
            <td class="px-2 py-1 w-20 text-slate-900 font-medium"><?= ucwords($d['jabatan']) ?></td>
          </tr>
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Bidang Usaha</td>
            <td class="px-2 py-1 border-r border-slate-300 text-slate-900"><?= ucwords($d['bidang_usaha']) ?></td>
          </tr>
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Alamat Tempat Bekerja/Usaha</td>
            <td class="px-2 py-1 text-slate-900" colspan="3"><?= ucwords($d['alamat_tempat_bekerja']) ?></td>
          </tr>
          <tr>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Lama Bekerja/Berwirausaha</td>
            <td class="px-2 py-1 text-slate-900 font-medium"><?= ucwords($d['lama_bekerja']) ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- SECTION C: KELUARGA TIDAK SERUMAH -->
    <div class="mb-1">
      <div class="bg-slate-800 text-white px-2 py-0.5 font-bold tracking-wider text-[10px] uppercase mb-1">
        Data Keluarga Tidak Serumah Yang Dapat Dihubungi (Emergency Contact)
      </div>
      <table class="w-full border-collapse border border-slate-300">
        <tbody>
          <tr class="border-b border-slate-300">
            <td class="w-1/4 bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Nama Lengkap</td>
            <td class="px-2 py-1 w-32 border-r border-slate-300 font-bold text-slate-900"><?= ucwords($d['nama_keluarga']) ?></td>
          </tr>
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Nomor Telepon</td>
            <td class="px-2 py-1 font-mono text-slate-900 font-semibold"><?= $d['nomor_telepon_keluarga'] ?></td>
          </tr>
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 w-20 font-semibold border-r border-slate-300">Hubungan</td>
            <td class="px-2 py-1 w-20 text-slate-900"><?= ucwords($d['hubungan_keluarga']) ?></td>
          </tr>
          <tr>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Alamat</td>
            <td class="px-2 py-1 text-slate-900"><?= ucwords($d['alamat_keluarga']) ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- SECTION D: DATA PASANGAN -->
    <div class="mb-1">
      <div class="bg-slate-800 text-white px-2 py-0.5 font-bold tracking-wider text-[10px] uppercase mb-1 flex justify-between">
        <span>Status Perkawinan & Data Suami / Istri</span>
        <span class="text-[8px] font-normal italic">Wajib dilengkapi apabila Status "Kawin"</span>
      </div>
      <table class="w-full border-collapse border border-slate-300">
        <tbody>
          <tr class="border-b border-slate-300">
            <td class="w-1/4 bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Status Perkawinan</td>
            <td class="px-2 py-1" colspan="3">
              <span class="chk-box">
                <?php if($d['status_perkawinan']=="Kawin"){echo "✓";}?>
              </span> <span class="mr-3">Kawin</span>
              <span class="chk-box">
                <?php if($d['status_perkawinan']=="Belum Kawin"){echo "✓";}?>
              </span> <span class="mr-3">Belum Kawin</span>
              <span class="chk-box">
                <?php if($d['status_perkawinan']=="Cerai"){echo "✓";}?>
              </span> <span class="mr-3">Cerai</span>
            </td>
          </tr>
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Nomor Identitas</td>
            <td class="px-2 py-1" colspan="3">
              <span class="font-mono tracking-wider text-slate-950 font-semibold"><?=$d['nomor_identitas_pasangan']?></span>
            </td>
          </tr>
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Nama (Sesuai Identitas)</td>
            <td class="px-2 py-1 w-1/4 border-r border-slate-300 font-bold text-slate-900"><?= $d['nama_pasangan'] ?></td>
            <td class="bg-slate-50 px-2 py-1 w-1/5 font-semibold border-r border-slate-300">Tempat & Tanggal Lahir</td>
            <td class="px-2 py-1 text-slate-900">
              <span class="font-semibold"><?= ucwords($d['tempat_lahir_pasangan']) ?>, </span>
              <span class="font-semibold">
                <?php
                  if ($d['tanggal_lahir_pasangan'] != "0000-00-00") {
                    echo tgl_indo($d['tanggal_lahir_pasangan']);
                  }
                ?>
              </span>
            </td>
          </tr>
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Nomor Telepon</td>
            <td class="px-2 py-1 font-mono border-r text-slate-900 font-semibold"><?= $d['no_telp_pasangan'] ?></td>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Jabatan</td>
            <td class="px-2 py-1 text-slate-900"><?= ucwords($d['jabatan_pasangan']) ?></td>
          </tr>
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Nama Perusahaan/Usaha</td>
            <td class="px-2 py-1 border-r border-slate-300 text-slate-900"><?= ucwords($d['nama_perusahaan_pasangan']) ?></td>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Bidang Usaha</td>
            <td class="px-2 py-1 text-slate-900"><?= ucwords($d['bidang_usaha_pasangan']) ?></td>
          </tr>
          <tr>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Alamat Tempat Bekerja/Usaha</td>
            <td class="px-2 py-1 border-r border-slate-300 text-slate-900"><?= ucwords($d['alamat_tempat_bekerja_pasangan']) ?></td>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Lama Bekerja / Berwirausaha</td>
            <td class="px-2 py-1 text-slate-900"><?= ucwords($d['lama_bekerja_pasangan']) ?></td>
          </tr>
        </tbody>
      </table>
    </div>

     <?php } elseif($d['jenis_pemohon']=="badan_usaha"){ ?>

    <!-- SECTION E: DATA BADAN USAHA -->
    <div class="mb-1">
      <div class="bg-slate-800 text-white px-2 py-0.5 font-bold tracking-wider text-[10px] uppercase mb-1 flex justify-between">
        <span>Data Badan Usaha</span>
        <span class="text-[8px] font-normal italic">Wajib dilengkapi oleh Pemohon berbentuk Badan Usaha</span>
      </div>
      <table class="w-full border-collapse border border-slate-300">
        <tbody>
          <tr class="border-b border-slate-300">
            <td class="w-40 bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Nama Pengurus (Berwenang)</td>
            <td class="px-2 py-1 border-slate-300 font-bold text-slate-900" colspan="3"><?= ucwords($d['nama_pengurus_berwenang']) ?></td>
          </tr>
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Nama Badan Usaha (Sesuai Akta)</td>
            <td class="px-2 py-1 border-r border-slate-300 font-bold text-slate-900"><?= ucwords($d['nama_akta_usaha']) ?></td>
            <td class="bg-slate-50 px-2 py-1 w-1/4 font-semibold border-r border-slate-300">No. Identitas Badan Usaha</td>
            <td class="px-2 py-1 w-1/4 font-mono">
              <span class="chk-box">
                <?= $d['npwp_badan'] ? '✓' : '' ?>
              </span> <span class="mr-1">NPWP:</span>
              <span class="text-slate-900 font-semibold"><?= $d['npwp_badan'] ?></span>
            </td>
          </tr>
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Bentuk Badan Usaha</td>
            <td class="px-2 py-1" colspan="3">
              <span class="chk-box">
                <?= $d['bentuk_badan_usaha'] == 'Perseroan Terbatas (PT)' ? '✓' : '' ?>
              </span> <span class="mr-3">Perseroan Terbatas (PT)</span>
              <span class="chk-box">
                <?= $d['bentuk_badan_usaha'] == 'Commanditier Venotschap (CV)' ? '✓' : '' ?>
              </span> <span class="mr-3">Commanditer Venotschap (CV)</span>
              <span class="chk-box">
                <?= $d['bentuk_badan_usaha'] == 'Koperasi' ? '✓' : '' ?>
              </span> <span class="mr-3">Koperasi</span>
              <span class="chk-box">
                <?= $d['bentuk_badan_usaha'] == 'Lainnya' ? '✓' : '' ?>
              </span> <span class="mr-1">Lainnya:</span>
              <span class="dotted-line min-w-[20px]"><?= ucwords($d['bentuk_badan_usaha_lain']) ?></span>
            </td>
          </tr>
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Bidang Usaha</td>
            <td class="px-2 py-1 border-r border-slate-300 text-slate-900"><?= ucwords($d['bidang_usaha_badan']) ?></td>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Tempat & Tanggal Pendirian</td>
            <td class="px-2 py-1 text-slate-900">
              <span class="font-semibold"><?= ucwords($d['tempat_usaha']) ?>, </span>
              <span class="font-semibold">
                <?php
                  if ($d['tanggal_pendirian'] != "0000-00-00") {
                    echo tgl_indo($d['tanggal_pendirian']);
                  }
                ?>
              </span>
            </td>
          </tr>
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Alamat Kantor Utama</td>
            <td class="px-2 py-1 border-r border-slate-300 text-slate-900"><?= ucwords($d['alamat_kantor_usaha']) ?></td>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Kode Pos</td>
            <td class="px-2 py-1 font-mono text-slate-900 font-semibold"><?= $d['kode_pos_alamat_usaha'] ?></td>
          </tr>
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Status Kepemilikan Kantor</td>
            <td class="px-2 py-1" colspan="3">
              <span class="chk-box">
                <?= $d['status_kantor_usaha'] == 'Milik Sendiri' ? '✓' : '' ?>
              </span> <span class="mr-4">Milik Sendiri</span>
              <span class="chk-box">
                <?= $d['status_kantor_usaha'] == 'Sewa' ? '✓' : '' ?>
              </span> <span class="mr-4">Sewa</span>
              <span class="chk-box"></span> <span class="mr-1">Lainnya:</span>
              <span class="dotted-line min-w-[100px]"><?= $d['status_kantor_usaha_lain'] ?></span>
            </td>
          </tr>
          <tr>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Kontak Telepon Kantor</td>
            <td class="px-2 py-1 font-mono" colspan="3">
              <span class="chk-box"><?php if ($d['no_kantor_usaha']) { echo "✓"; } ?></span> <span class="mr-1 text-slate-700">Kantor:</span>
              <span class="mr-4 text-slate-950 font-semibold"><?=  $d['no_kantor_usaha'] ?></span>
              <span class="chk-box"><?php if ($d['no_fax_usaha']) { echo "✓"; } ?></span> <span class="mr-1 text-slate-700">Fax:</span>
              <span class="mr-4 text-slate-950 font-semibold"><?= $d['no_fax_usaha'] ?></span>
              <span class="chk-box"><?php if ($d['hp_pic']) { echo "✓"; } ?></span> <span class="mr-1 text-slate-700">HP PIC:</span>
              <span class="text-slate-950 font-semibold"><?= $d['hp_pic'] ?></span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <?php } ?>

    <!-- SECTION F: PERMOHONAN KREDIT -->
    <div class="mb-1">
      <div class="bg-slate-800 text-white px-2 py-0.5 font-bold tracking-wider text-[10px] uppercase mb-1">
        Permohonan Kredit
      </div>
      <table class="w-full border-collapse border border-slate-300">
        <tbody>
          <!-- Nominal & Tujuan -->
          <tr class="border-b border-slate-300">
            <td class="w-1/4 bg-slate-50 px-2 py-1.5 font-semibold border-r border-slate-300 text-slate-900">Plafond Pinjaman</td>
            <td class="px-2 py-1.5 border-r border-slate-300 font-bold text-slate-950 text-xs">
              <span class="text-slate-900 font-semibold">Rp</span>
              <span class="text-slate-900 font-semibold"><?= number_format($d['plafond_pinjaman'], 2, ',', '.') ?></span>
              <span class="text-[10px] font-normal italic">(<?= terbilang($d['plafond_pinjaman']) ?> Rupiah )</span>
            </td>
          </tr>
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1.5 font-semibold border-r border-slate-300">Tujuan Pinjaman</td>
            <td class="px-2 py-1.5">
              <span class="chk-box">
                <?= $d['tujuan_pinjaman'] == 'Modal Kerja' ? '✓' : '' ?>
              </span> <span class="mr-3">Modal Kerja</span>
              <span class="chk-box">
                <?= $d['tujuan_pinjaman'] == 'Investasi' ? '✓' : '' ?>
              </span> <span class="mr-3">Investasi</span>
              <span class="chk-box">
                <?= $d['tujuan_pinjaman'] == 'Lainnya' ? '✓' : '' ?>
              </span> <span class="mr-1">Lainnya:</span>
              <span class="dotted-line min-w-[60px]"><?= $d['tujuan_pinjaman_lain'] ?></span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <?php if($d['jenis_pemohon']=="perorangan"){ ?>
    <div class="page-break mb-4"></div>

    <div class="flex justify-between items-start border-b border-slate-400 pb-2 mb-4">
      <div class="flex items-center gap-1.5">
        <span class="text-[9px] font-bold uppercase tracking-wider text-slate-800">Formulir Kredit (Hal. 2)</span>
      </div>
      <div class="text-[9px] font-mono text-slate-950 font-bold" id="hal2-no-nik">NIK: <?= $d['nik'] ?></div>
    </div>

    <?php } ?>

    <div class="mb-1">
      <div class="bg-slate-800 text-white px-2 py-0.5 font-bold tracking-wider text-[10px] uppercase mb-1">
        Agunan
      </div>
      <table class="w-full border-collapse border border-slate-300">
        <tbody>
          <?php while($a=mysql_fetch_array($agunan)){ ?>
          <?php if($a['jenis_agunan']=="shm" || $a['jenis_agunan']=="shgb" || $a['jenis_agunan']=="shmsrs"){ ?>
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 w-1/4 px-2 py-1 font-semibold border-r border-slate-300">
              <?php if($a['jenis_agunan']=="shm"){ echo  "<span class='chk-box'>✓</span> SHM";}
                else if($a['jenis_agunan']=="shgb"){ echo "<span class='chk-box'>✓</span> SHGB";}
                else if($a['jenis_agunan']=="shmsrs"){ echo "<span class='chk-box'>✓</span> SHMSRS";}
                else { echo ""; }
              ?>
            </td>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">No.</td>
            <td class="px-2 py-1 border-r border-slate-300 text-slate-900"><?= $a['nomor_agunan'] ?></td>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Nama Pemilik</td>
            <td class="px-2 py-1 border-r text-slate-900"><?= ucwords($a['nama_pemilik']) ?></td>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Alamat</td>
            <td class="px-2 py-1 w-1/4 text-slate-900"><?= ucwords($a['alamat_agunan']) ?></td>
          </tr>
          <?php }else if($a['jenis_agunan']=="bpkb" || $a['jenis_agunan']=="invoice" || $a['jenis_agunan']=="deposito"){ ?>
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">
              <?php if ($a['jenis_agunan'] == 'bpkb') { echo "<span class='chk-box'>✓</span> BPKB";}
                else if ($a['jenis_agunan'] == 'invoice') { echo "<span class='chk-box'>✓</span> Invoice";}
                else if ($a['jenis_agunan'] == 'deposito') { echo "<span class='chk-box'>✓</span> Deposito";}
                else { echo "";}
              ?>
            </td>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">No.</td>
            <td class="px-2 py-1 border-r border-slate-300 text-slate-900"><?= $a['nomor_agunan'] ?></td>
            <td class="bg-slate-50 px-2 py- font-semibold border-r border-slate-300">Nama Pemilik</td>
            <td class="px-2 py-1 text-slate-900"><?= ucwords($a['nama_pemilik']) ?></td>
          </tr>
          <?php }else if($a['jenis_agunan']=="lainnya"){ ?>
          <tr class="border-b border-slate-300">
            <td class="bg-slate-50 px-2 py-1.5 font-semibold border-r border-slate-300">
              <span class="chk-box">
                <?php if ($a['jenis_agunan'] == 'lainnya') { echo "✓"; } ?>
              </span>
              <!-- <span class="mr-1">Agunan Lainnya:</span> -->
              <span class="dotted-line min-w-[60px]"><?= ucwords($a['nama_agunan']) ?></span>
            </td>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">No.</td>
            <td class="px-2 py-1 border-slate-300 border-r text-slate-900"><?= $a['nomor_agunan'] ?></td>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Nama Pemilik</td>
            <td class="px-2 py-1 border-r text-slate-900"><?= ucwords($a['nama_pemilik']) ?></td>
            <td class="bg-slate-50 px-2 py-1 font-semibold border-r border-slate-300">Alamat</td>
            <td class="px-2 py-1 text-slate-900"><?= ucwords($a['alamat_agunan']) ?></td>
          </tr>
          <?php } ?>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <!-- SECTION G: PERNYATAAN PEMOHON -->
    <div class="mb-4">
      <div class="bg-slate-800 text-white px-2 py-0.5 font-bold tracking-wider text-[10px] uppercase mb-1">
        Pernyataan Pemohon
      </div>
      <div class="border border-slate-300 p-3 bg-slate-50 text-[9.5px] leading-relaxed text-slate-700 text-justify">
        <p class="font-semibold text-slate-900 mb-1">Sehubungan dengan permohonan kredit ini saya menyatakan bahwa :</p>
        <ol class="list-decimal pl-4 space-y-1">
          <li>Semua informasi dan keterangan diatas adalah benar, lengkap dan bertanggung jawab penuh atas segala informasi yang diberikan;</li>
          <li>Seluruh dokumen yang diberikan sesuai asli dan sesuai yang sebenarnya.</li>
          <li>Dengan ini saya memberikan persetujuan dan kuasa kepada Bank Utomo untuk memperoleh informasi dari sumber manapun;</li>
          <li>Jika permohonan kredit disetujui, saya mengetahui bahwa seluruh informasi tentang diri saya disampaikan melalui SLIK.</li>
          <li>Saya memahami sepenuhnya bahwa dengan alasan apapun Bank Utomo dapat menolak permohonan yang saya ajukan serta saya akan Tunduk dan terikat pada ketentuan dan persyaratan di Bank Utomo.</li>
        </ol>
      </div>
    </div>

    <!-- SECTION H: REFERENSI & TANDA TANGAN -->
    <div class="grid grid-cols-2 gap-4 mt-6">
      <!-- Sisi Kiri: Referensi -->
      <div class="border border-slate-300 p-2.5 rounded">
        <table class="w-full text-[9.5px]">
          <tr class="border-b border-slate-200">
            <td class="py-1 font-medium text-slate-500 w-1/3">Referensi</td>
            <td class="py-1 font-bold text-slate-900">: </td>
          </tr>
          <tr>
            <td class="py-1 font-medium text-slate-500">Atas Nama</td>
            <td class="py-1 font-medium text-slate-900">: </td>
          </tr>
          <tr>
            <td class="py-1 font-medium text-slate-500">Tanda Tangan</td>
          </tr>
        </table>
      </div>

      <!-- Sisi Kanan: Tanda Tangan Pemohon -->
      <div class="text-center flex flex-col justify-between items-center border border-slate-300 p-2.5 rounded">
        <div>
          <span class="text-[9.5px] text-slate-900 font-semibold">......................................., ......................................</span>
          <p class="font-bold text-[9.5px] mt-0.5 text-slate-900">Pemohon,</p>
        </div>
        
        <!-- Kolom Tanda Tangan Fisik -->
        <div class="h-16 w-48 border border-dashed border-slate-300 my-2 flex items-center justify-center relative bg-slate-50">
          <span class="text-[8px] text-slate-300 uppercase select-none"></span>
          <div class="absolute font-serif italic text-lg text-indigo-900 opacity-80 pointer-events-none"></div>
        </div>

        <div>
          <p class="font-bold text-slate-950 text-[10px]">( .................................................. )</p>
        </div>
      </div>
    </div>

  </div>

</body>
<script>window.print();</script>
</html>