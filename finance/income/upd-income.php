<?php 
  include('config/koneksi.php');

  // harap include SESSION <?php include('session.php'); //

  $mod         = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $id_daftar   = isset($_GET['id_n']) ? $_GET['id_n'] : "";
  $p_tombol    = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
  $p_id_daftar = isset($_POST['id_daftar']) ? $_POST['id_daftar'] : "";
  $p_kd_income = isset($_POST['kd_income']) ? $_POST['kd_income'] : "";
  $p_kd_detail = isset($_POST['kd_detail']) ? $_POST['kd_detail'] : "";

  $tahun = date('Y');
  $nomor = "-".$tahun;

  $query1 = "SELECT max(kd_income) as maxKode FROM tbl_kode_income WHERE YEAR(time) = '$tahun'";
  $hasil1 = mysqli_query($con, $query1);
  $data1 = mysqli_fetch_array($hasil1);
  $kodeinc = $data1['maxKode'];

  $noinc = (int) substr($kodeinc, 3, 5);

  $noinc++;
  $char1 = "INC";
  $newinc = $char1 . sprintf("%05s", $noinc) . $nomor;

  $query2 = "SELECT max(kd_detail) as maxKode1 FROM tbl_kode_income WHERE YEAR(time) = '$tahun' ";
  $hasil2 = mysqli_query($con, $query2);
  $data2 = mysqli_fetch_array($hasil2);
  $kodedtl = $data2['maxKode1'];

  $nodtl = (int) substr($kodedtl, 3, 5);

  $nodtl++;
  $char2 = "DTL";
  $newdtl = $char2 . sprintf("%05s", $nodtl) . $nomor;
  
  $p_waktu     = date("Y-m-d H:i:s");  
  $p_id_wo     = isset($_POST['wo']) ? $_POST['wo'] : "";
  $p_id_so     = isset($_POST['so']) ? $_POST['so'] : "";
  $p_ba        = isset($_POST['ba']) ? $_POST['ba'] : "";
  $p_boq       = isset($_POST['boq']) ? $_POST['boq'] : "";
  $p_tglba     = isset($_POST['tglba']) ? $_POST['tglba'] : "";  
  $p_desk      = isset($_POST['desk']) ? $_POST['desk'] : "";  
  $p_pm        = isset($_POST['pm']) ? $_POST['pm'] : "";
  $p_price     = isset($_POST['nominal']) ? $_POST['nominal'] : "";  
  $p_verifikasi= isset($_POST['verifikasi']) ? $_POST['verifikasi'] : "";
  $p_nopb      = isset($_POST['nopb']) ? $_POST['nopb'] : "";  
  $p_pbdate    = isset($_POST['pbdate']) ? $_POST['pbdate'] : "";
  $p_handover  = isset($_POST['handover']) ? $_POST['handover'] : "";  
  $p_pono      = isset($_POST['pono']) ? $_POST['pono'] : "";
  $p_podate    = isset($_POST['podate']) ? $_POST['podate'] : "";  
  $p_reqgr     = isset($_POST['reqgr']) ? $_POST['reqgr'] : "";
  $p_invno     = isset($_POST['invno']) ? $_POST['invno'] : "";  
  $p_pay       = isset($_POST['paystat']) ? $_POST['paystat'] : "";
  $p_paydate   = isset($_POST['paydate']) ? $_POST['paydate'] : "";  
  $p_final     = isset($_POST['final']) ? $_POST['final'] : ""; 

  $p_submit   = "Update";

  if ($mod == "Update") {

    $p_submit   = "Update";
    $title      = "Update Income";

  } elseif ($mod == "edit") {
    $q_data_edit  = mysqli_query($con, "SELECT * FROM tbl_kode_income join tbl_income on tbl_income.kd_income = tbl_kode_income.kd_income join tbl_income_detail on tbl_income_detail.kd_detail = tbl_kode_income.kd_detail WHERE id_income = '$id_daftar'");
    $a_data_edit  = mysqli_fetch_array($q_data_edit);
    $id_daftar    = $a_data_edit['id_income'];
    $kd_income    = $a_data_edit['kd_income'];
    $kd_detail    = $a_data_edit['kd_detail'];
    $e_id_wo      = $a_data_edit['wo_id'];
    $e_id_so      = $a_data_edit['so_id'];
    $e_ba         = $a_data_edit['no_ba'];  
    $e_boq        = $a_data_edit['no_boq'];    
    $e_tglba      = $a_data_edit['tglba'];   
    $e_desk       = $a_data_edit['deskripsi'];   
    $e_pm         = $a_data_edit['pm'];   
    $e_price      = $a_data_edit['price'];
    $e_verif      = $a_data_edit['verifikasi'];
    $e_nopb       = $a_data_edit['no_pb'];
    $e_pbdate     = $a_data_edit['pb_date'];
    $e_hand       = $a_data_edit['handover'];
    $e_pono       = $a_data_edit['po_no'];
    $e_podate     = $a_data_edit['po_date'];
    $e_reqgr      = $a_data_edit['req_gr'];
    $e_invno      = $a_data_edit['inv_no'];
    $e_paystat    = $a_data_edit['pay_stat'];
    $e_paydate    = $a_data_edit['pay_date'];
    $e_final      = $a_data_edit['final_stat'];
    $e_notes      = $a_data_edit['notes'];

    $p_submit   = "Edit";
    $title      = "Edit Income";

  }

  if ($p_tombol == "Update") {
  $cekdulu = "SELECT * FROM tbl_income WHERE no_ba = $p_ba AND no_boq = $p_boq"; 
  $prosescek = mysqli_query($con, $cekdulu);
  if (mysqli_num_rows($prosescek) > 0) { 
      echo "<script>alert('No BOQ sudah digunakan'); history.go(-1) </script>";
  } else {
    $q_tmb1 = mysqli_query($con, "INSERT INTO tbl_income VALUES ('','$newinc', '$p_id_wo', '$p_id_so', '$p_ba', '$p_boq', '$p_tglba', '$p_desk', '$p_pm', '$p_price', '$p_waktu', '')");
    $q_tmb2 = mysqli_query($con, "INSERT INTO tbl_kode_income (kd_income, kd_detail, time) VALUES ('$newinc', '$newdtl', '$p_waktu')");
    $q_tmb3 = mysqli_query($con, "INSERT INTO tbl_income_detail (kd_detail) VALUES ('$newdtl')");
    
    if ($q_tmb1 == true && $q_tmb2 == true && $q_tmb3 == true) {
      echo "<div class='alert alert-success'><strong>SUCCESS</strong> Data Order Berhasil di Update <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button><a href='?id=income' class='btn btn-primary' style='float: right;'><i class='ace-icon fa fa-folder-open'></i> Show Data</a></div>";
    } else {
      echo "<div class='alert alert-danger'><strong>Gagal Menambah Data! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    }
  }
  } elseif ($p_tombol == "Edit") {

    $q_edt1  = mysqli_query($con, "UPDATE tbl_income SET wo_id = '$p_id_wo', so_id = '$p_id_so', no_ba = '$p_ba', tglba = '$p_tglba', deskripsi = '$p_desk', pm = '$p_pm' WHERE kd_income = '$p_kd_income'");

    $q_edt2  = mysqli_query($con, "UPDATE tbl_income_detail SET verifikasi = '$p_verifikasi', no_pb = '$p_nopb', pb_date = '$p_pbdate', handover = '$p_handover', po_no = '$p_pono', req_gr = '$p_reqgr', inv_no = '$p_invno', pay_stat = '$p_pay', pay_date = '$p_paydate', final_stat = '$p_final' WHERE kd_detail = '$p_kd_detail'");

    if ($q_edt1 == true && $q_edt2 == true) {
      echo "<div id='gagal' class='alert alert-success'><strong>SUCCESS</strong> Data Order Berhasil di Edit <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button><a href='?id=income' class='btn btn-primary' style='float: right;'><i class='ace-icon fa fa-mail-reply'></i> Back</a></div>";
    } else {
      echo "<div id='gagal' class='alert alert-danger'><strong>Gagal Update Data! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    }
  }

?>


<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?php echo $title; ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content"> 
                          <?php

                              if ($mod == 'Update') {
                               
                          ?>

                      <form class="form-horizontal" action="?id=upd-income&mod=Update" method="post" role="form">
                          <div class="panel panel-primary setup-content">
                              <div class="panel-heading">
                                   <h3 class="panel-title">Update Income</h3>
                              </div>
                              <div class="panel-body">
                                  <div class="form-group">
                                    <div class="col-sm-4">
                                      <label for="wo">NO BA</label>
                                        <input type="text" name="ba" id="ba" class="form-control">
                                    </div>
                                    <div class="col-sm-4">
                                      <label for="so">WO ID</label>
                                        <input type="text" name="wo" id="wo" class="form-control">
                                    </div>
                                    <div class="col-sm-4">
                                      <label for="wo">SO ID</label>
                                        <input type="text" name="so" class="form-control" id="so">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-sm-6">
                                      <label class="control-label">PM</label>
                                      <input name="pm" type="text" id="pm" required="required" class="form-control"/>
                                    </div>
                                    <div class="col-sm-6">
                                      <label class="control-label">Tanggal BA</label>
                                      <div class='input-group date' id='datepicker'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='text' class="form-control" name="tglba" placeholder="YYYY/MM/DD" id="tglba" required />
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                       <label for="price">Deskripsi</label>
                                       <textarea name="desk" class="form-control" rows="4" id="desk"></textarea>
                                  </div>
                                  <hr>
                                  <div class="form-group">
                                    <div class="col-sm-6">
                                      <label class="control-label">NO BOQ</label>
                                      <input name="boq" type="text" required="required" class="form-control"/>
                                    </div>
                                    <div class="col-sm-6">
                                      <label class="control-label">Nominal</label>
                                      <input type="number" name="nominal" required="required" class="form-control">
                                    </div>
                                  </div>
                                 
                                  <br><br>
                                  <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="<?php echo $p_submit; ?>">
                                  <a href="?id=income"><button type="button" class="btn btn-warning pull-left"><span class="fa fa-arrow-left"> Back</span></button></a>
                                </div>
                          </div>

                          <?php 
                              } elseif ($mod == 'edit') {                            
                          ?>
                        
                        <form class="form-horizontal" action="?id=add-income&mod=edit" method="post"  role="form">
                          <input type="hidden" name="id_daftar" value="<?php echo $id_daftar; ?>">
                          <input type="hidden" name="kd_income" value="<?php echo $kd_income; ?>">
                          <input type="hidden" name="kd_detail" value="<?php echo $kd_detail; ?>">
                          <div class="panel panel-primary setup-content">
                              <div class="panel-heading">
                                   <h3 class="panel-title">Edit Income</h3>
                              </div>
                              <div class="panel-body">
                                  <div class="form-group">
                                    <div class="col-sm-6">
                                      <label for="wo">Input WO ID</label>
                                        <input type="text" name="wo" class="form-control" id="wo" value="<?php echo $e_id_wo; ?>">
                                    </div>
                                    <div class="col-sm-6">
                                      <label for="so">Input SO ID</label>
                                        <input type="text" name="so" class="form-control" id="so" value="<?php echo $e_id_so; ?>">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-sm-4">                                     
                                      <label for="wo">NO BA</label>
                                        <input type="text" name="ba" class="form-control" value="<?php echo $e_ba; ?>">
                                    </div>
                                    <div class="col-sm-4">
                                      <label class="control-label">Tanggal BA</label>
                                      <div class='input-group date' id='datepicker'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='text' class="form-control" name="tglba" placeholder="YYYY/MM/DD" value="<?php echo $e_tglba; ?>" />
                                      </div>
                                    </div>
                                    <div class="col-sm-4">
                                      <label class="control-label">PM</label>
                                      <input name="pm" type="text" id="pm" required="required" class="form-control" value="<?php echo $e_pm; ?>"/>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                       <label for="price">Deskripsi</label>
                                       <textarea name="desk" class="form-control" rows="4"><?php echo $e_desk; ?></textarea>
                                  </div>
                                  <hr>
                                  <div class="form-group">
                                    <div class="col-sm-4">
                                      <label class="control-label">Verifikasi</label>
                                      <div class='input-group date'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='date' class="form-control" name="verifikasi" placeholder="YYYY/MM/DD" value="<?php echo $e_verif; ?>" />
                                      </div>
                                    </div>
                                    <div class="col-sm-4">
                                      <label class="control-label">No PB</label>
                                      <input name="nopb" type="text" class="form-control" value="<?php echo $e_nopb; ?>"/>
                                    </div>
                                    <div class="col-sm-4">
                                      <label class="control-label">PB Date</label>
                                      <div class='input-group date'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='date' class="form-control" name="pbdate" placeholder="YYYY/MM/DD" value="<?php echo $e_pbdate; ?>" />
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-sm-4">
                                      <label class="control-label">Handover</label>
                                      <div class='input-group date'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='date' class="form-control" name="handover" placeholder="YYYY/MM/DD" value="<?php echo $e_hand; ?>" />
                                      </div>
                                    </div>
                                    <div class="col-sm-4">
                                      <label class="control-label">No PO</label>
                                      <input name="pono" type="text" class="form-control" value="<?php echo $e_pono; ?>"/>
                                    </div>
                                    <div class="col-sm-4">
                                      <label class="control-label">PO Date</label>
                                      <div class='input-group date'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='date' class="form-control" name="podate" placeholder="YYYY/MM/DD" value="<?php echo $e_podate; ?>" />
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-sm-4">
                                      <label class="control-label">REQ GR</label>
                                      <div class='input-group date'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='date' class="form-control" name="reqgr" placeholder="YYYY/MM/DD" value="<?php echo $e_reqgr; ?>" />
                                      </div>
                                    </div>
                                    <div class="col-sm-4">
                                      <label class="control-label">Invoice No</label>
                                      <input name="invno" type="text" class="form-control" value="<?php echo $e_invno; ?>"/>
                                    </div>
                                    <div class="col-sm-4">
                                      <label class="control-label">Payment Date</label>
                                      <div class='input-group date'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='date' class="form-control" name="paydate" placeholder="YYYY/MM/DD" value="<?php echo $e_paydate; ?>" />
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-sm-6">
                                      <label class="control-label">Payment Status</label>
                                      <select class="form-control" name="paystat">
                                        <option value="" hidden>- Pilih -</option>
                                        <option value="PAID" <?php if($e_paystat == 'PAID'){ echo 'selected'; } ?>>PAID</option>
                                        <option value="UNPAID" <?php if($e_paystat == 'UNPAID'){ echo 'selected'; } ?>>UNPAID</option>
                                        <option value="VOID" <?php if($e_paystat == 'VOID'){ echo 'selected'; } ?>>VOID</option>

                                      </select>
                                    </div>
                                    <div class="col-sm-6">
                                      <label class="control-label">Final Status</label>
                                      <select class="form-control" name="final">
                                        <option value="" hidden>- Pilih -</option>
                                        <option value="OPEN" <?php if($e_final == 'OPEN'){ echo 'selected'; } ?>>OPEN</option>
                                        <option value="CLOSE" <?php if($e_final == 'CLOSE'){ echo 'selected'; } ?>>CLOSE</option>
                                      </select>
                                    </div>
                                  </div>
                                  <br><br>
                                  <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="<?php echo $p_submit; ?>">
                                  <a href="?id=income"><button type="button" class="btn btn-warning pull-left"><span class="fa fa-arrow-left"> Back</span></button></a>
                                </div>
                          </div>

                          <?php
                            }
                          ?>
                          
                      </form>
                  </div>
                  </div>
                </div>
              </div>
          </div>