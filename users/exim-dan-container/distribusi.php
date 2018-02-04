<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="./">Beranda</a>
                </li>
                <li class="active">Distribusi</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Distribusi
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Jadwal Distribusi
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <?php
                    if (isset($_GET['invoice'])) { ?>

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
                    }
                    else{
                        ?>
                        <div class="clearfix">
                            <div class="pull-right tableTools-container"></div>
                        </div>
                        <div class="table-header">
                            Daftar data "Distribusi"
                        </div>
                        <!-- div.table-responsive -->

                        <!-- div.dataTables_borderWrap -->
                        <div class="table table-responsive">
                            <table id="mytable" class="display" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="">
                                        <th width="7%" class="text-center">No</th>
                                        <th width="10%" class="text-left">Nomor Invoice</th>
                                        <th width="15%" class="text-left">Tanggal Pengiriman</th>
                                        <th width="15%" class="text-left">Status Persetujuan</th>
                                        <th width="15%" class="text-left">Status Pengiriman</th>
                                        <th width="10%" class="text-left"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
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
<div class="modal fade" id="kirim" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-truck"></i> Konfirmasi Pengiriman</h4>
            </div>
            <form method="post" action="../action/pengiriman_produk.php" class="myform">
                <div class="modal-body">
                    <input type="hidden" name="status_pengiriman" value="1" readonly>
                    <input type="hidden" name="nomor_invoice" readonly>
                    <p>Apakah anda akan mengirimkan pesanan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function kirim(nomor_invoice){
        $('.modal-body input[name=nomor_invoice]').val(nomor_invoice);
    }
    // LOADING SCREEN WHILE PROCESS SAVING/UPDATE/DELETE DATA
    $(document).ready(function(){

        $('#mytable').DataTable({
                    "bProcessing": true,
                    "sAjaxSource": "<?php echo $base_url.'action/tampilkan_data_distribusi.php' ?>",
                    "deferRender": true,
                    "select": true,
                    //"dom": 'Bfrtip',
                    //"scrollY": "300",
                    //"order": [[ 4, "desc" ]],
                     "aoColumns": [
                            { mData: 'no' } ,
                            { mData: 'nomor_invoice' } ,
                            { mData: 'tanggal_pengiriman' },
                            { mData: 'status_persetujuan' } ,
                            { mData: 'status_pengiriman' },
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
                    $("#kirim").modal('hide');
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
