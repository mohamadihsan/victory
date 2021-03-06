<?php
session_start();
// buka koneksi
require_once '../config/connection.php';

$nomor_invoice = date('dmy').'INV'.date('i-s');
$id_konsumen = mysqli_escape_string($conn, trim($_POST['id_konsumen']));
$status_pemesanan = 'p';
$status_pembayaran = 0;
$ketersediaan_produk = '1';
$lama_produksi = 0;
$lama_pengiriman = 2;

if (isset($_POST['konfirmasi'])) {
    $nomor_invoice = mysqli_escape_string($conn, trim($_POST['nomor_invoice']));
    $status_pembayaran = '1';
    $sql = "UPDATE pemesanan_produk SET status_pembayaran = '$status_pembayaran' WHERE nomor_invoice = '$nomor_invoice'";
    if (mysqli_query($conn,$sql)) {
        $pesan_berhasil = "Data berhasil diperbaharui";
    }else{
        $pesan_gagal = "Detail pesanan gagal diperbaharui";
    }
}else{

    // simpan data
    $sql = "INSERT INTO pemesanan_produk (nomor_invoice, id_konsumen, status_pemesanan, status_pembayaran)
            VALUES ('$nomor_invoice', '$id_konsumen', '$status_pemesanan', '$status_pembayaran')";
    if(mysqli_query($conn, $sql)){

        //detail pesanan
        $id_produk          = $_POST['id_produk'];
        $quantity   = $_POST['quantity'];
        $i=0;
        $total_pemesanan=0;

        while ($i < count($id_produk)) {
            // retrieve harga
            $sql = "SELECT harga, stock, kapasitas_produksi
                    FROM produk
                    WHERE id_produk = '$id_produk[$i]'
                    LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
            $harga = $data['harga'];
            $stock = $data['stock'];
            $kapasitas_produksi = $data['kapasitas_produksi'];

            // cek stock setiap produk, jika salah satu stock produk yg dipesan kosong, maka set ketersediaan produk menjadi tidak tersedia
            if ($stock < $quantity[$i]) {
                $ketersediaan_produk = '0';

                $kekurangan = $quantity[$i] - $stock;
                $lama_produksi = ceil($kapasitas_produksi/$kekurangan);
            }else{
                $stock_baru = $stock - $quantity[$i];
                $sql_stock = "UPDATE produk SET stock='$stock_baru' WHERE id_produk='$id_produk[$i]'";
                mysqli_query($conn, $sql_stock);
            }

            // hitung total kapasitas pemesanan
            $total_pemesanan = $total_pemesanan + $quantity[$i];

            // insert detail pesanan
            $sql = "INSERT INTO detail_pemesanan_produk (nomor_invoice, id_produk, quantity, harga)
                    VALUES ('$nomor_invoice', '$id_produk[$i]', '$quantity[$i]', '$harga')";
            if(mysqli_query($conn, $sql)){
                $pesan_berhasil = "Data berhasil disimpan";
            }else{
                $pesan_gagal = "Detail pesanan gagal disimpan";
            }

            $i++;
        }

        $sql = "SELECT nomor_invoice FROM pemesanan_produk ORDER BY tanggal_pemesanan DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $nomor_invoice_terakhir = $row['nomor_invoice'];

        $sql = "UPDATE pemesanan_produk SET ketersediaan_produk='$ketersediaan_produk' WHERE nomor_invoice='$nomor_invoice_terakhir'";
        mysqli_query($conn, $sql);

        // PENENTUAN TANGGAL PENGIRIMAN
        date_default_timezone_set('Asia/Jakarta');
        $waktu_last_order = strtotime('16:00:00');
        $waktu_order = strtotime(date('H:i:s'));
        $tanggal_sekarang = date('Y-m-d');

        // cek apakah orderan lebih dari jam 16:00
        $lama_pengiriman = $lama_pengiriman + $lama_produksi;

        if($waktu_order >= $waktu_last_order){
            $tanggal_pengiriman = date('Y-m-d', strtotime('+'.$lama_pengiriman.' days', strtotime($tanggal_sekarang)));
        }else{
            $tanggal_pengiriman = date('Y-m-d', strtotime('+'.$lama_pengiriman.' days', strtotime($tanggal_sekarang)));
        }

        // PENENTUAN KENDARAAN YANG DIGUNAKAN
        // $sql = "SELECT
        //         	plat_nomor_kendaraan
        //         FROM
        //         	kendaraan
        //         WHERE
        //         	kapasitas >= '$total_pemesanan'
        //         ORDER BY
        //         	kapasitas ASC
        //         LIMIT 1";
        // $result = mysqli_query($conn, $sql);
        // if (mysqli_num_rows($result)>0) {
        //     $row=mysqli_fetch_assoc($result);
        //     $plat_nomor_kendaraan = $row['plat_nomor_kendaraan'];
        // }else{
        //     $plat_nomor_kendaraan = null;
        // }

        // create ID Ditribusi
        // $id_distribusi = 'DIS'.date('dmyis');
        $status_pengiriman = '0';
        $status_persetujuan = 's';

        $sql = "INSERT INTO pengiriman_produk (nomor_invoice, status_persetujuan, tanggal_pengiriman, status_pengiriman)
                VALUES ('$nomor_invoice', '$status_persetujuan', '$tanggal_pengiriman', '$status_pengiriman')";
        if(mysqli_query($conn, $sql)){
            $pesan_berhasil = "Data berhasil disimpan";
        }else{
            $pesan_gagal = "Data distribusi gagal disimpan";
        }

    }else{
        $pesan_gagal = "Data gagal disimpan";
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
