<?php 
  error_reporting(0);

  include('config/koneksi.php');

  $mod      = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $id_del     = isset($_GET['id_n']) ? $_GET['id_n'] : NULL;

  $p_bulan     = isset($_POST['bulan']) ? $_POST['bulan'] : "";
  $p_tahun     = isset($_POST['tahun']) ? $_POST['tahun'] : "";
  $p_nama     = isset($_POST['nama']) ? $_POST['nama'] : "";

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
                    <form method="post" action="report/excel-technician-performance.php">
                        <input type="hidden" name="bulan" value="<?php echo $p_bulan ?>">
                        <input type="hidden" name="tahun" value="<?php echo $p_tahun ?>">
                        <input type="hidden" name="nama" value="<?php echo $p_nama ?>">
                        <input type="submit" name="kirim_daftar" class="btn btn-primary" value="EXPORT">
                    </form>
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
                          <th>Nama</th>
                          <th>Project Name</th>
                          <th>Tanggal Project</th>
                          <th>WO ID</th>
                          <th>SO</th>
                          <th>Customer</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        
                      <?php
                        $no = 1;
                        $res = $con->query("SELECT teknisi1,teknisi2,teknisi3,teknisi4,('$p_nama') AS teknisi,tbl_teknisi_wo.*,tbl_project_wo.* FROM tbl_project_wo JOIN tbl_teknisi_wo ON tbl_teknisi_wo.kode_teknisi=tbl_project_wo.kode_teknisi  JOIN tbl_schedule_wo ON tbl_project_wo.kode_jadwal = tbl_schedule_wo.kode_jadwal WHERE MONTH(tbl_project_wo.tgl_project) = '$p_bulan' AND YEAR(tbl_project_wo.tgl_project) = '$p_tahun' AND (tbl_teknisi_wo.teknisi1 = '$p_nama' OR tbl_teknisi_wo.teknisi2 = '$p_nama' OR tbl_teknisi_wo.teknisi3 = '$p_nama' OR tbl_teknisi_wo.teknisi4 = '$p_nama')")or die(mysqli_error($con));
                        while($row = $res->fetch_assoc()){
                      ?>

                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $row['teknisi']; ?></td>
                          <td><?php echo $row['project_title']; ?></td>
                          <td><?php echo $row['tgl_project']; ?></td>
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
      
                