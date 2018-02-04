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

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <?php
                    // retrieve data dari API
                    $file = file_get_contents($url_api."tampilkan_data_pengiriman_produk.php");
                    $json = json_decode($file, true);
                    $i=0;
                    while ($i < count($json['data'])) {
                        $total_pengiriman = $json['data'][$i]['total_pengiriman'];
                        $belum_dikirim = $json['data'][$i]['belum_dikirim'];
                        $sudah_dikirim = $json['data'][$i]['sudah_dikirim'];
                        $sudah_diterima = $json['data'][$i]['sudah_diterima'];
                        $i++;
                    }
                    ?>

                    <caption><h5><b>Data Pengiriman </b></h5></caption>
					<div class="infobox infobox-orange">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-truck"></i>
						</div>

						<div class="infobox-data">
							<span class="infobox-data-number"><?= $total_pengiriman ?></span>
							<div class="infobox-content">Total Pengiriman</div>
						</div>
					</div>

					<div class="infobox infobox-green">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-list"></i>
						</div>

						<div class="infobox-data">
							<span class="infobox-data-number"><?= $sudah_dikirim ?></span>
							<div class="infobox-content">Dikirim</div>
						</div>
					</div>

					<div class="infobox infobox-blue">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-cubes"></i>
						</div>

						<div class="infobox-data">
							<span class="infobox-data-number"><?= $belum_dikirim ?></span>
							<div class="infobox-content">Belum dikirim</div>
						</div>

					</div>

					<div class="infobox infobox-pink">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-file-text"></i>
						</div>

						<div class="infobox-data">
							<span class="infobox-data-number"><?= $sudah_diterima ?></span>
							<div class="infobox-content">Sudah diterima</div>
						</div>
                    </div>

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
