<?php
// buka koneksi
require_once '../config/connection.php';

$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];
$periode = $bulan.'-'.$tahun;

// sql statement
$sql = "SELECT
        	y.nama_item,
        	SUM(
        		x.peramalan_produk * y.quantity
        	) AS hasil_peramalan,
        	y.satuan
        FROM
        	(
        		SELECT
        			p.id_produk,
        			p.hasil_peramalan AS peramalan_produk
        		FROM
        			peramalan p
        		WHERE
        			DATE_FORMAT(p.periode, '%m-%Y') = '$periode'
        	) AS x
        LEFT JOIN (
        	SELECT
        		k.id_produk,
        		k.quantity,
        		k.satuan,
        		bb.nama_item
        	FROM
        		komposisi k
        	LEFT JOIN bahan_baku bb ON bb.id_bahan_baku = k.id_bahan_baku
        ) AS y ON x.id_produk = y.id_produk
        GROUP BY
        	1,
        	3";
$result = mysqli_query($conn, $sql);
$data = array();
$no = 1;
while($row = mysqli_fetch_assoc($result)){
    $sub_array['no']                = $no++;
    $sub_array['nama_item'] = $row['nama_item'];
    $sub_array['hasil_peramalan'] = $row['hasil_peramalan'];
    $sub_array['satuan']           = $row['satuan'];

    $data[] = $sub_array;

}

$results = array(
    "sEcho" => 1,
        "jumlahRecord" => count($data),
        "jumlahRecordDitampilkan" => count($data),
        "data"=>$data);

echo json_encode($results);
?>
