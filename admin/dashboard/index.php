<?php
include "../../config/koneksi.php";
$page_title = "Dashboard";
include "../layout/header.php";
include "../layout/sidebar.php";
include "../layout/navbar.php";
include "../../utils/tgl_indo.php";
include "../../utils/log_helper.php";

$limit = 10;
$result = mysql_query("
    SELECT menu, referensi, aktifitas, data_awal, data_diperbaharui, created_by, created_at
    FROM logs
    ORDER BY created_at DESC
    LIMIT " . (int) $limit . "
");

$result_stats = mysql_query("
    SELECT
        COUNT(*) AS total,
        SUM(CASE WHEN flag = '0' THEN 1 ELSE 0 END) AS menunggu,
        SUM(CASE WHEN flag = '1' THEN 1 ELSE 0 END) AS disetujui,
        SUM(CASE WHEN flag = '2' THEN 1 ELSE 0 END) AS ditolak
    FROM permohonan_kredit
");
$stats = mysql_fetch_assoc($result_stats);

$total_permohonan   = isset($stats['total'])     ? $stats['total']     : 0;
$menunggu_otorisasi = isset($stats['menunggu'])  ? $stats['menunggu']  : 0;
$disetujui          = isset($stats['disetujui']) ? $stats['disetujui'] : 0;
$ditolak            = isset($stats['ditolak'])   ? $stats['ditolak']   : 0;

?>
<style>
.timeline-with-icons {
  border-left: 1px solid hsl(0, 0%, 90%);
  position: relative;
  list-style: none;
}

.timeline-with-icons .timeline-item {
  position: relative;
}

.timeline-with-icons .timeline-item:after {
  position: absolute;
  display: block;
  top: 0;
}

.timeline-with-icons .timeline-icon {
  position: absolute;
  left: -44px;
  top: -3px;
  background-color: hsl(217, 88.2%, 90%);
  color: hsl(217, 88.8%, 35.1%);
  border-radius: 50%;
  height: 31px;
  width: 31px;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>

        <div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7 mb-2">Selamat datang, <?php echo ucwords($_SESSION['username']); ?></h6>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-primary bubble-shadow-small"
                        >
                          <i class="fas fa-hand-holding-usd"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Total Permohonan Kredit</p>
                          <h4 class="card-title"><?= number_format($total_permohonan, 0, ',', '.'); ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-warning bubble-shadow-small"
                        >
                          <i class="fas fa-hourglass"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Menunggu Otorisasi Edit</p>
                          <h4 class="card-title"><?= number_format($menunggu_otorisasi, 0, ',', '.'); ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-success bubble-shadow-small"
                        >
                          <i class="fas fa-check"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Disetujui</p>
                          <h4 class="card-title"><?= number_format($disetujui, 0, ',', '.'); ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-danger bubble-shadow-small"
                        >
                          <i class="fas fa-exclamation-circle"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Ditolak</p>
                          <h4 class="card-title"><?= number_format($ditolak, 0, ',', '.'); ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <section class="py-5">
              <ul class="timeline-with-icons">
                <?php while ($row = mysql_fetch_assoc($result)): ?>
                    <?php
                    $tipe = strtolower($row['aktifitas']);
                    if (strpos($tipe, 'approve') !== false) {
                        $icon  = 'fa-check';
                        $pelaku = 'Disetujui oleh';
                    } elseif (strpos($tipe, 'update') !== false) {
                        $icon  = 'fa-pen';
                        $pelaku = 'Diperbarui oleh';
                    } elseif (strpos($tipe, 'reject') !== false) {
                        $icon  = 'fa-exclamation-circle';
                        $pelaku = 'Ditolak oleh';
                    } elseif (strpos($tipe, 'delete') !== false) {
                        $icon  = 'fa-trash';
                        $pelaku = 'Dihapus oleh';
                    } else {
                        $icon  = 'fa-plus';
                        $pelaku = 'Dibuat oleh';
                    }
                    ?>
                    <li class="timeline-item mb-5">
                        <span class="timeline-icon">
                            <i class="fas <?= $icon; ?> fa-sm fa-fw"></i>
                        </span>

                        <h5 class="fw-bold"><?= htmlspecialchars($row['aktifitas']); ?> - <?= htmlspecialchars($row['menu']); ?></h5>
                        <p class="text-muted mb-2 fw-bold"><?= dateTimeIndo($row['created_at']); ?></p>
                        <p class="text-muted mb-2">
                            <?= $pelaku; ?> <strong><?= ucwords($row['created_by']); ?></strong>
                            &middot; Ref #<?= htmlspecialchars($row['referensi']); ?>
                        </p>

                        <?php if (!empty($row['data_diperbaharui'])): ?>
                          <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                  Lihat Data
                                </button>
                              </h2>
                              <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                  <?= format_log_data($row['data_diperbaharui']); ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php elseif (!empty($row['data_awal'])): ?>
                          <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                  Lihat Data
                                </button>
                              </h2>
                              <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                  <?= format_log_data($row['data_awal']); ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php endif; ?>
                    </li>
                <?php endwhile; ?>
              </ul>
            </section>
          </div>
        </div>

<?php include "../layout/footer.php"; ?>