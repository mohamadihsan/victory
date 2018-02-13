<?php
// buka koneksi
require_once '../config/connection.php';



if(mysqli_escape_string($conn, trim($_POST['hapus']))=='0'){
    // init
    $id_produk  = strtoupper(mysqli_escape_string($conn, trim($_POST['id_produk'])));
    $bulan      = strtoupper(mysqli_escape_string($conn, trim($_POST['bulan'])));
    $tahun      = strtoupper(mysqli_escape_string($conn, trim($_POST['tahun'])));
    $periode    = $bulan.'-'.$tahun;
    $periode_bulan = date('Y-m-d', strtotime('01-'.$periode));
    $periode_bulan_sebelumnya = date('m-Y', strtotime('-1 month', strtotime($periode_bulan)));
    $periode_dua_bulan_sebelumnya = date('m-Y', strtotime('-2 month', strtotime($periode_bulan)));
    $alpha      = 0.3;

    // jumlah peramalan 1 bulan yang lalu dari periode yang dicari
    $sql = "SELECT hasil_peramalan, single_exp, double_exp, at, bt
            FROM peramalan
            WHERE DATE_FORMAT(periode,'%m-%Y') = '$periode_bulan_sebelumnya'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $at = $row['at'];
    $bt = $row['bt'];
    $single_exp = $row['single_exp'];
    $double_exp = $row['double_exp'];
    if ($bt != 0) {

        // peramalan bulan selanjutnya
        $hasil_peramalan = ceil($at + $bt);

        $sql = "SELECT
                	dpp.id_produk,
                	SUM(dpp.quantity) AS omzet_bulan_sekarang
                FROM
                	pemesanan_produk pp
                LEFT JOIN detail_pemesanan_produk dpp ON dpp.nomor_invoice = pp.nomor_invoice
                WHERE
                	DATE_FORMAT(
                		pp.tanggal_pemesanan,
                		'%m-%Y'
                	) = '$periode'
                GROUP BY
                	1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $omzet_bulan_sekarang = $row['omzet_bulan_sekarang'];

        if ($omzet_bulan_sekarang == null) {
            $omzet_bulan_sekarang = 0;
        }

        // count single exponential
        $exp_smoothing_bulan_kemarin = ($alpha * $omzet_bulan_sekarang) + (1-$alpha) * $single_exp;

        // count double exponential
        $double_exp_smoothing_bulan_kemarin = ($alpha * $exp_smoothing_bulan_kemarin) + (1-$alpha) * $double_exp;

        // count at
        $at = 2 * $exp_smoothing_bulan_kemarin - $double_exp_smoothing_bulan_kemarin;

        // count bt
        $bt = ($alpha / (1 - $alpha)) * ($exp_smoothing_bulan_kemarin - $double_exp_smoothing_bulan_kemarin);

    }else{
        // jumlah pemesanan sebulan sebelum periode yang dicari
        $sql = "SELECT
                	*
                FROM
                	(
                		SELECT
                			SUM(quantity) AS jumlah_pemesanan_dua_bulan_kemarin
                		FROM
                			detail_pemesanan_produk dpp
                		LEFT JOIN pemesanan_produk pp ON pp.nomor_invoice = dpp.nomor_invoice
                		WHERE
                			dpp.id_produk = 'PR001'
                		AND DATE_FORMAT(tanggal_pemesanan, '%m-%Y') = '$periode_dua_bulan_sebelumnya'
                	) AS w
                JOIN (
                	SELECT
                		SUM(quantity) AS jumlah_pemesanan_bulan_kemarin
                	FROM
                		detail_pemesanan_produk dpp
                	LEFT JOIN pemesanan_produk pp ON pp.nomor_invoice = dpp.nomor_invoice
                	WHERE
                		dpp.id_produk = 'PR001'
                	AND DATE_FORMAT(tanggal_pemesanan, '%m-%Y') = '$periode_bulan_sebelumnya'
                ) AS x
                JOIN (
                	SELECT
                		SUM(quantity) AS jumlah_pemesanan
                	FROM
                		detail_pemesanan_produk dpp
                	LEFT JOIN pemesanan_produk pp ON pp.nomor_invoice = dpp.nomor_invoice
                	WHERE
                		dpp.id_produk = 'PR001'
                	AND DATE_FORMAT(tanggal_pemesanan, '%m-%Y') = '$periode'
                ) AS y";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($result);
        $jumlah_pemesanan = $data['jumlah_pemesanan'];
        $jumlah_pemesanan_bulan_kemarin = $data['jumlah_pemesanan_bulan_kemarin'];
        $jumlah_pemesanan_dua_bulan_kemarin = $data['jumlah_pemesanan_dua_bulan_kemarin'];
        if ($jumlah_pemesanan_bulan_kemarin == NULL OR $jumlah_pemesanan_dua_bulan_kemarin == NULL) {
            $hasil_peramalan = 0;
            $at = 0;
            $bt = 0;
            $exp_smoothing_bulan_kemarin = 0;
            $double_exp_smoothing_bulan_kemarin = 0;
        }else{
            // cek terlebih dahulu apakah sudah ada data peramalan atau belum
            // jumlah peramalan 1 bulan yang lalu dari periode yang dicari
            $sql = "SELECT hasil_peramalan, at, bt
                    FROM peramalan
                    WHERE DATE_FORMAT(periode,'%m-%Y') = '$periode_bulan_sebelumnya'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $at = $row['at'];
            $bt = $row['bt'];
            if ($bt != 0) {

                // peramalan bulan selanjutnya
                $hasil_peramalan = ceil($at + $bt);

            }else{
                // lakukan dari awal
                $omzet_dua_bulan_kemarin = $jumlah_pemesanan_dua_bulan_kemarin;
                $exp_smoothing_dua_bulan_kemarin = $jumlah_pemesanan_dua_bulan_kemarin;
                $double_exp_smoothing_dua_bulan_kemarin = $jumlah_pemesanan_dua_bulan_kemarin;
                $at_dua_bulan_kemarin = $jumlah_pemesanan_dua_bulan_kemarin;
                $bt_dua_bulan_kemarin = $exp_smoothing_dua_bulan_kemarin - $double_exp_smoothing_dua_bulan_kemarin;

                // count single exponential
                $omzet_bulan_kemarin = $jumlah_pemesanan_bulan_kemarin;
                $exp_smoothing_bulan_kemarin = ($alpha * $omzet_bulan_kemarin) + (1-$alpha) * $exp_smoothing_dua_bulan_kemarin;

                // count double exponential
                $double_exp_smoothing_bulan_kemarin = ($alpha * $exp_smoothing_bulan_kemarin) + (1-$alpha) * $double_exp_smoothing_dua_bulan_kemarin;

                // count at
                $at = 2 * $exp_smoothing_bulan_kemarin - $double_exp_smoothing_bulan_kemarin;

                // count bt
                $bt = ($alpha / (1 - $alpha)) * ($exp_smoothing_bulan_kemarin - $double_exp_smoothing_bulan_kemarin);

                // peramalan bulan selanjutnya
                $hasil_peramalan = ceil($at_dua_bulan_kemarin + $bt_dua_bulan_kemarin);
            }
        }
    }

    $periode = $tahun.'-'.$bulan.'-01';
    // cek data apakah sudah tersedia atau belum
    $sql = "SELECT id_peramalan, single_exp, double_exp, at, bt
            FROM peramalan
            WHERE periode='$periode' AND id_produk='$id_produk'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $id_peramalan = $data['id_peramalan'];
        $single_exp = $data['single_exp'];
        $double_exp = $data['double_exp'];
        $at = $data['at'];
        $bt = $data['bt'];

        // update data
        $sql = "UPDATE peramalan
                SET hasil_peramalan = '$hasil_peramalan', single_exp='$exp_smoothing_bulan_kemarin', double_exp='$double_exp_smoothing_bulan_kemarin', at='$at', bt='$bt'
                WHERE id_peramalan = '$id_peramalan'";
        mysqli_query($conn, $sql);
    }else{
        // simpan data
        $sql = "INSERT INTO peramalan (periode, id_produk, hasil_peramalan, single_exp, double_exp, at, bt)
                VALUES ('$periode', '$id_produk', '$hasil_peramalan', '$exp_smoothing_bulan_kemarin', '$double_exp_smoothing_bulan_kemarin', '$at', $bt)";
        if(mysqli_query($conn, $sql)){
            $pesan_berhasil = "Data peramalan telah disimpan";
        }else{
            $pesan_gagal = "Data peramalan gagal disimpan";
        }
    }
}else{
    $id_peramalan  = strtoupper(mysqli_escape_string($conn, trim($_POST['id_peramalan'])));
    // hapus data
    $sql = "DELETE FROM peramalan
            WHERE id_peramalan='$id_peramalan'";
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
