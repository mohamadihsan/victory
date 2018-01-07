<nav class="navigation">
    <div class="">
        <span class="title">
            <i class="fa fa-building"></i> PT.Indonesia Victory Garment
        </span>
    </div>
</nav>
<div class="container">
    <form class="form-search" method="post" action="">
        <div class="search-box" id="SBox">
            <input type="text" id="search" class="search-query" value="<?php if(isset($_POST['faktur'])) echo $_POST['faktur'] ?>" name="faktur" size="80px" placeholder="Masukkan Nomor Invoice Pembelian..." required />

            <div class="also search-link" >
                <button type="submit" style="height:50px; width:50px;font-family:fontawesome;border:0px"></button>
            </div>
            <!-- <a class="fa fa-cog also setting"></a> -->
        </div>
    </form>

    <?php
    if (isset($_POST['faktur'])) {
        ?>
        <div class="hasil"><br><br><br><br><br>
            <?php
            // retrieve data dari API
            $file = file_get_contents($url_api."tracking.php?nomor_faktur=".$_POST['faktur']);
            $json = json_decode($file, true);
            $i=0;
            if($i < count($json['data'])) {
                $nomor_faktur[$i]       = $json['data'][$i]['nomor_faktur'];
                $nama_pelanggan[$i]     = $json['data'][$i]['nama_pelanggan'];
                $status_pemesanan[$i]   = $json['data'][$i]['status_pemesanan'];
                $status[$i]             = $json['data'][$i]['status'];
                $tanggal_pemesanan[$i]  = $json['data'][$i]['tanggal_pemesanan'];
                $alamat[$i]             = $json['data'][$i]['alamat'];
                $no_telp[$i]            = $json['data'][$i]['no_telp'];
                $email[$i]              = $json['data'][$i]['email'];
                ?>

                <div class="text-left"><br><br><br><br><br><br>
                  <h5><b>Hasil Pencarian :</b></h5>
                  <table class="table table-responsive" border="0">
                    <tr>
                      <td width="15%">Nomor Faktur</td>
                      <td>: <?= $nomor_faktur[$i] ?></td>
                    </tr>

                    <tr>
                      <td width="15%">Tanggal Pemesanan</td>
                      <td>: <?= $tanggal_pemesanan[$i] ?></td>
                    </tr>

                    <tr>
                      <td width="15%">Pelanggan</td>
                      <td>: <?= $nama_pelanggan[$i] ?></td>
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
            ?>
        </div>
            <?php
    }
    ?>
</div>
