<?php
// buka koneksi
require_once '../config/connection.php';

$id_kebutuhan_produksi      = mysqli_escape_string($conn, trim($_POST['id_kebutuhan_produksi']));
if(mysqli_escape_string($conn, trim($_POST['hapus']))=='0'){
    $id_kebutuhan_produksi    = mysqli_escape_string($conn, trim($_POST['id_kebutuhan_produksi']));
    $id_produk    = mysqli_escape_string($conn, trim($_POST['id_produk']));
    $quantity_produksi       = mysqli_escape_string($conn, trim($_POST['quantity_produksi']));
    $tanggal   = mysqli_escape_string($conn, trim($_POST['tanggal']));
    $status        = mysqli_escape_string($conn, trim($_POST['status']));
}


if ($id_kebutuhan_produksi=='') {
    $id_kebutuhan_produksi = date('mdHs');

    // simpan data
    $sql = "INSERT INTO kebutuhan_produksi (id_kebutuhan_produksi, id_produk, quantity_produksi, tanggal, status)
            VALUES ('$id_kebutuhan_produksi', '$id_produk', '$quantity_produksi', '$tanggal', '$status')";
    if(mysqli_query($conn, $sql)){
        $pesan_berhasil = "Data berhasil disimpan";
    }else{
        $pesan_gagal = "Data gagal disimpan";
    }
}else if($id_kebutuhan_produksi!='' AND empty(mysqli_escape_string($conn, trim($_POST['hapus'])))){

    // perbaharui data
    $sql = "UPDATE kebutuhan_produksi
            SET id_produk='$id_produk', quantity_produksi='$quantity_produksi', tanggal='$tanggal', status='$status'
            WHERE id_kebutuhan_produksi='$id_kebutuhan_produksi'";
    if(mysqli_query($conn, $sql)){
        $pesan_berhasil = "Data berhasil diperbaharui";
    }else{
        $pesan_gagal = "Data gagal diperbaharui";
    }
}else if(mysqli_escape_string($conn, trim($_POST['hapus']))=='1'){
    // hapus data
    $sql = "DELETE FROM kebutuhan_produksi
            WHERE id_kebutuhan_produksi='$id_kebutuhan_produksi'";
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
