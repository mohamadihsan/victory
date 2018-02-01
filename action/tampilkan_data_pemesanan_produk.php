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

$id_konsumen = isset($_GET['id']) ? $_GET['id']: '';
$id_konsumen = trim($id_konsumen);
$status       = isset($_GET['s']) ? $_GET['s']: '';

// sql statement
if($id_konsumen==''){
    $sql = "SELECT nomor_invoice, id_konsumen, status_pemesanan, ketersediaan_produk, total_pembayaran, bukti_pembayaran, status_pembayaran
            FROM pemesanan_produk
            ORDER BY nomor_invoice DESC";
}else{
    $sql = "SELECT nomor_invoice, id_konsumen, status_pemesanan, ketersediaan_produk, total_pembayaran, bukti_pembayaran, status_pembayaran
    FROM pemesanan_produk
    WHERE id_konsumen = '$id_konsumen'
    ORDER BY nomor_invoice DESC";

    if ($status=='false') {
        $sql = "SELECT  nomor_invoice, id_konsumen, status_pemesanan, ketersediaan_produk, total_pembayaran, bukti_pembayaran, status_pembayaran
        FROM pemesanan_produk
        WHERE id_konsumen = '$id_konsumen' AND tanggal_pembayaran IS NULL AND bukti_pembayaran IS NULL
        ORDER BY tanggal_pemesanan DESC";
    }
}
$result = mysqli_query($conn, $sql);
$data = array();
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $sub_array['no']                  = $no++;
    $sub_array['nomor_invoice']       = $row['nomor_invoice'];
    $sub_array['id_konsumen']         = $row['id_konsumen'];
    $sub_array['status_pemesanan']    = $row['status_pemesanan'];
    $sub_array['ketersediaan_produk'] = $row['ketersediaan_produk'];
    $sub_array['total_pembayaran']    = $row['total_pembayaran'];
    $sub_array['bukti_pembayaran']    = $row['bukti_pembayaran'];
    $sub_array['status_pembayaran']   = $row['status_pembayaran'];
	  $sub_array['action']	            = '  <a href="./index.php?menu=pemesanan&invoice='.$row['nomor_invoice'].'" class="btn btn-warning btn-xs"><i class="ace-icon fa fa-file-text-o bigger-120"></i> Detail</a>';
    $sub_array['invoice']	            = ' <a href="./index.php?id='.$row['nomor_invoice'].'&menu=invoice" type="button" class="btn btn-warning btn-xs" title="Detail"><i class="ace-icon fa fa-file-text-o bigger-120"></i> </a>';

    // ubah tampilan data
    if ($sub_array['status_pemesanan'] == 'p') {
        $sub_array['status_pemesanan'] = '<span class="label label-info label-white middle">
                                                <i class="ace-icon fa fa-exclamation-triangle bigger-120"></i>
                                                pending
                                            </span>';
    }else if ($sub_array['status_pemesanan'] == 's') {
        $sub_array['status_pemesanan'] = '<span class="label label-success label-white middle">
                                                <i class="ace-icon fa fa-check-square bigger-120"></i>
                                                diterima
                                            </span>';
    }else if ($sub_array['status_pemesanan'] == 't') {
        $sub_array['status_pemesanan'] = '<span class="label label-danger label-white middle">
                                                <i class="ace-icon fa fa-close bigger-120"></i>
                                                ditolak
                                            </span>';
    }

    if ($sub_array['ketersediaan_produk'] == '0') {
        $sub_array['ketersediaan_produk'] = '<span class="label label-info label-white middle">
                                                kurang/tidak tersedia
                                            </span>';
    }else{
        $sub_array['ketersediaan_produk'] = '<span class="label label-info label-white middle">
                                                <i class="ace-icon fa fa-check-square bigger-120"></i>
                                                tersedia
                                            </span>';
    }

    if ($sub_array['status_pembayaran'] == 0) {
        $sub_array['status_pembayaran'] = '<span class="label label-warning label-white middle">
                                                <i class="ace-icon fa fa-exclamation-triangle bigger-120"></i>
                                                belum dibayar
                                            </span>';
    }else{
        $sub_array['status_pembayaran'] = '<span class="label label-success label-white middle">
                                                <i class="ace-icon fa fa-check-square bigger-120"></i>
                                                sudah dibayar
                                            </span>';
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
