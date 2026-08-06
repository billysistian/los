<?php
include "../../config/koneksi.php";

$page_title = "Permohonan Kredit";

include "../layout/header.php";
include "../layout/sidebar.php";
include "../layout/navbar.php";
include "../../utils/tgl_indo.php";
include "../../utils/otorisasi.php";
require_role('AO');

$filter_jenis_pemohon = isset($_GET['jenis_pemohon']) ? $_GET['jenis_pemohon'] : '';
$filter_dari_tanggal  = isset($_GET['dari_tanggal']) ? $_GET['dari_tanggal'] : '';
$filter_sampai_tanggal = isset($_GET['sampai_tanggal']) ? $_GET['sampai_tanggal'] : '';

$where = array();

if ($filter_jenis_pemohon !== '') {
    $jenis_pemohon_esc = mysql_real_escape_string($filter_jenis_pemohon);
    $where[] = "jenis_pemohon = '{$jenis_pemohon_esc}'";
}

if ($filter_dari_tanggal !== '') {
    $dari_esc = mysql_real_escape_string($filter_dari_tanggal);
    $where[] = "DATE(created_at) >= '{$dari_esc}'";
}

if ($filter_sampai_tanggal !== '') {
    $sampai_esc = mysql_real_escape_string($filter_sampai_tanggal);
    $where[] = "DATE(created_at) <= '{$sampai_esc}'";
}

$sql = "SELECT * FROM permohonan_kredit";
if (count($where) > 0) {
    $sql .= " WHERE " . implode(" AND ", $where);
}
$sql .= " ORDER BY id DESC";

$data = mysql_query($sql);
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
                  <a href="#">Daftar Permohonan Kredit</a>
                </li>
              </ul>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Filter Data</h4>
                  </div>
                  <div class="card-body">
                    <form method="GET" action="" class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">Jenis Pemohon</label>
                            <select name="jenis_pemohon" class="form-control">
                                <option value="">-- Semua --</option>
                                <option value="perorangan" <?= $filter_jenis_pemohon == 'perorangan' ? 'selected' : ''; ?>>Perorangan</option>
                                <option value="badan_usaha" <?= $filter_jenis_pemohon == 'badan_usaha' ? 'selected' : ''; ?>>Badan Usaha</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Dari Tanggal</label>
                            <input type="date" name="dari_tanggal" class="form-control" value="<?= htmlspecialchars($filter_dari_tanggal); ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Sampai Tanggal</label>
                            <input type="date" name="sampai_tanggal" class="form-control" value="<?= htmlspecialchars($filter_sampai_tanggal); ?>">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary btn-round">
                                <i class="fa fa-search"></i> Filter
                            </button>
                            <a href="<?= basename($_SERVER['PHP_SELF']); ?>" class="btn btn-outline-secondary btn-round">
                                <i class="fa fa-times"></i> Reset
                            </a>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Daftar Permohonan Kredit</h4>
                      <a href="create.php" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i>
                        Tambah
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                    <table id="tableResponsive" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="text-center">Aksi</th>
                                <th>Jenis Pemohon</th>
                                <th>NIK</th>
                                <th>NPWP</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat, Tanggal Lahir</th>
                                <th>Kewarganegaraan</th>
                                <th>Pendidikan Terakhir</th>
                                <th>Alamat</th>
                                <th>Kode Pos</th>
                                <th>Alamat Rumah (Domisili)</th>
                                <th>Kode Pos</th>
                                <th>Status Rumah</th>
                                <th>No. Telepon</th>
                                <th>Nama Gadis Ibu Kandung</th>
                                <th>Pekerjaan</th>
                                <th>Nama Perusahaan/Usaha</th>
                                <th>Jabatan</th>
                                <th>Bidang Usaha</th>
                                <th>Alamat Tempat Bekerja/Usaha</th>
                                <th>Lama Bekerja/Usaha</th>
                                <th>Nama Lengkap Keluarga</th>
                                <th>No. Telepon Keluarga</th>
                                <th>Hubungan Keluarga</th>
                                <th>Alamat Keluarga</th>
                                <th>Status Edit</th>
                                <th>Tempat, Tanggal Pendirian</th>
                                <th>Status Kepemilikan Kantor</th>
                                <th>Kontak Telepon Kantor</th>
                                <th>Plafond Pinjaman</th>
                                <th>Tujuan Pinjaman
                                <th>Nama AO</th>
                                <th>Kode AO</th>
                                <th>Tanggal Dibuat</th>
                                <th>Dibuat Oleh</th>
                                <th>Tanggal Diubah</th>
                                <th>Diubah Oleh</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while($d = mysql_fetch_array($data)){
                            ?>
                            <tr class="align-middle">
                                <td><?= $no++; ?></td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="border: none!important;">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 37px);" data-popper-placement="bottom-start">
                                            <a class="dropdown-item" href="history.php?id=<?= $d['id']; ?>"><i class="fas fa-history"></i> History</a>
                                            <a class="dropdown-item" href="edit.php?id=<?= $d['id']; ?>"><i class="fas fa-edit"></i> Edit</a>
                                            <a class="dropdown-item" href="print.php?id=<?= $d['id']; ?>" target="_blank"><i class="fas fa-print"></i> Print</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger hapus" href="javascript:void(0)" data-id="<?= $d['id']; ?>"><i class="fas fa-trash"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? "Perorangan" : "Badan Usaha"; ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['nik'] : "-" ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['npwp'] : $d['npwp_badan']; ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['nama_identitas'] : $d['nama_pengurus_berwenang']; ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['jenis_kelamin'] : "-" ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['tempat'].", ".tgl_indo($d['tanggal_lahir']) : "-" ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['kewarganegaraan'] : "-" ?></td>
                                <td>
                                    <?php
                                    if ($d['jenis_pemohon'] == "perorangan"){
                                        if ($d['pendidikan_terakhir'] == "lainnya")
                                        { echo $d['pendidikan_lain']; }
                                        else
                                        { echo $d['pendidikan_terakhir']; }
                                    }
                                    else
                                    { echo "-"; }
                                    ?>
                                </td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['alamat_ktp'] : $d['alamat_kantor_usaha']; ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['kode_pos_ktp'] : $d['kode_pos_alamat_usaha']; ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['alamat_domisili'] : "-" ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['kode_pos_domisili'] : "-" ?></td>
                                <td><?php
                                    if ($d['jenis_pemohon'] == "perorangan"){
                                        if ($d['status_rumah'] == "lainnya")
                                        { echo $d['status_rumah_lain']; }
                                        else
                                        { echo $d['status_rumah']; }
                                    }
                                    else
                                    { echo "-"; }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($d['jenis_pemohon'] == "perorangan"){
                                        if (!empty($d['no_rumah_perorangan']))
                                        { echo $d['no_rumah_perorangan']; }
                                        else if (!empty($d['no_fax_perorangan']))
                                        { echo $d['no_fax_perorangan']; }
                                        else if (!empty($d['no_kantor_perorangan']))
                                        { echo $d['no_kantor_perorangan']; }
                                        else
                                        { echo $d['selular_perorangan']; }
                                    }
                                    else
                                    { echo "-"; }
                                    ?>
                                </td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['nama_gadis_ibu_kandung'] : "-" ?></td>
                                <td>
                                    <?php
                                    if ($d['jenis_pemohon'] == "perorangan"){
                                        if ($d['pekerjaan'] == "lainnya")
                                        { echo $d['pekerjaan_lain']; }
                                        else
                                        { echo $d['pekerjaan']; }
                                    }
                                    else
                                    { echo "-"; }
                                    ?>
                                </td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['nama_perusahaan'] : "-" ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['jabatan'] : "-" ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['bidang_usaha'] : $d['bidang_usaha_badan'] ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['alamat_tempat_bekerja'] : "-" ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['lama_bekerja'] : "-" ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['nama_keluarga'] : "-" ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['nomor_telepon_keluarga'] : "-" ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['hubungan_keluarga'] : "-" ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['alamat_keluarga'] : "-" ?></td>
                                <td>
                                    <?php
                                        if ($d['flag'] == "") {
                                            echo '-';
                                        } elseif ($d['flag'] == "0") {
                                            echo '<span class="badge text-white bg-warning">Menunggu Persetujuan</span>';
                                        } elseif ($d['flag'] == "1") {
                                            echo '<span class="badge text-white bg-success">Disetujui</span>';
                                        } elseif ($d['flag'] == "2") {
                                            echo '<span class="badge text-white bg-danger">Ditolak</span>';
                                        }
                                    ?>
                                </td>
                                <td><?= $d['jenis_pemohon'] == "badan_usaha" ? $d['tempat_usaha'].", ".tgl_indo($d['tanggal_pendirian']) : "-" ?></td>
                                <td>
                                    <?php
                                    if ($d['jenis_pemohon'] == "badan_usaha"){
                                        if ($d['status_kantor_usaha'] == "lainnya")
                                        { echo $d['status_kantor_usaha_lain']; }
                                        else
                                        { echo $d['status_kantor_usaha']; }
                                    }
                                    else
                                    { echo "-"; }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($d['jenis_pemohon'] == "badan_usaha"){
                                        if (!empty($d['no_kantor_usaha']))
                                        { echo $d['no_kantor_usaha']; }
                                        else if (!empty($d['no_fax_usaha']))
                                        { echo $d['no_fax_usaha']; }
                                        else
                                        { echo $d['hp_pic']; }
                                    }
                                    else
                                    { echo "-"; }
                                    ?>
                                </td>
                                <td><?= number_format($d['plafond_pinjaman'], 2, ',', '.') ?></td>
                                <td>
                                    <?php
                                        if ($d['tujuan_pinjaman'] == "lainnya")
                                        { echo $d['tujuan_pinjaman_lain']; }
                                        else
                                        { echo $d['tujuan_pinjaman']; }
                                    ?>
                                </td>
                                <td><?= ucwords($d['nama_ao']) ?></td>
                                <td><?= $d['kode_ao']; ?></td>
                                <td><?= dateTimeIndo($d['created_at']); ?></td>
                                <td><?= ucwords($d['created_by']) ?></td>
                                <td><?= $d['edit_at'] == "0000-00-00 00:00:00" || $d['edit_at'] == NULL ? "-" : dateTimeIndo($d['edit_at']); ?></td>
                                <td><?= $d['edit_by'] == "" || $d['edit_by'] == NULL ? "-" : ucwords($d['edit_by']); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        </table>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

<?php include "../layout/footer.php" ?>
<script>
    $(document).on("click",".hapus",function(){
        var id=$(this).data("id");

        Swal.fire({
            title: 'Hapus Data',
            text: "Apakah anda yakin ingin menghapus data ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if(result.isConfirmed){
            $.ajax({
                url:"proses_delete.php",
                type:"POST",
                data:{
                    id:id
                },
                success:function(){
                    Swal.fire({
                        title: "Terhapus!",
                        text: "Data berhasil dihapus.",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    setTimeout(function(){
                        location.reload();
                    }, 1500);
                }
            });
            }
        });
    });
</script>