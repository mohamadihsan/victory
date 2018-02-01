<?php
// buka koneksi
require_once '../config/connection.php';
include_once 'generate_kode.php';

$id_konsumen      = strtoupper(mysqli_escape_string($conn, trim($_POST['id_konsumen'])));
if(mysqli_escape_string($conn, trim($_POST['hapus']))=='0'){
    $nama_konsumen      = strtoupper(mysqli_escape_string($conn, trim($_POST['nama_konsumen'])));
    $alamat             = strtolower(mysqli_escape_string($conn, trim($_POST['alamat'])));
    $no_telp            = strtolower(mysqli_escape_string($conn, trim($_POST['no_telp'])));
    $email              = strtolower(mysqli_escape_string($conn, trim($_POST['email'])));
}

if ($id_konsumen=='') {
    // init kode terkahir
    $init = 'KON';

    // retrieve ID terakhir yg tersimpan
    $sql = "SELECT id_konsumen
            FROM konsumen
            ORDER BY id_konsumen DESC
            LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);
        $id_terakhir_tersimpan = $data['id_konsumen'];
    }else{
        $id_terakhir_tersimpan = $init.'000';
    }

    // panggil fungsi generate kode
    $id_konsumen = buat_kode_supplier($init, $id_terakhir_tersimpan);

    // simpan data
    $sql = "INSERT INTO konsumen (id_konsumen, nama_konsumen, alamat, no_telp, email)
            VALUES ('$id_konsumen', '$nama_konsumen', '$alamat', '$no_telp', '$email')";
    if(mysqli_query($conn, $sql)){
        $pesan_berhasil = "Data berhasil disimpan";
    }else{
        $pesan_gagal = "Data gagal disimpan";
    }
}else if($id_konsumen!='' AND empty(mysqli_escape_string($conn, trim($_POST['hapus'])))){
    // perbaharui data
    $sql = "UPDATE konsumen
            SET nama_konsumen='$nama_konsumen', alamat='$alamat', no_telp='$no_telp', email='$email'
            WHERE id_konsumen='$id_konsumen'";
    if(mysqli_query($conn, $sql)){
        $pesan_berhasil = "Data berhasil diperbaharui";
    }else{
        $pesan_gagal = "Data gagal diperbaharui";
    }
}else if(mysqli_escape_string($conn, trim($_POST['hapus']))=='1'){
    // hapus data
    $sql = "DELETE FROM konsumen
            WHERE id_konsumen='$id_konsumen'";
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
