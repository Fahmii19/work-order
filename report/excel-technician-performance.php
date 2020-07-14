<?php 
    include('../fungsi_indotgl.php');

    $p_bulan     = isset($_POST['bulan']) ? $_POST['bulan'] : "";
    $p_tahun     = isset($_POST['tahun']) ? $_POST['tahun'] : "";
    $p_nama      = isset($_POST['nama']) ? $_POST['nama'] : "";
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
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Report Technician Performance - ". $bulan. " ".$p_tahun.".xls");
?>
<style type="text/css">
  table,th,td{
    border-collapse: collapse;
    padding: 15px;
    margin: 10px;
    color: #000;
    font-size: 16px;
  }
</style>
<div style="text-align: center;">
	<br>
	<span style="margin-left: 20px;font-size: 20px;"><b>REPORT TECHNICIAN PERFORMANCE</b></span>
</div>
<div style="text-align: center;">
  <span style="margin-left: 20px;font-size: 20px;"><b>PT. LUMBUNG RIANG COMMUNICATION</b></span>
</div>
<div style="text-align: center;">
  <span style="margin-left: 20px;font-size: 20px;"><b>PERIODE <?php echo $bulan," ", $p_tahun; ?></b></span>
</div><br>
<table border="1">
  <thead>
    <tr>
      <th>NO</th>
      <th>NAMA</th>
      <th>PROJECT NAME</th>
      <th>TANGGAL PROJECT</th>
      <th>WO ID</th>
      <th>SO ID</th>
      <th>CUSTOMER</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if(isset($_POST['kirim_daftar'])) {
        $p_bulan     = isset($_POST['bulan']) ? $_POST['bulan'] : "";
        $p_tahun     = isset($_POST['tahun']) ? $_POST['tahun'] : "";
        $p_nama      = isset($_POST['nama']) ? $_POST['nama'] : "";
        
        include('../config/koneksi.php');

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
    </tr>
    <?php
        $no++;
      }
    }
  ?>
  </tbody>
</table>