<?php
// buka koneksi
require_once '../config/connection.php';

// sql statement
$sql = "SELECT id_bahan_baku, kode_item, nama_item, ukuran, tipe_warna, style, value
        FROM bahan_baku
        ORDER BY id_bahan_baku ASC";
$result = mysqli_query($conn, $sql);
$data = array();
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $sub_array['no']                = $no++;
    $sub_array['id_bahan_baku']     = $row['id_bahan_baku'];
    $sub_array['kode_item']         = $row['kode_item'];
    $sub_array['nama_item']         = $row['nama_item'];
    $sub_array['ukuran']            = $row['ukuran'];
    $sub_array['tipe_warna']        = $row['tipe_warna'];
    $sub_array['style']             = $row['style'];
    $sub_array['value']             = $row['value'];
	  $sub_array['action']		        = ' <button type="button" class="btn btn-warning btn-xs" data-toggle="collapse" data-target=".tampil" onclick="return ubah(\''.$row['id_bahan_baku'].'\',\''.$row['kode_item'].'\',\''.$row['nama_item'].'\',\''.$row['ukuran'].'\',\''.$row['tipe_warna'].'\',\''.$row['style'].'\',\''.$row['value'].'\')"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i> </button>
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus" onclick="return hapus(\''.$row['id_bahan_baku'].'\')"><i class="ace-icon fa fa-trash-o bigger-120"></i> </button>';

    $data[] = $sub_array;
}

$results = array(
    "sEcho" => 1,
        "jumlahRecord" => count($data),
        "jumlahRecordDitampilkan" => count($data),
        "data"=>$data);

echo json_encode($results);
?>
