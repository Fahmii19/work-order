<?php 
  include('../config/koneksi.php');
  include('../fungsi_indotgl.php');

  $p_nama       = isset($_GET['nama']) ? $_GET['nama'] : "";
  $p_bulan      = isset($_GET['bulan']) ? $_GET['bulan'] : "";
  $p_tahun      = isset($_GET['tahun']) ? $_GET['tahun'] : "";

   header("Content-type: application/vnd-ms-excel");
   header("Content-Disposition: attachment; filename= Summary Teknisi - ". $p_nama. ".xls");

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
	<span style="margin-left: 20px;font-size: 20px;"><b>SUMMARY TEKNISI</b></span>
</div>
<div style="text-align: center;">
  <span style="margin-left: 20px;font-size: 20px;"><b>PT. LUMBUNG RIANG COMMUNICATION</b></span>
</div>
<div style="text-align: center;">
  <span style="margin-left: 20px;font-size: 20px;"><b>NAMA TEKNISI <?php echo $p_nama; ?></b></span>
</div>
<div style="text-align: center;">
  <span style="margin-left: 20px;font-size: 20px;"><b>BULAN <?php echo $bulan; ?></b></span>
</div><br>
<table style="text-align: center;" border="1" width="100%">
  <thead>
    <tr>
      <th>NO</th>
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
                     $sql = mysqli_query($con, "SELECT * FROM tbl_project_wo JOIN tbl_teknisi_wo on tbl_project_wo.kode_teknisi = tbl_teknisi_wo.kode_teknisi JOIN tbl_schedule_wo ON tbl_project_wo.kode_jadwal = tbl_schedule_wo.kode_jadwal WHERE (MONTH(tgl) = '$p_bulan' AND YEAR(tgl) = '$p_tahun') AND (tbl_teknisi_wo.teknisi1 = '$p_nama' || tbl_teknisi_wo.teknisi2 = '$p_nama' || tbl_teknisi_wo.teknisi3 = '$p_nama' || tbl_teknisi_wo.teknisi4 = '$p_nama' || tbl_teknisi_wo.pkl1 = '$p_nama' || tbl_teknisi_wo.pkl2 = '$p_nama' || tbl_teknisi_wo.pkl3 = '$p_nama')");
                     while ($row = $sql->fetch_assoc()) {
                      $wo_id   = $row['wo_id'];
                      $so_id   = $row['so_id'];
                      $project = $row['project_title'];
                      $jadwal  = $row['tgl'];
                  ?>

                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $row['wo_id']; ?></td>
                    <td><?php echo $row['so_id']; ?></td>
                    <td><?php echo $row['project_title']; ?></td>
                    <td><?php echo bln_indo($row['tgl']); ?></td>
                    <td>
                      <?php
                        $cek = "SELECT * FROM tbl_income where wo_id = '".$row['wo_id']."'"; 
                        $proscek = mysqli_query($con, $cek);
                        if (mysqli_num_rows($proscek) > 0) { 
                          $res = mysqli_query($con, "SELECT * FROM tbl_income where wo_id = '".$row['wo_id']."'");
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
                    <th colspan="4"><h3>Total Amount : </h3></th>
                    <th colspan="2"><h4><?php echo $rp, number_format($amount_price, 0, ".", "."); ?></h4></th>
                  </tr>
                </tfoot>
              </table>