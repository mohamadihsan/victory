<?php
// buka koneksi
require_once '../config/connection.php';

$id_bahan_baku      = strtoupper(mysqli_escape_string($conn, trim($_POST['id_bahan_baku'])));
$nomor_po    = mysqli_escape_string($conn, trim($_POST['nomor_po']));
if(mysqli_escape_string($conn, trim($_POST['hapus']))=='0'){
    $id_supplier    = mysqli_escape_string($conn, trim($_POST['id_supplier']));
    $stok_awal       = mysqli_escape_string($conn, trim($_POST['stok_awal']));
    $quantity_order   = mysqli_escape_string($conn, trim($_POST['quantity_order']));
    $outgoing_produksi        = mysqli_escape_string($conn, trim($_POST['outgoing_produksi']));
    $tanggal        = mysqli_escape_string($conn, trim($_POST['tanggal']));
    $balance_stok_akhir = $stok_awal + $quantity_order - $outgoing_produksi;
}

if ($id_bahan_baku!='' AND mysqli_escape_string($conn, trim($_POST['hapus']))=='0') {
    // simpan data
    $sql = "INSERT INTO persediaan_bahan_baku (id_bahan_baku, nomor_po, id_supplier, stok_awal, quantity_order, outgoing_produksi, balance_stok_akhir, tanggal)
            VALUES ('$id_bahan_baku', '$nomor_po', '$id_supplier', '$stok_awal', '$quantity_order', '$outgoing_produksi', '$balance_stok_akhir', '$tanggal')";
    if(mysqli_query($conn, $sql)){
        $pesan_berhasil = "Data berhasil disimpan";
    }else{
        $pesan_gagal = "Data gagal disimpan";
    }
}else if($id_bahan_baku!='' AND empty(mysqli_escape_string($conn, trim($_POST['hapus'])))){
    // perbaharui data
    $sql = "UPDATE persediaan_bahan_baku
            SET id_supplier='$id_supplier', stok_awal='$stok_awal', quantity_order='$quantity_order', outgoing_produksi='$outgoing_produksi', balance_stok_akhir='$balance_stok_akhir', tanggal='$tanggal'
            WHERE id_bahan_baku='$id_bahan_baku', nomor_po='$nomor_po'";
    if(mysqli_query($conn, $sql)){
        $pesan_berhasil = "Data berhasil diperbaharui";
    }else{
        $pesan_gagal = "Data gagal diperbaharui";
    }
}else if(mysqli_escape_string($conn, trim($_POST['hapus']))=='1'){
    // hapus data
    $sql = "DELETE FROM persediaan_bahan_baku
            WHERE id_bahan_baku='$id_bahan_baku' AND nomor_po='$nomor_po'";
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
