<div class="main-content">
<div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="./">Beranda</a>
            </li>
            <li class="active">Komposisi Produk</li>
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">

        <div class="page-header">
            <h1>
                Komposisi Produk
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Pengolahan Data
                </small>
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">
                <a href="index.php?menu=tambah-komposisi&id=<?= $_GET['id'] ?>" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Tambahkan Komposisi</a>
                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>
                <div class="table-header">
                    Bahan baku untuk Produk <?= $_GET['id'] ?>
                </div>
                <!-- div.table-responsive -->

                <!-- div.dataTables_borderWrap -->
                <div class="table table-responsive">
                    <table id="mytable" class="display" width="100%" cellspacing="0">
                        <thead>
                            <tr class="">
                                <th width="5%" class="text-center">No</th>
                                <th width="50%" class="text-left">Bahan-Bahan</th>
                                <th width="10%" class="text-left">Quantity</th>
                                <th width="15%" class="text-left">Satuan</th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <!-- loading -->
                <center><div id="loading"></div></center>
                <div id="result"></div>

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
            <form method="post" action="../action/komposisi.php" class="myform">
            <div class="modal-body">
                <input type="hidden" name="status" value="3" readonly>
                <input type="hidden" name="id_produk" readonly>
                <input type="hidden" name="id_bahan_baku" readonly>
                <p>Apakah anda akan menghapus data komposisi produk ini?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button>
            </div>
        </form>
    </div>
</div>
</div>

<script>

function hapus(id_produk, id_bahan_baku){
    $('.modal-body input[name=id_produk]').val(id_produk);
    $('.modal-body input[name=id_bahan_baku]').val(id_bahan_baku);
}

// LOADING SCREEN WHILE PROCESS SAVING/UPDATE/DELETE DATA
$(document).ready(function(){

    // LOADING SCREEN WHILE PROCESS SAVING/UPDATE/DELETE DATA
    $(document).ready(function(){

        $('#mytable').DataTable({
                    "bProcessing": true,
                    "sAjaxSource": "<?php echo $base_url.'action/tampilkan_data_detail_komposisi.php?id='.$_GET['id'] ?>",
                    "deferRender": true,
                    "select": true,
                    //"dom": 'Bfrtip',
                    //"scrollY": "300",
                    //"order": [[ 4, "desc" ]],
                     "aoColumns": [
                            { mData: 'no' } ,
                            { mData: 'id_bahan_baku' } ,
                            { mData: 'quantity' },
                            { mData: 'satuan' },
                            { mData: 'action' }
                    ]
        });

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
