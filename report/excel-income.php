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
  header("Content-Disposition: attachment; filename=Report Income - ". $bulan. " ".$p_tahun.".xls");
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
	<span style="margin-left: 20px;font-size: 20px;"><b>REPORT INCOME</b></span>
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
      <th>WO ID</th>
      <th>SO</th>
      <th>NO BA</th>
      <th>NO BOQ</th>
      <th>TGL BA</th>
      <th>DESKRIPSI</th>
      <th>PM</th>
      <th>PRICE</th>
      <th>VERIFIKASI</th>
      <th>NO PB</th>
      <th>PB DATE</th>
      <th>HANDOVER / SC</th>
      <th>PO NO</th>
      <th>NO INVOICE</th>
      <th>PAYMENT STATUS</th>
      <th>PAYMENT DATE</th>
      <th>FINAL STATUS</th>
      <th>NOTES</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if(isset($_POST['kirim_daftar'])) {
        $p_bulan     = isset($_POST['bulan']) ? $_POST['bulan'] : "";
        $p_tahun     = isset($_POST['tahun']) ? $_POST['tahun'] : "";

        
        include('../config/koneksi.php');

        $no = 1;
        $res = $con->query("SELECT * FROM tbl_project_wo JOIN tbl_income ON tbl_project_wo.wo_id = tbl_income.wo_id JOIN tbl_kode_income ON tbl_kode_income.kd_income  =tbl_income.kd_income JOIN tbl_income_detail ON tbl_kode_income.kd_detail = tbl_income_detail.kd_detail WHERE month(tbl_income.waktu_input) = '$p_bulan' AND year(tbl_income.waktu_input) = '$p_tahun'");
        while($row = $res->fetch_assoc()){
          $rp = "Rp. ";
          $ba = $row['no_ba'];
          $sql = $con->query("SELECT * FROM tbl_income where no_ba = '$ba' AND month(tbl_income.waktu_input) = '$p_bulan' AND year(tbl_income.waktu_input) = '$p_tahun'");
            while($data = $sql->fetch_assoc()){
              $price[] = $data['price'];
              $amount = array_sum($price);
            }

    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $row['wo_id']; ?></td>
      <td><?php echo $row['so_id']; ?></td>
      <td><?php echo $row['no_ba']; ?></td>
      <td><?php echo $row['no_boq']; ?></td>
      <td><?php echo tgl_indo($row['tglba']); ?></td>
      <td><?php echo $row['deskripsi']; ?></td>
      <td><?php echo $row['pm']; ?> </td>
      <td><?php echo $rp, number_format($row['price'], 0, ".", "."); ?></td>
      <td><?php echo $row['verifikasi']; ?></td>
      <td><?php echo $row['no_pb']; ?></td>
      <td><?php echo tgl_indo($row['pb_date']); ?></td>
      <td><?php echo $row['handover']; ?></td>
      <td><?php echo $row['po_no']; ?></td>
      <td><?php echo tgl_indo($row['po_date']); ?></td>
      <td><?php echo $row['req_gr']; ?></td>
      <td><?php echo $row['inv_no']; ?></td>
      <td><?php echo $row['pay_stat']; ?></td>
      <td><?php echo tgl_indo($row['pay_date']); ?></td>
      <td><?php echo $row['final_stat']; ?></td>
      <td><?php echo $row['notes']; ?></td>
    </tr>
    <?php
        $no++;
      }
    }
  ?>
  </tbody>
  <tfoot>
    <tr style="background-color: yellow;">
      <th colspan="15"><h3>TOTAL PRICE : </h3></th>
      <th colspan="6"><h3><?php echo $rp, number_format($amount, 0, ".", "."); ?></h3>
    </tr>
  </tfoot>
</table>