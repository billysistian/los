<?php
include "../../config/koneksi.php";

$id = $_GET['id'];
$data = mysql_fetch_array(mysql_query("
    SELECT * FROM permohonan_kredit_temp
    WHERE id='$id'
"));

$agunan = mysql_query("
    SELECT * FROM agunan_kredit_temp
    WHERE id_permohonan_kredit='$id'
");

$page_title = "Setujui Edit Permohonan Kredit";

include "../layout/header.php";
include "../layout/sidebar.php";
include "../layout/navbar.php";
include "../../utils/otorisasi.php";
require_role('Kadiv AO');
?>

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Permohonan Kredit</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Data Permohonan Kredit</a>
                    </li>
              </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Permohonan Kredit</h4>
                        </div>
                        <form id="approveForm">
                        <div class="card-body">
                            <!-- JENIS PEMOHON -->
                            <input type="hidden" name="id" value="<?php echo $data['id_permohonan_kredit'];?>">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">
                                            Jenis Pemohon
                                        </label>
                                        <select id="jenis" name="jenis_pemohon" class="form-control" readonly-select>
                                            <option value="">-- Pilih --</option>
                                            <option value="perorangan"
                                                <?php 
                                                if($data['jenis_pemohon']=="perorangan"){
                                                    echo "selected";
                                                }
                                                ?>
                                            >
                                                Perorangan
                                            </option>

                                            <option value="badan_usaha"
                                                <?php 
                                                if($data['jenis_pemohon']=="badan_usaha"){
                                                    echo "selected";
                                                }
                                                ?>
                                            >
                                                Badan Usaha
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">
                                            Nama AO
                                        </label>
                                        <input type="text" name="nama_ao" value="<?php echo $data['nama_ao'];?>" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">
                                            Kode AO
                                        </label>
                                        <input type="text" name="kode_ao" value="<?php echo $data['kode_ao'];?>" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">
                                            Diubah Oleh
                                        </label>
                                        <input type="text" name="edit_by" value="<?php echo $data['edit_by'];?>" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- ================= PERORANGAN ================= -->
                            <div id="perorangan">
                                <div class="card">
                                    <div class="card-header bg-secondary text-white">
                                        <div class="text-center fw-bold">DATA PRIBADI</div>
                                    </div>
                                    <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>NIK :</label>
                                                <input 
                                                    type="text"
                                                    name="nik"
                                                    value="<?php echo $data['nik'];?>"
                                                    class="form-control"
                                                    minlength="16"
                                                    maxlength="16"
                                                    pattern="[0-9]{16,16}"
                                                    oninvalid="this.setCustomValidity('NIK harus 16 digit angka')"
                                                    oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9]/g,'')"
                                                    readonly
                                                >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>NPWP :</label>
                                                <input
                                                    type="text"
                                                    name="npwp"
                                                    value="<?php echo $data['npwp'];?>"
                                                    class="form-control"
                                                    minlength="15"
                                                    maxlength="16"
                                                    pattern="[0-9]{15,16}"
                                                    oninvalid="this.setCustomValidity('NPWP harus 15 atau 16 digit angka')"
                                                    oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9]/g,'')"
                                                    readonly
                                                >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label>Nama (Sesuai Identitas) :</label>
                                                <input type="text" name="nama_identitas" value="<?php echo $data['nama_identitas'];?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label">
                                                    Jenis Kelamin
                                                </label>
                                                <div class="col-sm-5 d-flex align-items-center">
                                                    <label class="col-sm-3 col-form-label">
                                                        :
                                                    </label>
                                                    <div class="form-check me-4">
                                                    <input 
                                                    class="form-check-input"
                                                    type="radio"
                                                    name="jenis_kelamin"
                                                    id="pria"
                                                    value="Pria"
                                                    <?php 
                                                    if($data['jenis_kelamin']=="Pria"){
                                                        echo "checked";
                                                    }
                                                    ?> readonly>
                                                    <label class="form-check-label" for="pria">
                                                        Pria
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input 
                                                    class="form-check-input"
                                                    type="radio"
                                                    name="jenis_kelamin"
                                                    id="wanita"
                                                    value="Wanita"
                                                    <?php 
                                                    if($data['jenis_kelamin']=="Wanita"){
                                                        echo "checked";
                                                    }
                                                    ?> readonly>
                                                    <label class="form-check-label" for="wanita">
                                                        Wanita
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label">
                                                Kewarganegaraan
                                            </label>
                                            <div class="col-sm-6 d-flex align-items-center">
                                                <label class="col-sm-3 col-form-label">
                                                :
                                                </label>
                                                <div class="form-check me-4">
                                                    <input 
                                                    class="form-check-input"
                                                    type="radio"
                                                    name="kewarganegaraan"
                                                    id="wni"
                                                    value="WNI"
                                                    <?php 
                                                    if($data['kewarganegaraan']=="WNI"){
                                                        echo "checked";
                                                    }
                                                    ?> readonly>
                                                    <label class="form-check-label" for="wni">
                                                        WNI
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input 
                                                    class="form-check-input"
                                                    type="radio"
                                                    name="kewarganegaraan"
                                                    id="wna"
                                                    value="WNA"
                                                    <?php 
                                                    if($data['kewarganegaraan']=="WNA"){
                                                        echo "checked";
                                                    }
                                                    ?> readonly>
                                                    <label class="form-check-label" for="wna">
                                                        WNA
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Tempat :</label>
                                                <input type="text" name="tempat" value="<?php echo $data['tempat'];?>" readonly class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Tanggal Lahir :</label>
                                                <input type="date" name="tanggal_lahir" max="<?php echo date('Y-m-d'); ?>" value="<?php echo $data['tanggal_lahir'];?>" readonly-date class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">
                                            Pendidikan Terakhir :
                                        </label>
                                        <div class="col-sm-10">
                                            <select 
                                                id="pendidikan"
                                                name="pendidikan_terakhir"
                                                class="form-control" readonly-select>
                                                <option value="">-- Pilih Pendidikan --</option>
                                                <option value="SMP"
                                                    <?php if($data['pendidikan_terakhir']=="SMP"){echo "selected";} ?>
                                                    >SMP
                                                </option>
                                                <option value="SMA"
                                                    <?php if($data['pendidikan_terakhir']=="SMA"){echo "selected";} ?>
                                                    >SMA
                                                </option>
                                                <option value="Diploma"
                                                    <?php if($data['pendidikan_terakhir']=="Diploma"){echo "selected";} ?>
                                                    >DIPLOMA
                                                </option>
                                                <option value="S1"
                                                    <?php if($data['pendidikan_terakhir']=="S1"){echo "selected";} ?>
                                                    >S1
                                                </option>
                                                <option value="S2"
                                                    <?php if($data['pendidikan_terakhir']=="S2"){echo "selected";} ?>
                                                    >S2
                                                </option>
                                                <option value="Lainnya"
                                                    <?php if($data['pendidikan_terakhir']=="Lainnya"){echo "selected";} ?>
                                                    >Lainnya
                                                </option>
                                            </select>
                                            <div id="pendidikan_lain" class="mt-2">
                                            <input 
                                                type="text"
                                                name="pendidikan_lain"
                                                class="form-control"
                                                value="<?php echo $data['pendidikan_lain'];?>"
                                                placeholder="Masukkan pendidikan" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Alamat Rumah (Sesuai Identitas) :</label>
                                                <input type="text" id="alamat_ktp" name="alamat_ktp" value="<?php echo $data['alamat_ktp'];?>" readonly class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Kode Pos :</label>
                                                <input
                                                    type="text"
                                                    oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9]/g,'')"
                                                    id="kode_pos_ktp"
                                                    name="kode_pos_ktp"
                                                    value="<?php echo $data['kode_pos_ktp'];?>"
                                                    class="form-control"
                                                    autocomplete="off"
                                                    readonly
                                                >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Alamat Rumah (Sesuai Domisili) :</label>
                                                <input type="text" id="alamat_domisili" name="alamat_domisili" value="<?php echo $data['alamat_domisili'];?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Kode Pos :</label>
                                                <input
                                                    type="text"
                                                    oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9]/g,'')"
                                                    id="kode_pos_domisili"
                                                    name="kode_pos_domisili"
                                                    value="<?php echo $data['kode_pos_domisili'];?>"
                                                    class="form-control"
                                                    autocomplete="off"
                                                    readonly
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">
                                            Status Rumah :
                                        </label>
                                        <div class="col-sm-10">
                                            <select 
                                                id="status_rumah"
                                                name="status_rumah"
                                                class="form-control" readonly-select>
                                                <option value="">-- Pilih Status Rumah --</option>
                                                <option value="Milik Sendiri"
                                                    <?php if($data['status_rumah']=="Milik Sendiri"){echo "selected";} ?>
                                                    >Milik Sendiri
                                                </option>
                                                <option value="Milik Keluarga"
                                                    <?php if($data['status_rumah']=="Milik Keluarga"){echo "selected";} ?>
                                                    >Milik Keluarga
                                                </option>
                                                <option value="Kost/Kontrak"
                                                    <?php if($data['status_rumah']=="Kost/Kontrak"){echo "selected";} ?>
                                                    >Kost/Kontrak
                                                </option>
                                                <option value="Milik Perusahaan"
                                                    <?php if($data['status_rumah']=="Milik Perusahaan"){echo "selected";} ?>
                                                    >Milik Perusahaan
                                                </option>
                                                <option value="Kredit"
                                                    <?php if($data['status_rumah']=="Kredit"){echo "selected";} ?>
                                                    >Kredit
                                                </option>
                                                <option value="Lainnya"
                                                    <?php if($data['status_rumah']=="Lainnya"){echo "selected";} ?>
                                                    >Lainnya
                                                </option>
                                            </select>
                                            <div id="status_rumah_lain" class="mt-2">
                                            <input 
                                                type="text"
                                                name="status_rumah_lain"
                                                class="form-control"
                                                value="<?php echo $data['status_rumah_lain'];?>"
                                                placeholder="Masukkan status rumah"
                                                readonly
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 mt-3 col-form-label">No. Telepone:</label>
                                        <div class="col-sm-3">
                                            <label>Selular</label>
                                            <input
                                                type="text"
                                                oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9]/g,'')"
                                                name="selular_perorangan"
                                                value="<?php echo $data['selular_perorangan'];?>"
                                                class="form-control"
                                                autocomplete="off"
                                                readonly
                                            >
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Rumah</label>
                                            <input
                                                type="text"
                                                oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9]/g,'')"
                                                name="no_rumah_perorangan"
                                                value="<?php echo $data['no_rumah_perorangan'];?>"
                                                class="form-control"
                                                autocomplete="off"
                                                readonly
                                            >
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Kantor</label>
                                            <input 
                                                type="text"
                                                oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9]/g,'')"
                                                name="no_kantor_perorangan"
                                                value="<?php echo $data['no_kantor_perorangan'];?>"
                                                class="form-control"
                                                autocomplete="off"
                                                readonly
                                            >
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Fax</label>
                                            <input
                                                type="text"
                                                oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9]/g,'')"
                                                name="no_fax_perorangan"
                                                value="<?php echo $data['no_fax_perorangan'];?>"
                                                class="form-control"
                                                autocomplete="off"
                                                readonly
                                            >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label>Nama Gadis Ibu Kandung :</label>
                                                <input type="text" name="nama_gadis_ibu_kandung" value="<?php echo $data['nama_gadis_ibu_kandung'];?>" readonly class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-secondary text-white">
                                                <div class="text-center fw-bold">DATA PEKERJAAN</div>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-3 col-form-label">
                                                        Pekerjaan :
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <select 
                                                            id="pekerjaan"
                                                            name="pekerjaan"
                                                            class="form-control" readonly-select>
                                                            <option value="">-- Pilih Pekerjaan --</option>
                                                            <option value="Karyawan"
                                                                <?php if($data['pekerjaan']=="Karyawan"){echo "selected";} ?>
                                                                >Karyawan
                                                            </option>
                                                            <option value="Wirausaha"
                                                                <?php if($data['pekerjaan']=="Wirausaha"){echo "selected";} ?>
                                                                >Wirausaha
                                                            </option>
                                                            <option value="Profesi"
                                                                <?php if($data['pekerjaan']=="Profesi"){echo "selected";} ?>
                                                                >Profesi
                                                            </option>
                                                            <option value="Lainnya"
                                                                <?php if($data['pekerjaan']=="Lainnya"){echo "selected";} ?>
                                                                >Lainnya
                                                            </option>
                                                        </select>
                                                        <div id="pekerjaan_lain" class="mt-2">
                                                        <input 
                                                            type="text"
                                                            name="pekerjaan_lain"
                                                            class="form-control"
                                                            value="<?php echo $data['pekerjaan_lain'];?>"
                                                            placeholder="Masukkan pekerjaan" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label>Nama Perusahaan/Usaha :</label>
                                                        <input type="text" name="nama_perusahaan" class="form-control" value="<?php echo $data['nama_perusahaan'];?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label>Jabatan :</label>
                                                        <input type="text" name="jabatan" class="form-control" value="<?php echo $data['jabatan'];?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label>Bidang Usaha :</label>
                                                        <input type="text" name="bidang_usaha" class="form-control" value="<?php echo $data['bidang_usaha'];?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label>Alamat Tempat Bekerja/Usaha :</label>
                                                        <input type="text" name="alamat_tempat_bekerja" class="form-control" value="<?php echo $data['alamat_tempat_bekerja'];?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label>Lama Bekerja/Berwirausaha :</label>
                                                        <input type="text" name="lama_bekerja" class="form-control" value="<?php echo $data['lama_bekerja'];?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header bg-secondary text-white">
                                                <div class="text-center fw-bold">DATA KELUARGA TIDAK SERUMAH YANG DAPAT DIHUBUNGI</div>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label>Nama :</label>
                                                        <input type="text" name="nama_keluarga" class="form-control" value="<?php echo $data['nama_keluarga'];?>" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nomor Telepon :</label>
                                                        <input
                                                            type="text"
                                                            name="nomor_telepon_keluarga"
                                                            class="form-control"
                                                            value="<?php echo $data['nomor_telepon_keluarga'];?>"
                                                            readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Hubungan :</label>
                                                        <input type="text" name="hubungan_keluarga" class="form-control" value="<?php echo $data['hubungan_keluarga'];?>" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Alamat :</label>
                                                        <input type="text" name="alamat_keluarga" class="form-control" value="<?php echo $data['alamat_keluarga'];?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-secondary text-white">
                                                <div class="text-center fw-bold">STATUS PERKAWINAN (DATA SUAMI/ISTRI)</div>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3 row">
                                                    <label class="col-sm-4 col-form-label">
                                                        Status Perkawinan :
                                                    </label>
                                                    <div class="col-sm-8">
                                                        <select 
                                                            id="status_perkawinan"
                                                            name="status_perkawinan"
                                                            class="form-control" readonly-select>
                                                            <option value="">-- Pilih Status Perkawinan --</option>
                                                            <option value="Kawin"
                                                                <?php if ($data['status_perkawinan'] == 'Kawin') echo 'selected'; ?>
                                                                >Kawin
                                                            </option>
                                                            <option value="Belum Kawin"
                                                                <?php if ($data['status_perkawinan'] == 'Belum Kawin') echo 'selected'; ?>
                                                                >Belum Kawin
                                                            </option>
                                                            <option value="Cerai"
                                                                <?php if ($data['status_perkawinan'] == 'Cerai') echo 'selected'; ?>
                                                                >Cerai
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Nomor Identitas :</label>
                                                    <input
                                                        type="text"
                                                        oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9-]/g,'')"
                                                        name="nomor_identitas_pasangan"
                                                        class="form-control pasangan"
                                                        value="<?php echo $data['nomor_identitas_pasangan'];?>"
                                                        readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Nama (Sesuai Identitas) :</label>
                                                    <input
                                                        type="text"
                                                        name="nama_pasangan"
                                                        value="<?php echo $data['nama_pasangan'];?>"
                                                        autocomplete="off"
                                                        class="form-control pasangan"
                                                        readonly>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label>Tempat :</label>
                                                            <input
                                                                type="text"
                                                                name="tempat_lahir_pasangan"
                                                                value="<?php echo $data['tempat_lahir_pasangan'];?>"
                                                                class="form-control pasangan"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label>Tanggal Lahir :</label>
                                                            <input
                                                                type="date"
                                                                name="tanggal_lahir_pasangan"
                                                                max="<?php echo date('Y-m-d'); ?>"
                                                                value="<?php echo $data['tanggal_lahir_pasangan'];?>"
                                                                class="form-control pasangan"
                                                                readonly-date>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Nomor Telepon :</label>
                                                    <input
                                                        type="text"
                                                        name="no_telp_pasangan"
                                                        value="<?php echo $data['no_telp_pasangan'];?>"
                                                        class="form-control pasangan"
                                                        readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Nama Perusahaan / Usaha :</label>
                                                    <input type="text" name="nama_perusahaan_pasangan" class="form-control pasangan" value="<?php echo $data['nama_perusahaan_pasangan'];?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Jabatan :</label>
                                                    <input type="text" name="jabatan_pasangan" class="form-control pasangan" value="<?php echo $data['jabatan_pasangan'];?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Bidang Usaha :</label>
                                                    <input type="text" name="bidang_usaha_pasangan" class="form-control pasangan" value="<?php echo $data['bidang_usaha_pasangan'];?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Alamat Tempat Bekerja / Usaha :</label>
                                                    <input type="text" name="alamat_tempat_bekerja_pasangan" class="form-control pasangan" value="<?php echo $data['alamat_tempat_bekerja_pasangan'];?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Lama Bekerja / Berwirausaha :</label>
                                                    <input type="text" name="lama_bekerja_pasangan" class="form-control pasangan" value="<?php echo $data['lama_bekerja_pasangan'];?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- ================= BADAN USAHA ================= -->
                            <div id="badan">
                                <div class="card">
                                    <div class="card-header bg-secondary text-white">
                                        <div class="text-center fw-bold">DATA BADAN USAHA</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label>Nama (Pengurus Yang Berwenang) :</label>
                                                    <input type="text" name="nama_pengurus_berwenang" class="form-control" value="<?php echo $data['nama_pengurus_berwenang'];?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label>Nomor Identitas Badan Usaha :</label>
                                                    <input
                                                        type="text"
                                                        name="npwp_badan"
                                                        class="form-control"
                                                        placeholder="NPWP"
                                                        minlength="15"
                                                        maxlength="16"
                                                        pattern="[0-9]{15,16}"
                                                        oninvalid="this.setCustomValidity('NPWP harus 15 atau 16 digit angka')"
                                                        oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9]/g,'')"
                                                        autocomplete="off"
                                                        value="<?php echo $data['npwp_badan'];?>"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label>Nama (Sesuai Akta Badan Usaha) :</label>
                                                    <input type="text" name="nama_akta_usaha" class="form-control" value="<?php echo $data['nama_akta_usaha'];?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">
                                                Bentuk Badan Usaha :
                                            </label>
                                            <div class="col-sm-9">
                                                <select 
                                                    id="bentuk_badan_usaha"
                                                    name="bentuk_badan_usaha"
                                                    class="form-control" readonly-select>
                                                    <option value="">-- Pilih Bentuk Badan Usaha --</option>
                                                    <option value="Perseroan Terbatas (PT)"
                                                        <?php if($data['bentuk_badan_usaha']=="Perseroan Terbatas (PT)"){echo "selected";} ?>
                                                        >Perseroan Terbatas (PT)
                                                    </option>
                                                    <option value="Commanditier Venotschap (CV)"
                                                        <?php if($data['bentuk_badan_usaha']=="Commanditier Venotschap (CV)"){echo "selected";} ?>
                                                        >Commanditier Venotschap (CV)
                                                    </option>
                                                    <option value="Koperasi"
                                                        <?php if($data['bentuk_badan_usaha']=="Koperasi"){echo "selected";} ?>
                                                        >Koperasi
                                                    </option>
                                                    <option value="Lainnya"
                                                        <?php if($data['bentuk_badan_usaha']=="Lainnya"){echo "selected";} ?>
                                                        >Lainnya
                                                    </option>
                                                </select>
                                                <div id="bentuk_badan_usaha_lain" class="mt-2">
                                                <input 
                                                    type="text"
                                                    name="bentuk_badan_usaha_lain"
                                                    class="form-control"
                                                    value="<?php echo $data['bentuk_badan_usaha_lain'];?>"
                                                    placeholder="Masukkan bentuk badan usaha">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label>Bidang Usaha :</label>
                                            <input type="text" name="bidang_usaha_badan" class="form-control" value="<?php echo $data['bidang_usaha_badan'];?>" readonly>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Tempat :</label>
                                                    <input type="text" name="tempat_usaha" class="form-control" value="<?php echo $data['tempat_usaha'];?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Tanggal Pendirian :</label>
                                                    <input type="date" name="tanggal_pendirian" max="<?php echo date('Y-m-d'); ?>" class="form-control" value="<?php echo $data['tanggal_pendirian'];?>" readonly-date>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="mb-3">
                                                    <label>Alamat Kantor :</label>
                                                    <input type="text" name="alamat_kantor_usaha" value="<?php echo $data['alamat_kantor_usaha'];?>" class="form-control" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label>Kode Pos :</label>
                                                    <input type="text" name="kode_pos_alamat_usaha" class="form-control" value="<?php echo $data['kode_pos_alamat_usaha'];?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">
                                                Status Kantor :
                                            </label>
                                            <div class="col-sm-10">
                                                <select 
                                                    id="status_kantor"
                                                    name="status_kantor_usaha"
                                                    class="form-control" readonly-select>
                                                    <option value="">-- Pilih Status Kantor --</option>
                                                    <option value="Milik Sendiri"
                                                        <?php if($data['status_kantor_usaha']=="Milik Sendiri"){echo "selected";} ?>
                                                        >Milik Sendiri
                                                    </option>
                                                    <option value="Sewa"
                                                        <?php if($data['status_kantor_usaha']=="Sewa"){echo "selected";} ?>
                                                        >Sewa
                                                    </option>
                                                    <option value="Lainnya"
                                                        <?php if($data['status_kantor_usaha']=="Lainnya"){echo "selected";} ?>
                                                        >Lainnya
                                                    </option>
                                                </select>
                                                <div id="status_kantor_lain" class="mt-2">
                                                <input 
                                                    type="text"
                                                    name="status_kantor_usaha_lain"
                                                    class="form-control"
                                                    value="<?php echo $data['status_kantor_usaha_lain'];?>"
                                                    placeholder="Masukkan status kantor">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 mt-3 col-form-label">No. Telepone</label>
                                            <div class="col-sm-3">
                                                <label>Kantor</label>
                                                <input
                                                    type="text"
                                                    oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9]/g,'')"
                                                    name="no_kantor_usaha"
                                                    value="<?php echo $data['no_kantor_usaha'];?>"
                                                    class="form-control"
                                                    readonly>
                                            </div>
                                            <div class="col-sm-2">
                                                <label>Fax</label>
                                                <input
                                                    type="text"
                                                    oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9]/g,'')"
                                                    name="no_fax_usaha"
                                                    value="<?php echo $data['no_fax_usaha'];?>"
                                                    class="form-control"
                                                    readonly>
                                            </div>
                                            <div class="col-sm-2">
                                                <label>HP PIC</label>
                                                <input
                                                    type="text"
                                                    oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9]/g,'')"
                                                    name="hp_pic"
                                                    value="<?php echo $data['hp_pic'];?>"
                                                    class="form-control"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- DATA KREDIT -->
                            <div class="card mt-4">
                                    <div class="card-header bg-secondary text-white">
                                        <div class="text-center fw-bold">PERMOHONAN KREDIT</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Plafond Pinjaman :</label>
                                            <div class="col-sm-10">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                    <input
                                                        type="text"
                                                        inputmode="numeric"
                                                        id="plafond_pinjaman"
                                                        name="plafond_pinjaman"
                                                        value="<?php echo number_format($data['plafond_pinjaman'], 0, ',', '.' );?>"
                                                        class="form-control"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">
                                                Tujuan Pinjaman :
                                            </label>
                                            <div class="col-sm-10">
                                                <select 
                                                    id="tujuan_pinjaman"
                                                    name="tujuan_pinjaman"
                                                    class="form-control" readonly-select>
                                                    <option value="">-- Pilih Tujuan Pinjaman --</option>
                                                    <option value="Modal Kerja"
                                                        <?php if($data['tujuan_pinjaman']=="Modal Kerja"){echo "selected";} ?>
                                                        >Modal Kerja
                                                    </option>
                                                    <option value="Investasi"
                                                        <?php if($data['tujuan_pinjaman']=="Investasi"){echo "selected";} ?>
                                                        >Investasi
                                                    </option>
                                                    <option value="Lainnya"
                                                        <?php if($data['tujuan_pinjaman']=="Lainnya"){echo "selected";} ?>
                                                        >Lainnya
                                                    </option>
                                                </select>
                                                <div id="tujuan_pinjaman_lain" class="mt-2">
                                                <input 
                                                    type="text"
                                                    name="tujuan_pinjaman_lain"
                                                    class="form-control"
                                                    value="<?php echo $data['tujuan_pinjaman_lain'];?>"
                                                    placeholder="Masukkan tujuan pinjaman">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <!-- AGUNAN -->
                            <div class="card mt-4">
                                <div class="card-header bg-secondary text-white">
                                    <div class="text-center fw-bold">DATA AGUNAN</div>
                                </div>
                                <div class="card-body">
                                    <div id="list-agunan">
                                        <?php while($a=mysql_fetch_array($agunan)){ ?>
                                        <div class="row mb-3 agunan-item">
                                            <div class="col-md-2">
                                                <label>Jenis Agunan :</label>
                                                <select 
                                                name="jenis_agunan[]" 
                                                class="form-control jenis-agunan readonly-select">
                                                    <option value="">Pilih Agunan</option>
                                                    <option value="shm"
                                                    <?php if($a['jenis_agunan']=="shm") echo "selected"; ?>>
                                                    SHM
                                                    </option>
                                                    <option value="shgb"
                                                    <?php if($a['jenis_agunan']=="shgb") echo "selected"; ?>>
                                                    SHGB
                                                    </option>
                                                    <option value="shmsrs"
                                                    <?php if($a['jenis_agunan']=="shmsrs") echo "selected"; ?>>
                                                    SHMSRS
                                                    </option>
                                                    <option value="bpkb"
                                                    <?php if($a['jenis_agunan']=="bpkb") echo "selected"; ?>>
                                                    BPKB
                                                    </option>
                                                    <option value="invoice"
                                                    <?php if($a['jenis_agunan']=="invoice") echo "selected"; ?>>
                                                    INVOICE
                                                    </option>
                                                    <option value="deposito"
                                                    <?php if($a['jenis_agunan']=="deposito") echo "selected"; ?>>
                                                    Deposito
                                                    </option>
                                                    <option value="lainnya"
                                                    <?php if($a['jenis_agunan']=="lainnya") echo "selected"; ?>>
                                                    Lainnya
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-md-10 field-agunan">

                                            <?php if($a['jenis_agunan']=="shm" || $a['jenis_agunan']=="shgb" || $a['jenis_agunan']=="shmsrs"){ ?>
                                                <input type="hidden" name="id_agunan[]" value="<?= $a['id_agunan_kredit'] ?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>No. Agunan :</label>
                                                        <input 
                                                        type="text"
                                                        name="nomor_agunan[]"
                                                        class="form-control"
                                                        value="<?php echo $a['nomor_agunan']; ?>"
                                                        readonly>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Nama Pemilik :</label>
                                                        <input 
                                                        type="text"
                                                        name="nama_pemilik[]"
                                                        class="form-control"
                                                        value="<?php echo $a['nama_pemilik']; ?>"
                                                        readonly>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Alamat :</label>
                                                        <input 
                                                        type="text"
                                                        name="alamat_agunan[]"
                                                        class="form-control"
                                                        value="<?php echo $a['alamat_agunan']; ?>"
                                                        readonly>
                                                    </div>
                                                    <div class="col-md-3 d-none">
                                                        <label>Nama Agunan :</label>
                                                        <input 
                                                        type="text"
                                                        name="nama_agunan[]"
                                                        class="form-control"
                                                        value="<?php echo $a['nama_agunan']; ?>"
                                                        readonly>
                                                    </div>
                                                </div>

                                            <?php }elseif($a['jenis_agunan']=="bpkb" || $a['jenis_agunan']=="invoice" || $a['jenis_agunan']=="deposito"){ ?>
                                                <input type="hidden" name="id_agunan[]" value="<?= $a['id_agunan_kredit'] ?>">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>No. Agunan :</label>
                                                        <input 
                                                        type="text"
                                                        name="nomor_agunan[]"
                                                        class="form-control"
                                                        value="<?php echo $a['nomor_agunan']; ?>"
                                                        readonly>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Nama Pemilik :</label>
                                                        <input 
                                                        type="text"
                                                        name="nama_pemilik[]"
                                                        class="form-control"
                                                        value="<?php echo $a['nama_pemilik']; ?>"
                                                        readonly>
                                                    </div>
                                                    <div class="col-md-3 d-none">
                                                        <label>Alamat :</label>
                                                        <input 
                                                        type="text"
                                                        name="alamat_agunan[]"
                                                        class="form-control"
                                                        value="<?php echo $a['alamat_agunan']; ?>"
                                                        readonly>
                                                    </div>
                                                    <div class="col-md-3 d-none">
                                                        <label>Nama Agunan :</label>
                                                        <input 
                                                        type="text"
                                                        name="nama_agunan[]"
                                                        class="form-control"
                                                        value="<?php echo $a['nama_agunan']; ?>"
                                                        readonly>
                                                    </div>
                                                </div>
                                            <?php }elseif($a['jenis_agunan']=="lainnya"){ ?>
                                                <input type="hidden" name="id_agunan[]" value="<?= $a['id_agunan_kredit'] ?>">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Nama Agunan :</label>
                                                        <input 
                                                        type="text"
                                                        name="nama_agunan[]"
                                                        class="form-control"
                                                        value="<?php echo $a['nama_agunan']; ?>"
                                                        readonly>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>No. Agunan :</label>
                                                        <input 
                                                        type="text"
                                                        name="nomor_agunan[]"
                                                        class="form-control"
                                                        value="<?php echo $a['nomor_agunan']; ?>"
                                                        readonly>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Nama Pemilik :</label>
                                                        <input 
                                                        type="text"
                                                        name="nama_pemilik[]"
                                                        class="form-control"
                                                        value="<?php echo $a['nama_pemilik']; ?>"
                                                        readonly>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label>Alamat :</label>
                                                        <input 
                                                        type="text"
                                                        name="alamat_agunan[]"
                                                        class="form-control"
                                                        value="<?php echo $a['alamat_agunan']; ?>"
                                                        readonly>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        <div class="card-action">
                            <button type="button" id="approve" class="btn btn-primary"><i class="fas fa-check"></i> Setujui Perubahan</button>
                            <a href="approval.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "../layout/footer.php"; ?>
    <script>
    $(document).ready(function(){
        function tampilForm(){
            var jenis = $("#jenis").val();
            if(jenis=="perorangan"){
                $("#perorangan").show();
                $("#badan").hide();
            }
            else if(jenis=="badan_usaha"){
                $("#badan").show();
                $("#perorangan").hide();
            }
            else{
                $("#perorangan").hide();
                $("#badan").hide();
            }
        }
        tampilForm();
        $("#jenis").change(function(){
            tampilForm();
        });
        
        document.querySelectorAll('select').forEach(el => {
            el.classList.add('readonly-select');
            el.tabIndex = -1;
        });

        document.querySelectorAll('input[type="date"]').forEach(el => {
            el.readOnly = true;
            el.classList.add('readonly-date');
            el.tabIndex = -1;
        });

        function cekLainnya(select, input){
            var nilai = $(select).val();
            if(nilai=="Lainnya"){
                $(input).show();
            }else{
                $(input).hide();
            }
        }

        cekLainnya("#pendidikan","#pendidikan_lain");
        cekLainnya("#status_rumah","#status_rumah_lain");
        cekLainnya("#pekerjaan","#pekerjaan_lain");
        cekLainnya("#bentuk_badan_usaha","#bentuk_badan_usaha_lain");
        cekLainnya("#status_kantor","#status_kantor_lain");
        cekLainnya("#tujuan_pinjaman","#tujuan_pinjaman_lain");

        $("#pendidikan").change(function(){
            cekLainnya("#pendidikan","#pendidikan_lain");
        });

        $("#status_rumah").change(function(){
            cekLainnya("#status_rumah","#status_rumah_lain");
        });

        $("#pekerjaan").change(function(){
            cekLainnya("#pekerjaan","#pekerjaan_lain");
        });

        $("#bentuk_badan_usaha").change(function(){
            cekLainnya("#bentuk_badan_usaha","#bentuk_badan_usaha_lain");
        });

        $("#status_kantor").change(function(){
            cekLainnya("#status_kantor","#status_kantor_lain");
        });

        $("#tujuan_pinjaman").change(function(){
            cekLainnya("#tujuan_pinjaman","#tujuan_pinjaman_lain");
        });

        $('#plafond_pinjaman').on('input', function() {
            var raw = $(this).val().replace(/\D/g, '');
            var fmt = raw.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            $(this).val(fmt);
        });

        $("#alamat_ktp").on("input", function(){
            $("#alamat_domisili").val($(this).val());
        });

        $("#kode_pos_ktp").on("input", function(){
            $("#kode_pos_domisili").val($(this).val());
        });
    });
    </script>

    <?php include "../kredit/ajax.php"; ?>