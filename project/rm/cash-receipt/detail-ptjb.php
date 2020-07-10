<?php
  error_reporting(0);
  include('config/koneksi.php');

  $mod       = isset($_GET['mod']) ? $_GET['mod'] : "";
  $id_daftar = isset($_GET['id_n']) ? $_GET['id_n'] : "";

    if ($mod == "view") {

      $rp = "Rp. ";

      $p_tampil     = mysqli_query($con, "SELECT * FROM tbl_ptjb join tbl_amount on tbl_amount.kode_amount_ptjb = tbl_ptjb.kode_amount_ptjb WHERE id_ptjb = '$id_daftar'");
      $p_lihat      = mysqli_fetch_array($p_tampil);
      $id_daftar    = $p_lihat['id_ptjb'];
      $p_id_wo      = $p_lihat['wo_id'];
      $p_id_so      = $p_lihat['so_id'];
      $p_project    = $p_lihat['project_title'];  
      $p_vr         = $p_lihat['no_vr'];    
      $p_tgl        = $p_lihat['start_date'];     
      $p_today      = $p_lihat['date_now'];  
      $p_nama       = $p_lihat['nama'];  
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

                        <table class="table table-striped" >
                            <tr>
                              <th class="col-sm-3">ID WO</th>
                              <td class="col-sm-1">:</td>
                              <td class="col-sm-4"><?php echo $p_id_wo; ?></td>
                              <td class="col-sm-4"   ></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3">ID SO</th>
                              <td class="col-sm-1">:</td>
                              <td class="col-sm-4"><?php echo $p_id_so; ?></td>
                              <td class="col-sm-4"   ></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3">Tanggal Kasbon</th>
                              <td class="col-sm-1">:</td>
                              <td class="col-sm-4"><?php echo $p_tgl; ?></td>
                              <td class="col-sm-4"  ></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3">No VR</th>
                              <td class="col-sm-1">:</td>
                              <td class="col-sm-4"><?php echo $p_vr; ?></td>
                              <td class="col-sm-4"></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3">Nama Teknisi</th>
                              <td class="col-sm-1">:</td>
                              <td class="col-sm-4"><?php echo $p_nama; ?></td>
                              <td class="col-sm-4"></td>
                            </tr>
                        </table>
                        
                        <table class="table table-striped" >
                            <tr>
                              <th>No</th>
                              <th>Keterangan</th>
                              <th>Amount</th>
                            </tr>

                            <tr>
                              <td>1</td>
                              <td><?php echo $p_ket1; ?></td>
                              <td><?php echo $rp, number_format($p_amount1, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <td>2</th>
                              <td><?php echo $p_ket2; ?></td>
                              <td><?php echo $rp, number_format($p_amount2, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <td>3</td>
                              <td><?php echo $p_ket3; ?></td>
                              <td><?php echo $rp, number_format($p_amount3, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <td>4</td>
                              <td><?php echo $p_ket4; ?></td>
                              <td><?php echo $rp, number_format($p_amount4, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <td>5</td>
                              <td><?php echo $p_ket5; ?></td>
                              <td><?php echo $rp, number_format($p_amount5, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <td>6</td>
                              <td><?php echo $p_ket6; ?></td>
                              <td><?php echo $rp, number_format($p_amount6, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <td>7</td>
                              <td><?php echo $p_ket7; ?></td>
                              <td><?php echo $rp, number_format($p_amount7, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <td>8</td>
                              <td><?php echo $p_ket8; ?></td>
                              <td><?php echo $rp, number_format($p_amount8, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <td>9</td>
                              <td><?php echo $p_ket9; ?></td>
                              <td><?php echo $rp, number_format($p_amount9, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <td>10</td>
                              <td><?php echo $p_ket10; ?></td>
                              <td><?php echo $rp, number_format($p_amount10, 0, ".", "."); ?></td>
                            </tr>
                            <tr>
                              <td></td>
                              <th>Total Amount</th>
                              <td><?php echo $rp, number_format($total, 0, ".", "."); ?></td>
                            </tr>
                        </table>

                        <a href="?id=ptjb"><button type="button" class="btn btn-primary">BACK</button></a>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>