<?php
  error_reporting(0);
  include('config/koneksi.php');

  $mod       = isset($_GET['mod']) ? $_GET['mod'] : "";
  $id_daftar = isset($_GET['id_n']) ? $_GET['id_n'] : "";
  $status    = isset($_GET['status']) ? $_GET['status'] : "";

    if ($mod == "view") {

      $rp = "Rp. ";

      $p_tampil     = mysqli_query($con, "SELECT * FROM tbl_kasbon join tbl_amount_kasbon on tbl_amount_kasbon.kode_amount = tbl_kasbon.kode_amount join tbl_status_kasbon on tbl_status_kasbon.kode_status = tbl_kasbon.kode_status WHERE id_kasbon = '$id_daftar'");
      $p_lihat      = mysqli_fetch_array($p_tampil);
      $id_daftar    = $p_lihat['id_kasbon'];
      $p_id_wo      = $p_lihat['wo_id'];
      $p_id_so      = $p_lihat['so_id'];
      $p_project    = $p_lihat['project_title'];  
      $p_vr         = $p_lihat['no_vr'];
      $p_jalan      = $p_lihat['tgl_jalan'];
      $p_today      = $p_lihat['tgl_input'];  
      $p_nama       = $p_lihat['nama'];   
      $p_bon        = $p_lihat['st_bon'];   
      $p_amount     = $p_lihat['st_amount'];   
      $p_lunas      = $p_lihat['st_lunas'];   
      $p_jmlh       = $p_lihat['jmlh_amount'];  
      $p_amount1    = $p_lihat['amount1'];  
      $p_ket1       = $p_lihat['keterangan1'];
      $p_amount2    = $p_lihat['amount2'];  
      $p_ket2       = $p_lihat['keterangan2'];
      $p_amount3    = $p_lihat['amount3'];  
      $p_ket3       = $p_lihat['keterangan3'];
      $p_amount4    = $p_lihat['amount4'];  
      $p_ket4       = $p_lihat['keterangan4'];
      $p_amount5    = $p_lihat['amount5'];  
      $p_ket5       = $p_lihat['keterangan5'];
      $p_amount6    = $p_lihat['amount6'];  
      $p_ket6       = $p_lihat['keterangan6'];
      $p_amount7    = $p_lihat['amount7'];  
      $p_ket7       = $p_lihat['keterangan7'];
      $p_amount8    = $p_lihat['amount8'];  
      $p_ket8       = $p_lihat['keterangan8'];
      $p_amount9    = $p_lihat['amount9'];  
      $p_ket9       = $p_lihat['keterangan9'];
      $p_amount10   = $p_lihat['amount10'];  
      $p_ket10      = $p_lihat['keterangan10'];
    }

    $total = $p_amount1 + $p_amount2 + $p_amount3 + $p_amount4 + $p_amount5 + $p_amount6 + $p_amount7 + $p_amount8 + $p_amount9 + $p_amount10;
    $sisa =  $p_jmlh - $total;
?>
   
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View Cash Receipt Detail</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="container">
                      <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">
                        <form style="font-size: 15px;  ">

                        <h3><b>Detail of Cash Receipt</b></h3><hr>

                        <table class="table table-striped table-responsive" >
                            <tr>
                              <th style="text-align: left; width: 20%;">ID WO</th>
                              <td style="text-align: left; width: 5%;">:</td>
                              <td style="text-align: left; width: 75%;"><?php echo $p_id_wo; ?></td>
                            </tr>

                            <tr>
                              <th style="text-align: left; width: 20%;">ID SO</th>
                              <td style="text-align: left; width: 5%;">:</td>
                              <td style="text-align: left; width: 75%;"><?php echo $p_id_so; ?></td>
                            </tr>
                            
                            <tr>
                              <th style="text-align: left; width: 20%;">Tanggal Kasbon</th>
                              <td style="text-align: left; width: 5%;">:</td>
                              <td style="text-align: left; width: 75%;"><?php echo $p_jalan; ?></td>
                            </tr>

                            <tr>
                              <th style="text-align: left; width: 20%;">No VR</th>
                              <td style="text-align: left; width: 5%;">:</td>
                              <td style="text-align: left; width: 75%;"><?php echo $p_vr; ?></td>
                            </tr>

                            <tr>
                              <th style="text-align: left; width: 20%;">Nama Teknisi</th>
                              <td style="text-align: left; width: 5%;">:</td>
                              <td style="text-align: left; width: 75%;"><?php echo $p_nama; ?></td>
                            </tr>

                            <tr>
                              <th style="text-align: left; width: 20%;">Keterangan Bon</th>
                              <td style="text-align: left; width: 5%;">:</td>
                              <td style="text-align: left; width: 75%;"><?php echo $p_bon; ?></td>
                            </tr>

                            <tr>
                              <th style="text-align: left; width: 20%;">Keterangan Uang</th>
                              <td style="text-align: left; width: 5%;">:</td>
                              <td style="text-align: left; width: 75%;"><?php echo $p_amount; ?></td>
                            </tr>

                            <tr>
                              <th style="text-align: left; width: 20%;">Keterangan Kasbon</th>
                              <td style="text-align: left; width: 5%;">:</td>
                              <td style="text-align: left; width: 75%;"><?php echo $p_lunas; ?></td>
                            </tr>
                        </table>
                        <hr>
                        <table class="table table-striped" >
                            <tr>
                              <th style="width: 50%;">Keterangan</th>
                              <th>Amount</th>
                            </tr>

                            <tr>
                              <td>Saldo Awal</td>
                              <td><?php echo $rp, number_format($p_jmlh, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <td><?php echo $p_ket1; ?></td>
                              <td><?php echo $rp, number_format($p_amount1, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <td><?php echo $p_ket2; ?></td>
                              <td><?php echo $rp, number_format($p_amount2, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <td><?php echo $p_ket3; ?></td>
                              <td><?php echo $rp, number_format($p_amount3, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <td><?php echo $p_ket4; ?></td>
                              <td><?php echo $rp, number_format($p_amount4, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <td><?php echo $p_ket5; ?></td>
                              <td><?php echo $rp, number_format($p_amount5, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <td><?php echo $p_ket6; ?></td>
                              <td><?php echo $rp, number_format($p_amount6, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <td><?php echo $p_ket7; ?></td>
                              <td><?php echo $rp, number_format($p_amount7, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <td><?php echo $p_ket8; ?></td>
                              <td><?php echo $rp, number_format($p_amount8, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <td><?php echo $p_ket9; ?></td>
                              <td><?php echo $rp, number_format($p_amount9, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <td><?php echo $p_ket10; ?></td>
                              <td><?php echo $rp, number_format($p_amount10, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <th style="font-size: 20px;"><b>Sisa Uang Kasbon</b></th>
                              <td style="font-size: 20px;"><b><?php echo $rp, number_format($sisa, 0, ".", "."); ?></b></td>
                            </tr>
                        </table>

                        <a href="?id=cash-receipt&mod=ptjb"><button type="button" class="btn btn-primary">BACK</button></a>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>