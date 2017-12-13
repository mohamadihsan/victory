<?php
// buka koneksi
require_once '../config/connection.php';

$nomor_induk_karyawan	= isset($_GET['id']) ? $_GET['id']: '';
$nomor_induk_karyawan = trim($nomor_induk_karyawan);

// sql statement
if($nomor_induk_karyawan==''){
    $sql = "SELECT nomor_induk_karyawan, email, bagian
            FROM pengguna
            ORDER BY nomor_induk_karyawan ASC";
}else{
    $sql = "SELECT nomor_induk_karyawan, email, bagian
            FROM pengguna
            WHERE nomor_induk_karyawan = '$nomor_induk_karyawan'";
}
$result = mysqli_query($conn, $sql);
$data = array();
$no=1;
while ($row = mysqli_fetch_assoc($result)) {
    $sub_array['no']                    = $no++;
    $sub_array['nomor_induk_karyawan']  = $row['nomor_induk_karyawan'];
    $sub_array['email']                 = $row['email'];
    $sub_array['bagian']                = $row['bagian'];
	  $sub_array['action']	              = ' <button type="button" class="btn btn-warning btn-xs" data-toggle="collapse" data-target=".tampil" onclick="return ubah(\''.$row['nomor_induk_karyawan'].'\',\''.$row['email'].'\',\''.$row['bagian'].'\')"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i> Ubah</button>
                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus" onclick="return hapus(\''.$row['nomor_induk_karyawan'].'\')"><i class="ace-icon fa fa-trash-o bigger-120"></i> Hapus</button>';

    $data[] = $sub_array;
}

$results = array("data"=>$data);

echo json_encode($results);
?>
