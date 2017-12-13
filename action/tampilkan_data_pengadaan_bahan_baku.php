<?php
// buka koneksi
require_once '../config/connection.php';

$id_supplier = isset($_GET['id']) ? $_GET['id']: '';
$id_supplier = trim($id_supplier);

// sql statement
if($id_supplier==''){
    $sql = "SELECT id_pengadaan_bahan_baku, nomor_induk_karyawan, tanggal_pengajuan, status_pengajuan, status_pemesanan, status_pengadaan, id_supplier
            FROM pengadaan_bahan_baku
            ORDER BY tanggal_pengajuan DESC";
}else{
    $sql = "SELECT id_pengadaan_bahan_baku, nomor_induk_karyawan, tanggal_pengajuan, status_pengajuan, status_pemesanan, status_pengadaan, id_supplier
            FROM pengadaan_bahan_baku
            WHERE id_supplier = '$id_supplier'
            ORDER BY tanggal_pengajuan DESC";
}

$result = mysqli_query($conn, $sql);
$data = array();
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $sub_array['no']                        = $no++;
    $sub_array['id_pengadaan_bahan_baku']   = $row['id_pengadaan_bahan_baku'];
    $sub_array['nomor_induk_karyawan']      = $row['nomor_induk_karyawan'];
    $sub_array['tanggal_pengajuan']         = $row['tanggal_pengajuan'];
    $sub_array['status_pengajuan']          = $row['status_pengajuan'];
    $sub_array['status_pemesanan']          = $row['status_pemesanan'];
    $sub_array['status_pengadaan']          = $row['status_pengadaan'];
    $sub_array['id_supplier']               = $row['id_supplier'];
	   $sub_array['action']	                  = ' <button type="button" class="btn btn-warning btn-xs" data-toggle="collapse" data-target=".tampil_detail" title="Detail" onclick="return detail(\''.$row['id_pengadaan_bahan_baku'].'\')"><i class="ace-icon fa fa-file-text-o bigger-120"></i> </button>
                                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus" title="Hapus" onclick="return hapus(\''.$row['id_pengadaan_bahan_baku'].'\')"><i class="ace-icon fa fa-trash-o bigger-120"></i> </button>';
    $sub_array['action_diterima']           = ' <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#terima" title="Terima" onclick="return terima(\''.$row['id_pengadaan_bahan_baku'].'\')"><i class="ace-icon fa fa-check-square bigger-120"></i> </button>';

    // ubah tampilan data
    if ($sub_array['status_pengajuan'] == 'p') {
        $sub_array['status_pengajuan'] = '<span class="label label-info label-white middle">
                                                <i class="ace-icon fa fa-exclamation-triangle bigger-120"></i>
                                                pending
                                            </span>';
    }else if ($sub_array['status_pengajuan'] == 's') {
        $sub_array['status_pengajuan'] = '<span class="label label-success label-white middle">
                                                <i class="ace-icon fa fa-check-square bigger-120"></i>
                                                disetujui
                                            </span>';
    }else if ($sub_array['status_pengajuan'] == 't') {
        $sub_array['status_pengajuan'] = '<span class="label label-danger label-white middle">
                                                <i class="ace-icon fa fa-close bigger-120"></i>
                                                ditolak
                                            </span>';
    }

    if ($sub_array['status_pemesanan'] == '0') {
        $sub_array['status_pemesanan'] = '<span class="label label-info label-white middle">
                                                belum diterima supplier
                                            </span>';
    }else{
        $sub_array['status_pemesanan'] = '<span class="label label-info label-white middle">
                                                <i class="ace-icon fa fa-check-square bigger-120"></i>
                                                sudah diterima supplier
                                            </span>';
    }

    if ($sub_array['status_pemesanan'] == '0') {
        $sub_array['status_pemesanan'] = '<span class="label label-danger label-white middle">
                                                gagal
                                            </span>';
    }else{
        $sub_array['status_pemesanan'] = '<span class="label label-success label-white middle">
                                                <i class="ace-icon fa fa-check-square bigger-120"></i>
                                                sukses
                                            </span>';
    }

    $data[] = $sub_array;
}

$results = array(
    "sEcho" => 1,
        "jumlahRecord" => count($data),
        "jumlahRecordDitampilkan" => count($data),
        "data"=>$data);

echo json_encode($results);
?>
