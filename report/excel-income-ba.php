<?php 
    include('../fungsi_indotgl.php');

    $ba    = isset($_GET['ba']) ? $_GET['ba'] : "";
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Report Income - ". $ba. ".xls");
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
  <span style="margin-left: 20px;font-size: 20px;"><b>NO BA <?php echo $ba; ?></b></span>
</div><br>
<table style="text-align: center;" border="1" width="100%">
  <thead>
                                  <tr>
                                    <th>NO</th>
                                    <th>WO ID</th>
                                    <th>SO ID</th>
                                    <th>No BA</th>
                                    <th>Tgl BA</th>
                                    <th>BOQ</th>
                                    <th>Income</th>
                                  </tr>
                              </thead>
  <tbody>
                                <?php

                                  include('../config/koneksi.php');

                                  $view = mysqli_query($con, "SELECT * FROM tbl_kode_income JOIN tbl_income ON tbl_kode_income.kd_income = tbl_income.kd_income JOIN tbl_income_detail ON tbl_kode_income.kd_detail = tbl_income_detail.kd_detail JOIN tbl_project_wo ON tbl_project_wo.wo_id = tbl_income.wo_id WHERE tbl_income.no_ba LIKE '%".$ba."%'");
                                  $no = 1;
                                  $rp = "Rp. ";
                                  while ($rows = mysqli_fetch_array($view)) { 
                                    $rp = "Rp. ";
                                    $price[] = $rows['price'];
                                    $nominal[] = $rows['price'];
                                    $amount = array_sum($price);
                                    $p_nominal = array_sum($nominal);?>
                                    <tr>
                                      <td><?= $no; ?>
                                      <td><?= $rows['wo_id'] ?></td>
                                      <td><?= $rows['so_id'] ?></td>
                                      <td><?= $rows['no_ba'] ?></td>
                                      <td><?= $rows['tglba'] ?></td>
                                      <td><?= $rows['no_boq'] ?></td>
                                      <td><?php echo $rp, number_format($rows['price'], 0, ".", "."); ?></td>  
                                    </tr>
                                <?php
                                    $no++;
                                  }
                                ?>
                              </tbody>

                            <tfoot>
                              <tr>
                                <th colspan="5"><h3>Total Income : </h3></th>
                                <th colspan="2"><h3><?php echo $rp, number_format($amount, 0, ".", "."); ?></h3></th>
                              </tr>
                            </tfoot>
</table>