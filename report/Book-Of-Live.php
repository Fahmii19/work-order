<?php 
    include('../fungsi_indotgl.php');

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
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Book Of Life - ". $bulan. " ".$p_tahun.".xls");
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
	<span style="margin-left: 20px;font-size: 20px;"><b>BOOK OF LIVE</b></span>
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
      <th>TANGGAL</th>
      <th>PROJECT</th>
      <th>CUSTOMER</th>
      <th>IDWO</th>
      <th>SO</th>
      <th>PIC INDOSAT</th>
      <th>LOCATION</th>
      <th>TECHNICIAN</th>
      <th>KETERANGAN</th>
      <th>STATUS</th>
      <th>CID</th>
      <th>Harga</th>
      <th>NO BOQ</th>
      <th>NO BA</th>
      <th>NO PB</th>
      <th>NO PO</th>
      <th>NO INVOICE</th>
      <th>PAID</th>
      <th>TGL INV</th>
      <th>FINAL STATUS</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if(isset($_POST['kirim_daftar'])) {
        $p_bulan     = isset($_POST['bulan']) ? $_POST['bulan'] : "";
        $p_tahun     = isset($_POST['tahun']) ? $_POST['tahun'] : "";

        
        include('../config/koneksi.php');

        $no = 1;
        $res = $con->query("SELECT * FROM tbl_project_wo JOIN tbl_schedule_wo ON tbl_project_wo.kode_jadwal = tbl_schedule_wo.kode_jadwal JOIN tbl_teknisi_wo ON tbl_project_wo.kode_teknisi = tbl_teknisi_wo.kode_teknisi JOIN tbl_income ON tbl_project_wo.wo_id = tbl_income.wo_id JOIN tbl_kode_income ON tbl_kode_income.kd_income  =tbl_income.kd_income JOIN tbl_income_detail ON tbl_kode_income.kd_detail = tbl_income_detail.kd_detail WHERE month(tgl_project) = '$p_bulan' AND year(tgl_project) = '$p_tahun'");
        while($row = $res->fetch_assoc()){
          $rp = "Rp. ";
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo tgl_indo($row['tgl_project']); ?></td>
      <td><?php echo $row['project_title']; ?></td>
      <td><?php echo $row['customer']; ?></td>
      <td><?php echo $row['wo_id']; ?></td>
      <td><?php echo $row['so_id']; ?></td>
      <td><?php echo $row['pic']; ?></td>
      <td><?php echo $row['lokasi']; ?></td>
      <td><?php echo $row['teknisi1'], ", ", $row['teknisi2'], ", ", $row['teknisi3'], ", ", $row['teknisi4'], ", ", $row['pkl1'], ", ", $row['pkl2'], ", ", $row['pkl3'], ", "; ?> </td>
      <td></td>
      <td></td>
      <td></td>
      <td><?php echo $rp, number_format($row['price'], 0, ".", "."); ?></td>
      <td><?php echo $row['no_boq']; ?></td>
      <td><?php echo $row['no_ba']; ?></td>
      <td><?php echo $row['no_pb']; ?></td>
      <td><?php echo $row['po_no']; ?></td>
      <td><?php echo $row['inv_no']; ?></td>
      <td><?php echo $row['pay_stat']; ?></td>
      <td><?php echo tgl_indo($row['pay_date']); ?></td>
      <td></td>
    </tr>
    <?php
        $no++;
      }
    }
  ?>
  </tbody>
</table>