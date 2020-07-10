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
  header("Content-Disposition: attachment; filename=Report PTJB - ". $bulan. " ".$p_tahun.".xls");
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
	<span style="margin-left: 20px;font-size: 20px;"><b>REPORT PTJB</b></span>
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
      <th>PROJECT NAME</th>
      <th>WO ID</th>
      <th>SO</th>
      <th>TGL MULAI</th>
      <th>TGL SEKARANG</th>
      <th>TGL BERAKHIR</th>
      <th>NO VR</th>
      <th>AMOUNT 1</th>
      <th>KETERANGAN 1</th>
      <th>AMOUNT 2</th>
      <th>KETERANGAN 2</th>
      <th>AMOUNT 3</th>
      <th>KETERANGAN 3</th>
      <th>AMOUNT 4</th>
      <th>KETERANGAN 4</th>
      <th>AMOUNT 5</th>
      <th>KETERANGAN 5</th>
      <th>AMOUNT 6</th>
      <th>KETERANGAN 6</th>
      <th>AMOUNT 7</th>
      <th>KETERANGAN 7</th>
      <th>AMOUNT 8</th>
      <th>KETERANGAN 8</th>
      <th>AMOUNT 9</th>
      <th>KETERANGAN 9</th>
      <th>AMOUNT 10</th>
      <th>KETERANGAN 10</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if(isset($_POST['kirim_daftar'])) {
        $p_bulan     = isset($_POST['bulan']) ? $_POST['bulan'] : "";
        $p_tahun     = isset($_POST['tahun']) ? $_POST['tahun'] : "";

        
        include('../config/koneksi.php');

        $no = 1;
        $res = $con->query("SELECT * FROM tbl_ptjb join tbl_amount on tbl_amount.kode_amount_ptjb = tbl_ptjb.kode_amount_ptjb WHERE month(tbl_ptjb.tgl_input) = '$p_bulan' AND year(tbl_ptjb.tgl_input) = '$p_tahun'");
        while($row = $res->fetch_assoc()){
          $total = $row['amount1'] + $row['amount2'] + $row['amount3'] + $row['amount4'] + $row['amount5'] + $row['amount6'] + $row['amount7'] + $row['amount8'] + $row['amount9'] + $row['amount10'];
          $rp = "Rp. ";
          $price[]      = $total;
          $amount_total = array_sum($price);

    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $row['project_name']; ?></td>
      <td><?php echo $row['wo_id']; ?></td>
      <td><?php echo $row['so_id']; ?></td>
      <td><?php echo $row['start_date']; ?></td>
      <td><?php echo $row['date_now']; ?></td>
      <td><?php echo $row['end_date']; ?></td>
      <td><?php echo $row['no_vr']; ?></td>
      <td><?php echo $row['amount1']; ?></td>
      <td><?php echo $row['keterangan1']; ?> </td>
      <td><?php echo $row['amount2']; ?></td>
      <td><?php echo $row['keterangan2']; ?> </td>
      <td><?php echo $row['amount3']; ?></td>
      <td><?php echo $row['keterangan3']; ?> </td>
      <td><?php echo $row['amount4']; ?></td>
      <td><?php echo $row['keterangan4']; ?> </td>
      <td><?php echo $row['amount5']; ?></td>
      <td><?php echo $row['keterangan5']; ?> </td>
      <td><?php echo $row['amount6']; ?></td>
      <td><?php echo $row['keterangan6']; ?> </td>
      <td><?php echo $row['amount7']; ?></td>
      <td><?php echo $row['keterangan7']; ?> </td>
      <td><?php echo $row['amount8']; ?></td>
      <td><?php echo $row['keterangan8']; ?> </td>
      <td><?php echo $row['amount9']; ?></td>
      <td><?php echo $row['keterangan9']; ?> </td>
      <td><?php echo $row['amount10']; ?></td>
      <td><?php echo $row['keterangan10']; ?> </td>
    </tr>
    <?php
        $no++;
      }
    }
  ?>
  </tbody>
  <tfoot>
    <tr style="background-color: yellow;">
      <th colspan="18"><h3>TOTAL PTJB : </h3></th>
      <th colspan="10"><h3><?php echo $rp, number_format($amount_total, 0, ".", "."); ?></h3>
    </tr>
  </tfoot>
</table>