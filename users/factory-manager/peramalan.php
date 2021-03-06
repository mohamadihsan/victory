<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="./">Beranda</a>
                </li>
                <li class="active">Peramalan Produksi</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Peramalan Produksi
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
                    if (isset($_GET['detail'])) {

                        // retrieve data dari API
                        $file = file_get_contents($url_api."tampilkan_data_kebutuhan_bahan_baku.php?data=".$_GET['id_produk']."&f=".$_GET['f']."&periode=".$_GET['periode']);
                        $json = json_decode($file, true);
                        ?>
                        <div id="" class="">
                            <div class="well">
                                <caption><h4>Kebutuhan Bahan Baku</h4></caption>
                                <table class="table table-responsive">
                                    <tr>
                                        <th width="20%">ID PRODUK</th>
                                        <th>: <?= $json['data_produk'][0]['id_produk'] ?></th>
                                    </tr>
                                    <tr>
                                        <th>NAMA PRODUK</th>
                                        <th>: <?= $json['data_produk'][0]['nama_produk'] ?></th>
                                    </tr>
                                    <tr>
                                        <th>HARGA PRODUK</th>
                                        <th>: <?= "Rp".Rupiah($json['data_produk'][0]['harga']) ?></th>
                                    </tr>
                                    <tr>
                                        <th>SAFETY STOCK</th>
                                        <th>: <?= $json['data_produk'][0]['safety_stock'] ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2">PERAMALAN KEBUTUHAN BAHAN BAKU YANG HARUS DISEDIAKAN :</th>
                                    </tr>

                                    <?php
                                    if (!isset($json['data'][0]['pesan'])) {
                                        $i=0;
                                        while ($i < count($json['data'])) {
                                            $takaran[$i] = $json['data'][$i]['takaran'];
                                            $bahan_baku[$i] = $json['data'][$i]['id_bahan_baku'].' - '.$json['data'][$i]['nama_bahan_baku'];
                                            ?>
                                              <tr>
                                                  <td colspan="2"><?= $bahan_baku[$i].' sebanyak '.$takaran[$i] ?></td>
                                              </tr>
                                            <?php
                                            $i++;
                                        }
                                    }else{ ?>
                                      <tr>
                                          <td colspan="2"><?= $json['data'][0]['pesan'] ?></td>
                                      </tr>
                                      <?php
                                    }
                                    ?>
                                    <tfoot>
                                        <tr>
                                            <td><a href="./index.php?menu=peramalan" class="btn btn-sm btn-primary">Tampilkan List Peramalan</a></td>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>
                        <?php
                    }else { ?>

                        <button data-toggle="collapse" data-target=".tampil" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-plus bigger-110"></i> Form</button>

                        <div id="" class="collapse tampil">
                            <div class="well">
                                <form action="../action/peramalan.php" method="post" class="myform">

                                    <!-- hidden status hapus false -->
                                    <input type="hidden" name="hapus" value="0" class="form-control" placeholder="" readonly>

                                    <table class="table table-renponsive">
                                        <caption>Masukkan Data Peramalan:</caption>
                                        <tr>
                                            <td width="15%">Produk</td>
                                            <td>
                                                <select name="id_produk" class="form-control select2" required>
                                                    <?php
                                                    // retrieve data dari API
                                                    $file = file_get_contents($url_api."tampilkan_data_produk.php");
                                                    $json = json_decode($file, true);
                                                    $i=0;
                                                    while ($i < count($json['data'])) {
                                                        $id_produk[$i] = $json['data'][$i]['id_produk'];
                                                        $nama_produk[$i] = $json['data'][$i]['id_produk'].' - '.$json['data'][$i]['nama_produk'];
                                                        ?>
                                                        <option value="<?= $id_produk[$i] ?>"> <?= $nama_produk[$i] ?></option>
                                                        <?php
                                                        $i++;
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="15%">Periode</td>
                                            <td>
                                                <select name="bulan" class="form-control select2" required>
                                                    <option value="01">Januari</option>
                                                    <option value="02">Februari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                                <select name="tahun" class="form-control select2" required>
                                                    <option value="2016">2016</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="btn-group">
                                                    <button type="submit" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-save bigger-120"></i> Simpan</button>
                                                    <button type="reset" class="btn btn-sm btn-default"><i class="ace-icon fa fa-refresh bigger-120"></i> Reset</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </form>

                                  <!-- Tampilkan hasil -->
                                <div id="result"></div>

                            </div>
                        </div>

                        <div id="" class="collapse tampil_detail">
                            <div class="well">
                            Produksi
                            <button data-toggle="collapse" data-target=".tampil_detail" class="btn btn-sm"><i class="ace-icon fa fa-close bigger-110"></i> Tutup</button>

                            </div>
                        </div>

                        <!-- loading -->
                        <center><div id="loading"></div></center>

                        <div class="clearfix">
                            <div class="pull-right tableTools-container"></div>
                        </div>
                        <div class="table-header">
                            Daftar data "Peramalan"
                        </div>
                        <!-- div.table-responsive -->

                        <!-- div.dataTables_borderWrap -->
                        <div class="table table-responsive">
                            <table id="mytable" class="display" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="">
                                        <th width="7%" class="text-center">No</th>
                                        <th width="15%" class="text-left">Periode</th>
                                        <th width="40%" class="text-left">ID Produk</th>
                                        <th width="15%" class="text-left">Hasil Peramalan</th>
                                        <th width="25%" class="text-center"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <?php
                    } ?>
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
            <form method="post" action="../action/peramalan.php" class="myform">
                <div class="modal-body">
                    <input type="hidden" name="hapus" value="1" readonly>
                    <input type="hidden" name="id_peramalan" readonly>
                    <p>Apakah anda akan menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function detail(id_peramalan) {

    }

    function hapus(id_peramalan){
        $('.modal-body input[name=id_peramalan]').val(id_peramalan);
    }

    // LOADING SCREEN WHILE PROCESS SAVING/UPDATE/DELETE DATA
    $(document).ready(function(){

        $('#mytable').DataTable({
                    "bProcessing": true,
                    "sAjaxSource": "<?php echo $base_url.'action/tampilkan_data_peramalan.php' ?>",
                    "deferRender": true,
                    "select": true,
                    //"dom": 'Bfrtip',
                    //"scrollY": "300",
                    //"order": [[ 4, "desc" ]],
                     "aoColumns": [
                            { mData: 'no' } ,
                            { mData: 'periode' } ,
                            { mData: 'id_produk' } ,
                            { mData: 'hasil_peramalan' },
                            { mData: 'action_hapus'}
                    ]
        });

        //Callback handler for form submit event
        $(".myform").submit(function(e)
        {

        var formObj = $(this);
        var formURL = formObj.attr("action");
        var formData = new FormData(this);
        $.ajax({
            url: formURL,
            type: 'POST',
            data:  formData,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function (){
                       $("#loading").show(1000).html("<img src='../assets/images/loading.gif' height='100'>");
                       },
            success: function(data, textStatus, jqXHR){
                    $("#result").html(data);
                    $("#loading").hide();
                    $("#hapus").modal('hide');
                    $('#mytable').DataTable().ajax.reload();
            },
                error: function(jqXHR, textStatus, errorThrown){
         }
        });
            e.preventDefault(); //Prevent Default action.
            e.unbind();
        });

    });
</script>
