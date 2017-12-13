<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-cubes cubes-icon"></i>
                    <a href="./">Produk</a>
                </li>
                <li class="active">Pesan Sekarang</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            
            <div class="page-header">
                <h1>
                    Produk 
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Daftar Produk Riki Bakery
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <ul class="ace-thumbnails clearfix">
                        <?php
                        // retrieve data dari API
                        $file = file_get_contents($url_api."tampilkan_data_produk.php");
                        $json = json_decode($file, true);
                        $i=0;
                        while ($i < count($json['data'])) {
                            $id_produk[$i] = $json['data'][$i]['id_produk'];
                            $nama_produk[$i] = $json['data'][$i]['nama_produk'];
                            $harga[$i] = $json['data'][$i]['harga'];
                            $jenis_produk[$i] = $json['data'][$i]['jenis_produk'];
                            $nama_file_gambar[$i] = $json['data'][$i]['nama_file_gambar'];

                            $link_gambar[$i] = 'assets/images/'.$nama_file_gambar[$i];
                            ?>
                            <li>
                                <a href="<?= $link_gambar[$i] ?>" title="<?= $nama_produk[$i] ?>" data-rel="colorbox">
                                    <img width="200" height="200" alt="200x200" src="<?= $link_gambar[$i] ?>" />
                                </a>

                                <div class="tags">
                                    <span class="label-holder">
                                        <span class="label label-success"><?= $harga[$i] ?></span>
                                    </span>

                                    <span class="label-holder">
                                        <span class="label label-warning arrowed-in"><?= $nama_produk[$i] ?></span>
                                    </span>
                                </div>

                                <div class="tools tools-bottom">
                                    <?php if(empty($_SESSION['id_pelanggan'])){ ?>
                                        <a href="./index.php?menu=login">
                                            <i class="ace-icon fa fa-shopping-cart"></i> Pesan
                                        </a>
                                        <?php
                                    }else{?>
                                        <a href="action/keranjang.php?id=<?= $id_produk[$i] ?>">
                                            <i class="ace-icon fa fa-shopping-cart"></i> Pesan
                                        </a>
                                        <?php
                                    } ?>
                                </div>
                            </li>
                            <?php
                            $i++;
                        }
                        ?>
                    </ul>    
                </div>    
            </div>
        </div>
    </div>
</div>        