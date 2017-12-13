<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-cubes cubes-icon"></i>
                    <a href="./">Produk</a>
                </li>
                <li class="active">Konfirmasi Pembayaran</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            
            <div class="page-header">
                <h1>
                    Konfirmasi Pembayaran 
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Pemesanan Produk
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <button data-toggle="collapse" data-target=".tampil" class="btn btn-sm"><i class="ace-icon fa fa-plus bigger-110"></i> Form Konfirmasi</button>
                    
                    <div id="" class="collapse tampil">
                        <div class="well">
                            <form action="action/konfirmasi_pembayaran.php" method="post" accept-charset="utf-8" enctype="multipart/form-data" class="myform">
                                
                                <!-- hidden status hapus false -->
                                <input type="hidden" name="hapus" value="0" class="form-control" placeholder="" readonly>

                                <table class="table table-renponsive">
                                    <caption>Masukkan Informasi:</caption>
                                    <tr>
                                        <td width="15%">Faktur</td>
                                        <td>
                                            <select name="nomor_faktur" class="form-control select2" required>
                                                <?php
                                                // retrieve data dari API
                                                $file = file_get_contents($url_api."tampilkan_data_pemesanan_produk.php?id=".$_SESSION['id_pelanggan']."&s=false");
                                                $json = json_decode($file, true);
                                                $i=0;
                                                while ($i < count($json['data'])) {
                                                    $nomor_faktur[$i] = $json['data'][$i]['nomor_faktur'];
                                                    ?>
                                                    <option value="<?= $nomor_faktur[$i] ?>"> <?= $nomor_faktur[$i] ?></option>
                                                    <?php
                                                    $i++;
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Tanggal transfer</td>
                                        <td><input type="date" name="tanggal_pembayaran" value="" class="form-control" placeholder="" required></td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Unggah bukti pembayaran</td>
                                        <td><input type="file" name="bukti_pembayaran" value="" class="form-control" placeholder="" required></td>
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
                        </div>
                    </div>
                    
                    <!-- loading -->
                    <center><div id="loading"></div></center>
                    <div id="result"></div>

                    <div class="clearfix">
                        <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="table-header">
                        Daftar data "Pemesanan Produk"
                    </div>
                    <!-- div.table-responsive -->

                    <!-- div.dataTables_borderWrap -->
                    <div class="table table-responsive">
                        <table id="mytable" class="display" width="100%" cellspacing="0">
                            <thead>
                                <tr class="">
                                    <th width="5%" class="text-center">No</th>
                                    <th width="15%" class="text-left">Nomor Faktur</th>
                                    <th width="10%" class="text-left">Sales</th>
                                    <th width="12%" class="text-left">Status Pemesanan</th>
                                    <th width="15%" class="text-left">Tgl Pemesanan</th>
                                    <th width="15%" class="text-left">Status Pembayaran</th>
                                    <th width="15%" class="text-left">Tgl Pembayaran</th>
                                    <th width="5%" class="text-left"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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
            <form method="post" action="../action/bahan_baku.php" class="myform">
                <div class="modal-body">
                    <input type="hidden" name="hapus" value="1" readonly>
                    <input type="hidden" name="id_bahan_baku" readonly>
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
    function detail(nomor_faktur){
        
    }
    
    function hapus(nomor_faktur){
        $('.modal-body input[name=nomor_faktur]').val(nomor_faktur);
    }
    
    // LOADING SCREEN WHILE PROCESS SAVING/UPDATE/DELETE DATA 
    $(document).ready(function(){

        $('#mytable').DataTable({
            "bProcessing": true,
            "sAjaxSource": "<?php echo $base_url.'action/tampilkan_data_pemesanan_produk.php?id='.$_SESSION['id_pelanggan'] ?>",
            "deferRender": true,
            "select": true,
            //"dom": 'Bfrtip',
            //"scrollY": "300",
            //"order": [[ 4, "desc" ]],
             "aoColumns": [
                    { mData: 'no' } ,
                    { mData: 'nomor_faktur' } ,
                    { mData: 'id_pegawai' },
                    { mData: 'status_pemesanan' },
                    { mData: 'tanggal_pemesanan' },
                    { mData: 'status_pembayaran' },
                    { mData: 'tanggal_pembayaran' },
                    { mData: 'faktur' }
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
                       $("#loading").show(1000).html("<img src='assets/images/loading.gif' height='100'>");                   
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



