<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="./">Beranda</a>
                </li>
                <li class="active">Pengadaan Bahan Baku</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Pengadaan Bahan Baku
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Pengolahan Data
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <?php
                    if (isset($_GET['form'])) {
                        ?>
                        <div class="well">
                            <form action="" method="get" class="">

                                <!-- hidden status hapus false -->
                                <input type="hidden" name="menu" value="pengadaan" class="form-control" placeholder="" readonly>
                                <input type="hidden" name="form" value="true" class="form-control" placeholder="" readonly>

                                <table class="table table-renponsive">
                                    <caption>Masukkan Data Pengadaan berdasarkan peramalan periode:</caption>

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
                                                <button type="submit" class="btn btn-sm btn-primary"> Submit</button>
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
                                    <form action="" method="post" class="myform">

                                        <h4>Form Pengadaan :</h4>
                                        <table class="table">
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="20%">Bahan Baku</th>
                                                <th width="15%">Quantity</th>
                                                <th>Satuan</th>
                                            </tr>
                                            <?php
                                            while ($i < count($json['data'])) {
                                                $no[$i] = $json['data'][$i]['no'];
                                                $id_bahan_baku[$i] = $json['data'][$i]['id_bahan_baku'];
                                                $nama_item[$i] = $json['data'][$i]['nama_item'];
                                                $hasil_peramalan[$i] = $json['data'][$i]['hasil_peramalan'];
                                                $satuan[$i] = $json['data'][$i]['satuan'];
                                                ?>
                                                <tr>
                                                    <td><?= $no[$i] ?></td>
                                                    <td>
                                                        <?= $nama_item[$i] ?>
                                                        <input type="hidden" name="id_bahan_baku[]" value="<?= $id_bahan_baku[$i] ?>">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="quantity[]" class="form-control" value="<?= $hasil_peramalan[$i] ?>">
                                                    </td>
                                                    <td><?= $satuan[$i] ?></td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="4">
                                                    <button type="submit" class="btn btn-success btn-sm" name="button">Checkout</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                    <?php
                                }else{
                                    echo "Tidak dapat diramalkan";
                                }
                            }
                            ?>

                        </div>
                        <?php
                    }else{
                        ?>
                        <a href="index.php?menu=pengadaan&form=true" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-plus bigger-110"></i> Form</a>

                        <div class="clearfix">
                            <div class="pull-right tableTools-container"></div>
                        </div>
                        <div class="table-header" style="">
                            Daftar data "Pengadaan Bahan Baku"
                        </div>
                        <!-- div.table-responsive -->

                        <!-- div.dataTables_borderWrap -->
                        <div class="table table-responsive">
                            <table id="mytable" class="display" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="">
                                        <th width="5%" class="text-center">No</th>
                                        <th width="15%" class="text-left">ID</th>
                                        <th width="15%" class="text-left">Supplier</th>
                                        <th width="15%" class="text-left">Pegawai</th>
                                        <th width="15%" class="text-center">Tanggal Pengajuan</th>
                                        <th width="5%" class="text-center">Status Pengajuan</th>
                                        <th width="5%" class="text-center">Status Pemesanan</th>
                                        <th width="5%" class="text-center">Status Pengadaan</th>
                                        <th width="15%" class="text-center"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <!-- loading -->
                        <center><div id="loading"></div></center>
                        <div id="result"></div>
                        <?php
                    }
                    ?>

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<!-- Modal Hapus -->
<div class="modal fade" id="hapus" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-trash"></i> Hapus Data</h4>
            </div>
            <form method="post" action="../action/pemesanan_bahan_baku.php" class="myform">
                <div class="modal-body">
                    <input type="hidden" name="hapus" value="1" readonly>
                    <input type="hidden" name="nomor_faktur" readonly>
                    <p>Apakah anda akan menghapus data pemesanan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function detail(id_pengadaan_bahan_baku){

    }

    function hapus(id_pengadaan_bahan_baku){
        $('.modal-body input[name=id_pengadaan_bahan_baku]').val(id_pengadaan_bahan_baku);
    }

    // LOADING SCREEN WHILE PROCESS SAVING/UPDATE/DELETE DATA
    $(document).ready(function(){

        $('#mytable').DataTable({
                    "bProcessing": true,
                    "sAjaxSource": "<?php echo $base_url.'action/tampilkan_data_pengadaan_bahan_baku.php' ?>",
                    "deferRender": true,
                    "select": true,
                    //"dom": 'Bfrtip',
                    //"scrollY": "300",
                    //"order": [[ 4, "desc" ]],
                     "aoColumns": [
                            { mData: 'no' } ,
                            { mData: 'id_pengadaan_bahan_baku' } ,
                            { mData: 'id_supplier' } ,
                            { mData: 'nomor_induk_karyawan' },
                            { mData: 'tanggal_pengajuan' },
                            { mData: 'status_pengajuan' },
                            { mData: 'status_pemesanan' },
                            { mData: 'status_pengadaan' },
                            { mData: 'action' }
                    ],
                    "aoColumnDefs": [
                        { sClass: "dt-center", "aTargets": [0,3,4] },
                        { sClass: "dt-nowrap", "aTargets": [0,1,2] }
                    ]
        });

    });
</script>
