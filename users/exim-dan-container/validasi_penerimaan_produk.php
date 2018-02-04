<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="./">Beranda</a>
                </li>
                <li class="active">Penerimaan Produk</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Penerimaan Produk
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Status Penerimaan
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="clearfix">
                        <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="table-header">
                        Daftar data "Penerimaan Produk"
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
                                    <th width="15%" class="text-left">Konsumen</th>
                                    <th width="15%" class="text-left">Alamat</th>
                                    <th width="15%" class="text-left">Status Pengiriman</th>
                                    <th width="10%" class="text-left"></th>
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
<div class="modal fade" id="terima" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-truck"></i> Konfirmasi Penerimaan</h4>
            </div>
            <form method="post" action="../action/penerimaan_produk.php" class="myform">
                <div class="modal-body">
                    <input type="hidden" name="status_pengiriman" value="2" readonly>
                    <input type="hidden" name="nomor_invoice" readonly>
                    <p>Validasi Barang sudah dikirim dan diterima oleh konsumen?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function terima(nomor_invoice){
        $('.modal-body input[name=nomor_invoice]').val(nomor_invoice);
    }
    // LOADING SCREEN WHILE PROCESS SAVING/UPDATE/DELETE DATA
    $(document).ready(function(){

        $('#mytable').DataTable({
                    "bProcessing": true,
                    "sAjaxSource": "<?php echo $base_url.'action/tampilkan_data_penerimaan_produk.php' ?>",
                    "deferRender": true,
                    "select": true,
                    //"dom": 'Bfrtip',
                    //"scrollY": "300",
                    //"order": [[ 4, "desc" ]],
                     "aoColumns": [
                            { mData: 'no' } ,
                            { mData: 'nomor_invoice' } ,
                            { mData: 'tanggal_pengiriman' },
                            { mData: 'nama_konsumen' } ,
                            { mData: 'alamat' } ,
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
                    $("#terima").modal('hide');
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
