<?php
include "../../config/koneksi.php";

$data = mysql_query("
    SELECT * 
    FROM permohonan_kredit_temp
    ORDER BY id DESC
");

$page_title = "Persetujuan Edit";

include "../layout/header.php";
include "../layout/sidebar.php";
include "../layout/navbar.php";
include "../../utils/tgl_indo.php";
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
                  <a href="#">Persetujuan Edit</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Data Edit Permohonan Kredit</h4>
                    </div>
                  </div>
                    <div class="card-body">
                        <table id="tableResponsive" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th class="text-center">Aksi</th>
                                <th>Jenis Pemohon</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>NPWP</th>
                                <th>Nama AO</th>
                                <th>Kode AO</th>
                                <th>Status Edit</th>
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
                                    <div class="btn-group btn-group-sm">
                                        <a href="approve_edit.php?id=<?= $d['id']; ?>" class="btn btn-outline-secondary">
                                            <i class="fas fa-check-circle"></i> Setujui
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-outline-danger reject" data-id="<?= $d['id_permohonan_kredit']; ?>" title="Reject">
                                            <i class="fas fa-exclamation-circle"></i> Tolak
                                        </a>
                                    </div>
                                </td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? "Perorangan" : "Badan Usaha"; ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['nama_identitas'] : $d['nama_pengurus_berwenang']; ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['nik'] : "-" ?></td>
                                <td><?= $d['jenis_pemohon'] == "perorangan" ? $d['npwp'] : $d['npwp_badan']; ?></td>
                                <td><?= ucwords($d['nama_ao']) ?></td>
                                <td><?= $d['kode_ao']; ?></td>
                                <td>
                                    <?php
                                        if ($d['flag'] == "") {
                                            echo '-';
                                        } elseif ($d['flag'] == "0") {
                                            echo '<span class="badge badge-warning">Menunggu Persetujuan</span>';
                                        } elseif ($d['flag'] == "1") {
                                            echo '<span class="badge badge-success">Disetujui</span>';
                                        } elseif ($d['flag'] == "2") {
                                            echo '<span class="badge badge-danger">Ditolak</span>';
                                        }
                                    ?>
                                </td>
                                <td><?= $d['edit_at'] == "0000-00-00 00:00:00" || $d['edit_at'] == NULL ? "-" : dateTimeIndo($d['edit_at']); ?></td>
                                <td><?= ucwords($d['edit_by']) ?></td>
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

<?php include "../layout/footer.php"; ?>
<script>
  $(document).on("click",".reject",function(){
      var id=$(this).data("id");

      Swal.fire({
          title: 'Tolak',
          text: "Apakah anda yakin ingin menolak perubahan ini?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: 'Ya, tolak',
          cancelButtonText: 'Batal'
      }).then((result) => {
          if(result.isConfirmed){
          $.ajax({
              url:"proses_reject.php",
              type:"POST",
              data:{
                  id:id
              },
              success:function(){
                  Swal.fire({
                      title: "Ditolak!",
                      text: "Data berhasil ditolak.",
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