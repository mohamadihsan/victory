<?php
// buka koneksi
require_once '../config/connection.php';

$nomor_induk_karyawan      = mysqli_escape_string($conn, trim($_POST['nomor_induk_karyawan']));
$hapus                    = mysqli_escape_string($conn, trim($_POST['hapus']));
if($hapus=='0'){
    $nip_lama             = mysqli_escape_string($conn, trim($_POST['nip_lama']));
    $nomor_induk_karyawan = mysqli_escape_string($conn, trim($_POST['nomor_induk_karyawan']));
    $email                = mysqli_escape_string($conn, trim($_POST['email']));
    $bagian               = strtolower(mysqli_escape_string($conn, trim($_POST['bagian'])));
    $kata_sandi           = md5(strtolower(mysqli_escape_string($conn, trim($_POST['kata_sandi']))));
}

if($hapus=='1'){
    // hapus data
    $sql = "DELETE FROM pengguna
            WHERE nomor_induk_karyawan='$nomor_induk_karyawan'";
    if(mysqli_query($conn, $sql)){
        $pesan_berhasil = "Data berhasil dihapus";
    }else{
        $pesan_gagal = "Data gagal dihapus";
    }
}else if ($nip_lama == '') {

    // simpan data
    $sql = "INSERT INTO pengguna (nomor_induk_karyawan, email, bagian, kata_sandi)
            VALUES ('$nomor_induk_karyawan', '$email', '$bagian', '$kata_sandi')";
    if(mysqli_query($conn, $sql)){
        $pesan_berhasil = "Data berhasil disimpan";
    }else{
        $pesan_gagal = "Data gagal disimpan";
    }
}else if($nip_lama != ''){
    // perbaharui data
    $sql = "UPDATE pengguna
            SET nomor_induk_karyawan='$nomor_induk_karyawan', email='$email', bagian='$bagian', kata_sandi='$kata_sandi'
            WHERE nomor_induk_karyawan='$nip_lama'";
    if(mysqli_query($conn, $sql)){
        $pesan_berhasil = "Data berhasil diperbaharui";
    }else{
        $pesan_gagal = "Data gagal diperbaharui";
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
