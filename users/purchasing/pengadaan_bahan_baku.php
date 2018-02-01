<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="./">Beranda</a>
                </li>
                <li class="active">Pengadaan Bahan Baku</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Pengadaan Bahan Baku
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Pengolahan Data
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <a href="index.php?menu=pengadaan&form=true" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-plus bigger-110"></i> Form</a>

                    <div class="clearfix">
                        <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="table-header" style="">
                        Daftar data "Pengadaan Bahan Baku"
                    </div>
                    <!-- div.table-responsive -->

                    <!-- div.dataTables_borderWrap -->
                    <div class="table table-responsive">
                        <table id="mytable" class="display" width="100%" cellspacing="0">
                            <thead>
                                <tr class="">
                                    <th width="5%" class="text-center">No</th>
                                    <th width="15%" class="text-left">ID</th>
                                    <th width="15%" class="text-left">Supplier</th>
                                    <th width="15%" class="text-left">Pegawai</th>
                                    <th width="15%" class="text-center">Tanggal Pengajuan</th>
                                    <th width="5%" class="text-center">Status Pengajuan</th>
                                    <th width="5%" class="text-center">Status Pemesanan</th>
                                    <th width="5%" class="text-center">Status Pengadaan</th>
                                    <th width="15%" class="text-center"></th>
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
            <form method="post" action="../action/pemesanan_bahan_baku.php" class="myform">
                <div class="modal-body">
                    <input type="hidden" name="hapus" value="1" readonly>
                    <input type="hidden" name="nomor_faktur" readonly>
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
    function detail(id_pengadaan_bahan_baku){

    }

    function hapus(id_pengadaan_bahan_baku){
        $('.modal-body input[name=id_pengadaan_bahan_baku]').val(id_pengadaan_bahan_baku);
    }

    // LOADING SCREEN WHILE PROCESS SAVING/UPDATE/DELETE DATA
    $(document).ready(function(){

        $('#mytable').DataTable({
                    "bProcessing": true,
                    "sAjaxSource": "<?php echo $base_url.'action/tampilkan_data_pengadaan_bahan_baku.php' ?>",
                    "deferRender": true,
                    "select": true,
                    //"dom": 'Bfrtip',
                    //"scrollY": "300",
                    //"order": [[ 4, "desc" ]],
                     "aoColumns": [
                            { mData: 'no' } ,
                            { mData: 'id_pengadaan_bahan_baku' } ,
                            { mData: 'id_supplier' } ,
                            { mData: 'nomor_induk_karyawan' },
                            { mData: 'tanggal_pengajuan' },
                            { mData: 'status_pengajuan' },
                            { mData: 'status_pemesanan' },
                            { mData: 'status_pengadaan' },
                            { mData: 'action' }
                    ],
                    "aoColumnDefs": [
                        { sClass: "dt-center", "aTargets": [0,3,4] },
                        { sClass: "dt-nowrap", "aTargets": [0,1,2] }
                    ]
        });

    });
</script>
