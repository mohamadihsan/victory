<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="./">Beranda</a>
                </li>
                <li class="active">Persediaan Bahan Baku</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Persediaan Bahan Baku
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
                            <form action="../action/persediaan_bahan_baku.php" method="post" class="myform">

                                <!-- hidden status hapus false -->
                                <input type="hidden" name="hapus" value="0" class="form-control" placeholder="" readonly>

                                <table class="table table-renponsive">
                                    <caption>Masukkan Data Persediaan Bahan Baku:</caption>
                                    <tr>
                                        <td width="15%">Bahan Baku</td>
                                        <td>
                                            <select name="id_bahan_baku" class="form-control select2" required>
                                                <?php
                                                // retrieve data dari API
                                                $file = file_get_contents($url_api."tampilkan_data_bahan_baku.php");
                                                $json = json_decode($file, true);
                                                $i=0;
                                                while ($i < count($json['data'])) {
                                                    $id_bahan_baku[$i] = $json['data'][$i]['id_bahan_baku'];
                                                    $nama_item[$i] = $json['data'][$i]['id_bahan_baku'].' - '.$json['data'][$i]['nama_item'];
                                                    ?>
                                                    <option value="<?= $id_bahan_baku[$i] ?>"> <?= $nama_item[$i] ?></option>
                                                    <?php
                                                    $i++;
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Nomor PO</td>
                                        <td><input type="text" name="nomor_po" value="" class="form-control" placeholder="" required></td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Supplier</td>
                                        <td>
                                            <select name="id_supplier" class="form-control select2" required>
                                                <?php
                                                // retrieve data dari API
                                                $file = file_get_contents($url_api."tampilkan_data_supplier.php");
                                                $json = json_decode($file, true);
                                                $i=0;
                                                while ($i < count($json['data'])) {
                                                    $id_supplier[$i] = $json['data'][$i]['id_supplier'];
                                                    $nama_supplier[$i] = $json['data'][$i]['id_supplier'].' - '.$json['data'][$i]['nama_supplier'];
                                                    ?>
                                                    <option value="<?= $id_supplier[$i] ?>"> <?= $nama_supplier[$i] ?></option>
                                                    <?php
                                                    $i++;
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Stok Awal</td>
                                        <td><input type="number" name="stok_awal" value="" class="form-control" placeholder="" min="0" required></td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Quantity Order</td>
                                        <td><input type="number" name="quantity_order" value="" class="form-control" placeholder="" min="0" required></td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Outgoing Produksi</td>
                                        <td><input type="number" name="outgoing_produksi" value="" class="form-control" placeholder="" min="0" required></td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Tanggal</td>
                                        <td><input type="date" name="tanggal" value="<?= date('Y-m-d') ?>" class="form-control" placeholder="" required></td>
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
                    <div class="table-header" style="">
                        Daftar data "Persediaan Bahan Baku"
                    </div>
                    <!-- div.table-responsive -->

                    <!-- div.dataTables_borderWrap -->
                    <div class="table table-responsive">
                        <table id="mytable" class="display" width="100%" cellspacing="0">
                            <thead>
                                <tr class="">
                                    <th width="5%" class="text-center">No</th>
                                    <th width="12%" class="text-left">Nomor PO</th>
                                    <th width="12%" class="text-left">Barang</th>
                                    <th width="5%" class="text-left">Stok Awal</th>
                                    <th width="5%" class="text-center">Qty Order</th>
                                    <th width="5%" class="text-center">Outgoing Produksi</th>
                                    <th width="5%" class="text-center">Stok Akhir</th>
                                    <th width="12%" class="text-center">Tanggal</th>
                                    <th width="12%" class="text-center">Supplier</th>
                                    <th width="10%" class="text-center"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <!-- loading -->
                    <center><div id="loading"></div></center>
                    <div id="result"></div>

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
            <form method="post" action="../action/persediaan_bahan_baku.php" class="myform">
                <div class="modal-body">
                    <input type="hidden" name="hapus" value="1" readonly>
                    <input type="hidden" name="nomor_po" readonly>
                    <input type="hidden" name="id_bahan_baku" readonly>
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
    function ubah(id_bahan_baku, nomor_po, id_supplier, stok_awal, quantity_order, outgoing_produksi, tanggal){
        $('.well select[name=id_bahan_baku]').val(id_bahan_baku);
        $('.well input[name=nomor_po]').val(nomor_po);
        $('.well select[name=id_supplier]').val(id_supplier);
        $('.well input[name=stok_awal]').val(stok_awal);
        $('.well input[name=quantity_order]').val(quantity_order);
        $('.well input[name=outgoing_produksi]').val(outgoing_produksi);
        $('.well input[name=tanggal]').val(tanggal);
    }

    function hapus(id_bahan_baku, nomor_po){
        $('.modal-body input[name=id_bahan_baku]').val(id_bahan_baku);
        $('.modal-body input[name=nomor_po]').val(nomor_po);
    }

    // LOADING SCREEN WHILE PROCESS SAVING/UPDATE/DELETE DATA
    $(document).ready(function(){

        $('#mytable').DataTable({
                    "bProcessing": true,
                    "sAjaxSource": "<?php echo $base_url.'action/tampilkan_data_persediaan_bahan_baku.php' ?>",
                    "deferRender": true,
                    "select": true,
                    //"dom": 'Bfrtip',
                    //"scrollY": "300",
                    //"order": [[ 4, "desc" ]],
                     "aoColumns": [
                            { mData: 'no' } ,
                            { mData: 'nomor_po' } ,
                            { mData: 'nama_item' } ,
                            { mData: 'stok_awal' },
                            { mData: 'quantity_order' },
                            { mData: 'outgoing_produksi' },
                            { mData: 'balance_stok_akhir' },
                            { mData: 'tanggal' },
                            { mData: 'nama_supplier' },
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
