<?php
session_start();

// buka koneksi
require_once '../config/connection.php';

if(mysqli_escape_string($conn, trim($_POST['status']))=='0'){
    // buat session
    for ($i=0; $i < count($_POST['id_bahan_baku']); $i++) {
        $_SESSION['id_bahan_baku'][$i] = $_POST['id_bahan_baku'][$i];
    }

    $_SESSION['id_produk'] = $_POST['id_produk'];

}else if(mysqli_escape_string($conn, trim($_POST['status']))=='1'){


    // simpan data
    for ($i=0; $i < count($_POST['id_bahan_baku']); $i++) {
        $id_produk      = $_POST['id_produk'];
        $id_bahan_baku[$i]  = $_POST['id_bahan_baku'][$i];
        $quantity[$i]        = $_POST['quantity'][$i];

        $sql = "SELECT ukuran FROM bahan_baku WHERE id_bahan_baku='$id_bahan_baku[$i]'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $satuan = $row['ukuran'];

        $sql = "INSERT INTO komposisi (id_produk, id_bahan_baku, quantity, satuan)
                VALUES ('$id_produk', '$id_bahan_baku[$i]', '$quantity[$i]', '$satuan')";
        if(mysqli_query($conn, $sql)){
            $pesan_berhasil = "Data berhasil disimpan";
        }else{
            $pesan_gagal = "Data gagal disimpan";
        }
    }
}

if(mysqli_escape_string($conn, trim($_POST['status']))=='3'){
    $id_produk      = $_POST['id_produk'];
    $id_bahan_baku  = $_POST['id_bahan_baku'];
    $sql = "DELETE FROM komposisi WHERE id_produk='$id_produk' AND id_bahan_baku='$id_bahan_baku'";
    if (mysqli_query($conn, $sql)) {
        $pesan_berhasil = 'Data berhasil dihapus';
    }else{
        $pesan_gagal = 'Data gagal dihapus';
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
