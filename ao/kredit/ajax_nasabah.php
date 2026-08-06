<?php
require '../../config/koneksi.php';

$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : '';
$keyword = isset($_GET['q']) ? trim($_GET['q']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) $page = 1;

$limit = 4; // tampilkan 20 data saja
$offset = ($page - 1) * $limit;

$keyword = mysql_real_escape_string($keyword);

if ($jenis == 'perorangan') {

    $where = "";

    if ($keyword != '') {
        $where = "WHERE nama LIKE '%$keyword%'
                  OR nik LIKE '%$keyword%'
                  OR npwp LIKE '%$keyword%'";
    }

    $sql = mysql_query("
        SELECT
            nik, npwp, nama, tempat_lahir, tanggal_lahir,
            alamat, no_hp, jenis_kelamin
        FROM nasabah
        $where
        ORDER BY nama ASC
        LIMIT $offset, $limit
    ");

} else {

    $where = "";

    if ($keyword != '') {
        $where = "WHERE nama_usaha LIKE '%$keyword%'
                  OR npwp LIKE '%$keyword%'";
    }

    $sql = mysql_query("
        SELECT
            nama, npwp, nama_usaha,
            bidang_usaha, alamat_kantor, hp_pic
        FROM nasabah
        $where
        ORDER BY nama_usaha ASC
        LIMIT $offset, $limit
    ");
}

if ($jenis == 'perorangan') {

    $no = $offset + 1;

    while ($r = mysql_fetch_assoc($sql)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $r['nik']; ?></td>
            <td><?php echo $r['nama']; ?></td>
            <td><?php echo $r['alamat']; ?></td>
            <td>
                <button type="button"
                        class="btn btn-primary btn-sm pilih-nasabah"
                        data-nik="<?php echo $r['nik']; ?>"
                        data-npwp="<?php echo $r['npwp']; ?>"
                        data-nama="<?php echo htmlspecialchars($r['nama']); ?>"
                        data-tempat="<?php echo htmlspecialchars($r['tempat_lahir']); ?>"
                        data-tanggal_lahir="<?php echo $r['tanggal_lahir']; ?>"
                        data-alamat="<?php echo htmlspecialchars($r['alamat']); ?>"
                        data-hp="<?php echo $r['no_hp']; ?>"
                        data-jenis_kelamin="<?php echo $r['jenis_kelamin']; ?>">
                    Pilih
                </button>
            </td>
        </tr>
        <?php
    }

} elseif ($jenis == 'badan_usaha') {

    $no = $offset + 1;

    while ($r = mysql_fetch_assoc($sql)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $r['npwp']; ?></td>
            <td><?php echo $r['nama_usaha']; ?></td>
            <td><?php echo $r['alamat_kantor']; ?></td>
            <td>
                <button type="button"
                class="btn btn-primary btn-sm pilih-nasabah"
                data-pengurus="<?php echo htmlspecialchars($r['nama']); ?>"
                data-npwp="<?php echo $r['npwp']; ?>"
                data-nama_usaha="<?php echo htmlspecialchars($r['nama_usaha']); ?>"
                data-bidang_usaha="<?php echo htmlspecialchars($r['bidang_usaha']); ?>"
                data-alamat="<?php echo htmlspecialchars($r['alamat_kantor']); ?>"
                data-hp="<?php echo $r['hp_pic']; ?>">
                    Pilih
                </button>
            </td>
        </tr>
        <?php
    }
}
?>