<?php 
  error_reporting(0);

  include('config/koneksi.php');

  $mod      = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $id_del     = isset($_GET['id_n']) ? $_GET['id_n'] : NULL;

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
          echo "Bulan Kosong";
        }
?>

<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Income List <small>Project Order</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <table id="datatable-buttons" class="table table-striped table-bordered table-responsive table-hover">
                      <thead>
                        <tr>
                          <th>NO</th>
                          <th>Project Name</th>
                          <th>WO ID</th>
                          <th>SO</th>
                          <th>Customer</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        
                      <?php
                        $no = 1;
                        $res = $con->query("SELECT * FROM tbl_project_wo JOIN tbl_schedule_wo ON tbl_project_wo.kode_jadwal = tbl_schedule_wo.kode_jadwal JOIN tbl_teknisi_wo ON tbl_project_wo.kode_teknisi = tbl_teknisi_wo.kode_teknisi JOIN tbl_income ON tbl_project_wo.wo_id = tbl_income.wo_id JOIN tbl_kode_income ON tbl_income.kd_income = tbl_kode_income.kd_income JOIN tbl_income_detail ON tbl_kode_income.kd_detail = tbl_income_detail.kd_detail WHERE tbl_income.price = '0' OR tbl_income.price = '' AND month(tbl_income.waktu_input) = '$p_bulan' AND year(tbl_income.waktu_input) = '$p_tahun' ");
                        while($row = $res->fetch_assoc()){
                          $ba = $row['no_ba'];
                          $sql = $con->query("SELECT * FROM tbl_income where no_ba = '$ba'");
                          while($data = $sql->fetch_assoc()){
                            $rp = "Rp. ";
                            $price[] = $data['price'];
                            $nominal[] = $data['price'];
                            $amount = array_sum($price);
                            $p_nominal = array_sum($nominal);
                          }
                      ?>

                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $row['project_title']; ?></td>
                          <td><?php echo $row['wo_id']; ?></td>
                          <td><?php echo $row['so_id']; ?></td>
                          <td><?php echo $row['customer']; ?></td>
                          <td>
                            <a data-rel="tooltip" title="View Detail" class="blue" href="?id=view-wo-no-income&mod=view&id_n=<?php echo $row['id_income'];?>">
                              <span class="fa fa-list">
                            </a>
                          </td>
                        </tr>
                    <?php $no++; } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
      
                