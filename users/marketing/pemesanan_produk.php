<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="./">Beranda</a>
                </li>
                <li class="active">Pemesanan Produk</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Pemesanan Produk
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
                            <button type="button" name="add" id="add" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i> Tambah Item</button>
                            <form action="../action/pemesanan_produk.php" method="post" class="myform">

                                <!-- hidden status hapus false -->
                                <input type="hidden" name="hapus" value="0" class="form-control" placeholder="" readonly>

                                <table class="table table-renponsive">
                                    <h4><caption>Masukkan Data Order:</caption></h4>
                                    <tr>
                                        <th width="20%">Konsumen :</th>
                                        <th colspan="2">
                                            <select name="id_konsumen" class="form-control select2" required>
                                                <?php
                                                // retrieve data dari API
                                                $file = file_get_contents($url_api."tampilkan_data_konsumen.php");
                                                $json = json_decode($file, true);
                                                $i=0;
                                                while ($i < count($json['data'])) {
                                                    $id_konsumen[$i] = $json['data'][$i]['id_konsumen'];
                                                    $nama_konsumen[$i] = $json['data'][$i]['id_konsumen'].' - '.$json['data'][$i]['nama_konsumen'];
                                                    ?>
                                                    <option value="<?= $id_konsumen[$i] ?>"> <?= $nama_konsumen[$i] ?></option>
                                                    <?php
                                                    $i++;
                                                }
                                                ?>
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th width="20%">Produk</th>
                                        <th width="60%">Qty</th>
                                        <th width="5%"></th>
                                    </tr>
                                </table>

                                <div class="modal fade" id="konfirmasi_checkout" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header bg-red">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><i class="fa fa-question"></i> Konfirmasi Pesanan</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah anda yakin?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"></i> Checkout</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <table class="table table-renponsive" id="dynamic_field">
                                    <tr>
                                        <td colspan="3">
                                            <div class="btn-group">
                                                <a data-toggle="modal" data-target="#konfirmasi_checkout" class="btn btn-sm btn-success"><i class="ace-icon fa fa-shopping-cart bigger-120"></i> Checkout</a>
                                                <a data-toggle="modal" data-target="#batalkan" class="btn btn-sm btn-danger"><i class="ace-icon fa fa-refresh bigger-120"></i> Batal</a>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </form>

                            <!-- loading -->
                            <center><div id="loading"></div></center>
                            <div id="result"></div>
                        </div>
                        <?php
                    }else if (isset($_GET['invoice'])) { ?>

                      <div class="well">

                          <?php
                          // retrieve data dari API
                          $file = file_get_contents($url_api."tampilkan_data_detail_pemesanan_produk.php?nomor_invoice=".$_GET['invoice']);
                          $json = json_decode($file, true);


                          $nomor_invoice       = $json['data'][0]['nomor_invoice'];
                          $id_konsumen       = $json['data'][0]['id_konsumen'];
                          $status_pemesanan   = $json['data'][0]['status_pemesanan'];
                          $status_pembayaran  = $json['data'][0]['status_pembayaran'];
                          $tanggal_pemesanan  = $json['data'][0]['tanggal_pemesanan'];
                          $nama_konsumen     = $json['data'][0]['nama_konsumen'];
                          $alamat             = $json['data'][0]['alamat'];
                          $no_telp            = $json['data'][0]['no_telp'];
                          $email              = $json['data'][0]['email'];
                          $jumlahRecord       = $json['jumlahRecord'];

                          ?>

                          <div class="space-6"></div>

                          <div class="row">
                              <div class="col-sm-10 col-sm-offset-1">
                                  <div class="widget-box transparent">
                                      <div class="widget-header widget-header-large">
                                          <h3 class="widget-title grey lighter">
                                              <i class="ace-icon fa fa-leaf" style="color:#cd5c00"></i>
                                              Detail Pemesanan
                                          </h3>

                                          <div class="widget-toolbar no-border invoice-info">
                                              <span class="invoice-info-label">No Faktur:</span>
                                              <span class="red"><?= $nomor_invoice ?></span>

                                              <br />
                                              <span class="invoice-info-label">Tanggal:</span>
                                              <span class="blue"><?= $tanggal_pemesanan ?></span>
                                          </div>
                                      </div>

                                      <div class="widget-body">
                                          <div class="widget-main padding-24">
                                              <div class="row">

                                                  <div class="col-sm-6">
                                                      <div class="row">
                                                          <div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right" style="">
                                                              <b>Informasi Pelanggan & Alamat Pengiriman</b>
                                                          </div>
                                                      </div>

                                                      <div>
                                                          <ul class="list-unstyled  spaced">
                                                              <li>
                                                                  <i class="ace-icon fa fa-caret-right green"></i>Pelanggan : <?= $id_konsumen.' - '.$nama_konsumen ?>
                                                              </li>

                                                              <li>
                                                                  <i class="ace-icon fa fa-caret-right green"></i>Alamat : <?= $alamat ?>
                                                              </li>

                                                              <li>
                                                                  <i class="ace-icon fa fa-caret-right green"></i>No Telp : <?= $no_telp ?>
                                                              </li>

                                                              <li class="divider"></li>

                                                              <li>
                                                                  <i class="ace-icon fa fa-file-text-o green"></i>Detail Pemesanan
                                                              </li>
                                                          </ul>
                                                      </div>
                                                  </div><!-- /.col -->
                                              </div><!-- /.row -->

                                              <div>

                                                  <table class="table table-striped table-bordered">
                                                      <thead>
                                                          <tr>
                                                              <th class="center">#</th>
                                                              <th width="40%">Produk</th>
                                                              <th class="hidden-xs">Jumlah</th>
                                                              <th class="hidden-480">Harga</th>
                                                              <th>Sub Total</th>
                                                          </tr>
                                                      </thead>

                                                      <tbody>
                                                          <?php
                                                          $no = 1;
                                                          $total = 0;
                                                          $sub_total = 0;
                                                          for ($i=0; $i < $jumlahRecord; $i++) {

                                                            $no                 = $json['data'][$i]['no'];
                                                            $jumlah_pemesanan   = $json['data'][$i]['jumlah_pemesanan'];
                                                            $id_produk          = $json['data'][$i]['id_produk'];
                                                            $nama_produk        = $json['data'][$i]['nama_produk'];
                                                            $harga_produk       = $json['data'][$i]['harga_produk'];

                                                              $sub_total = $harga_produk * $jumlah_pemesanan;
                                                              $total = $total + $sub_total;
                                                              ?>
                                                              <tr>
                                                                  <td class="center">
                                                                      <?= $no++ ?>
                                                                  </td>

                                                                  <td>
                                                                      <a href="#"><?= $nama_produk ?></a>
                                                                  </td>
                                                                  <td class="hidden-xs">
                                                                      <?= $jumlah_pemesanan ?>
                                                                  </td>
                                                                  <td class="hidden-480">
                                                                      <?= 'Rp.'.Rupiah($harga_produk) ?></td>
                                                                  <td>
                                                                      <?= 'Rp.'.Rupiah($sub_total) ?>
                                                                  </td>
                                                              </tr>
                                                              <?php
                                                          }
                                                          ?>
                                                      </tbody>
                                                  </table>
                                              </div>

                                              <div class="hr hr8 hr-double hr-dotted"></div>

                                              <div class="row">
                                                  <div class="col-sm-5 pull-right">
                                                      <h4 class="pull-right">
                                                          Total Pemesanan :
                                                          <span class="red"><?= 'Rp.'.Rupiah($total) ?></span>
                                                      </h4>
                                                  </div>
                                              </div>

                                              <div class="space-6"></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <?php
                    }else{
                        ?>
                        <a href="index.php?menu=pemesanan&form=true" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-plus bigger-110"></i> Form</a>

                        <div id="" class="collapse tampil_detail">
                            <div class="well">
                            Detail Pemesanan
                            <button data-toggle="collapse" data-target=".tampil_detail" class="btn btn-sm"><i class="ace-icon fa fa-close bigger-110"></i> Tutup</button>

                            </div>
                        </div>

                        <div class="clearfix">
                            <div class="pull-right tableTools-container"></div>
                        </div>
                        <div class="table-header" style="">
                            Daftar data "Pemesanan Produk"
                        </div>
                        <!-- div.table-responsive -->

                        <!-- div.dataTables_borderWrap -->
                        <div class="table table-responsive">
                            <table id="mytable" class="display" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="">
                                        <th width="5%" class="text-center">No</th>
                                        <th width="15%" class="text-left">Invoice</th>
                                        <th width="10%" class="text-left">Konsumen</th>
                                        <th width="12%" class="text-left">Tgl Pemesanan</th>
                                        <th width="10%" class="text-left">Pemesanan</th>
                                        <th width="15%" class="text-left">Status Barang</th>
                                        <th width="10%" class="text-left">Pembayaran</th>
                                        <th width="15%" class="text-left"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- PAGE CONTENT ENDS -->
                        <?php
                    }
                    ?>

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
            <form method="post" action="../action/pemesanan_produk.php" class="myform">
                <div class="modal-body">
                    <input type="hidden" name="hapus" value="1" readonly>
                    <input type="hidden" name="nomor_invoice" readonly>
                    <p>Apakah anda akan menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="konfirmasi" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-file-text"></i> Konfirmasi</h4>
            </div>
            <form method="post" action="../action/pemesanan_produk.php" class="myform">
                <div class="modal-body">
                    <input type="hidden" name="konfirmasi" value="1" readonly>
                    <input type="hidden" name="id_konsumen" value="" readonly>
                    <input type="hidden" name="nomor_invoice" readonly>
                    <p>Konfirmasi Pembayaran telah diterima?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-money"></i> Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="batalkan" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header red">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-question"></i> Konfirmasi</h4>
            </div>
            <div class="modal-body">
                <p>Batalkan pesanan?</p>
            </div>
            <div class="modal-footer">
                <a href="index.php?menu=pemesanan" class="btn btn-sm btn-danger"><i class="ace-icon fa fa-refresh bigger-120"></i> Batalkan</a>
            </div>
        </div>
    </div>
</div>

<script>
    $("#dynamic_field").hide();
    $("#add").click(function(){
        $("#dynamic_field").show();
    });

    var i = 1;
    $('#add').click(function(){
        i++;
        $('#dynamic_field').prepend(
            '<tr id="row'+i+'">' +
            '<td width="20%">' +
                '<select name="id_produk[]" class="form-control select2" required>' +
                    <?php
                    // retrieve data dari API
                    $file = file_get_contents($url_api."tampilkan_data_produk.php");
                    $json = json_decode($file, true);
                    $i=0;
                    while ($i < count($json['data'])) {
                        $id_produk[$i] = $json['data'][$i]['id_produk'];
                        $nama_produk[$i] = $json['data'][$i]['id_produk'].' - '.$json['data'][$i]['nama_produk'];
                        ?>
                        '<option value="<?= $id_produk[$i] ?>"> <?= $nama_produk[$i] ?></option>'+
                        <?php
                        $i++;
                    }
                    ?>
                '</select>' +
            '</td>' +
            '<td width="60%">' +
                '<input type="text" name="quantity[]" id="quantity" value="" class="form-control" min="1" required>' +
            '</td>' +
            '<td width="5%"><button name="remove" id="'+i+'" class="btn btn-sm btn-danger btn_remove">X</button></td></tr>');
    });

    $(document).on('click','.btn_remove', function(){
        var button_id = $(this).attr("id");
        $("#row"+button_id+"").remove();
    });

    function hapus(nomor_invoice){
        $('.modal-body input[name=nomor_invoice]').val(nomor_invoice);
    }

    function konfirmasi(nomor_invoice){
        $('.modal-body input[name=nomor_invoice]').val(nomor_invoice);
    }

    // LOADING SCREEN WHILE PROCESS SAVING/UPDATE/DELETE DATA
    $(document).ready(function(){

        $('#mytable').DataTable({
                    "bProcessing": true,
                    "sAjaxSource": "<?php echo $base_url.'action/tampilkan_data_pemesanan_produk.php' ?>",
                    "deferRender": true,
                    "select": true,
                    //"dom": 'Bfrtip',
                    //"scrollY": "300",
                    //"order": [[ 4, "desc" ]],
                     "aoColumns": [
                            { mData: 'no' } ,
                            { mData: 'nomor_invoice' } ,
                            { mData: 'id_konsumen' } ,
                            { mData: 'tanggal_pemesanan' },
                            { mData: 'status_pemesanan' },
                            { mData: 'ketersediaan_produk' },
                            { mData: 'status_pembayaran' },
                            { mData: 'action' }
                    ],
                    "aoColumnDefs": [
                        { sClass: "dt-center", "aTargets": [0,3,4] },
                        { sClass: "dt-nowrap", "aTargets": [0,1,2] }
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
                    $("#konfirmasi_checkout").modal('hide');
                    $('#mytable').DataTable().ajax.reload();
                    setTimeout(
                        function()
                        {
                            $(location).attr('href', 'index.php?menu=pemesanan');
                        }, 1500);
            },
                error: function(jqXHR, textStatus, errorThrown){
         }
        });
            e.preventDefault(); //Prevent Default action.
            e.unbind();
        });

    });
</script>
