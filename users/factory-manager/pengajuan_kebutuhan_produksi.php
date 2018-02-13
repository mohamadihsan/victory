<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="./">Beranda</a>
                </li>
                <li class="active">Pengajuan Kebutuhan Produksi</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Pengajuan Kebutuhan Produksi
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Pengolahan Data
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <button data-toggle="collapse" data-target=".tampil" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-plus bigger-110"></i> Form</button>

                    <div id="" class="collapse tampil">
                        <div class="well">
                            <form action="../action/kebutuhan_produksi.php" method="post" class="myform">

                                <!-- hidden status hapus false -->
                                <input type="hidden" name="hapus" value="0" class="form-control" placeholder="" readonly>

                                <table class="table table-renponsive">
                                    <caption>Masukkan Data Pengajuan Kebutuhan Produksi:</caption>
                                    <tr>
                                        <td width="15%">ID Kebutuhan</td>
                                        <td>
                                            <input type="text" name="id_kebutuhan_produksi" value="" class="form-control" placeholder="ID akan dibuat secara otomatis" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Item</td>
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
                                        <td width="15%">Quantity Produksi</td>
                                        <td><input type="number" name="quantity_produksi" value="" min="1" class="form-control" placeholder="" required></td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Tanggal</td>
                                        <td><input type="date" name="tanggal" value="<?= date('Y-m-d') ?>" class="form-control" placeholder="" required></td>
                                    </tr>
                                    <tr class="hidden">
                                        <td width="15%">Status</td>
                                        <td>
                                            <input type="text" name="status" value="0" required>
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
                        </div>
                    </div>

                    <!-- loading -->
                    <center><div id="loading"></div></center>
                    <div id="result"></div>

                    <div class="clearfix">
                        <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="table-header">
                        Daftar data "Pengajuan Kebutuhan Produksi"
                    </div>
                    <!-- div.table-responsive -->

                    <!-- div.dataTables_borderWrap -->
                    <div class="table table-responsive">
                        <table id="mytable" class="display" width="100%" cellspacing="0">
                            <thead>
                                <tr class="">
                                    <th width="7%" class="text-center">No</th>
                                    <th width="15%" class="text-left">Kode Produk</th>
                                    <th width="15%" class="text-left">Nama Produk</th>
                                    <th width="15%" class="text-left">Style</th>
                                    <th width="10%" class="text-center">Quantity</th>
                                    <th width="12%" class="text-center">Tanggal</th>
                                    <th width="15%" class="text-center">Status</th>
                                    <th width="10%" class="text-center"></th>
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
            <form method="post" action="../action/kebutuhan_produksi.php" class="myform">
                <div class="modal-body">
                    <input type="hidden" name="hapus" value="1" readonly>
                    <input type="hidden" name="id_kebutuhan_produksi" readonly>
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
    function ubah(id_kebutuhan_produksi, id_produk, quantity_produksi, tanggal, status){
        $('.well input[name=id_kebutuhan_produksi]').val(id_kebutuhan_produksi);
        $('.well input[name=id_produk]').val(id_produk);
        $('.well input[name=quantity_produksi]').val(quantity_produksi);
        $('.well input[name=tanggal]').val(tanggal);
        $('.well input[name=status]').val(status);
    }

    function hapus(id_kebutuhan_produksi){
        $('.modal-body input[name=id_kebutuhan_produksi]').val(id_kebutuhan_produksi);
    }

    // LOADING SCREEN WHILE PROCESS SAVING/UPDATE/DELETE DATA
    $(document).ready(function(){

        $('#mytable').DataTable({
                    "bProcessing": true,
                    "sAjaxSource": "<?php echo $base_url.'action/tampilkan_data_kebutuhan_produksi.php' ?>",
                    "deferRender": true,
                    "select": true,
                    //"dom": 'Bfrtip',
                    //"scrollY": "300",
                    //"order": [[ 4, "desc" ]],
                     "aoColumns": [
                            { mData: 'no' } ,
                            { mData: 'id_produk' } ,
                            { mData: 'nama_produk' },
                            { mData: 'style' },
                            { mData: 'quantity_produksi' },
                            { mData: 'tanggal' },
                            { mData: 'status' },
                            { mData: 'action'}
                    ],
                    "aoColumnDefs": [
                        { sClass: "dt-center", "aTargets": [0,3,4,5] },
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
