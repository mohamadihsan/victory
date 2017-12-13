<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="./">Beranda</a>
                </li>
                <li class="active">Bahan Baku</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Bahan Baku
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Pengolahan Data
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <!-- <button data-toggle="collapse" data-target=".tampil" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-plus bigger-110"></i> Form</button> -->

                    <div id="" class="collapse tampil">
                        <div class="well">
                            <form action="../action/bahan_baku.php" method="post" class="myform">

                                <!-- hidden status hapus false -->
                                <input type="hidden" name="hapus" value="0" class="form-control" placeholder="" readonly>

                                <table class="table table-renponsive">
                                    <caption>Masukkan Data Bahan Baku:</caption>
                                    <tr>
                                        <td width="15%">Kode Item</td>
                                        <input type="text" name="id_bahan_baku" value="" class="" placeholder="ID akan dibuat secara otomatis" hidden>
                                        <td><input type="text" name="kode_item" value="" class="form-control" placeholder=""></td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Nama Item</td>
                                        <td><input type="text" name="nama_item" value="" class="form-control" placeholder="" required></td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Ukuran</td>
                                        <td><input type="text" name="ukuran" value="" class="form-control" placeholder="" required></td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Tipe/Warna</td>
                                        <td><input type="text" name="tipe_warna" value="" class="form-control" placeholder="" required></td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Style</td>
                                        <td>
                                            <select class="form-control" name="style" required>
                                                <option value="Carter's">Carter's</option>
                                                <option value="Gymbore">Gymbore</option>
                                                <option value="TCP">TCP</option>
                                                <option value="K-mart">K-mart</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15%">Value</td>
                                        <td><input type="text" name="value" value="" class="form-control" placeholder="" required></td>
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
                    <div class="table-header" style="background-color:#D15B47">
                        Daftar data "Bahan Baku"
                    </div>
                    <!-- div.table-responsive -->

                    <!-- div.dataTables_borderWrap -->
                    <div class="table table-responsive">
                        <table id="mytable" class="display" width="100%" cellspacing="0">
                            <thead>
                                <tr class="">
                                    <th width="7%" class="text-center">No</th>
                                    <th width="15%" class="text-left">Kode Item</th>
                                    <th width="15%" class="text-left">Nama Item</th>
                                    <th width="15%" class="text-left">Ukuran</th>
                                    <th width="10%" class="text-center">Tipe/Warna</th>
                                    <th width="12%" class="text-center">Style</th>
                                    <th width="15%" class="text-center">Value</th>
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
    function ubah(id_bahan_baku, kode_item, nama_item, ukuran, tipe_warna, style, value){
        $('.well input[name=id_bahan_baku]').val(id_bahan_baku);
        $('.well input[name=kode_item]').val(kode_item);
        $('.well input[name=nama_item]').val(nama_item);
        $('.well input[name=ukuran]').val(ukuran);
        $('.well input[name=tipe_warna]').val(tipe_warna);
        $('.well select[name=style]').val(style);
        $('.well input[name=value]').val(value);
    }

    function hapus(id_bahan_baku){
        $('.modal-body input[name=id_bahan_baku]').val(id_bahan_baku);
    }

    // LOADING SCREEN WHILE PROCESS SAVING/UPDATE/DELETE DATA
    $(document).ready(function(){

        $('#mytable').DataTable({
                    "bProcessing": true,
                    "sAjaxSource": "<?php echo $base_url.'action/tampilkan_data_bahan_baku.php' ?>",
                    "deferRender": true,
                    "select": true,
                    //"dom": 'Bfrtip',
                    //"scrollY": "300",
                    //"order": [[ 4, "desc" ]],
                     "aoColumns": [
                            { mData: 'no' } ,
                            { mData: 'kode_item' } ,
                            { mData: 'nama_item' },
                            { mData: 'ukuran' },
                            { mData: 'tipe_warna' },
                            { mData: 'style' },
                            { mData: 'value' }
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
