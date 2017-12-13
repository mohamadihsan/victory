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
                <input type="hidden" name="hapus" value="1" readonly>
                <input type="hidden" name="id_produk" readonly>
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
function ubah(id_produk, id_bahan_baku, takaran){
    $('.well input[name=id_produk]').val(id_produk);
    $('.well input[name=id_bahan_baku]').val(id_bahan_baku);
    $('.well input[name=takaran]').val(takaran);
}

function tampil_komposisi(id_produk){

}

function hapus(id_produk){
    $('.modal-body input[name=id_produk]').val(id_produk);
}

// LOADING SCREEN WHILE PROCESS SAVING/UPDATE/DELETE DATA
$(document).ready(function(){

    $('#mytable').DataTable({
                "bProcessing": true,
                "sAjaxSource": "<?php echo $base_url.'action/tampilkan_data_produk.php' ?>",
                "deferRender": true,
                "select": true,
                //"dom": 'Bfrtip',
                //"scrollY": "300",
                //"order": [[ 4, "desc" ]],
                 "aoColumns": [
                        { mData: 'no' } ,
                        { mData: 'gambar_produk' } ,
                        { mData: 'id_produk' } ,
                        { mData: 'nama_produk' } ,
                        { mData: 'jenis_produk' },
                        { mData: 'komposisi'}
                ]
    });

    $('#komposisitable').DataTable({
                "bProcessing": true,
                "sAjaxSource": "<?php echo $base_url.'action/tampilkan_data_komposisi.php' ?>",
                "deferRender": true,
                "select": true,
                //"dom": 'Bfrtip',
                //"scrollY": "300",
                //"order": [[ 4, "desc" ]],
                 "aoColumns": [
                        { mData: 'id_bahan_baku' } ,
                        { mData: 'takaran' },
                        { mData: 'input_id_produk' },
                        { mData: 'input_id_bahan_baku' }
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
                $('#komposisitable').DataTable().ajax.reload();
                $("#tableproduk").hide();
                $("#selanjutnya").collapse();
        },
            error: function(jqXHR, textStatus, errorThrown){
        }
    });
        e.preventDefault(); //Prevent Default action.
        e.unbind();
    });

    $(".myform2").submit(function(e)
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
                $("#selanjutnya").hide();
                $("#tableproduk").show();
        },
            error: function(jqXHR, textStatus, errorThrown){
        }
    });
        e.preventDefault(); //Prevent Default action.
        e.unbind();
    });

});
</script>
