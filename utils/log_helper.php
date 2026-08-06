<?php
function get_field_labels() {
    return array(
        'jenis_pemohon'              => 'Jenis Pemohon',
        'nama_ao'                    => 'Nama AO',
        'kode_ao'                    => 'Kode AO',
        'nama_pengurus_berwenang'    => 'Nama Pengurus Berwenang',
        'npwp_badan'                 => 'NPWP Badan',
        'nama_akta_usaha'            => 'Nama Akta Usaha',
        'bentuk_badan_usaha'         => 'Bentuk Badan Usaha',
        'bentuk_badan_usaha_lain'    => 'Bentuk Badan Usaha Lainnya',
        'bidang_usaha_badan'         => 'Bidang Usaha',
        'tempat_usaha'               => 'Tempat Usaha',
        'tanggal_pendirian'          => 'Tanggal Pendirian',
        'alamat_kantor_usaha'        => 'Alamat Kantor Usaha',
        'kode_pos_alamat_usaha'      => 'Kode Pos',
        'status_kantor_usaha'        => 'Status Kantor Usaha',
        'status_kantor_usaha_lain'   => 'Status Kantor Usaha Lainnya',
        'no_kantor_usaha'            => 'No. Telp Kantor',
        'no_fax_usaha'               => 'No. Fax',
        'hp_pic'                     => 'No. HP PIC',
        'plafond_pinjaman'           => 'Plafond Pinjaman',
        'tujuan_pinjaman'            => 'Tujuan Pinjaman',
        'tujuan_pinjaman_lain'       => 'Tujuan Pinjaman Lainnya',
        'jenis_agunan'               => 'Jenis Agunan',
        'nomor_agunan'               => 'Nomor Agunan',
        'nama_pemilik'               => 'Nama Pemilik Agunan',
        'alamat_agunan'              => 'Alamat Agunan',
        'nama_agunan'                => 'Nama Agunan',
    );
}

function format_log_data($json_string) {
    $data = json_decode($json_string, true);
    if (!is_array($data)) {
        return htmlspecialchars($json_string);
    }

    $labels = get_field_labels();
    $html = '';

    $agunan_keys = array('jenis_agunan', 'id_agunan', 'nomor_agunan', 'nama_pemilik', 'alamat_agunan', 'nama_agunan');
    $simple_fields = array();
    $agunan_fields = array();

    foreach ($data as $key => $value) {
        if (in_array($key, $agunan_keys) && is_array($value)) {
            $agunan_fields[$key] = $value;
        } elseif ($value !== '' && $value !== null) {
            $simple_fields[$key] = $value;
        }
    }

    $html .= '<ul class="list-unstyled mb-2 small">';
    foreach ($simple_fields as $key => $value) {
        $label = isset($labels[$key]) ? $labels[$key] : ucwords(str_replace('_', ' ', $key));
        $html .= '<li><span class="text-muted">' . htmlspecialchars($label) . ':</span> <strong>' . htmlspecialchars($value) . '</strong></li>';
    }
    $html .= '</ul>';

    if (!empty($agunan_fields['jenis_agunan'])) {
        $jumlah = count($agunan_fields['jenis_agunan']);
        $html .= '<table class="table table-sm table-bordered small mb-0">';
        $html .= '<thead><tr><th>Jenis</th><th>Nomor</th><th>Pemilik</th><th>Alamat</th></tr></thead><tbody>';
        for ($i = 0; $i < $jumlah; $i++) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars(isset($agunan_fields['jenis_agunan'][$i]) ? strtoupper($agunan_fields['jenis_agunan'][$i]) : '-') . '</td>';
            $html .= '<td>' . htmlspecialchars(isset($agunan_fields['nomor_agunan'][$i]) ? $agunan_fields['nomor_agunan'][$i] : '-') . '</td>';
            $html .= '<td>' . htmlspecialchars(isset($agunan_fields['nama_pemilik'][$i]) ? $agunan_fields['nama_pemilik'][$i] : '-') . '</td>';
            $html .= '<td>' . htmlspecialchars(isset($agunan_fields['alamat_agunan'][$i]) && $agunan_fields['alamat_agunan'][$i] !== '' ? $agunan_fields['alamat_agunan'][$i] : '-') . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';
    }

    return $html;
}