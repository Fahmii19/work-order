<?php 
  include('config/koneksi.php');

  // harap include SESSION <?php include('session.php'); //

  $mod         = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $id_daftar   = isset($_GET['id_n']) ? $_GET['id_n'] : "";
  $p_tombol    = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
  $p_id_daftar = isset($_POST['id_daftar']) ? $_POST['id_daftar'] : "";
  $p_bulan     = isset($_POST['bulan']) ? $_POST['bulan'] : "";
  $p_tahun     = isset($_POST['tahun']) ? $_POST['tahun'] : "";

  if ($mod == "view") {

    $cekdulu = "SELECT * FROM tbl_income WHERE year(waktu_input) = $p_tahun AND month(waktu_input) = $p_bulan"; 
    $prosescek = mysqli_query($con, $cekdulu);
    if (mysqli_num_rows($prosescek) > 0) { 
      $sql = mysqli_query($con, "SELECT * FROM tbl_income where year(waktu_input) = $p_tahun AND month(waktu_input) = $p_bulan");
     while ($row = $sql->fetch_assoc()) {
      $r_id_wo    = $row['wo_id'];
      $r_id_so    = $row['so_id'];
      $r_price[]  = $row['price'];
    }

      $price      = array_sum($r_price);

      $sql2 = mysqli_query($con, "SELECT * FROM tbl_kasbon join tbl_amount_kasbon on tbl_amount_kasbon.kode_amount = tbl_kasbon.kode_amount WHERE year(tbl_kasbon.tgl_input) = '$p_tahun' AND month(tbl_kasbon.tgl_input) = '$p_bulan' ");
      while ($row2 = $sql2->fetch_assoc()) {
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
      $k_amo10[]   = $row2['sisa_amount'];
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

      $sql3 = mysqli_query($con, "SELECT * FROM tbl_ptjb join tbl_amount on tbl_amount.kode_amount_ptjb = tbl_ptjb.kode_amount_ptjb WHERE year(tbl_ptjb.tgl_input) = '$p_tahun' AND month(tbl_ptjb.tgl_input) = '$p_bulan' ");
      while ($row3 = $sql3->fetch_assoc()) {
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
      $terpakai  = $terpakai1 + $terpakai2;
      $sisa      = $price - $terpakai;
      
    }
  }

    $rp = "Rp. ";

?>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
    <h2>Summary Benefit <small>Benefit per-Bulan</small></h2>
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
      <form class="form-horizontal" action="?id=summary-benefit&mod=view" method="post"  role="form">
        <input type="hidden" name="id_daftar" value="<?php echo $id_daftar; ?>">
        <div class="panel panel-primary setup-content">
          <div class="panel-heading">
          <h3 class="panel-title">Lihat Benefit per-Bulan</h3>
          </div>
          <div class="panel-body">
            <div class="form-group">
              <div class="col-xs-12 col-lg-6">
                <label for="wo">Bulan</label>
                <select class="form-control" name="bulan" required>
                  <option value="" hidden>Pilih Bulan</option>
                  <option value="01" >Januari</option>
                  <option value="02" >Februari</option>
                  <option value="03" >Maret</option>
                  <option value="04" >April</option>
                  <option value="05" >Mei</option>
                  <option value="06" >Juni</option>
                  <option value="07" >Juli</option>
                  <option value="08" >Agustus</option>
                  <option value="09" >September</option>
                  <option value="10" >Oktober</option>
                  <option value="11" >November</option>
                  <option value="12" >Desember</option>
                </select>
              </div>
              <div class="col-xs-12 col-lg-6">
                <label for="wo">Tahun</label>
                <select name="tahun" class="form-control" required>
                    <option value="" hidden>Pilih Tahun</option>
                    <?php
                    $thn_skr = date('Y');
                    for ($x = $thn_skr; $x >= 2010; $x--) {
                    ?>
                        <option value="<?php echo $x ?>"><?php echo $x ?></option>
                    <?php
                    }
                    ?>
                </select>
              </div>
            </div>
            <hr>
            <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="SUBMIT">
          </div>
        </div>                          
      </form>
      <?php 
        } elseif ($mod == 'view') {

          if ($p_bulan == "01") {
            $bulan = "Januari";
          } elseif ($p_bulan == "02") {
            $bulan = "Februari";
          } elseif ($p_bulan == "03") {
            $bulan = "Maret";
          } elseif ($p_bulan == "04") {
            $bulan = "April";
          } elseif ($p_bulan == "05") {
            $bulan = "Mei";
          } elseif ($p_bulan == "06") {
            $bulan = "Juni";
          } elseif ($p_bulan == "07") {
            $bulan = "Juli";
          } elseif ($p_bulan == "08") {
            $bulan = "Agustus";
          } elseif ($p_bulan == "09") {
            $bulan = "September";
          } elseif ($p_bulan == "10") {
            $bulan = "Oktober";
          } elseif ($p_bulan == "11") {
            $bulan = "November";
          } elseif ($p_bulan == "12") {
            $bulan = "Desember";
          } else {
            echo "Bulan Kosong";
          }

      ?>
      <div class="container">
        <div class="stepwizard">
          <div class="setup-panel">
          <form style="font-size: 15px;  ">

          <h3><b>Income : <?php echo $bulan." ".$p_tahun; ?></b></h3><hr>

          <table class="table table-striped table-responsive" >

            <tr>
              <th style="text-align: left; width: 20%;">Total Income</th>
              <td style="text-align: left; width: 5%;">:</td>
              <td style="text-align: left; width: 75%;"><?php echo $rp, number_format($price, 0, ".", "."); ?></td>
            </tr>

            <tr>
              <th style="text-align: left; width: 20%;">Total Kasbon</th>
              <td style="text-align: left; width: 5%;">:</td>
              <td style="text-align: left; width: 75%;"><?php echo $rp, number_format($terpakai1, 0, ".", "."); ?></td>
            </tr>

            <tr>
              <th style="text-align: left; width: 20%;">Total PTJB</th>
              <td style="text-align: left; width: 5%;">:</td>
              <td style="text-align: left; width: 75%;"><?php echo $rp, number_format($terpakai2, 0, ".", "."); ?></td>
            </tr>

            <tr>
              <th style="text-align: left; width: 20%;">Total Pendapatan Bersih</th>
              <td style="text-align: left; width: 5%;">:</td>
              <td style="text-align: left; width: 75%;"><?php echo $rp, number_format($sisa, 0, ".", "."); ?></td>
            </tr>

          </table>
          <hr>
        </form>
        </div>
      </div>
    </div>
      <?php
        }
      ?>
    </div>
  </div>
</div>