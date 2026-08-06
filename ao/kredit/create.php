<?php
$page_title = "Input Permohonan Kredit";
include "../layout/header.php";
include "../layout/sidebar.php";
include "../layout/navbar.php";
include "../../utils/otorisasi.php";
require_role('AO');
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
                        <form id="form">
                        <div class="card-body">
                            <!-- JENIS PEMOHON -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">
                                            Jenis Pemohon
                                        </label>
                                        <select id="jenis" name="jenis_pemohon" class="form-control">
                                            <option value="">-- Pilih --</option>
                                            <option value="perorangan">Perorangan</option>
                                            <option value="badan_usaha">Badan Usaha</option>
                                        </select>
                                        
                                        <button type="button"
                                                id="btnPilihNasabah"
                                                class="btn btn-secondary btn-md mt-2 d-none">
                                            <i class="fas fa-search"></i> Klik dan pilih jika ingin menggunakan data nasabah
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">
                                            Nama AO
                                        </label>
                                        <input type="text" name="nama_ao" class="form-control" autocomplete="off" required data-required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">
                                            Kode AO
                                        </label>
                                        <input type="text" name="kode_ao" class="form-control" autocomplete="off" required data-required>
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
                                                        class="form-control"
                                                        minlength="16"
                                                        maxlength="16"
                                                        pattern="[0-9]{16,16}"
                                                        oninvalid="this.setCustomValidity('NIK harus 16 digit angka')"
                                                        oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9]/g,'-')"
                                                        autocomplete="off"
                                                        required data-required disabled
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>NPWP :</label>
                                                    <input 
                                                        type="text"
                                                        name="npwp"
                                                        class="form-control"
                                                        minlength="15"
                                                        maxlength="16"
                                                        pattern="[0-9]{15,16}"
                                                        oninvalid="this.setCustomValidity('NPWP harus 15 atau 16 digit angka')"
                                                        oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9]/g,'')"
                                                        autocomplete="off"
                                                        required data-required disabled
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label>Nama (Sesuai Identitas) :</label>
                                                    <input
                                                        type="text"
                                                        name="nama_identitas"
                                                        class="form-control"
                                                        autocomplete="off"
                                                        required data-required disabled>
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
                                                                class="form-check-input" disabled
                                                                type="radio"
                                                                name="jenis_kelamin"
                                                                id="pria"
                                                                value="Pria"
                                                                required data-required>
                                                            <label class="form-check-label" for="pria">
                                                                Pria
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input 
                                                                class="form-check-input" disabled
                                                                type="radio"
                                                                name="jenis_kelamin"
                                                                id="wanita"
                                                                value="Wanita"
                                                                required data-required>
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
                                                                class="form-check-input" disabled
                                                                type="radio"
                                                                name="kewarganegaraan"
                                                                id="wni"
                                                                value="WNI"
                                                                required data-required>
                                                            <label class="form-check-label" for="wni">
                                                                WNI
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input 
                                                                class="form-check-input" disabled
                                                                type="radio"
                                                                name="kewarganegaraan"
                                                                id="wna"
                                                                value="WNA"
                                                                required data-required>
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
                                                    <label>Tempat:</label>
                                                    <input type="text" name="tempat" class="form-control" autocomplete="off" required data-required disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Tanggal Lahir :</label>
                                                    <input
                                                        type="date"
                                                        name="tanggal_lahir"
                                                        class="form-control"
                                                        max="<?php echo date('Y-m-d'); ?>"
                                                        autocomplete="off"
                                                        required data-required disabled>
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
                                                    class="form-control" required data-required disabled>
                                                    <option value="">-- Pilih Pendidikan --</option>
                                                    <option value="SMP">SMP</option>
                                                    <option value="SMA">SMA</option>
                                                    <option value="Diploma">DIPLOMA</option>
                                                    <option value="S1">S1</option>
                                                    <option value="S2">S2</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                                <div id="pendidikan_lain" class="mt-2">
                                                <input 
                                                    type="text"
                                                    name="pendidikan_lain"
                                                    class="form-control" disabled
                                                    autocomplete="off"
                                                    placeholder="Masukkan pendidikan">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Alamat Rumah (Sesuai Identitas) :</label>
                                                    <input
                                                        type="text"
                                                        id="alamat_ktp"
                                                        name="alamat_ktp"
                                                        class="form-control"
                                                        autocomplete="off"
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Kode Pos :</label>
                                                    <input
                                                        type="text"
                                                        oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9-]/g,'')"
                                                        id="kode_pos_ktp"
                                                        name="kode_pos_ktp"
                                                        class="form-control"
                                                        autocomplete="off" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Alamat Rumah (Sesuai Domisili) :</label>
                                                    <input
                                                        type="text"
                                                        id="alamat_domisili"
                                                        name="alamat_domisili"
                                                        class="form-control"
                                                        autocomplete="off"
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Kode Pos :</label>
                                                    <input type="text" id="kode_pos_domisili" name="kode_pos_domisili" class="form-control" autocomplete="off" disabled>
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
                                                    class="form-control" required data-required disabled>
                                                    <option value="">-- Pilih Status Rumah --</option>
                                                    <option value="Milik Sendiri">Milik Sendiri</option>
                                                    <option value="Milik Keluarga">Milik Keluarga</option>
                                                    <option value="Kost/Kontrak">Kost/Kontrak</option>
                                                    <option value="Milik Perusahaan">Milik Perusahaan</option>
                                                    <option value="Kredit">Kredit</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                                <div id="status_rumah_lain" class="mt-2">
                                                <input 
                                                    type="text"
                                                    name="status_rumah_lain"
                                                    class="form-control" disabled
                                                    autocomplete="off"
                                                    placeholder="Masukkan status rumah">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">No. Telepone</label>
                                            <div class="col-sm-3">
                                                <input
                                                    type="text"
                                                    oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9]/g,'')"
                                                    name="selular_perorangan"
                                                    class="form-control"
                                                    autocomplete="off"
                                                    required data-required disabled placeholder="Selular">
                                            </div>
                                            <div class="col-sm-2">
                                                <input
                                                    type="text"
                                                    oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9]/g,'')"
                                                    name="no_rumah_perorangan"
                                                    class="form-control"
                                                    autocomplete="off" disabled placeholder="Rumah">
                                            </div>
                                            <div class="col-sm-3">
                                                <input
                                                    type="text"
                                                    oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9]/g,'')"
                                                    name="no_kantor_perorangan"
                                                    class="form-control"
                                                    autocomplete="off" disabled placeholder="Kantor">
                                            </div>
                                            <div class="col-sm-2">
                                                <input
                                                    type="text"
                                                    oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9]/g,'')"
                                                    name="no_fax_perorangan"
                                                    class="form-control"
                                                    autocomplete="off" disabled placeholder="Fax">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label>Nama Gadis Ibu Kandung :</label>
                                                    <input
                                                        type="text"
                                                        name="nama_gadis_ibu_kandung"
                                                        class="form-control"
                                                        autocomplete="off" required data-required disabled>
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
                                                            class="form-control" required data-required disabled>
                                                            <option value="">-- Pilih Pekerjaan --</option>
                                                            <option value="Karyawan">Karyawan</option>
                                                            <option value="Wirausaha">Wirausaha</option>
                                                            <option value="Profesi">Profesi</option>
                                                            <option value="Lainnya">Lainnya</option>
                                                        </select>
                                                        <div id="pekerjaan_lain" class="mt-2">
                                                        <input 
                                                            type="text"
                                                            name="pekerjaan_lain"
                                                            class="form-control" disabled
                                                            autocomplete="off"
                                                            placeholder="Masukkan pekerjaan">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label>Nama Perusahaan/Usaha :</label>
                                                        <input
                                                            type="text"
                                                            name="nama_perusahaan"
                                                            class="form-control"
                                                            value="-" autocomplete="off" required data-required disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label>Jabatan :</label>
                                                        <input
                                                            type="text"
                                                            name="jabatan"
                                                            class="form-control"
                                                            value="-" autocomplete="off" required data-required disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label>Bidang Usaha :</label>
                                                        <input
                                                            type="text"
                                                            name="bidang_usaha"
                                                            class="form-control"
                                                            value="-" autocomplete="off" required data-required disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label>Alamat Tempat Bekerja/Usaha :</label>
                                                        <input
                                                            type="text"
                                                            name="alamat_tempat_bekerja"
                                                            class="form-control" value="-"
                                                            autocomplete="off" required data-required disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label>Lama Bekerja/Berwirausaha :</label>
                                                        <input
                                                            type="text"
                                                            name="lama_bekerja"
                                                            class="form-control"
                                                            value="-" autocomplete="off" required data-required disabled>
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
                                                        <input
                                                            type="text"
                                                            name="nama_keluarga"
                                                            class="form-control"
                                                            value="-" autocomplete="off" required data-required disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nomor Telepon :</label>
                                                        <input
                                                            type="text"
                                                            oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9-]/g,'')"
                                                            name="nomor_telepon_keluarga"
                                                            class="form-control"
                                                            value="-"
                                                            autocomplete="off" required data-required disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Hubungan :</label>
                                                        <input
                                                            type="text"
                                                            name="hubungan_keluarga"
                                                            class="form-control"
                                                            value="-" autocomplete="off" required data-required disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Alamat :</label>
                                                        <input
                                                            type="text"
                                                            name="alamat_keluarga"
                                                            class="form-control"
                                                            value="-" autocomplete="off" required data-required disabled>
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
                                                            class="form-control" required data-required disabled>
                                                            <option value="">-- Pilih Status Perkawinan --</option>
                                                            <option value="Kawin">Kawin</option>
                                                            <option value="Belum Kawin">Belum Kawin</option>
                                                            <option value="Cerai">Cerai</option>
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
                                                        value="-"
                                                        autocomplete="off" required data-required disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Nama (Sesuai Identitas) :</label>
                                                    <input
                                                        type="text"
                                                        name="nama_pasangan"
                                                        class="form-control pasangan"
                                                        value="-" autocomplete="off" required data-required disabled>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label>Tempat :</label>
                                                            <input
                                                                type="text"
                                                                name="tempat_lahir_pasangan"
                                                                class="form-control pasangan"
                                                                value="-" autocomplete="off" required data-required disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label>Tanggal Lahir :</label>
                                                            <input
                                                                type="date"
                                                                name="tanggal_lahir_pasangan"
                                                                class="form-control pasangan"
                                                                max="<?= date('Y-m-d'); ?>" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Nomor Telepon :</label>
                                                    <input
                                                        type="text"
                                                        oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9-]/g,'')"
                                                        name="no_telp_pasangan"
                                                        class="form-control pasangan"
                                                        value="-"
                                                        autocomplete="off" required data-required disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Nama Perusahaan / Usaha :</label>
                                                    <input
                                                        type="text"
                                                        name="nama_perusahaan_pasangan"
                                                        class="form-control pasangan"
                                                        value="-"
                                                        autocomplete="off" required data-required disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Jabatan :</label>
                                                    <input
                                                        type="text"
                                                        name="jabatan_pasangan"
                                                        class="form-control pasangan"
                                                        value="-"
                                                        autocomplete="off" required data-required disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Bidang Usaha :</label>
                                                    <input
                                                        type="text"
                                                        name="bidang_usaha_pasangan"
                                                        class="form-control pasangan"
                                                        value="-"
                                                        autocomplete="off" required data-required disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Alamat Tempat Bekerja / Usaha :</label>
                                                    <input
                                                        type="text"
                                                        name="alamat_tempat_bekerja_pasangan"
                                                        class="form-control pasangan"
                                                        value="-"
                                                        autocomplete="off" required data-required disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Lama Bekerja / Berwirausaha :</label>
                                                    <input
                                                        type="text"
                                                        name="lama_bekerja_pasangan"
                                                        class="form-control pasangan"
                                                        value="-"
                                                        autocomplete="off" required data-required disabled>
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
                                                        <input type="text" name="nama_pengurus_berwenang" class="form-control" autocomplete="off" required data-required disabled>
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
                                                            required data-required disabled
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label>Nama (Sesuai Akta Badan Usaha) :</label>
                                                        <input
                                                            type="text"
                                                            name="nama_akta_usaha"
                                                            class="form-control"
                                                            autocomplete="off" required data-required disabled>
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
                                                        class="form-control" required data-required disabled>
                                                        <option value="">-- Pilih Bentuk Badan Usaha --</option>
                                                        <option value="Perseroan Terbatas (PT)">Perseroan Terbatas (PT)</option>
                                                        <option value="Commanditier Venotschap (CV)">Commanditier Venotschap (CV)</option>
                                                        <option value="Koperasi">Koperasi</option>
                                                        <option value="Lainnya">Lainnya</option>
                                                    </select>
                                                    <div id="bentuk_badan_usaha_lain" class="mt-2">
                                                    <input 
                                                        type="text"
                                                        name="bentuk_badan_usaha_lain"
                                                        class="form-control" disabled
                                                        autocomplete="off"
                                                        placeholder="Masukkan bentuk badan usaha">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label>Bidang Usaha :</label>
                                                <input
                                                    type="text"
                                                    name="bidang_usaha_badan"
                                                    class="form-control"
                                                    autocomplete="off" required data-required disabled>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label>Tempat :</label>
                                                        <input
                                                            type="text"
                                                            name="tempat_usaha"
                                                            class="form-control"
                                                            autocomplete="off" required data-required disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label>Tanggal Pendirian :</label>
                                                        <input
                                                            type="date"
                                                            name="tanggal_pendirian"
                                                            max="<?= date('Y-m-d'); ?>"
                                                            class="form-control"
                                                            required data-required disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="mb-3">
                                                        <label>Alamat Kantor :</label>
                                                        <input
                                                            type="text"
                                                            name="alamat_kantor_usaha"
                                                            class="form-control"
                                                            autocomplete="off" required data-required disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label>Kode Pos :</label>
                                                        <input
                                                            type="text"
                                                            oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9-]/g,'')"
                                                            name="kode_pos_alamat_usaha"
                                                            class="form-control"
                                                            autocomplete="off" disabled>
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
                                                        class="form-control" required data-required disabled>
                                                        <option value="">-- Pilih Status Kantor --</option>
                                                        <option value="Milik Sendiri">Milik Sendiri</option>
                                                        <option value="Sewa">Sewa</option>
                                                        <option value="Lainnya">Lainnya</option>
                                                    </select>
                                                    <div id="status_kantor_lain" class="mt-2">
                                                    <input 
                                                        type="text"
                                                        name="status_kantor_usaha_lain"
                                                        class="form-control" disabled
                                                        autocomplete="off"
                                                        placeholder="Masukkan status kantor">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-2 col-form-label">No. Telepone</label>
                                                <div class="col-sm-4">
                                                    <input
                                                        type="text"
                                                        oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9-]/g,'')"
                                                        name="no_kantor_usaha"
                                                        class="form-control"
                                                        disabled
                                                        autocomplete="off"
                                                        placeholder="Kantor">
                                                </div>
                                                <div class="col-sm-3">
                                                    <input
                                                        type="text"
                                                        oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9-]/g,'')"
                                                        name="no_fax_usaha"
                                                        class="form-control"
                                                        disabled
                                                        autocomplete="off"
                                                        placeholder="Fax">
                                                </div>
                                                <div class="col-sm-3">
                                                    <input
                                                        type="text"
                                                        oninput="this.setCustomValidity(''); this.value=this.value.replace(/[^0-9-]/g,'')"
                                                        name="hp_pic"
                                                        class="form-control"
                                                        required data-required
                                                        disabled
                                                        autocomplete="off"
                                                        placeholder="HP PIC">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <!-- DATA KREDIT -->
                            <div id="all">
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
                                                        id="plafond_pinjaman"
                                                        inputmode="numeric"
                                                        name="plafond_pinjaman"
                                                        class="form-control"
                                                        autocomplete="off" required data-required disabled>
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
                                                    class="form-control" required data-required disabled>
                                                    <option value="">-- Pilih Tujuan Pinjaman --</option>
                                                    <option value="Modal Kerja">Modal Kerja</option>
                                                    <option value="Investasi">Investasi</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                                <div id="tujuan_pinjaman_lain" class="mt-2">
                                                <input 
                                                    type="text"
                                                    name="tujuan_pinjaman_lain"
                                                    class="form-control" disabled
                                                    autocomplete="off"
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
                                            <div class="row mb-3 agunan-item">
                                                <div class="col-md-2">
                                                    <label>Jenis Agunan :</label>
                                                    <select name="jenis_agunan[]" class="form-control jenis-agunan" required data-required>
                                                        <option value="">Pilih Agunan</option>
                                                        <option value="shm">SHM</option>
                                                        <option value="shgb">SHGB</option>
                                                        <option value="shmsrs">SHMSRS</option>
                                                        <option value="bpkb">BPKB</option>
                                                        <option value="invoice">INVOICE</option>
                                                        <option value="deposito">Deposito</option>
                                                        <option value="lainnya">Lainnya</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-9 field-agunan"></div>
                                                <div class="col-md-1 mt-4">
                                                    <div class="float-end">
                                                        <button type="button" class="btn btn-danger remove" title="Hapus Agunan">
                                                        <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="float-end">
                                            <button 
                                                type="button" 
                                                id="add-agunan"
                                                class="btn btn-success">
                                                <i class="fas fa-plus-circle"></i> Agunan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        </form>
                        <div class="card-action">
                            <button type="button" id="simpan" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Simpan</button>
                            <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalNasabah" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Data Nasabah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text"
                                id="cariNasabah"
                                class="form-control"
                                placeholder="Cari nama / NIK / NPWP...">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK / NPWP</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th width="100">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tabelNasabah">
                                <!-- isi ajax -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include "../layout/footer.php"; ?>
<script>
$(document).ready(function(){
    $("#perorangan").hide();
    $("#badan").hide();
    $("#all").hide();
    
    $("#jenis").change(function(){
        var jenis = $(this).val();

        $("#perorangan, #badan").find("input, select, textarea").attr("disabled", true).removeAttr("required");

        if(jenis=="perorangan"){
            $("#perorangan").show();
            $("#badan").hide();
            $("#all").show();

            $("#perorangan").find("input, select, textarea").removeAttr("disabled");
            $("#perorangan").find("input[data-required], select[data-required], textarea[data-required]").attr("required", true);
            $("#all").find("input, select, textarea").removeAttr("disabled");
        }else if(jenis=="badan_usaha"){
            $("#badan").show();
            $("#perorangan").hide();
            $("#all").show();

            $("#badan").find("input, select, textarea").removeAttr("disabled");
            $("#badan").find("input[data-required], select[data-required], textarea[data-required]").attr("required", true);
            $("#all").find("input, select, textarea").removeAttr("disabled");
        }else{
            $("#perorangan").hide();
            $("#badan").hide();
            $("#all").hide();
        }
    });

    function cekStatusKawin(){
        var status = $("#status_perkawinan").val();
        if(status=="Kawin"){
            $(".pasangan").removeAttr("disabled").attr("required",true);
        }else{
            $(".pasangan").attr("disabled",true).removeAttr("required");
            $(".pasangan").val("");
        }
    }
    cekStatusKawin();
    $("#status_perkawinan").change(function(){
        cekStatusKawin();
    });

    $("#pendidikan_lain").hide();
    $("#pendidikan").change(function(){
        var pilih = $(this).val();
        if(pilih=="Lainnya"){
            $("#pendidikan_lain").slideDown();
        }else{
            $("#pendidikan_lain").slideUp();
        }
    });

    $("#status_rumah_lain").hide();
    $("#status_rumah").change(function(){
        var pilih = $(this).val();
        if(pilih=="Lainnya"){
            $("#status_rumah_lain").slideDown();
        }else{
            $("#status_rumah_lain").slideUp();
        }
    });

    $("#pekerjaan_lain").hide();
    $("#pekerjaan").change(function(){
        var pilih = $(this).val();
        if(pilih=="Lainnya"){
            $("#pekerjaan_lain").slideDown();
        }else{
            $("#pekerjaan_lain").slideUp();
        }
    });

    $("#bentuk_badan_usaha_lain").hide();
    $("#bentuk_badan_usaha").change(function(){
        var pilih = $(this).val();
        if(pilih=="Lainnya"){
            $("#bentuk_badan_usaha_lain").slideDown();
        }else{
            $("#bentuk_badan_usaha_lain").slideUp();
        }
    });

    $("#status_kantor_lain").hide();
    $("#status_kantor").change(function(){
        var pilih = $(this).val();
        if(pilih=="Lainnya"){
            $("#status_kantor_lain").slideDown();
        }else{
            $("#status_kantor_lain").slideUp();
        }
    });

    $("#tujuan_pinjaman_lain").hide();
    $("#tujuan_pinjaman").change(function(){
        var pilih = $(this).val();
        if(pilih=="Lainnya"){
            $("#tujuan_pinjaman_lain").slideDown();
        }else{
            $("#tujuan_pinjaman_lain").slideUp();
        }
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

    // tampilkan tombol ketika jenis dipilih
$('#jenis').change(function(){
    const jenis = $(this).val();

    if(jenis){
        $('#btnPilihNasabah').removeClass('d-none');
    }else{
        $('#btnPilihNasabah').addClass('d-none');
    }
});

// buka modal
$('#btnPilihNasabah').click(function(){
    const jenis = $('#jenis').val();

    $.get('ajax_nasabah.php', { jenis: jenis }, function(res){
        $('#tabelNasabah').html(res);
        $('#modalNasabah').modal('show');
    });
});

// pilih nasabah dari tabel
$(document).on('click', '.pilih-nasabah', function(){
    const data = $(this).data();
    const jenis = $('#jenis').val();

    if(jenis === 'perorangan'){
        $('input[name="nik"]').val(data.nik);
        $('input[name="npwp"]').val(data.npwp);
        $('input[name="nama_identitas"]').val(data.nama);
        $('input[name="tempat"]').val(data.tempat);
        $('input[name="tanggal_lahir"]').val(data.tanggal_lahir);
        $('input[name="alamat_ktp"]').val(data.alamat);
        $('input[name="selular_perorangan"]').val(data.hp);

        if(data.jenis_kelamin === 'Pria'){
            $('#pria').prop('checked', true);
        }else{
            $('#wanita').prop('checked', true);
        }

    }else if(jenis === 'badan_usaha'){
        $('input[name="nama_pengurus_berwenang"]').val(data.pengurus);
        $('input[name="npwp_badan"]').val(data.npwp);
        $('input[name="nama_akta_usaha"]').val(data.nama_usaha);
        $('input[name="bidang_usaha_badan"]').val(data.bidang_usaha);
        $('input[name="alamat_kantor_usaha"]').val(data.alamat);
        $('input[name="hp_pic"]').val(data.hp);
    }

    $('#modalNasabah').modal('hide');
});

function loadNasabah(page){
    $.get('ajax_nasabah.php', {
        jenis: $('#jenis').val(),
        q: $('#cariNasabah').val(),
        page: page || 1
    }, function(res){
        $('#tabelNasabah').html(res);
    });
}

// buka modal
$('#btnPilihNasabah').click(function(){
    $('#modalNasabah').modal('show');
    loadNasabah(1);
});

// pencarian dengan delay
let timer;
$('#cariNasabah').on('keyup', function(){
    clearTimeout(timer);

    timer = setTimeout(function(){
        loadNasabah(1);
    }, 300);
});
});
</script>

<?php include "../kredit/ajax.php"; ?>