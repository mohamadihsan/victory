<?php
// buka koneksi
require_once '../config/connection.php';

$id_supplier = isset($_GET['id']) ? $_GET['id']: '';
$id_supplier = trim($id_supplier);

// sql statement
if ($id_supplier=='') {
    $sql = "SELECT sp.id_supplier, sp.id_bahan_baku, b.nama_item, b.ukuran, sp.harga_jual, sp.stok
        FROM detail_supplier sp
        LEFT JOIN bahan_baku b ON b.id_bahan_baku = sp.id_bahan_baku
        ORDER BY sp.id_bahan_baku ASC";
}else{
    $sql = "SELECT sp.id_supplier, sp.id_bahan_baku, b.nama_item, b.ukuran, sp.harga_jual, sp.stok
        FROM detail_supplier sp
        LEFT JOIN bahan_baku b ON b.id_bahan_baku = sp.id_bahan_baku
        WHERE sp.id_supplier = '$id_supplier'
        ORDER BY sp.id_bahan_baku ASC";
}

$result = mysqli_query($conn, $sql);
$data = array();
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $sub_array['no']                = $no++;
    $sub_array['id_supplier']       = $row['id_supplier'];
    $sub_array['id_bahan_baku']     = $row['id_bahan_baku'];
    $sub_array['nama_item']         = $row['nama_item'];
    $sub_array['ukuran']            = $row['ukuran'];
    $sub_array['harga_jual']        = $row['harga_jual'];
    $sub_array['stok']              = $row['stok'];
	$sub_array['action']		    = ' <button type="button" class="btn btn-warning btn-xs" data-toggle="collapse" data-target=".tampil" onclick="return ubah(\''.$row['id_bahan_baku'].'\',\''.$row['harga_jual'].'\',\''.$row['stok'].'\')"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i> Ubah</button>
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus" onclick="return hapus(\''.$row['id_bahan_baku'].'\')"><i class="ace-icon fa fa-trash-o bigger-120"></i> Hapus</button>';

    $data[] = $sub_array;
}

$results = array(
    "sEcho" => 1,
        "jumlahRecord" => count($data),
        "jumlahRecordDitampilkan" => count($data),
        "data"=>$data);

echo json_encode($results);
?>
