<div class="main-content">
    <div class="main-content-inner">
        <!-- <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="./">Beranda</a>
                </li>
                <li class="active">Bahan Baku</li>
            </ul>
        </div> -->

        <div class="page-content">

            <div class="page-header">
                <h1>
                    <b style="color: #cd5c00">PT.Indonesia Victory Garment</b>
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Tracking
                    </small>
                </h1>
            </div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<!-- #section:pages/error -->
								<div class="error-container center">
									<div class="well">
										<h1 class="grey lighter smaller">
											<span class="bigger-125" style="color:#cd5c00">
												<i class="ace-icon fa fa-search"></i>
												Tracking
											</span>
											Barang
										</h1>
                                        <br />
                                        <center>
                                            <img src="assets/images/logo.png" alt="logo" width="250px" height="80px" class="img-responsive" style="background-color:#2abe1d;margin-top:-16px;margin-left:-20px">
                                        </center>

										<hr />
										<h3 class="lighter smaller">Cari barang yang anda pesan di PT.Indonesia Victory Garment!</h3>

										<div class="center">
											<form class="form-search" method="post" action="">
												<span class="input-icon align-middle">
													<i class="ace-icon fa fa-search"></i>

													<input type="text" class="search-query" value="<?php if(isset($_POST['faktur'])) echo $_POST['faktur'] ?>" name="faktur" size="80px" placeholder="Masukkan Nomor Invoice Pembelian..." required />
												</span>
												<button class="btn btn-sm" type="submit">Submit</button>
											</form>

											<div class="space"></div>

										</div>

										<hr />
										<div class="space"></div>

                    <?php
                    if (isset($_POST['faktur'])) {

                        // retrieve data dari API
                        $file = file_get_contents($url_api."tracking.php?nomor_invoice=".$_POST['faktur']);
                        $json = json_decode($file, true);
                        $i=0;

                        if($i < count($json['data'])) {
                            $nomor_invoice[$i]       = $json['data'][$i]['nomor_invoice'];
                            $nama_konsumen[$i]     = $json['data'][$i]['nama_konsumen'];
                            $status_pemesanan[$i]   = $json['data'][$i]['status_pemesanan'];
                            $status[$i]             = $json['data'][$i]['status_pembayaran'];
                            $tanggal_pemesanan[$i]  = $json['data'][$i]['tanggal_pemesanan'];
                            $alamat[$i]             = $json['data'][$i]['alamat'];
                            $no_telp[$i]            = $json['data'][$i]['no_telp'];
                            $email[$i]              = $json['data'][$i]['email'];
                            ?>

                            <div class="text-left">
                              <h5><b>Hasil Pencarian :</b></h5>
                              <table class="table table-responsive">
                                <tr>
                                  <td width="15%">Nomor Faktur</td>
                                  <td>: <?= $nomor_invoice[$i] ?></td>
                                </tr>

                                <tr>
                                  <td width="15%">Tanggal Pemesanan</td>
                                  <td>: <?= $tanggal_pemesanan[$i] ?></td>
                                </tr>

                                <tr>
                                  <td width="15%">Pelanggan</td>
                                  <td>: <?= $nama_konsumen[$i] ?></td>
                                </tr>

                                <tr>
                                  <td width="15%">Alamat</td>
                                  <td>: <?= $alamat[$i] ?></td>
                                </tr>

                                <tr>
                                  <td width="15%">Status</td>
                                  <td>: <?= $status_pemesanan[$i] ?></td>
                                </tr>
                              </table>
                            </div>
                            <div class="">
                              <div class="widget-main">
                                <!-- #section:plugins/fuelux.wizard -->
                                <div id="fuelux-wizard-container">
                                  <div>
                                    <!-- #section:plugins/fuelux.wizard.steps -->
                                    <ul class="steps">
                                      <li data-step="1" class="active">
                                        <span class="step">1</span>
                                        <span class="title">Pembayaran</span>
                                      </li>

                                      <li data-step="2" class="<?php if($status[$i] == 'SP') echo 'active' ?>">
                                        <span class="step">2</span>
                                        <span class="title">Sedang diproses</span>
                                      </li>

                                      <li data-step="3" class="<?php if($status[$i] == 'DK') echo 'active' ?>">
                                        <span class="step">3</span>
                                        <span class="title">Dikirim</span>
                                      </li>

                                      <li data-step="4" class="<?php if($status[$i] == 'DT') echo 'active' ?>">
                                        <span class="step">4</span>
                                        <span class="title">Diterima</span>
                                      </li>

                                    </ul>

                                    <!-- /section:plugins/fuelux.wizard.steps -->
                                  </div>
                                </div>
                              </div>
                            </div>

                            <?php
                        }else{
                          ?>
                          <center><p class="text-danger"><b>Transaksi tidak ditemukan...</b></p></center>
                          <?php
                        }
                    }
                    ?>

									</div>
								</div>

								<!-- /section:pages/error -->

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
