<?php
// buka koneksi
require_once '../config/connection.php';

$id_konsumen	= isset($_GET['id']) ? $_GET['id']: '';
$id_konsumen = trim($id_konsumen);

// sql statement
if($id_konsumen==''){
    $sql = "SELECT id_konsumen, nama_konsumen, alamat, no_telp, email
            FROM konsumen
            ORDER BY id_konsumen ASC";
}else{
    $sql = "SELECT id_konsumen, nama_konsumen, alamat, no_telp, email
            FROM konsumen
            WHERE id_konsumen = '$id_konsumen'";
}
$result = mysqli_query($conn, $sql);
$data = array();
$no=1;
while ($row = mysqli_fetch_assoc($result)) {
    $sub_array['no']             = $no++;
    $sub_array['id_konsumen']     = $row['id_konsumen'];
    $sub_array['nama_konsumen']   = $row['nama_konsumen'];
    $sub_array['alamat']         = $row['alamat'];
    $sub_array['no_telp']        = $row['no_telp'];
    $sub_array['email']          = $row['email'];
	$sub_array['action']	     = ' <button type="button" class="btn btn-warning btn-xs" data-toggle="collapse" data-target=".tampil" onclick="return ubah(\''.$row['id_konsumen'].'\',\''.$row['nama_konsumen'].'\',\''.$row['no_telp'].'\',\''.$row['email'].'\',\''.$row['alamat'].'\')"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i> Ubah</button>
                                     <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus" onclick="return hapus(\''.$row['id_konsumen'].'\')"><i class="ace-icon fa fa-trash-o bigger-120"></i> Hapus</button>';

    $data[] = $sub_array;
}

$results = array("data"=>$data);

echo json_encode($results);
?>
