<?php 
  include('config/koneksi.php');

  // harap include SESSION <?php include('session.php'); //

  $mod         = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $id_daftar   = isset($_GET['id_n']) ? $_GET['id_n'] : "";
  $p_tombol    = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
  $p_id_daftar = isset($_POST['id_daftar']) ? $_POST['id_daftar'] : "";  
  $p_nama      = isset($_POST['nama']) ? $_POST['nama'] : "";

  if ($mod == "view") {
    $cekdulu = "SELECT * FROM tbl_kasbon WHERE nama like '%".$p_nama."%'"; 
    $prosescek = mysqli_query($con, $cekdulu);
    if (mysqli_num_rows($prosescek) > 0) { 
      $sql = mysqli_query($con, "SELECT * FROM tbl_kasbon join tbl_amount_kasbon on tbl_amount_kasbon.kode_amount = tbl_kasbon.kode_amount WHERE nama = '$p_nama'");
      while ($row = mysqli_fetch_array($sql)) {
      $r_nama     = $row['nama'];
      $r_jmlh[]   = $row['jmlh_amount'];
      $r_amo1[]   = $row['amount1'];
      $r_amo2[]   = $row['amount2'];
      $r_amo3[]   = $row['amount3'];
      $r_amo4[]   = $row['amount4'];
      $r_amo5[]   = $row['amount5'];
      $r_amo6[]   = $row['amount6'];
      $r_amo7[]   = $row['amount7'];
      $r_amo8[]   = $row['amount8'];
      $r_amo9[]   = $row['amount9'];
      $r_amo10[]   = $row['amount10'];
      }

      $jmlh       = array_sum($r_jmlh);
      $amo1       = array_sum($r_amo1);
      $amo2       = array_sum($r_amo2);
      $amo3       = array_sum($r_amo3);
      $amo4       = array_sum($r_amo4);
      $amo5       = array_sum($r_amo5);
      $amo6       = array_sum($r_amo6);
      $amo7       = array_sum($r_amo7);
      $amo8       = array_sum($r_amo8);
      $amo9       = array_sum($r_amo9);
      $amo10       = array_sum($r_amo10);

      $terpakai = $amo1 + $amo2 + $amo3 + $amo4 + $amo5 + $amo6 + $amo7 + $amo8 + $amo9 + $amo10;
      $sisa = $jmlh - $terpakai;

    } else {
      echo "<script>alert('Nama Tidak Terdaftar'); history.go(-1) </script>";
    }

  } elseif ($mod == "detail") {
     $p_tampil     = mysqli_query($con, "SELECT * FROM tbl_kasbon join tbl_amount_kasbon on tbl_amount_kasbon.kode_amount = tbl_kasbon.kode_amount WHERE id_kasbon = '$id_daftar'");
      $p_lihat      = mysqli_fetch_array($p_tampil);
      $id_daftar    = $p_lihat['id_kasbon'];
      $p_tgl        = $p_lihat['tgl_input'];  
      $p_nama       = $p_lihat['nama'];     
      $p_wo         = $p_lihat['wo_id'];      
      $p_so         = $p_lihat['so_id'];  
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

      $p_tampil2     = mysqli_query($con, "SELECT * FROM tbl_income join tbl_kasbon on tbl_kasbon.wo_id = tbl_income.wo_id WHERE id_kasbon = '$id_daftar'");
      $p_lihat2      = mysqli_fetch_array($p_tampil2);
      $id_daftar2    = $p_lihat2['id_kasbon'];
      $p_wo2         = $p_lihat2['wo_id'];  
      $p_price       = $p_lihat2['price'];  

    }

    $p_total = $p_amount1 + $p_amount2 + $p_amount3 + $p_amount4 + $p_amount5 + $p_amount6 + $p_amount7 + $p_amount8 + $p_amount9 + $p_amount10;
    $p_sisa =  $p_jmlh - $p_total;

    $persen = $p_total/$p_price*100;

    $rp = "Rp. ";

?>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
    <h2>Kasbon Teknisi <small>Laporan Pengeluaran Teknisi</small></h2>
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
      <form class="form-horizontal" action="?id=report-technician1&mod=view" method="post"  role="form">
        <input type="hidden" name="id_daftar" value="<?php echo $id_daftar; ?>">
        <div class="panel panel-primary setup-content">
          <div class="panel-heading">
          <h3 class="panel-title">Search Nama Teknisi</h3>
          </div>
          <div class="panel-body">
            <div class="form-group">
              <div class="col-xs-12 col-lg-12">
                <label for="wo">Nama Teknisi</label>
                <input type="text" name="nama" class="form-control" id="pegawai" required>
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

          <h3><b>Laporan Kasbon : <?php echo $r_nama; ?></b></h3><hr>

          <table class="table table-striped table-responsive" >
            <tr>
              <th style="text-align: left; width: 20%;">Nama Teknisi</th>
              <td style="text-align: left; width: 5%;">:</td>
              <td style="text-align: left; width: 75%;"><?php echo $r_nama; ?></td>
            </tr>

            <tr>
              <th style="text-align: left; width: 20%;">Total Kasbon</th>
              <td style="text-align: left; width: 5%;">:</td>
              <td style="text-align: left; width: 75%;"><?php echo $rp, number_format($jmlh, 0, ".", "."); ?></td>
            </tr>

            <tr>
              <th style="text-align: left; width: 20%;">Total Terpakai</th>
              <td style="text-align: left; width: 5%;">:</td>
              <td style="text-align: left; width: 75%;"><?php echo $rp, number_format($terpakai, 0, ".", "."); ?></td>
            </tr>

            <tr>
              <th style="text-align: left; width: 20%;">Total Sisa</th>
              <td style="text-align: left; width: 5%;">:</td>
              <td style="text-align: left; width: 75%;"><?php echo $rp, number_format($sisa, 0, ".", "."); ?></td>
            </tr>
          </table>
          <hr>
          <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered table-responsive dt-responsive nowrap table-hover">
            <thead>
              <tr>
                <th>No.</th>
                <th>Tanggal Kasbon</th>
                <th>ID WO</th>
                <th>ID SO</th>
                <th>Saldo Awal</th>
                <th>Total Terpakai</th>
                <th>Sisa Kasbon</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              <?php
                
                $no = 1;
                $res = $con->query("SELECT * FROM tbl_kasbon join tbl_amount_kasbon on tbl_amount_kasbon.kode_amount = tbl_kasbon.kode_amount where nama = '$p_nama'");
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
                  <a data-rel="tooltip" title="View Detail" class="blue" href="?id=report-technician1&mod=detail&id_n=<?php echo $row['id_kasbon'];?>"><span class="fa fa-list"></a>  
                </td>
              </tr>
              <?php $no++; } ?>
            </tbody>
          </table>
          </div>
          <a href="?id=report-technician1&mod=search"><button type="button" class="btn btn-primary">BACK</button></a>
          </form>
          </div>
        </div>
      </div>
      <?php
        } elseif ($mod == 'detail') {
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
                  <form style="font-size: 15px;" class="form-horizontal" action="?id=report-technician1&mod=view" method="post"  role="form">

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
                      <td style="font-size: 20px;"><b><?php echo $rp, number_format($p_sisa, 0, ".", "."); ?></b></td>
                    </tr>
                  </table>
                  
                  <div class="panel-body">
                    <div class="form-group">
                      <div class="col-xs-6 col-lg-6">
                        <input type="hidden" name="nama" class="form-control" value="<?php echo $p_nama; ?>">
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