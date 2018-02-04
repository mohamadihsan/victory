<?php
// buka koneksi
require_once '../config/connection.php';

// sql statement
$sql = "SELECT id_peramalan, id_produk, DATE_FORMAT(periode, '%m-%Y') as periode, hasil_peramalan
        FROM peramalan
        ORDER BY periode DESC";
$result = mysqli_query($conn, $sql);
$data = array();
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $id_produk = $row['id_produk'];
    $periode = $row['periode'];
    $hasil_peramalan = $row['hasil_peramalan'];
    $sub_array['no']                = $no++;
    $sub_array['id_peramalan']      = $row['id_peramalan'];
    $sub_array['id_produk']         = $row['id_produk'];
    $sub_array['periode']           = $row['periode'];
    $sub_array['hasil_peramalan']   = $row['hasil_peramalan'];
	$sub_array['action_detail']	    = ' ';
	$sub_array['action_hapus']	    = ' <a href="index.php?menu=peramalan&id_produk='.$id_produk.'&periode='.$periode.'&f='.$hasil_peramalan.'&detail" class="btn btn-success btn-xs"><i class="ace-icon fa fa-file-text-o bigger-120"></i> Kebutuhan Bahan Baku</a>
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus" onclick="return hapus(\''.$row['id_peramalan'].'\')"><i class="ace-icon fa fa-trash-o bigger-120"></i> Hapus</button>';

    $data[] = $sub_array;
}

$results = array(
    "sEcho" => 1,
        "jumlahRecord" => count($data),
        "jumlahRecordDitampilkan" => count($data),
        "data"=>$data);

echo json_encode($results);
?>
