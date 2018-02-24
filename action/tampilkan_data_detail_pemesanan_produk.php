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
$ketersediaan_produk_kosong = '0';

// sql statement
$sql = "SELECT
        	a.nomor_invoice,
        	a.id_konsumen,
            a.ketersediaan_produk,
        	status_pemesanan,
        	status_pembayaran,
        	tanggal_pemesanan,
        	quantity,
        	b.id_produk AS id_produk,
        	nama_produk,
        	c.harga,
        	a.id_konsumen AS id_konsumen,
        	nama_konsumen,
        	alamat,
        	no_telp,
        	email
        FROM
        	pemesanan_produk a
        LEFT JOIN detail_pemesanan_produk b ON a.nomor_invoice = b.nomor_invoice
        LEFT JOIN produk c ON c.id_produk = b.id_produk
        LEFT JOIN konsumen d ON d.id_konsumen = a.id_konsumen
        WHERE
        	a.nomor_invoice = '$nomor_invoice'
        ORDER BY
        	tanggal_pemesanan DESC";

$result = mysqli_query($conn, $sql);
$data = array();
$no = 1;
$jumlah_data = mysqli_num_rows($result);
$i=0;
while ($row = mysqli_fetch_assoc($result)) {
    $sub_array['no']                = $no++;
    $sub_array['nomor_invoice']      = $row['nomor_invoice'];
    $sub_array['id_konsumen']      = $row['id_konsumen'];
    $sub_array['status_pemesanan']  = strtoupper($row['status_pemesanan']);
    $sub_array['status_pembayaran'] = $row['status_pembayaran'];
    $sub_array['ketersediaan_produk'] = $row['ketersediaan_produk'];
    $sub_array['tanggal_pemesanan'] = $row['tanggal_pemesanan'];
    $sub_array['jumlah_pemesanan']  = $row['quantity'];
    $sub_array['id_produk']         = $row['id_produk'];
    $sub_array['nama_produk']       = $row['nama_produk'];
    $sub_array['harga_produk']      = $row['harga'];
    $sub_array['nama_konsumen']    = $row['nama_konsumen'];
    $sub_array['alamat']            = $row['alamat'];
    $sub_array['no_telp']           = $row['no_telp'];
    $sub_array['email']             = $row['email'];

    if ($row['ketersediaan_produk'] == '0') {
        $id_produk = $row['id_produk'];
        $sql_cek = "SELECT stock FROM produk WHERE id_produk='$id_produk'";
        $result_cek = mysqli_query($conn, $sql_cek);
        $row_cek = mysqli_fetch_assoc($result_cek);
        $stock = $row_cek['stock'];

        if ($stock < $row['quantity']) {
            $ketersediaan_produk_kosong = '1';
        }
    }

    if ($i == $jumlah_data-1) {
        if ($ketersediaan_produk_kosong == '1') {
            $ketersediaan_produk = '0';
        }else{
            $ketersediaan_produk = '1';
        }

        $sql_update = "UPDATE pemesanan_produk SET ketersediaan_produk='$ketersediaan_produk' WHERE nomor_invoice='$nomor_invoice'";
        mysqli_query($conn, $sql_update);
    }

    // ubah tampilan data
    if ($sub_array['status_pemesanan'] == 'SP') {
        $sub_array['status_pemesanan'] = '<span class="label label-info label-white middle">
                                                sedang diproses
                                            </span>';
    }else{
        $sub_array['status_pemesanan'] = '<span class="label label-info label-white middle">
                                                <i class="ace-icon fa fa-check-square bigger-120"></i>
                                                barang sudah diterima
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

    if ($sub_array['tanggal_pemesanan'] != NULL) {
        $sub_array['tanggal_pemesanan'] = Tanggal($sub_array['tanggal_pemesanan']);
    }


    $data[] = $sub_array;
    $i++;
}

$results = array(
    "sEcho" => 1,
        "jumlahRecord" => count($data),
        "jumlahRecordDitampilkan" => count($data),
        "data"=>$data);

echo json_encode($results);
?>
