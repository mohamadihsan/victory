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
// sql statement

$sql = "SELECT
        	*
        FROM
        	(
        		SELECT
        			COUNT(pp.status_pengiriman) AS total_pengiriman
        		FROM
        			pengiriman_produk pp
        	) AS w
        JOIN (
        	SELECT
        		COUNT(pp.status_pengiriman) AS sudah_dikirim
        	FROM
        		pengiriman_produk pp
        	WHERE
        		pp.status_pengiriman = '1'
        ) AS x
        JOIN (
        	SELECT
        		COUNT(pp.status_pengiriman) AS sudah_diterima
        	FROM
        		pengiriman_produk pp
        	WHERE
        		pp.status_pengiriman = '2'
        ) AS y
        JOIN (
        	SELECT
        		COUNT(pp.nomor_invoice) AS belum_dikirim
        	FROM
        		pengiriman_produk pp
        	WHERE
        		pp.status_pengiriman = '0'
        ) AS z";

$result = mysqli_query($conn, $sql);
$data = array();
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $sub_array['no']                    = $no++;
    $sub_array['total_pengiriman']          = $row['total_pengiriman'];
    $sub_array['belum_dikirim']          = $row['belum_dikirim'];
    $sub_array['sudah_dikirim']    = $row['sudah_dikirim'];
    $sub_array['sudah_diterima']    = $row['sudah_diterima'];

    $data[] = $sub_array;
}

$results = array(
    "sEcho" => 1,
        "jumlahRecord" => count($data),
        "jumlahRecordDitampilkan" => count($data),
        "data"=>$data);

echo json_encode($results);
?>
