<?php
// buka koneksi
require_once '../config/connection.php';

$id_bahan_baku      = strtoupper(mysqli_escape_string($conn, trim($_POST['id_bahan_baku'])));
if(mysqli_escape_string($conn, trim($_POST['hapus']))=='0'){
    $kode_item    = mysqli_escape_string($conn, trim($_POST['kode_item']));
    $nama_item    = mysqli_escape_string($conn, trim($_POST['nama_item']));
    $ukuran       = mysqli_escape_string($conn, trim($_POST['ukuran']));
    $tipe_warna   = mysqli_escape_string($conn, trim($_POST['tipe_warna']));
    $style        = mysqli_escape_string($conn, trim($_POST['style']));
    $value        = mysqli_escape_string($conn, trim($_POST['value']));
}

if ($id_bahan_baku=='') {
    // simpan data
    $sql = "INSERT INTO bahan_baku (kode_item, nama_item, ukuran, tipe_warna, style, value)
            VALUES ('$kode_item', '$nama_item', '$ukuran', '$tipe_warna', '$style', '$value')";
    if(mysqli_query($conn, $sql)){
        $pesan_berhasil = "Data berhasil disimpan";
    }else{
        $pesan_gagal = "Data gagal disimpan";
    }
}else if($id_bahan_baku!='' AND empty(mysqli_escape_string($conn, trim($_POST['hapus'])))){
    // perbaharui data
    $sql = "UPDATE bahan_baku
            SET kode_item='$kode_item', nama_item='$nama_item', ukuran='$ukuran', tipe_warna='$tipe_warna', style='$style', value='$value'
            WHERE id_bahan_baku='$id_bahan_baku'";
    if(mysqli_query($conn, $sql)){
        $pesan_berhasil = "Data berhasil diperbaharui";
    }else{
        $pesan_gagal = "Data gagal diperbaharui";
    }
}else if(mysqli_escape_string($conn, trim($_POST['hapus']))=='1'){
    // hapus data
    $sql = "DELETE FROM bahan_baku
            WHERE id_bahan_baku='$id_bahan_baku'";
    if(mysqli_query($conn, $sql)){
        $pesan_berhasil = "Data berhasil dihapus";
    }else{
        $pesan_gagal = "Data gagal dihapus";
    }
}

if (isset($pesan_berhasil)) {
    ?>
    <script type="text/javascript">
        $(function(){
            $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'Sukses!',
                // (string | mandatory) the text inside the notification
                text: '<?= $pesan_berhasil ?>',
                // (string | optional) the image to display on the left
                image: '../assets/images/berhasil.png',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: false,
                // (int | optional) the time you want it to be alive for before fading out
                time: ''
            });
        });
    </script>
    <?php
}else if(isset($pesan_gagal)){
    ?>
    <script type="text/javascript">
	    $(function(){
            $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'Gagal!',
                // (string | mandatory) the text inside the notification
                text: '<?= $pesan_gagal ?>',
                // (string | optional) the image to display on the left
                image: '../assets/images/gagal.png',
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: false,
                // (int | optional) the time you want it to be alive for before fading out
                time: ''
	        });
        });
	</script>
    <?php
}
?>
