<?php
// buka koneksi
require_once '../config/connection.php';

function Tanggal($tanggal) {
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $tahun = substr($tanggal, 0, 4);
    $bulan = substr($tanggal, 5, 2);
    $tgl = substr($tanggal, 8, 2);

    $hasil = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun;
    return ($hasil);
}

$nomor_invoice = isset($_GET['nomor_invoice']) ? $_GET['nomor_invoice']: '';
$nomor_invoice = trim($nomor_invoice);

// sql statement
if($nomor_invoice==''){
    $sql = "SELECT d.nomor_invoice, d.status_persetujuan, d.tanggal_pengiriman, d.status_pengiriman,
                  p.nama_konsumen, p.alamat
            FROM pengiriman_produk d
            LEFT JOIN pemesanan_produk pp ON pp.nomor_invoice=d.nomor_invoice
            LEFT JOIN konsumen p ON p.id_konsumen=pp.id_konsumen
            ORDER BY d.tanggal_pengiriman DESC";
}else{
    $sql = "SELECT d.nomor_invoice, d.status_persetujuan, d.tanggal_pengiriman, d.status_pengiriman,
                  p.nama_konsumen, p.alamat
            FROM pengiriman_produk d
            LEFT JOIN pemesanan_produk pp ON pp.nomor_invoice=d.nomor_invoice
            LEFT JOIN konsumen p ON p.id_konsumen=pp.id_konsumen
            WHERE d.nomor_invoice = '$nomor_invoice'
            ORDER BY d.tanggal_pengiriman DESC";
}
$result = mysqli_query($conn, $sql);
$data = array();
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $sub_array['no']                    = $no++;
    $sub_array['nomor_invoice']          = $row['nomor_invoice'];
    $sub_array['status_persetujuan']    = $row['status_persetujuan'];
    $sub_array['tanggal_pengiriman']    = $row['tanggal_pengiriman'];
    $sub_array['status_pengiriman']     = $row['status_pengiriman'];
    $sub_array['nama_konsumen']        = $row['nama_konsumen'];
    $sub_array['alamat']                = $row['alamat'];
    $sub_array['action']	              = ' <a href="./index.php?menu=pemesanan&nomor_invoice='.$row['nomor_invoice'].'" class="btn btn-warning btn-xs"><i class="ace-icon fa fa-file-text-o bigger-120"></i> Detail</a>
                                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#kirim" onclick="return kirim(\''.$row['nomor_invoice'].'\')"><i class="ace-icon fa fa-truck bigger-120"></i> Kirim</button>';

    // ubah tampilan data
    if ($sub_array['status_persetujuan'] == 'p') {
        $sub_array['status_persetujuan'] = '<span class="label label-info label-white middle">
                                                <i class="ace-icon fa fa-exclamation-triangle bigger-120"></i>
                                                pending
                                            </span>';
    }else if ($sub_array['status_persetujuan'] == 's') {
        $sub_array['status_persetujuan'] = '<span class="label label-success label-white middle">
                                                <i class="ace-icon fa fa-check-square bigger-120"></i>
                                                disetujui
                                            </span>';
    }else if ($sub_array['status_persetujuan'] == 't') {
        $sub_array['status_persetujuan'] = '<span class="label label-danger label-white middle">
                                                <i class="ace-icon fa fa-close bigger-120"></i>
                                                ditolak
                                            </span>';
    }

    if ($sub_array['status_pengiriman'] == 0) {
        $sub_array['status_pengiriman'] = '<span class="label label-warning label-white middle">
                                                <i class="ace-icon fa fa-exclamation-triangle bigger-120"></i>
                                                belum dikirim
                                            </span>';
    }else if ($sub_array['status_pengiriman'] == 1) {
        $sub_array['status_pengiriman'] = '<span class="label label-success label-white middle">
                                                <i class="ace-icon fa fa-check-square bigger-120"></i>
                                                sudah dikirim
                                            </span>';
    }else{
        $sub_array['status_pengiriman'] = '<span class="label label-success label-white middle">
                                                <i class="ace-icon fa fa-check-square bigger-120"></i>
                                                sudah diterima
                                            </span>';
    }

    if ($sub_array['tanggal_pengiriman'] != NULL) {
        $sub_array['tanggal_pengiriman'] = Tanggal($sub_array['tanggal_pengiriman']);
    }


    $data[] = $sub_array;
}

$results = array(
    "sEcho" => 1,
        "jumlahRecord" => count($data),
        "jumlahRecordDitampilkan" => count($data),
        "data"=>$data);

echo json_encode($results);
?>
