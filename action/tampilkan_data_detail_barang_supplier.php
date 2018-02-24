<?php
// buka koneksi
require_once '../config/connection.php';

$id_bahan_baku = isset($_GET['id']) ? $_GET['id']: '';
$id_bahan_baku = trim($id_bahan_baku);

// sql statement
$sql = "SELECT sp.id_supplier, s.nama_supplier, sp.harga_jual, sp.stok, s.waktu_pengiriman
    FROM detail_supplier sp
    LEFT JOIN supplier s ON s.id_supplier = sp.id_supplier
    WHERE sp.id_bahan_baku = '$id_bahan_baku'
    ORDER BY sp.stok DESC, sp.harga_jual, s.waktu_pengiriman ASC";

$result = mysqli_query($conn, $sql);
$data = array();
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $sub_array['no']                = $no++;
    $sub_array['id_supplier']       = $row['id_supplier'];
    $sub_array['nama_supplier']     = $row['nama_supplier'];
    $sub_array['harga_jual']        = $row['harga_jual'];
    $sub_array['stok']              = $row['stok'];
    $sub_array['waktu_pengiriman']  = $row['waktu_pengiriman'];

    $data[] = $sub_array;
}

$results = array(
    "sEcho" => 1,
        "jumlahRecord" => count($data),
        "jumlahRecordDitampilkan" => count($data),
        "data"=>$data);

echo json_encode($results);
?>
