<?php
// buka koneksi
require_once '../config/connection.php';

// sql statement
$sql = "SELECT
        	pbb.id_bahan_baku,
        	bb.nama_item,
        	pbb.nomor_po,
        	pbb.stok_awal,
        	pbb.quantity_order,
        	pbb.outgoing_produksi,
        	pbb.balance_stok_akhir,
        	pbb.tanggal,
        	s.nama_supplier
        FROM
        	persediaan_bahan_baku pbb
        LEFT JOIN supplier s ON s.id_supplier = pbb.id_supplier
        LEFT JOIN bahan_baku bb ON bb.id_bahan_baku = pbb.id_bahan_baku
        ORDER BY
        	pbb.tanggal DESC";

$result = mysqli_query($conn, $sql);
$data = array();
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $sub_array['no']                    = $no++;
    $sub_array['id_bahan_baku']         = $row['id_bahan_baku'];
    $sub_array['nomor_po']              = $row['nomor_po'];
    $sub_array['nama_item']             = $row['nama_item'];
    $sub_array['stok_awal']             = $row['stok_awal'];
    $sub_array['quantity_order']        = $row['quantity_order'];
    $sub_array['outgoing_produksi']     = $row['outgoing_produksi'];
    $sub_array['balance_stok_akhir']    = $row['balance_stok_akhir'];
    $sub_array['tanggal']               = date('d-m-Y', strtotime($row['tanggal']));
    $sub_array['nama_supplier']         = $row['nama_supplier'];
	$sub_array['action']	            = ' <a href="" class="btn btn-warning btn-xs" title="Detail"><i class="ace-icon fa fa-file-text-o bigger-120"></i> </a>
                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus" title="Hapus" onclick="return hapus(\''.$row['id_bahan_baku'].'\', \''.$row['nomor_po'].'\')"><i class="ace-icon fa fa-trash-o bigger-120"></i> </button>';
    $sub_array['action_diterima']       = ' <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#terima" title="Terima" onclick="return terima(\''.$row['id_bahan_baku'].'\', \''.$row['nomor_po'].'\')"><i class="ace-icon fa fa-check-square bigger-120"></i> </button>';

    $data[] = $sub_array;
}

$results = array(
    "sEcho" => 1,
        "jumlahRecord" => count($data),
        "jumlahRecordDitampilkan" => count($data),
        "data"=>$data);

echo json_encode($results);
?>
