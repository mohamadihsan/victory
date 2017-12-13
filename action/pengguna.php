<?php
// buka koneksi
require_once '../config/connection.php';

$nomor_induk_karyawan      = strtoupper(mysqli_escape_string($conn, trim($_POST['nomor'])));
if(mysqli_escape_string($conn, trim($_POST['hapus']))=='0'){
    $nomor_induk_karyawan = ucwords(mysqli_escape_string($conn, trim($_POST['nomor'])));
    $email                = strtolower(mysqli_escape_string($conn, trim($_POST['email'])));
    $bagian               = strtolower(mysqli_escape_string($conn, trim($_POST['bagian'])));
    $kata_sandi           = md5(strtolower(mysqli_escape_string($conn, trim($_POST['kata_sandi']))));
}

if ($nomor_induk_karyawan=='') {

    // simpan data
    $sql = "INSERT INTO pengguna (nomor_induk_karyawan, email, bagian, kata_sandi)
            VALUES ('$nomor_induk_karyawan', '$email', '$bagian', '$kata_sandi')";
    if(mysqli_query($conn, $sql)){
        $pesan_berhasil = "Data berhasil disimpan";
    }else{
        $pesan_gagal = "Data gagal disimpan";
    }
}else if($nomor_induk_karyawan!='' AND empty(mysqli_escape_string($conn, trim($_POST['hapus'])))){
    // perbaharui data
    $sql = "UPDATE pengguna
            SET nomor_induk_karyawan='$nomor_induk_karyawan', email='$email', bagian='$bagian', kata_sandi='$kata_sandi'
            WHERE nomor='$nomor_induk_karyawan'";
    if(mysqli_query($conn, $sql)){
        $pesan_berhasil = "Data berhasil diperbaharui";
    }else{
        $pesan_gagal = "Data gagal diperbaharui";
    }
}else if(mysqli_escape_string($conn, trim($_POST['hapus']))=='1'){
    // hapus data
    $sql = "DELETE FROM pengguna
            WHERE nomor_induk_karyawan='$nomor_induk_karyawan'";
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
