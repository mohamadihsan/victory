<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="./">Beranda</a>
                </li>
                <li class="active"></li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <h5><b>Filter :</b></h5>
                    <form action="" method="get">
                        <select name="id" class="form-control select2" required>
                            <?php
                            // retrieve data dari API
                            $file = file_get_contents($url_api."tampilkan_data_produk.php");
                            $json = json_decode($file, true);
                            $i=0;
                            while ($i < count($json['data'])) {
                                $id_produk[$i] = $json['data'][$i]['id_produk'];
                                $nama_produk[$i] = $json['data'][$i]['id_produk'].' - '.$json['data'][$i]['nama_produk'];
                                ?>
                                <option value="<?= $id_produk[$i] ?>" <?php if(isset($_GET['id'])){ if($_GET['id']==$id_produk[$i]) echo 'selected'; } ?>> <?= $nama_produk[$i] ?></option>
                                <?php
                                $i++;
                            }
                            ?>
                        </select>
                        <select name="periode" class="form-control select2" required>
                            <?php
                            // retrieve data dari API
                            $file = file_get_contents($url_api."tampilkan_data_tahun_peramalan.php");
                            $json = json_decode($file, true);
                            $i=0;
                            if (count($json['data']) == 0) {
                                ?><option value="<?= date('Y')?>"><?= date('Y') ?></option><?php
                            }else{
                                while ($i < count($json['data'])) {
                                    $tahun[$i] = $json['data'][$i]['tahun'];
                                    ?>
                                    <option value="<?= $tahun[$i] ?>" <?php if(isset($_GET['periode'])){ if($_GET['periode']==$tahun[$i]) echo 'selected'; } ?>> <?= $tahun[$i] ?></option>
                                    <?php
                                    if ($i==count($json['data'])-1) {
                                        ?><option value="<?= $tahun[$i]+1 ?>" <?php if(isset($_GET['periode'])){ if($_GET['periode']==$tahun[$i]+1) echo 'selected'; } ?>> <?= $tahun[$i]+1 ?></option><?php
                                    }

                                    $i++;
                                }
                            }
                            ?>

                        </select>
                        <button type="submit" class="btn btn-sm">Filter</button>
                    </form>

                    <div style="width:100%;">
                        <canvas id="canvas"></canvas>
                    </div>

                </div>

                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">

                    <?php
                    // retrieve data dari API
                    $file = file_get_contents($url_api."tampilkan_data_penjualan.php");
                    $json = json_decode($file, true);
                    $i=0;
                    while ($i < count($json['data'])) {
                        $jumlah_produk = $json['data'][$i]['jumlah_produk'];
                        $jumlah_pelanggan = $json['data'][$i]['jumlah_pelanggan'];
                        $jumlah_pemesanan_bulan_ini = $json['data'][$i]['jumlah_pemesanan_bulan_ini'];
                        $i++;
                    }
                    ?>

                    <caption><h5><b>Data Penjualan </b></h5></caption>
					<div class="infobox infobox-green">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-list"></i>
						</div>

						<div class="infobox-data">
							<span class="infobox-data-number"><?= $jumlah_pelanggan ?></span>
							<div class="infobox-content">Konsumen</div>
						</div>
					</div>

					<div class="infobox infobox-blue">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-cubes"></i>
						</div>

						<div class="infobox-data">
							<span class="infobox-data-number"><?= $jumlah_produk ?></span>
							<div class="infobox-content">Produk</div>
						</div>

					</div>

					<div class="infobox infobox-pink">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-file-text"></i>
						</div>

						<div class="infobox-data">
							<span class="infobox-data-number"><?= $jumlah_pemesanan_bulan_ini ?></span>
							<div class="infobox-content">Pemesanan Bulan ini</div>
						</div>
                    </div>

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<?php
if (isset($_GET['periode'])) {
    $periode = $_GET['periode'];
    $id = $_GET['id'];
    $param = "?periode=".$periode."&id=".$id;
}else{
    $param = '';
}
?>
<script>
$(document).ready(function(){
    $.ajax({
        url: "<?= $url_api ?>tampilkan_data_grafik_pemesanan_produk.php<?= $param ?>",
        method: "GET",
        success: function(data) {
            console.log(data);
            var periode = [];
            var hasil_peramalan = [];
            var peramalan_per_minggu = [];
            var jumlah_pemesanan = [];
            var tahun;
            var id_produk;
            var obj = JSON.parse(data);
            $.each(obj, function(key, val) {
                periode.push(val.periode);
                hasil_peramalan.push(val.hasil_peramalan);
                peramalan_per_minggu.push(val.peramalan_per_minggu);
                jumlah_pemesanan.push(val.jumlah_pemesanan);

                tahun = val.tahun;
                id_produk = val.id_produk;
            })

            // for(var i in data) {
            //     periode.push("P. " + data[i].periode);
            //     hasil_peramalan.push(data[i].hasil_peramalan);
            //     jumlah_pemesanan.push(data[i].hasil_peramalan);
            // }

            var chartdata = {
                labels: periode,
                datasets : [
                    {
                        label: "Data Pemesanan Produk",
                        backgroundColor: window.chartColors.blue,
                        borderColor: window.chartColors.blue,
                        fill: false,
                        data: jumlah_pemesanan
                    }
                ],
            };

            var ctx = $("#canvas");

            var barGraph = new Chart(ctx, {
                type: 'line',
                options: {
                    responsive: true,
                    title:{
                        display:true,
                        text:'Grafik Pemesanan Produk ' + id_produk + ' ' + tahun
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Periode'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Jumlah'
                            },
                            ticks: {
                                beginAtZero: true,
                                steps: 10
                            }
                        }]
                    }
                },
                data: chartdata
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
});
</script>
