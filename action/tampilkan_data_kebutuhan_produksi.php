<?php
// buka koneksi
require_once '../config/connection.php';

// sql statement
$sql = "SELECT id_kebutuhan_produksi, p.id_produk, p.style, nama_produk, tanggal, quantity_produksi, tanggal, status
            FROM kebutuhan_produksi kp
        LEFT JOIN produk p ON p.id_produk = kp.id_produk
        ORDER BY 1 DESC";
$result = mysqli_query($conn, $sql);
$data = array();
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $sub_array['no']                = $no++;
    $sub_array['id_kebutuhan_produksi']     = $row['id_kebutuhan_produksi'];
    $sub_array['id_produk']         = $row['id_produk'];
    $sub_array['nama_produk']         = $row['nama_produk'];
    $sub_array['style']         = $row['style'];
    $sub_array['tanggal']            = $row['tanggal'];
    $sub_array['quantity_produksi']        = $row['quantity_produksi'];
    $sub_array['tanggal']             = date('Y-m-d', strtotime($row['tanggal']));
    $sub_array['status']             = $row['status'];
	  $sub_array['action']		        = ' <button type="button" class="btn btn-warning btn-xs" data-toggle="collapse" data-target=".tampil" onclick="return ubah(\''.$row['id_kebutuhan_produksi'].'\',\''.$row['id_produk'].'\',\''.date('Y-m-d', strtotime($row['tanggal'])).'\',\''.$row['quantity_produksi'].'\',\''.$row['status'].'\')"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i> </button>
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus" onclick="return hapus(\''.$row['id_kebutuhan_produksi'].'\')"><i class="ace-icon fa fa-trash-o bigger-120"></i> </button>';

    $data[] = $sub_array;
}

$results = array(
    "sEcho" => 1,
        "jumlahRecord" => count($data),
        "jumlahRecordDitampilkan" => count($data),
        "data"=>$data);

echo json_encode($results);
?>
