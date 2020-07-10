<?php 
  include('config/koneksi.php');

  // harap include SESSION <?php include('session.php'); //

  $mod         = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $id_daftar   = isset($_GET['id_n']) ? $_GET['id_n'] : "";
  $p_tombol    = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
  $p_id_daftar = isset($_POST['id_daftar']) ? $_POST['id_daftar'] : "";  
  $p_id_wo     = isset($_POST['wo']) ? $_POST['wo'] : "";
  $p_id_so     = isset($_POST['so']) ? $_POST['so'] : "";

  if ($mod == "view") {

    $cekdulu = "SELECT * FROM tbl_income WHERE wo_id = '$p_id_wo' AND so_id = '$p_id_so' AND ket = 'first'"; 
    $prosescek = mysqli_query($con, $cekdulu);
    if (mysqli_num_rows($prosescek) > 0) { 
      $sql = mysqli_query($con, "SELECT * FROM tbl_income WHERE wo_id = '$p_id_wo' AND so_id = '$p_id_so'");
      while ($row = mysqli_fetch_array($sql)) {
      $r_id_wo    = $row['wo_id'];
      $r_id_so    = $row['so_id'];
      $r_pricel[]    = $row['price'];
    }
    $r_price       = array_sum($r_pricel);
    if ($r_price <= 1000000) {
        $persen = 10;
      } elseif ($r_price > 1000000) {
        $persen = 5;
      }


      $sql2 = mysqli_query($con, "SELECT * FROM tbl_kasbon join tbl_amount_kasbon on tbl_amount_kasbon.kode_amount = tbl_kasbon.kode_amount WHERE wo_id = '$p_id_wo' AND so_id = '$p_id_so'");
      while ($row2 = mysqli_fetch_array($sql2)) {
      $k_jmlh[]   = $row2['jmlh_amount'];
      $k_amo1[]   = $row2['amount1'];
      $k_amo2[]   = $row2['amount2'];
      $k_amo3[]   = $row2['amount3'];
      $k_amo4[]   = $row2['amount4'];
      $k_amo5[]   = $row2['amount5'];
      $k_amo6[]   = $row2['amount6'];
      $k_amo7[]   = $row2['amount7'];
      $k_amo8[]   = $row2['amount8'];
      $k_amo9[]   = $row2['amount9'];
      $k_amo10[]   = $row2['amount10'];
      }

      $kjmlh       = array_sum($k_jmlh);
      $kamo1       = array_sum($k_amo1);
      $kamo2       = array_sum($k_amo2);
      $kamo3       = array_sum($k_amo3);
      $kamo4       = array_sum($k_amo4);
      $kamo5       = array_sum($k_amo5);
      $kamo6       = array_sum($k_amo6);
      $kamo7       = array_sum($k_amo7);
      $kamo8       = array_sum($k_amo8);
      $kamo9       = array_sum($k_amo9);
      $kamo10       = array_sum($k_amo10);

      $sql3 = mysqli_query($con, "SELECT * FROM tbl_ptjb join tbl_amount on tbl_amount.kode_amount_ptjb = tbl_ptjb.kode_amount_ptjb WHERE wo_id = '$p_id_wo' AND so_id = '$p_id_so'");
      while ($row3 = mysqli_fetch_array($sql3)) {
      $p_amo1[]   = $row3['amount1'];
      $p_amo2[]   = $row3['amount2'];
      $p_amo3[]   = $row3['amount3'];
      $p_amo4[]   = $row3['amount4'];
      $p_amo5[]   = $row3['amount5'];
      $p_amo6[]   = $row3['amount6'];
      $p_amo7[]   = $row3['amount7'];
      $p_amo8[]   = $row3['amount8'];
      $p_amo9[]   = $row3['amount9'];
      $p_amo10[]   = $row3['amount10'];
      }

      $pamo1       = array_sum($p_amo1);
      $pamo2       = array_sum($p_amo2);
      $pamo3       = array_sum($p_amo3);
      $pamo4       = array_sum($p_amo4);
      $pamo5       = array_sum($p_amo5);
      $pamo6       = array_sum($p_amo6);
      $pamo7       = array_sum($p_amo7);
      $pamo8       = array_sum($p_amo8);
      $pamo9       = array_sum($p_amo9);
      $pamo10       = array_sum($p_amo10);

      $terpakai1 = $kamo1 + $kamo2 + $kamo3 + $kamo4 + $kamo5 + $kamo6 + $kamo7 + $kamo8 + $kamo9 + $kamo10;
      $terpakai2 = $pamo1 + $pamo2 + $pamo3 + $pamo4 + $pamo5 + $pamo6 + $pamo7 + $pamo8 + $pamo9 + $pamo10;
      $dipakai   = $terpakai1 + $terpakai2;
      $terpakai  = $r_price*$persen/100;
      $sisa      = $terpakai - $terpakai1 - $terpakai2;

    } else {
      echo "<script>alert('ID WO atau ID SO Tidak Terdaftar'); history.go(-1) </script>";
    }

  } elseif ($mod == "detail-kasbon") {
      $k_tampil     = mysqli_query($con, "SELECT * FROM tbl_kasbon join tbl_amount_kasbon on tbl_amount_kasbon.kode_amount = tbl_kasbon.kode_amount join tbl_income on tbl_income.wo_id = tbl_kasbon.wo_id WHERE id_kasbon = '$id_daftar'");
      while ($k_lihat = mysqli_fetch_array($k_tampil)) {
        $id_daftar    = $k_lihat['id_kasbon'];
        $k_tgl        = $k_lihat['tgl_input'];  
        $k_nama       = $k_lihat['nama'];     
        $k_wo         = $k_lihat['wo_id'];     
        $k_so         = $k_lihat['so_id'];  
        $k_price1[]   = $k_lihat['price'];  
        $k_jmlh       = $k_lihat['jmlh_amount'];  
        $k_amount1    = $k_lihat['amount1'];  
        $k_ket1       = $k_lihat['keterangan1'];
        $k_amount2    = $k_lihat['amount2'];  
        $k_ket2       = $k_lihat['keterangan2'];
        $k_amount3    = $k_lihat['amount3'];  
        $k_ket3       = $k_lihat['keterangan3'];
        $k_amount4    = $k_lihat['amount4'];  
        $k_ket4       = $k_lihat['keterangan4'];
        $k_amount5    = $k_lihat['amount5'];  
        $k_ket5       = $k_lihat['keterangan5'];
        $k_amount6    = $k_lihat['amount6'];  
        $k_ket6       = $k_lihat['keterangan6'];
        $k_amount7    = $k_lihat['amount7'];  
        $k_ket7       = $k_lihat['keterangan7'];
        $k_amount8    = $k_lihat['amount8'];  
        $k_ket8       = $k_lihat['keterangan8'];
        $k_amount9    = $k_lihat['amount9'];  
        $k_ket9       = $k_lihat['keterangan9'];
        $k_amount10   = $k_lihat['amount10'];  
        $k_ket10      = $k_lihat['keterangan10'];
      }

      $k_total = $k_amount1 + $k_amount2 + $k_amount3 + $k_amount4 + $k_amount5 + $k_amount6 + $k_amount7 + $k_amount8 + $k_amount9 + $k_amount10;
      $k_sisa =  $k_jmlh - $k_total;

      $k_price       = array_sum($k_price1);
      $kpersen = $k_total/$k_price*100;

    } elseif ($mod == "detail-ptjb") {
      $p_tampil     = mysqli_query($con, "SELECT * FROM tbl_ptjb join tbl_amount on tbl_amount.kode_amount_ptjb = tbl_ptjb.kode_amount_ptjb join tbl_income on tbl_income.wo_id = tbl_ptjb.wo_id WHERE id_ptjb = '$id_daftar'");
      while ($p_lihat = mysqli_fetch_array($p_tampil)) {
        $id_daftar    = $p_lihat['id_ptjb'];
        $p_tgl        = $p_lihat['date_now'];  
        $p_nama       = $p_lihat['nama'];     
        $p_wo         = $p_lihat['wo_id'];    
        $p_so         = $p_lihat['so_id'];  
        $p_price1[]   = $p_lihat['price'];  
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

      $p_total = $p_amount1 + $p_amount2 + $p_amount3 + $p_amount4 + $p_amount5 + $p_amount6 + $p_amount7 + $p_amount8 + $p_amount9 + $p_amount10;

      $p_price       = array_sum($p_price1);
      $persen = $p_total/$p_price*100;
    }

    $rp = "Rp. ";

?>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
    <h2>Finance Report <small>Laporan Finance</small></h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
    </ul>
    <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <?php
        
          if ($mod == 'search') {
                                     
      ?>
      <form class="form-horizontal" action="?id=report-income-ex&mod=view" method="post"  role="form">
        <input type="hidden" name="id_daftar" value="<?php echo $id_daftar; ?>">
        <div class="panel panel-primary setup-content">
          <div class="panel-heading">
          <h3 class="panel-title">Search by ID WO / ID SO</h3>
          </div>
          <div class="panel-body">
            <div class="form-group">
              <div class="col-xs-12 col-lg-6">
                <label for="wo">ID WO</label>
                <input type="text" name="wo" class="form-control" id="woid" >
              </div>
              <div class="col-xs-12 col-lg-6">
                <label for="wo">ID SO</label>
                <input type="text" name="so" class="form-control" id="so" >
              </div>
            </div>
            <hr>
            <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="SUBMIT">
          </div>
        </div>                          
      </form>
      <?php 
        } elseif ($mod == 'view') {
      ?>
      <div class="container">
        <div class="stepwizard">
          <div class="setup-panel">
          <form style="font-size: 15px;  ">

          <h3><b>Laporan Income : <?php echo $r_id_wo; ?></b></h3><hr>

          <table class="table table-striped table-responsive" >
            <tr>
              <th style="text-align: left; width: 20%;">ID WO</th>
              <td style="text-align: left; width: 5%;">:</td>
              <td style="text-align: left; width: 75%;"><?php echo $r_id_wo; ?></td>
            </tr>

            <tr>
              <th style="text-align: left; width: 20%;">ID SO</th>
              <td style="text-align: left; width: 5%;">:</td>
              <td style="text-align: left; width: 75%;"><?php echo $r_id_so; ?></td>
            </tr>

            <tr>
              <th style="text-align: left; width: 20%;">Total Income</th>
              <td style="text-align: left; width: 5%;">:</td>
              <td style="text-align: left; width: 75%;"><?php echo $rp, number_format($r_price, 0, ".", "."); ?></td>
            </tr>

            <tr>
              <th style="text-align: left; width: 20%;">Limit Operasional (<?php echo $persen; ?>%)</th>
              <td style="text-align: left; width: 5%;">:</td>
              <td style="text-align: left; width: 75%;"><?php echo $rp, number_format($terpakai, 0, ".", "."); ?></td>
            </tr>

            <tr>
              <th style="text-align: left; width: 20%;">Total Terpakai</th>
              <td style="text-align: left; width: 5%;">:</td>
              <td style="text-align: left; width: 75%;"><?php echo $rp, number_format($dipakai, 0, ".", "."); ?></td>
            </tr>

            <tr>
              <th style="text-align: left; width: 20%;">Total Sisa</th>
              <td style="text-align: left; width: 5%;">:</td>
              <td style="text-align: left; width: 75%;"><?php echo $rp, number_format($sisa, 0, ".", "."); ?></td>
            </tr>
          </table>
          <hr>

          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Kasbon <small>Detail Terpakai</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-bordered table-responsive dt-responsive nowrap table-hover">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Tanggal Kasbon</th>
                    <th>ID WO</th>
                    <th>ID SO</th>
                    <th>Total Kasbon</th>
                    <th>Total Terpakai</th>
                    <th>Total Sisa</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                    
                    $no = 1;
                    $res = $con->query("SELECT * FROM tbl_kasbon join tbl_amount_kasbon on tbl_amount_kasbon.kode_amount = tbl_kasbon.kode_amount where wo_id = '$p_id_wo' AND so_id = '$p_id_so'");
                    while($row = $res->fetch_assoc()){
                      $rp = "Rp. ";
                      $jmlh = $row['jmlh_amount'];
                      $total = $row['amount1'] + $row['amount2'] + $row['amount3'] + $row['amount4'] + $row['amount5'] + $row['amount6'] + $row['amount7'] + $row['amount8'] + $row['amount9'] + $row['amount10'];
                      $sisa = $jmlh - $total;
                  ?>

                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $row['tgl_input']; ?></td>
                    <td><?php echo $row['wo_id']; ?></td>
                    <td><?php echo $row['so_id']; ?></td>
                    <td><?php echo $rp, number_format($jmlh, 0, ".", "."); ?></td>
                    <td><?php echo $rp, number_format($total, 0, ".", "."); ?></td>
                    <td><?php echo $rp, number_format($sisa, 0, ".", "."); ?></td>
                    <td>
                      <a data-rel="tooltip" title="View Detail" class="blue" href="?id=report-income-ex&mod=detail-kasbon&id_n=<?php echo $row['id_kasbon'];?>"><span class="fa fa-list"></span></a>  
                    </td>
                  </tr>
                  <?php $no++; } ?>
                </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>PTJB <small>Detail Terpakai</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="dataTables" class="table table-striped table-bordered table-responsive dt-responsive nowrap table-hover">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Tanggal Kasbon</th>
                    <th>ID WO</th>
                    <th>ID SO</th>
                    <th>Total Terpakai</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                     
                    $no = 1;
                    $res = $con->query("SELECT * FROM tbl_ptjb join tbl_amount on tbl_amount.kode_amount_ptjb = tbl_ptjb.kode_amount_ptjb where wo_id = '$p_id_wo' AND so_id = '$p_id_so'");
                    while($row = $res->fetch_assoc()){
                      $rp = "Rp. ";
                      $total = $row['amount1'] + $row['amount2'] + $row['amount3'] + $row['amount4'] + $row['amount5'] + $row['amount6'] + $row['amount7'] + $row['amount8'] + $row['amount9'] + $row['amount10'];
                  ?>

                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $row['date_now']; ?></td>
                    <td><?php echo $row['wo_id']; ?></td>
                    <td><?php echo $row['so_id']; ?></td>
                    <td><?php echo $rp, number_format($total, 0, ".", "."); ?></td>
                    <td>
                      <a data-rel="tooltip" title="View Detail" class="blue" href="?id=report-income-ex&mod=detail-ptjb&id_n=<?php echo $row['id_ptjb'];?>"><span class="fa fa-list"></a>  
                    </td>
                  </tr>
                  <?php $no++; } ?>
                </tbody>
                </table>
              </div>
            </div>
          </div>
          <br>
          <a href="?id=report-income-ex&mod=search"><button type="button" class="btn btn-primary">BACK</button></a>
          </form>
          </div>
        </div>
      </div>
      <?php
        } elseif ($mod == 'detail-kasbon') {
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
                  <div class=" setup-panel">
                  <form style="font-size: 15px;" class="form-horizontal" action="?id=report-income-ex&mod=view" method="post"  role="form">

                  <table class="table table-striped table-responsive" >
                    <tr>
                      <th style="text-align: left; width: 20%;">Nama Teknisi</th>
                      <td style="text-align: left; width: 5%;">:</td>
                      <td style="text-align: left; width: 75%;"><?php echo $k_nama; ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: left; width: 20%;">Tanggal Kasbon</th>
                      <td style="text-align: left; width: 5%;">:</td>
                      <td style="text-align: left; width: 75%;"><?php echo $k_tgl; ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: left; width: 20%;">WO ID</th>
                      <td style="text-align: left; width: 5%;">:</td>
                      <td style="text-align: left; width: 75%;"><?php echo $k_wo; ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: left; width: 20%;">SO ID</th>
                      <td style="text-align: left; width: 5%;">:</td>
                      <td style="text-align: left; width: 75%;"><?php echo $k_so; ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: left; width: 20%;">Jumlah Income</th>
                      <td style="text-align: left; width: 5%;">:</td>
                      <td style="text-align: left; width: 75%;"><?php echo $rp, number_format($k_price, 0, ".", "."); ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: left; width: 20%;">Persen Terpakai</th>
                      <td style="text-align: left; width: 5%;">:</td>
                      <td style="text-align: left; width: 75%;"><?php echo $kpersen."%"; ?></td>
                    </tr>
                  </table>
                  <hr>
                  <table class="table table-striped table-responsive" >
                    <tr>
                      <th style="width: 50%;"><h3>Keterangan</h3></th>
                      <th><h3>Amount</h3></th>
                    </tr>

                    <tr>
                      <td>Saldo Awal</td>
                      <td><?php echo $rp, number_format($k_jmlh, 0, ".", "."); ?></td>
                    </tr>

                    <tr>
                      <td><?php echo $k_ket1; ?></td>
                      <td><?php echo $rp, number_format($k_amount1, 0, ".", "."); ?></td>
                    </tr>

                    <tr>
                      <td><?php echo $k_ket2; ?></td>
                      <td><?php echo $rp, number_format($k_amount2, 0, ".", "."); ?></td>
                    </tr>

                    <tr>
                      <td><?php echo $k_ket3; ?></td>
                      <td><?php echo $rp, number_format($k_amount3, 0, ".", "."); ?></td>
                    </tr>

                    <tr>
                      <td><?php echo $k_ket4; ?></td>
                      <td><?php echo $rp, number_format($k_amount4, 0, ".", "."); ?></td>
                    </tr>

                    <tr>
                      <td><?php echo $k_ket5; ?></td>
                      <td><?php echo $rp, number_format($k_amount5, 0, ".", "."); ?></td>
                    </tr>

                    <tr>
                      <td><?php echo $k_ket6; ?></td>
                      <td><?php echo $rp, number_format($k_amount6, 0, ".", "."); ?></td>
                    </tr>

                    <tr>
                      <td><?php echo $k_ket7; ?></td>
                      <td><?php echo $rp, number_format($k_amount7, 0, ".", "."); ?></td>
                    </tr>

                    <tr>
                      <td><?php echo $k_ket8; ?></td>
                      <td><?php echo $rp, number_format($k_amount8, 0, ".", "."); ?></td>
                    </tr>

                    <tr>
                      <td><?php echo $k_ket9; ?></td>
                      <td><?php echo $rp, number_format($k_amount9, 0, ".", "."); ?></td>
                    </tr>

                    <tr>
                      <td><?php echo $k_ket10; ?></td>
                      <td><?php echo $rp, number_format($k_amount10, 0, ".", "."); ?></td>
                    </tr>

                    <tr>
                      <th style="font-size: 20px;"><b>Sisa Uang Kasbon</b></th>
                      <td style="font-size: 20px;"><b><?php echo $rp, number_format($k_sisa, 0, ".", "."); ?></b></td>
                    </tr>
                  </table>
                  
                  <div class="panel-body">
                    <div class="form-group">
                      <div class="col-xs-6 col-lg-6">
                        <input type="hidden" name="wo" class="form-control" value="<?php echo $k_wo; ?>">
                        <input type="hidden" name="so" class="form-control" value="<?php echo $k_so; ?>">
                      </div>
                    </div>
                    <input type="submit" name="kirim_daftar" class="btn btn-primary pull-left" value="BACK">
                  </div>

                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
        } elseif ($mod == 'detail-ptjb') {
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
                  <div class=" setup-panel">
                  <form style="font-size: 15px;" class="form-horizontal" action="?id=report-income-ex&mod=view" method="post"  role="form">

                  <table class="table table-striped table-responsive" >
                    <tr>
                      <th style="text-align: left; width: 20%;">Nama Teknisi</th>
                      <td style="text-align: left; width: 5%;">:</td>
                      <td style="text-align: left; width: 75%;"><?php echo $p_nama; ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: left; width: 20%;">Tanggal Kasbon</th>
                      <td style="text-align: left; width: 5%;">:</td>
                      <td style="text-align: left; width: 75%;"><?php echo $p_tgl; ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: left; width: 20%;">WO ID</th>
                      <td style="text-align: left; width: 5%;">:</td>
                      <td style="text-align: left; width: 75%;"><?php echo $p_wo; ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: left; width: 20%;">SO ID</th>
                      <td style="text-align: left; width: 5%;">:</td>
                      <td style="text-align: left; width: 75%;"><?php echo $p_so; ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: left; width: 20%;">Jumlah Income</th>
                      <td style="text-align: left; width: 5%;">:</td>
                      <td style="text-align: left; width: 75%;"><?php echo $rp, number_format($p_price, 0, ".", "."); ?></td>
                    </tr>

                    <tr>
                      <th style="text-align: left; width: 20%;">Persen Terpakai</th>
                      <td style="text-align: left; width: 5%;">:</td>
                      <td style="text-align: left; width: 75%;"><?php echo $persen."%"; ?></td>
                    </tr>
                  </table>
                  <hr>
                  <table class="table table-striped table-responsive" >
                    <tr>
                      <th style="width: 50%;"><h3>Keterangan</h3></th>
                      <th><h3>Amount</h3></th>
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
                      <th style="font-size: 20px;"><b>Total</b></th>
                      <td style="font-size: 20px;"><b><?php echo $rp, number_format($p_total, 0, ".", "."); ?></b></td>
                    </tr>
                  </table>
                  
                  <div class="panel-body">
                    <div class="form-group">
                      <div class="col-xs-6 col-lg-6">
                        <input type="hidden" name="wo" class="form-control" value="<?php echo $p_wo; ?>">
                        <input type="hidden" name="so" class="form-control" value="<?php echo $p_so; ?>">
                      </div>
                    </div>
                    <input type="submit" name="kirim_daftar" class="btn btn-primary pull-left" value="BACK">
                  </div>

                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
        }
      ?>
    </div>
  </div>
</div>