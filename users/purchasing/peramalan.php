<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="./">Beranda</a>
                </li>
                <li class="active">Peramalan Bahan Baku</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Peramalan Kebutuhan Bahan Baku
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Pengolahan Data
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="well">
                        <form action="" method="get" class="">

                            <!-- hidden status hapus false -->
                            <input type="hidden" name="menu" value="peramalan" class="form-control" placeholder="" readonly>

                            <table class="table table-renponsive">
                                <caption>Masukkan Data Peramalan:</caption>

                                <tr>
                                    <td width="15%">Periode</td>
                                    <td>
                                        <select name="bulan" class="form-control select2" required>
                                            <option value="01" <?php if(isset($_GET['bulan'])){ if($_GET['bulan']=='01') echo "selected"; } ?>>Januari</option>
                                            <option value="02" <?php if(isset($_GET['bulan'])){ if($_GET['bulan']=='02') echo "selected"; } ?>>Februari</option>
                                            <option value="03" <?php if(isset($_GET['bulan'])){ if($_GET['bulan']=='03') echo "selected"; } ?>>Maret</option>
                                            <option value="04" <?php if(isset($_GET['bulan'])){ if($_GET['bulan']=='04') echo "selected"; } ?>>April</option>
                                            <option value="05" <?php if(isset($_GET['bulan'])){ if($_GET['bulan']=='05') echo "selected"; } ?>>Mei</option>
                                            <option value="06" <?php if(isset($_GET['bulan'])){ if($_GET['bulan']=='06') echo "selected"; } ?>>Juni</option>
                                            <option value="07" <?php if(isset($_GET['bulan'])){ if($_GET['bulan']=='07') echo "selected"; } ?>>Juli</option>
                                            <option value="08" <?php if(isset($_GET['bulan'])){ if($_GET['bulan']=='08') echo "selected"; } ?>>Agustus</option>
                                            <option value="09" <?php if(isset($_GET['bulan'])){ if($_GET['bulan']=='09') echo "selected"; } ?>>September</option>
                                            <option value="10" <?php if(isset($_GET['bulan'])){ if($_GET['bulan']=='10') echo "selected"; } ?>>Oktober</option>
                                            <option value="11" <?php if(isset($_GET['bulan'])){ if($_GET['bulan']=='11') echo "selected"; } ?>>November</option>
                                            <option value="12" <?php if(isset($_GET['bulan'])){ if($_GET['bulan']=='12') echo "selected"; } ?>>Desember</option>
                                        </select>
                                        <select name="tahun" class="form-control select2" required>
                                            <option value="2016" <?php if(isset($_GET['tahun'])){ if($_GET['tahun']=='2016') echo "selected"; } ?>>2016</option>
                                            <option value="2017" <?php if(isset($_GET['tahun'])){ if($_GET['tahun']=='2017') echo "selected"; } ?>>2017</option>
                                            <option value="2018" <?php if(isset($_GET['tahun'])){ if($_GET['tahun']=='2018') echo "selected"; } ?>>2018</option>
                                            <option value="2019" <?php if(isset($_GET['tahun'])){ if($_GET['tahun']=='2019') echo "selected"; } ?>>2019</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-line-chart bigger-120"></i> Ramalkan</button>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>

                        <?php
                        if (isset($_GET['bulan'])) {
                            // retrieve data dari API
                            $file = file_get_contents($url_api."tampilkan_data_peramalan_bahan_baku.php?bulan=".$_GET['bulan']."&tahun=".$_GET['tahun']);
                            $json = json_decode($file, true);

                            if(count($json['data']) > 0){
                                $i=0;
                                ?>
                                <h4>Hasil Peramalan :</h4>
                                <table class="table">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Bahan Baku</th>
                                        <th>Hasil Peramalan</th>
                                        <th>Satuan</th>
                                    </tr>
                                    <?php
                                    while ($i < count($json['data'])) {
                                        $no[$i] = $json['data'][$i]['no'];
                                        $nama_item[$i] = $json['data'][$i]['nama_item'];
                                        $hasil_peramalan[$i] = $json['data'][$i]['hasil_peramalan'];
                                        $satuan[$i] = $json['data'][$i]['satuan'];
                                        ?>
                                        <tr>
                                            <td><?= $no[$i] ?></td>
                                            <td><?= $nama_item[$i] ?></td>
                                            <td><?= $hasil_peramalan[$i] ?></td>
                                            <td><?= $satuan[$i] ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                </table>
                                <?php
                            }else{
                                echo "Tidak dapat diramalkan";
                            }
                        }
                        ?>

                    </div>

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
