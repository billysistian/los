<?php
session_start();
include "../../config/koneksi.php";

$jenis_pemohon     = $_POST['jenis_pemohon'];

if($jenis_pemohon == "perorangan"){
    $id                       = $_POST['id'];
    $jenis_pemohon            = $_POST['jenis_pemohon'];
    $nama_ao                  = $_POST['nama_ao'];
    $kode_ao                  = $_POST['kode_ao'];
    $nik                      = $_POST['nik'];
    $npwp                     = $_POST['npwp'];
    $nama_identitas           = $_POST['nama_identitas'];
    $jenis_kelamin            = $_POST['jenis_kelamin'];
    $kewarganegaraan          = $_POST['kewarganegaraan'];
    $tempat                   = $_POST['tempat'];
    $tanggal_lahir            = $_POST['tanggal_lahir'];
    $pendidikan_terakhir      = $_POST['pendidikan_terakhir'];
    $pendidikan_lain          = $_POST['pendidikan_lain'];
    $alamat_ktp               = $_POST['alamat_ktp'];
    $kode_pos_ktp             = $_POST['kode_pos_ktp'];
    $alamat_domisili          = $_POST['alamat_domisili'];
    $kode_pos_domisili        = $_POST['kode_pos_domisili'];
    $status_rumah             = $_POST['status_rumah'];
    $status_rumah_lain        = $_POST['status_rumah_lain'];
    $selular_perorangan       = $_POST['selular_perorangan'];
    $no_rumah_perorangan      = $_POST['no_rumah_perorangan'];
    $no_kantor_perorangan     = $_POST['no_kantor_perorangan'];
    $no_fax_perorangan        = $_POST['no_fax_perorangan'];
    $nama_gadis_ibu_kandung   = $_POST['nama_gadis_ibu_kandung'];
    $pekerjaan                = $_POST['pekerjaan'];
    $pekerjaan_lain           = $_POST['pekerjaan_lain'];
    $nama_perusahaan          = $_POST['nama_perusahaan'];
    $jabatan                  = $_POST['jabatan'];
    $bidang_usaha             = $_POST['bidang_usaha'];
    $alamat_tempat_bekerja    = $_POST['alamat_tempat_bekerja'];
    $lama_bekerja             = $_POST['lama_bekerja'];
    $nama_keluarga            = $_POST['nama_keluarga'];
    $nomor_telepon_keluarga   = $_POST['nomor_telepon_keluarga'];
    $hubungan_keluarga        = $_POST['hubungan_keluarga'];
    $alamat_keluarga          = $_POST['alamat_keluarga'];
    $status_perkawinan        = $_POST['status_perkawinan'];
    $nomor_identitas_pasangan = !empty($_POST['nomor_identitas_pasangan']) ? $_POST['nomor_identitas_pasangan'] : '';
    $nama_pasangan            = !empty($_POST['nama_pasangan']) ? $_POST['nama_pasangan'] : '';
    $tempat_lahir_pasangan    = !empty($_POST['tempat_lahir_pasangan']) ? $_POST['tempat_lahir_pasangan'] : '';
    $tanggal_lahir_pasangan   = !empty($_POST['tanggal_lahir_pasangan']) ? $_POST['tanggal_lahir_pasangan'] : '';
    $no_telp_pasangan         = !empty($_POST['no_telp_pasangan']) ? $_POST['no_telp_pasangan'] : '';
    $nama_perusahaan_pasangan = !empty($_POST['nama_perusahaan_pasangan']) ? $_POST['nama_perusahaan_pasangan'] : '';
    $jabatan_pasangan         = !empty($_POST['jabatan_pasangan']) ? $_POST['jabatan_pasangan'] : '';
    $bidang_usaha_pasangan    = !empty($_POST['bidang_usaha_pasangan']) ? $_POST['bidang_usaha_pasangan'] : '';
    $alamat_tempat_bekerja_pasangan = !empty($_POST['alamat_tempat_bekerja_pasangan']) ? $_POST['alamat_tempat_bekerja_pasangan'] : '';
    $lama_bekerja_pasangan    = !empty($_POST['lama_bekerja_pasangan']) ? $_POST['lama_bekerja_pasangan'] : '';
    $plafond_pinjaman         = doubleval(preg_replace("/[^\d-]+/", "" , $_POST["plafond_pinjaman"]));
    $tujuan_pinjaman          = $_POST['tujuan_pinjaman'];
    $tujuan_pinjaman_lain     = $_POST['tujuan_pinjaman_lain'];
    $edit_by                  = $_POST['edit_by'];
    $edit_at                  = date('Y-m-d H:i:s');
    $approve_by               = $_SESSION['username'];
    $approve_at               = date('Y-m-d H:i:s');

    mysql_query("START TRANSACTION");

    $query = mysql_query("
    UPDATE permohonan_kredit SET
    jenis_pemohon='$jenis_pemohon',
    nama_ao='$nama_ao',
    kode_ao='$kode_ao',
    nik='$nik',
    npwp='$npwp',
    nama_identitas= '$nama_identitas',
    jenis_kelamin='$jenis_kelamin',
    kewarganegaraan='$kewarganegaraan',
    tempat='$tempat',
    tanggal_lahir='$tanggal_lahir',
    pendidikan_terakhir='$pendidikan_terakhir',
    pendidikan_lain='$pendidikan_lain',
    alamat_ktp='$alamat_ktp',
    kode_pos_ktp='$kode_pos_ktp',
    alamat_domisili='$alamat_domisili',
    kode_pos_domisili='$kode_pos_domisili',
    status_rumah='$status_rumah',
    status_rumah_lain='$status_rumah_lain',
    selular_perorangan='$selular_perorangan',
    no_rumah_perorangan='$no_rumah_perorangan',
    no_kantor_perorangan='$no_kantor_perorangan',
    no_fax_perorangan='$no_fax_perorangan',
    nama_gadis_ibu_kandung='$nama_gadis_ibu_kandung',
    pekerjaan='$pekerjaan',
    pekerjaan_lain='$pekerjaan_lain',
    nama_perusahaan='$nama_perusahaan',
    jabatan='$jabatan',
    bidang_usaha='$bidang_usaha',
    alamat_tempat_bekerja='$alamat_tempat_bekerja',
    lama_bekerja='$lama_bekerja',
    nama_keluarga='$nama_keluarga',
    nomor_telepon_keluarga='$nomor_telepon_keluarga',
    hubungan_keluarga='$hubungan_keluarga',
    alamat_keluarga='$alamat_keluarga',
    status_perkawinan='$status_perkawinan',
    nomor_identitas_pasangan='$nomor_identitas_pasangan',
    nama_pasangan='$nama_pasangan',
    tempat_lahir_pasangan='$tempat_lahir_pasangan',
    tanggal_lahir_pasangan='$tanggal_lahir_pasangan',
    no_telp_pasangan='$no_telp_pasangan',
    nama_perusahaan_pasangan='$nama_perusahaan_pasangan',
    jabatan_pasangan='$jabatan_pasangan',
    bidang_usaha_pasangan='$bidang_usaha_pasangan',
    alamat_tempat_bekerja_pasangan='$alamat_tempat_bekerja_pasangan',
    lama_bekerja_pasangan='$lama_bekerja_pasangan',
    nama_pengurus_berwenang=NULL,
    npwp_badan=NULL,
    nama_akta_usaha=NULL,
    bentuk_badan_usaha=NULL,
    bentuk_badan_usaha_lain=NULL,
    bidang_usaha_badan=NULL,
    tempat_usaha=NULL,
    tanggal_pendirian=NULL,
    alamat_kantor_usaha=NULL,
    kode_pos_alamat_usaha=NULL,
    status_kantor_usaha=NULL,
    status_kantor_usaha_lain=NULL,
    no_kantor_usaha=NULL,
    no_fax_usaha=NULL,
    hp_pic=NULL,
    plafond_pinjaman='$plafond_pinjaman',
    tujuan_pinjaman='$tujuan_pinjaman',
    tujuan_pinjaman_lain='$tujuan_pinjaman_lain',
    flag='1',
    edit_by='$edit_by',
    edit_at='$edit_at'
    WHERE id='$id'
    ");

    if(!$query){
        mysql_query("ROLLBACK");
        die(mysql_error());
    }

    $id_agunan_terpakai = array();

    if(isset($_POST['jenis_agunan'])){
        foreach($_POST['jenis_agunan'] as $i => $jenis){

            $id_agunan     = isset($_POST['id_agunan'][$i]) ? $_POST['id_agunan'][$i] : '';
            $nomor         = isset($_POST['nomor_agunan'][$i]) ? $_POST['nomor_agunan'][$i] : '';
            $nama_pemilik  = isset($_POST['nama_pemilik'][$i]) ? $_POST['nama_pemilik'][$i] : '';
            $alamat_agunan = isset($_POST['alamat_agunan'][$i]) ? $_POST['alamat_agunan'][$i] : '';
            $nama_agunan   = isset($_POST['nama_agunan'][$i]) ? $_POST['nama_agunan'][$i] : '';

            if(!empty($id_agunan)){
                // AGUNAN LAMA -> UPDATE
                $update = mysql_query("
                    UPDATE agunan_kredit SET
                    jenis_agunan='$jenis',
                    nomor_agunan='$nomor',
                    nama_pemilik='$nama_pemilik',
                    nama_agunan='$nama_agunan',
                    alamat_agunan='$alamat_agunan'
                    WHERE id='$id_agunan' AND id_permohonan_kredit='$id'
                ");

                if(!$update){
                    mysql_query("ROLLBACK");
                    die(mysql_error());
                }

                $id_agunan_terpakai[] = $id_agunan;

            } else {
                // AGUNAN BARU -> INSERT
                $insert = mysql_query("
                    INSERT INTO agunan_kredit SET
                    id_permohonan_kredit='$id',
                    jenis_agunan='$jenis',
                    nomor_agunan='$nomor',
                    nama_pemilik='$nama_pemilik',
                    nama_agunan='$nama_agunan',
                    alamat_agunan='$alamat_agunan'
                ");

                if(!$insert){
                    mysql_query("ROLLBACK");
                    die(mysql_error());
                }

                $id_agunan_terpakai[] = mysql_insert_id();
            }
        }

        //hapus id yang tidak ada lagi di form
        if(!empty($id_agunan_terpakai)){
            $in = "'" . implode("','", $id_agunan_terpakai) . "'";
            $delete = mysql_query("
                DELETE FROM agunan_kredit
                WHERE id_permohonan_kredit='$id'
                AND id NOT IN ($in)
            ");
        } else {
            $delete = mysql_query("
                DELETE FROM agunan_kredit
                WHERE id_permohonan_kredit='$id'
            ");
        }

        if(!$delete){
            mysql_query("ROLLBACK");
            die(mysql_error());
        }
    }

    mysql_query("
        INSERT INTO logs (menu, referensi, aktifitas, data_awal, data_diperbaharui, created_by, created_at)
        VALUES('Permohonan Kredit','$id','APPROVE',NULL,'".mysql_real_escape_string(json_encode($_POST))."','$approve_by','$approve_at')
    ");

    $hapus= mysql_query("DELETE FROM permohonan_kredit_temp WHERE id_permohonan_kredit='$id'");
    if(!$hapus){
        mysql_query("ROLLBACK");
        die(mysql_error());
    }

    mysql_query("COMMIT");
    echo "success";
    
}else if($jenis_pemohon == "badan_usaha"){
    $id                          = $_POST['id'];
    $jenis_pemohon               = $_POST['jenis_pemohon'];
    $nama_ao                     = $_POST['nama_ao'];
    $kode_ao                     = $_POST['kode_ao'];
    $nama_pengurus_berwenang     = $_POST['nama_pengurus_berwenang'];
    $npwp_badan                  = $_POST['npwp_badan'];
    $nama_akta_usaha             = $_POST['nama_akta_usaha'];
    $bentuk_badan_usaha          = $_POST['bentuk_badan_usaha'];
    $bentuk_badan_usaha_lain     = $_POST['bentuk_badan_usaha_lain'];
    $bidang_usaha_badan          = $_POST['bidang_usaha_badan'];
    $tempat_usaha                = $_POST['tempat_usaha'];
    $tanggal_pendirian           = $_POST['tanggal_pendirian'];
    $alamat_kantor_usaha         = $_POST['alamat_kantor_usaha'];
    $kode_pos_alamat_usaha       = $_POST['kode_pos_alamat_usaha'];
    $status_kantor_usaha         = $_POST['status_kantor_usaha'];
    $status_kantor_usaha_lain    = $_POST['status_kantor_usaha_lain'];
    $no_kantor_usaha             = $_POST['no_kantor_usaha'];
    $no_fax_usaha                = $_POST['no_fax_usaha'];
    $hp_pic                      = $_POST['hp_pic'];
    $plafond_pinjaman            = doubleval(preg_replace("/[^\d-]+/", "" , $_POST["plafond_pinjaman"]));
    $tujuan_pinjaman             = $_POST['tujuan_pinjaman'];
    $tujuan_pinjaman_lain        = $_POST['tujuan_pinjaman_lain'];
    $edit_by                     = $_POST['edit_by'];
    $edit_at                     = date('Y-m-d H:i:s');
    $approve_by                  = $_SESSION['username'];
    $approve_at                  = date('Y-m-d H:i:s');

    mysql_query("START TRANSACTION");

    $query = mysql_query("
    UPDATE permohonan_kredit SET
    jenis_pemohon='$jenis_pemohon',
    nama_ao='$nama_ao',
    kode_ao='$kode_ao',
    nik=NULL,
    npwp=NULL,
    nama_identitas=NULL,
    jenis_kelamin=NULL,
    kewarganegaraan=NULL,
    tempat=NULL,
    tanggal_lahir=NULL,
    pendidikan_terakhir=NULL,
    pendidikan_lain=NULL,
    alamat_ktp=NULL,
    kode_pos_ktp=NULL,
    alamat_domisili=NULL,
    kode_pos_domisili=NULL,
    status_rumah=NULL,
    status_rumah_lain=NULL,
    selular_perorangan=NULL,
    no_rumah_perorangan=NULL,
    no_kantor_perorangan=NULL,
    no_fax_perorangan=NULL,
    nama_gadis_ibu_kandung=NULL,
    pekerjaan=NULL,
    pekerjaan_lain=NULL,
    nama_perusahaan=NULL,
    jabatan=NULL,
    bidang_usaha=NULL,
    alamat_tempat_bekerja=NULL,
    lama_bekerja=NULL,
    nama_keluarga=NULL,
    nomor_telepon_keluarga=NULL,
    hubungan_keluarga=NULL,
    alamat_keluarga=NULL,
    status_perkawinan=NULL,
    nomor_identitas_pasangan=NULL,
    nama_pasangan=NULL,
    tempat_lahir_pasangan=NULL,
    tanggal_lahir_pasangan=NULL,
    no_telp_pasangan=NULL,
    nama_perusahaan_pasangan=NULL,
    jabatan_pasangan=NULL,
    bidang_usaha_pasangan=NULL,
    alamat_tempat_bekerja_pasangan=NULL,
    lama_bekerja_pasangan=NULL,
    nama_pengurus_berwenang='$nama_pengurus_berwenang',
    npwp_badan='$npwp_badan',
    nama_akta_usaha='$nama_akta_usaha',
    bentuk_badan_usaha='$bentuk_badan_usaha',
    bentuk_badan_usaha_lain='$bentuk_badan_usaha_lain',
    bidang_usaha_badan='$bidang_usaha_badan',
    tempat_usaha='$tempat_usaha',
    tanggal_pendirian='$tanggal_pendirian',
    alamat_kantor_usaha='$alamat_kantor_usaha',
    kode_pos_alamat_usaha='$kode_pos_alamat_usaha',
    status_kantor_usaha='$status_kantor_usaha',
    status_kantor_usaha_lain='$status_kantor_usaha_lain',
    no_kantor_usaha='$no_kantor_usaha',
    no_fax_usaha='$no_fax_usaha',
    hp_pic='$hp_pic',
    plafond_pinjaman='$plafond_pinjaman',
    tujuan_pinjaman='$tujuan_pinjaman',
    tujuan_pinjaman_lain='$tujuan_pinjaman_lain',
    flag='1',
    edit_by='$edit_by',
    edit_at='$edit_at'
    WHERE id='$id'
    ");

    if(!$query){
        mysql_query("ROLLBACK");
        die(mysql_error());
    }

    $id_agunan_terpakai = array();

    if(isset($_POST['jenis_agunan'])){
        foreach($_POST['jenis_agunan'] as $i => $jenis){

            $id_agunan     = isset($_POST['id_agunan'][$i]) ? $_POST['id_agunan'][$i] : '';
            $nomor         = isset($_POST['nomor_agunan'][$i]) ? $_POST['nomor_agunan'][$i] : '';
            $nama_pemilik  = isset($_POST['nama_pemilik'][$i]) ? $_POST['nama_pemilik'][$i] : '';
            $alamat_agunan = isset($_POST['alamat_agunan'][$i]) ? $_POST['alamat_agunan'][$i] : '';
            $nama_agunan   = isset($_POST['nama_agunan'][$i]) ? $_POST['nama_agunan'][$i] : '';

            if(!empty($id_agunan)){
                // AGUNAN LAMA -> UPDATE
                $update = mysql_query("
                    UPDATE agunan_kredit SET
                    jenis_agunan='$jenis',
                    nomor_agunan='$nomor',
                    nama_pemilik='$nama_pemilik',
                    nama_agunan='$nama_agunan',
                    alamat_agunan='$alamat_agunan'
                    WHERE id='$id_agunan' AND id_permohonan_kredit='$id'
                ");

                if(!$update){
                    mysql_query("ROLLBACK");
                    die(mysql_error());
                }

                $id_agunan_terpakai[] = $id_agunan;

            } else {
                // AGUNAN BARU -> INSERT
                $insert = mysql_query("
                    INSERT INTO agunan_kredit SET
                    id_permohonan_kredit='$id',
                    jenis_agunan='$jenis',
                    nomor_agunan='$nomor',
                    nama_pemilik='$nama_pemilik',
                    nama_agunan='$nama_agunan',
                    alamat_agunan='$alamat_agunan'
                ");

                if(!$insert){
                    mysql_query("ROLLBACK");
                    die(mysql_error());
                }

                $id_agunan_terpakai[] = mysql_insert_id();
            }
        }

        //hapus id yang tidak ada lagi di form
        if(!empty($id_agunan_terpakai)){
            $in = "'" . implode("','", $id_agunan_terpakai) . "'";
            $delete = mysql_query("
                DELETE FROM agunan_kredit
                WHERE id_permohonan_kredit='$id'
                AND id NOT IN ($in)
            ");
        } else {
            $delete = mysql_query("
                DELETE FROM agunan_kredit
                WHERE id_permohonan_kredit='$id'
            ");
        }

        if(!$delete){
            mysql_query("ROLLBACK");
            die(mysql_error());
        }
    }

    mysql_query("
        INSERT INTO logs (menu, referensi, aktifitas, data_awal, data_diperbaharui, created_by, created_at)
        VALUES('Permohonan Kredit','$id','APPROVE',NULL,'".mysql_real_escape_string(json_encode($_POST))."','$approve_by','$approve_at')
    ");

    $hapus= mysql_query("DELETE FROM permohonan_kredit_temp WHERE id_permohonan_kredit='$id'");
    if(!$hapus){
        mysql_query("ROLLBACK");
        die(mysql_error());
    }

    mysql_query("COMMIT");
    echo "success";
}

?>