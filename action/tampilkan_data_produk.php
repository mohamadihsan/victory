<?php
// buka koneksi
require_once '../config/connection.php';

function Rupiah($rupiah) {
    //format rupiah
    $jumlah_desimal = "0";
    $pemisah_desimal = ",";
    $pemisah_ribuan = ".";

    $hasil = number_format($rupiah, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
    return 'Rp.'.($hasil);
}

// sql statement
$sql = "SELECT id_produk, nama_produk, style, deskripsi, warna, harga, gambar_produk
        FROM produk
        ORDER BY id_produk ASC";
$result = mysqli_query($conn, $sql);
$data = array();
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $sub_array['no']            = $no++;
    $sub_array['id_produk']     = $row['id_produk'];
    $sub_array['nama_produk']   = $row['nama_produk'];
    $sub_array['style']         = $row['style'];
    $sub_array['deskripsi']     = $row['deskripsi'];
    $sub_array['warna']         = $row['warna'];
    $sub_array['harga']         = Rupiah($row['harga']);
    $sub_array['gambar_produk'] = '<img src="../assets/images/'.$row['gambar_produk'].'" alt="produk" class="img-responsive" width="80px" height="80px" >';
    $sub_array['nama_file_gambar'] = $row['gambar_produk'];
	$sub_array['action']        = ' <a href="index.php?menu=komposisi&id='.$row['id_produk'].'" class="btn btn-default btn-xs" title="Komposisi"><i class="fa fa-file-text-o"></i></a> 
                                    <button type="button" class="btn btn-warning btn-xs" data-toggle="collapse" data-target=".tampil" title="Ubah" onclick="return ubah(\''.$row['id_produk'].'\',\''.$row['nama_produk'].'\',\''.$row['style'].'\',\''.$row['deskripsi'].'\',\''.$row['warna'].'\',\''.$row['harga'].'\')"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i> </button>
                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus" title="Hapus" onclick="return hapus(\''.$row['id_produk'].'\')"><i class="ace-icon fa fa-trash-o bigger-120"></i> </button>';
    $sub_array['komposisi']	    = ' <a class="btn btn-warning btn-xs" href="./index.php?id='.$row['id_produk'].'&menu=detail_komposisi"  title="Komposisi"><i class="ace-icon fa fa-file-text-o bigger-120"></i> </a>
                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus" title="Hapus" onclick="return hapus(\''.$row['id_produk'].'\')"><i class="ace-icon fa fa-trash-o bigger-120"></i> </button>';

    $data[] = $sub_array;
}

$results = array(
    "sEcho" => 1,
        "jumlahRecord" => count($data),
        "jumlahRecordDitampilkan" => count($data),
        "data"=>$data);

echo json_encode($results);
?>
