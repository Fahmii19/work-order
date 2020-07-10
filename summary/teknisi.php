<?php 
  include('config/koneksi.php');
  include('fungsi_indotgl.php');

  // harap include SESSION <?php include('session.php'); //

  $mod         = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $id_daftar   = isset($_GET['id_n']) ? $_GET['id_n'] : "";
  $p_tombol    = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
  $p_id_daftar = isset($_POST['id_daftar']) ? $_POST['id_daftar'] : "";
  $p_nama      = isset($_POST['nama']) ? $_POST['nama'] : "";
  $p_bulan     = isset($_POST['bulan']) ? $_POST['bulan'] : "";
  $p_tahun     = isset($_POST['tahun']) ? $_POST['tahun'] : "";

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
        }

?>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
    <h2>Summary Teknisi <small>Daftar Pekerjaan Teknisi</small></h2>
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
      <form class="form-horizontal" action="?id=summary-teknisi&mod=view" method="post"  role="form">
        <input type="hidden" name="id_daftar" value="<?php echo $id_daftar; ?>">
        <div class="panel panel-primary setup-content">
          <div class="panel-heading">
            <h3 class="panel-title">Lihat Daftar Pekerjaan Teknisi</h3>
          </div>
          <div class="panel-body">
            <div class="form-group">
              <div class="col-xs-12 col-lg-4">
                <label>Nama Teknisi</label>
                <input type="text" name="nama" class="form-control" id="nama" required>
              </div>
              <div class="col-xs-12 col-lg-4">
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
              <div class="col-xs-12 col-lg-4">
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

          $cekdulu = "SELECT * FROM tbl_project_wo JOIN tbl_teknisi_wo on tbl_project_wo.kode_teknisi = tbl_teknisi_wo.kode_teknisi JOIN tbl_schedule_wo ON tbl_project_wo.kode_jadwal = tbl_schedule_wo.kode_jadwal WHERE  MONTH(tgl) = '$p_bulan' AND YEAR(tgl) = '$p_tahun' AND tbl_teknisi_wo.teknisi1 = '$p_nama' || tbl_teknisi_wo.teknisi2 = '$p_nama' || tbl_teknisi_wo.teknisi3 = '$p_nama' || tbl_teknisi_wo.teknisi4 = '$p_nama' || tbl_teknisi_wo.pkl1 = '$p_nama' || tbl_teknisi_wo.pkl2 = '$p_nama' || tbl_teknisi_wo.pkl3 = '$p_nama'"; 
          $prosescek = mysqli_query($con, $cekdulu);
          if (mysqli_num_rows($prosescek) > 0) {

      ?>
      <div class="container">
        <div class="stepwizard">
          <div class="setup-panel">
          <h3><b>Nama Teknisi :
                                <?php echo $p_nama; ?></b></h3>
                        <h4><b>Bulan       :
                                <?php echo $bulan , " ", $p_tahun; ?></b></h4> <a href="report/excel-summaryteknisi.php?nama=<?= $p_nama ?>&bulan=<?=$p_bulan?>&tahun=<?= $p_tahun?>" class="btn btn-primary pull-right">EXPORT</a>
                        <br>
                        <hr>
                        <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered table-responsive dt-responsive nowrap table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>ID WO</th>
                                        <th>ID SO</th>
                                        <th>Project</th>
                                        <th>Tgl Project</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                      $no = 1;
                                       $sql = mysqli_query($con, "SELECT * FROM tbl_project_wo JOIN tbl_teknisi_wo on tbl_project_wo.kode_teknisi = tbl_teknisi_wo.kode_teknisi JOIN tbl_schedule_wo ON tbl_project_wo.kode_jadwal = tbl_schedule_wo.kode_jadwal WHERE (tbl_teknisi_wo.teknisi1 = '$p_nama' || tbl_teknisi_wo.teknisi2 = '$p_nama' || tbl_teknisi_wo.teknisi3 = '$p_nama' || tbl_teknisi_wo.teknisi4 = '$p_nama' || tbl_teknisi_wo.pkl1 = '$p_nama' || tbl_teknisi_wo.pkl2 = '$p_nama' || tbl_teknisi_wo.pkl3 = '$p_nama') AND (MONTH(tbl_schedule_wo.tgl) = '$p_bulan' AND YEAR(tbl_schedule_wo.tgl) = '$p_tahun')");
                                       while ($row = $sql->fetch_assoc()) {
                                        $wo_id   = $row['wo_id'];
                                        $so_id   = $row['so_id'];
                                        $project = $row['project_title'];
                                        $jadwal  = $row['tgl'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $no; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['wo_id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['so_id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['project_title']; ?>
                                        </td>
                                        <td>
                                            <?php echo bln_indo($row['tgl']); ?>
                                        </td>
                                        <td>
                                            <?php
                                              $cek = "SELECT * FROM tbl_income where wo_id = '$wo_id'"; 
                                              $proscek = mysqli_query($con, $cek);
                                              if (mysqli_num_rows($proscek) > 0) { 
                                                $res = mysqli_query($con, "SELECT * FROM tbl_income where wo_id = '$wo_id'");
                                                $rows      = mysqli_fetch_assoc($res);
                                                $price[]   = $rows['price'];
                                                $amount_price = array_sum($price);
                                                $amount    = $rows['price'];
                                                $rp        = "Rp. ";

                                                echo $rp, number_format($amount, "0", ".", ".");
                                              } else {
                                                echo "Rp. 0";
                                              }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php $no++; } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5">
                                            <h3>Total Amount : </h3>
                                        </th>
                                        <th colspan="2">
                                            <h4>
                                                <?php echo $rp, number_format($amount_price, 0, ".", "."); ?>
                                            </h4>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
        </div>
      </div>
    </div>
      <?php
          }
        }
      ?>
    </div>
  </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- <script>
    $(document).ready(function() {
     $('#example').DataTable( {
          "bProcessing": true,
          "bServerSide": true,
          "ajax": "serverside/response.php?view=income-wo?wo_id=<?= $p_id_wo ?>",
          "language": {                
            "infoFiltered": ""
          }
      } );
  } );