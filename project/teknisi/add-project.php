<?php 
  include('config/koneksi.php');

  // harap include SESSION <?php include('session.php'); //

  $mod         = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $id_daftar   = isset($_GET['id_n']) ? $_GET['id_n'] : "";
  $p_tombol    = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
  $p_id_daftar = isset($_POST['id_daftar']) ? $_POST['id_daftar'] : "";
  $p_kd_jdwl   = isset($_POST['kd_jdwl']) ? $_POST['kd_jdwl'] : "";
  $p_kd_tkns   = isset($_POST['kd_tkns']) ? $_POST['kd_tkns'] : "";

  $tahun = date('Y');
  $nomor = "-".$tahun;

    $q1 = "SELECT max(kode_jadwal) as maxKode1 FROM tbl_schedule_wo WHERE YEAR(waktu_input) = '$tahun' ";
    $hasil1 = mysqli_query($con, $q1);
    $data1  = mysqli_fetch_array($hasil1);
    $kodesch = $data1['maxKode1'];

    $nosch = (int) substr($kodesch, 3, 5);

    $nosch++;
    $char1 = "SCH";
    $newsch = $char1 . sprintf("%05s", $nosch) . $nomor; 


    $q2 = "SELECT max(kode_teknisi) as maxKode2 FROM tbl_teknisi_wo WHERE YEAR(time) = '$tahun' ";
    $hasil2 = mysqli_query($con, $q2);
    $data2  = mysqli_fetch_array($hasil2);
    $kodetch = $data2['maxKode2'];

    $notch = (int) substr($kodetch, 3, 5);

    $notch++;
    $char2 = "TCH";
    $newtch = $char2 . sprintf("%05s", $notch) . $nomor; 


    $q3 = "SELECT max(kode_project) as maxKode FROM tbl_project_wo WHERE YEAR(time) = '$tahun' ";
    $hasil3 = mysqli_query($con, $q3);
    $data3  = mysqli_fetch_array($hasil3);
    $kodepro = $data3['maxKode'];

    $nopro = (int) substr($kodepro, 3, 5);

    $nopro++;
    $char3 = "PRO";
    $newpro = $char3 . sprintf("%05s", $nopro) . $nomor;

  $p_date      = isset($_POST['tanggal']) ? $_POST['tanggal'] : "";  
  $p_project   = isset($_POST['project']) ? $_POST['project'] : "";   
  $p_level     = 'teknisi';  
  $p_id_wo     = isset($_POST['idwo']) ? $_POST['idwo'] : "";
  $p_id_so     = isset($_POST['idso']) ? $_POST['idso'] : "";
  $p_customer  = isset($_POST['customer']) ? $_POST['customer'] : "";  
  $p_pic       = isset($_POST['pic-indosat']) ? $_POST['pic-indosat'] : "";  
  $p_jadwal    = isset($_POST['jadwal']) ? $_POST['jadwal'] : "";  
  $p_lokasi    = isset($_POST['lokasi']) ? $_POST['lokasi'] : "";  
  $p_teknisi1  = isset($_POST['teknisi1']) ? $_POST['teknisi1'] : "";
  $p_teknisi2  = isset($_POST['teknisi2']) ? $_POST['teknisi2'] : "";  
  $p_teknisi3  = isset($_POST['teknisi3']) ? $_POST['teknisi3'] : "";  
  $p_teknisi4  = isset($_POST['teknisi4']) ? $_POST['teknisi4'] : "";    
  $p_pkl1      = isset($_POST['pkl1']) ? $_POST['pkl1'] : "";    
  $p_pkl2      = isset($_POST['pkl2']) ? $_POST['pkl2'] : "";    
  $p_pkl3      = isset($_POST['pkl3']) ? $_POST['pkl3'] : ""; 
  $p_waktu     = date("Y-m-d H:i:s");

  $p_submit   = "Tambah";

  if ($mod == "tambah") {

    $p_submit   = "Tambah";
    $title      = "Add Project";
    $sub_title  = "Tambah Project";   

  } elseif ($mod == "edit") {
    $q_data_edit  = mysqli_query($con, "SELECT * FROM tbl_project_wo join tbl_schedule_wo on tbl_schedule_wo.kode_jadwal = tbl_project_wo.kode_jadwal join tbl_teknisi_wo on tbl_teknisi_wo.kode_teknisi = tbl_project_wo.kode_teknisi WHERE id_project = '$id_daftar'");
    $a_data_edit  = mysqli_fetch_array($q_data_edit);
    $id_daftar    = $a_data_edit['id_project'];
    $kd_jadwal    = $a_data_edit['kode_jadwal'];
    $kd_teknisi   = $a_data_edit['kode_teknisi'];
    $e_date       = $a_data_edit['tgl_project'];  
    $e_project    = $a_data_edit['project_title'];    
    $e_id_wo      = $a_data_edit['wo_id'];
    $e_id_so      = $a_data_edit['so_id'];    
    $e_customer   = $a_data_edit['customer'];  
    $e_pic        = $a_data_edit['pic']; 
    $e_tgl        = $a_data_edit['tgl']; 
    $e_lokasi     = $a_data_edit['lokasi']; 
    $e_t1         = $a_data_edit['teknisi1']; 
    $e_t2         = $a_data_edit['teknisi2']; 
    $e_t3         = $a_data_edit['teknisi3']; 
    $e_t4         = $a_data_edit['teknisi4']; 
    $e_pkl1       = $a_data_edit['pkl1']; 
    $e_pkl2       = $a_data_edit['pkl2']; 
    $e_pkl3       = $a_data_edit['pkl3']; 

    $p_submit = "Edit";
    $title      = "Edit Project";
    $sub_title  = "Edit Project Detail";

  } elseif ($mod == "schedule") {
    $q_data_update  = mysqli_query($con, "SELECT * FROM tbl_project_wo WHERE id_project = '$id_daftar'");
    $a_data_update  = mysqli_fetch_array($q_data_update);
    $id_daftar      = $a_data_update['id_project'];
    $kd_jadwal      = $a_data_update['kode_jadwal'];
    $kd_teknisi     = $a_data_update['kode_teknisi'];
    $p_date         = $a_data_update['tgl_project'];  
    $p_project      = $a_data_update['project_title'];    
    $p_id_wo        = $a_data_update['wo_id'];
    $p_id_so        = $a_data_update['so_id'];    
    $p_customer     = $a_data_update['customer'];  
    $p_pic          = $a_data_update['pic'];

    $p_submit   = "Add";
    $title      = "Add Project Detail";
    $sub_title  = "Lengkapi detail project";

  }

  if ($p_tombol == "Tambah") {

  $cekdulu1 = "SELECT * FROM tbl_project_wo WHERE wo_id = '$p_id_wo' OR so_id = '$p_id_so'"; 
  $prosescek1 = mysqli_query($con, $cekdulu1);
  if (mysqli_num_rows($prosescek1) > 0) {
    echo "<script>alert('ID WO atau ID SO Sudah Digunakan'); history.go(-1) </script>";
  } else { 
    $q_tmb = mysqli_query($con, "INSERT INTO tbl_project_wo VALUES ('', '$newpro', '$newsch', '$newtch', '$p_level', '$p_date', '$p_project', '$p_id_wo', '$p_id_so', '$p_customer', '$p_lokasi', '$p_pic', 'first','$p_waktu')");
    
    if ($q_tmb == TRUE) {
      $q_tmb1 = mysqli_query($con, "INSERT INTO tbl_schedule_wo (kode_jadwal) VALUES ('$newsch')");
      $q_tmb2 = mysqli_query($con, "INSERT INTO tbl_teknisi_wo (kode_teknisi) VALUES ('$newtch')");
      echo "<div class='alert alert-success'><strong>SUCCESS</strong> Data Order Berhasil di Tambahkan <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button><a href='?id=project&view=project' class='btn btn-primary' style='float: right;'><i class='ace-icon fa fa-folder-open'></i> Show Data</a></div>";
    } else {
      echo "<div class='alert alert-danger'><strong>Data Gagal di Simpan ! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    }
      
  }
  
  } elseif ($p_tombol == "Edit") {

    $q_edt1 = mysqli_query($con, "UPDATE tbl_project_wo SET level = '$p_level', tgl_project = '$p_date', project_title = '$p_project', wo_id = '$p_id_wo', so_id = '$p_id_so', customer = '$p_customer', lokasi = '$p_lokasi', pic = '$p_pic' WHERE id_project= '$p_id_daftar'");
    $q_edt2 = mysqli_query($con, "UPDATE tbl_schedule_wo SET tgl = '$p_jadwal' WHERE kode_jadwal = '$p_kd_jdwl'");
    $q_edt3 = mysqli_query($con, "UPDATE tbl_teknisi_wo SET teknisi1 = '$p_teknisi1', teknisi2 = '$p_teknisi2', teknisi3 = '$p_teknisi3', teknisi4 = '$p_teknisi4', pkl1 = '$p_pkl1', pkl2 = '$p_pkl2', pkl3 = '$p_pkl3' WHERE kode_teknisi = '$p_kd_tkns'");

    if ($q_edt1 && $q_edt2 && $q_edt3) {
      echo "<div id='gagal' class='alert alert-success'><strong>SUCCESS</strong> Data Order Berhasil di Edit <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button><a href='?id=project&view=project' class='btn btn-primary' style='float: right;'><i class='ace-icon fa fa-mail-reply'></i> Back</a></div>";
    } else {
      echo "<div id='gagal' class='alert alert-danger'><strong>Data Gagal di Edit ! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    }
  } elseif ($p_tombol == "Add") {

    $q_upds = mysqli_query($con, "UPDATE tbl_schedule_wo SET tgl = '$p_jadwal' WHERE kode_jadwal = '$p_kd_jdwl'");
    $q_updt = mysqli_query($con, "UPDATE tbl_teknisi_wo SET teknisi1 = '$p_teknisi1', teknisi2 = '$p_teknisi2', teknisi3 = '$p_teknisi3', teknisi4 = '$p_teknisi4', pkl1 = '$p_pkl1', pkl2 = '$p_pkl2', pkl3 = '$p_pkl3' WHERE kode_teknisi = '$p_kd_tkns'");

    if ($q_upds && $q_updt) {
      echo "<div id='gagal' class='alert alert-success'><strong>SUCCESS</strong> Detail Project Berhasil di Tambahkan <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button><a href='?id=project&view=project' class='btn btn-primary' style='float: right;'><i class='ace-icon fa fa-mail-reply'></i> Back</a></div>";
    } else {
      echo "<div id='gagal' class='alert alert-danger'><strong>Data Gagal di Simpan ! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    }
  }

?>


<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?php echo $title; ?> </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="container">
                      <div class="stepwizard">
                          <div class="stepwizard-row setup-panel">
                            <?php
                              if ($mod == 'tambah') {
                               
                            ?>
                              <div class="stepwizard-step col-xs-6"> 
                                  <a href="#step-1" type="button" class="btn btn-success btn-circle" data-toggle="tooltip" title="Description"><span class="fa fa-tasks"></span></a>
                                  <p>Description</p>
                              </div>
                              <div class="stepwizard-step col-xs-6"> 
                                  <a href="#step-2" type="button" class="btn btn-default btn-circle" data-toggle="tooltip" title="Customer"><span class="fa fa-users"></span></a>
                                  <p>Customer</p>
                              </div>
                            <?php 
                              } elseif ($mod == 'edit') {
                            
                            ?>
                              <div class="stepwizard-step col-xs-3"> 
                                  <a href="#step-1" type="button" class="btn btn-success btn-circle" data-toggle="tooltip" title="Description"><span class="fa fa-tasks"></span></a>
                                  <p>Description</p>
                              </div>
                              <div class="stepwizard-step col-xs-3"> 
                                  <a href="#step-2" type="button" class="btn btn-default btn-circle" data-toggle="tooltip" title="Customer"><span class="fa fa-users"></span></a>
                                  <p>Customer</p>
                              </div>
                              <div class="stepwizard-step col-xs-3"> 
                                  <a href="#step-3" type="button" class="btn btn-default btn-circle" data-toggle="tooltip" title="Schedule"><span class="glyphicon glyphicon-calendar"></span></a>
                                  <p>Schedule</p>
                              </div>
                              <div class="stepwizard-step col-xs-3"> 
                                  <a href="#step-4" type="button" class="btn btn-default btn-circle" data-toggle="tooltip" title="Technician"><span class="fa fa-user"></span></a>
                                  <p>Technician</p>
                              </div>
                            <?php
                              }  elseif ($mod == 'schedule') {

                            ?>
                              <div class="stepwizard-step col-xs-4"> 
                                  <a href="#step-1" type="button" class="btn btn-success btn-circle" data-toggle="tooltip" title="Description"><span class="fa fa-tasks"></span></a>
                                  <p>Description</p>
                              </div> 
                              <div class="stepwizard-step col-xs-4"> 
                                  <a href="#step-2" type="button" class="btn btn-success btn-circle" data-toggle="tooltip" title="Schedule"><span class="glyphicon glyphicon-calendar"></span></a>
                                  <p>Schedule</p>
                              </div>
                              <div class="stepwizard-step col-xs-4"> 
                                  <a href="#step-3" type="button" class="btn btn-default btn-circle" data-toggle="tooltip" title="Technician"><span class="fa fa-user"></span></a>
                                  <p>Technician</p>
                              </div>
                            <?php
                              }
                            ?>                             
                          </div>
                      </div>
                    
                          <?php

                              if ($mod == 'tambah') {
                               
                          ?>
                      <form class="form-horizontal" action="?id=add-project&mod=tambah" method="post" name="randform" role="form">
                          <input type="hidden" name="id_daftar" value="<?php echo $id_daftar; ?>">
                          <div class="panel panel-primary setup-content" id="step-1">
                              <div class="panel-heading">
                                   <h3 class="panel-title">Description</h3>
                              </div>
                              <div class="panel-body">
                                  <div class="form-group">
                                      <label class="control-label">Project Date Received</label>
                                      <div class='input-group date' id='datepicker'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='text' class="form-control" name="tanggal" placeholder="YYYY/MM/DD" value="<?php echo $p_date; ?>" />
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Project Title</label>
                                      <select name="project" required class="form-control">
                                        <option value="">Choose Project</option>
                                        <?php
                                          $q = mysqli_query($con, "SELECT * FROM project_wo order by nama_project ASC"); 

                                          while ($a = mysqli_fetch_array($q)){
                                          if ($a[0] == $p_project) {
                                            echo "<option value ='$a[1]' selected> $a[1] </option>";
                                          } else {
                                          echo "<option value ='$a[1]'> $a[1] </option>";
                                          }
                                            }
                                        ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">WO ID</label><br>
                                      <div class="col-sm-10">
                                        <input name="idwo" type="text" class="form-control" placeholder="Enter WO ID" value=""  required="" />
                                      </div>
                                      <div class="col-sm-2">
                                        <input type="button" class="btn btn-primary" value="Random WO" onClick="randomString();">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">SO ID</label><br>
                                      <div class="col-sm-10">
                                        <input name="idso" type="text" class="form-control" placeholder="Enter SO ID" value=""  required=""/>
                                      </div>
                                      <div class="col-sm-2">
                                        <input type="button" class="btn btn-primary" value="Random SO" onClick="randomString2();">
                                      </div>
                                  </div>
                                  <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
                              </div>
                          </div>
                          
                          <div class="panel panel-primary setup-content" id="step-2">
                              <div class="panel-heading">
                                   <h3 class="panel-title">Customer</h3>
                              </div>
                              <div class="panel-body">
                                  <div class="form-group">
                                      <label class="control-label">Customer name</label>
                                      <input maxlength="200" name="customer" type="text" id="customer" required="required" class="form-control" placeholder="Enter Customer Name" value="<?php echo $p_customer; ?>" />
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Location</label>
                                      <textarea maxlength="200" name="lokasi" required="required" class="form-control" placeholder="Enter Location"></textarea>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">PIC Indosat</label>
                                      <input maxlength="200" name="pic-indosat" type="text" id="pm" required="required" class="form-control" placeholder="Enter PIC Indosat" value="<?php echo $p_pic; ?>" />
                                  </div>
                                  <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="<?php echo $p_submit; ?>">
                              </div>
                          </div>
                          <?php 
                              } elseif ($mod == 'edit') {
                            
                          ?>
                      <form class="form-horizontal" name="randform2" action="?id=add-project&mod=edit" method="post"  role="form">
                          <input type="hidden" name="id_daftar" value="<?php echo $id_daftar; ?>">
                          <div class="panel panel-primary setup-content" id="step-1">
                              <div class="panel-heading">
                                   <h3 class="panel-title">Description</h3>
                              </div>
                              <div class="panel-body">
                                  <div class="form-group">
                                      <label class="control-label">Date</label>
                                      <div class='input-group date' id='datepicker'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='text' class="form-control" name="tanggal" placeholder="YYYY/MM/DD" value="<?php echo $e_date; ?>" />
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Project Title</label>
                                      <select name="project" required class="form-control">
                                        <option hidden="" value="<?php echo $e_project; ?>"><?php echo $e_project; ?></option>
                                        <option value=""> </option>
                                        <?php
                                          $q = mysqli_query($con, "SELECT * FROM project_wo"); 

                                          while ($a = mysqli_fetch_array($q)){
                                          if ($a[0] == $p_project) {
                                            echo "<option value ='$a[1]' selected> $a[1] </option>";
                                          } else {
                                          echo "<option value ='$a[1]'> $a[1] </option>";
                                          }
                                            }
                                        ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">WO ID</label><br>
                                      <div class="col-sm-10">
                                        <input maxlength="100" name="idwo" type="text" required="required" class="form-control" placeholder="Enter WO ID" value="<?php echo $e_id_wo; ?>" />
                                      </div>
                                      <div class="col-sm-2">
                                        <?php 
                                          if ($e_id_wo == NULL) { ?>
                                            <input type="button" class="btn btn-primary" value="Random WO" onClick="randomString();">
                                        <?php 
                                          } else { ?>
                                            <input type="button" class="btn btn-primary" value="Random WO" onClick="randomString();" disabled="">
                                        <?php
                                          }
                                        ?>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">SO ID</label><br>
                                      <div class="col-sm-10">
                                        <input maxlength="100" name="idso" type="text" required="required" class="form-control" placeholder="Enter SO ID" value="<?php echo $e_id_so; ?>" />
                                      </div>
                                      <div class="col-sm-2">
                                        <?php 
                                          if ($e_id_so == NULL) { ?>
                                            <input type="button" class="btn btn-primary" value="Random SO" onClick="randomString2();">
                                        <?php 
                                          } else { ?>
                                            <input type="button" class="btn btn-primary" value="Random SO" onClick="randomString2();" disabled="">
                                        <?php
                                          }
                                        ?>
                                      </div>
                                  </div>
                                  <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
                              </div>
                          </div>
                          
                          <div class="panel panel-primary setup-content" id="step-2">
                              <div class="panel-heading">
                                   <h3 class="panel-title">Customer</h3>
                              </div>
                              <div class="panel-body">
                                  <div class="form-group">
                                      <label class="control-label">Customer name</label>
                                      <input maxlength="200" name="customer" type="text"  required="required" class="form-control" placeholder="Enter Customer Name" value="<?php echo $e_customer; ?>" />
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Location</label>
                                      <textarea maxlength="200" name="lokasi" required="required" class="form-control" placeholder="Enter Location"><?php echo $e_lokasi; ?></textarea>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">PIC Indosat</label>
                                      <input maxlength="200" name="pic-indosat" type="text" required="required" class="form-control" placeholder="Enter PIC Indosat" value="<?php echo $e_pic; ?>" />
                                  </div>
                                  <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
                            </div>
                          </div>

                          <div class="panel panel-primary setup-content" id="step-3">
                              <div class="panel-heading">
                                   <h3 class="panel-title">Schedule</h3>
                              </div>
                              <div class="panel-body">
                                  <div class="form-group">
                                      <input type='hidden' class="form-control" name="kd_jdwl" value="<?php echo $kd_jadwal; ?>" />
                                      <label class="control-label">Date</label>
                                      <div class='input-group date' id='datepicker1'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='text' class="form-control" name="jadwal" placeholder="YYYY/MM/DD" value="<?php echo $e_tgl; ?>" />
                                      </div>
                                  </div>
                                  <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
                              </div>
                          </div>
                          
                          <div class="panel panel-primary setup-content" id="step-4">
                              <div class="panel-heading">
                                   <h3 class="panel-title">Technician</h3>
                              </div>
                              <div class="panel-body">
                                  <div class="form-group">
                                      <input type='hidden' class="form-control" name="kd_tkns" value="<?php echo $kd_teknisi; ?>" />
                                      <label class="control-label">Technician Name (1)</label>
                                      <select name="teknisi1" required class="form-control">
                                        <option hidden="" value="<?php echo $e_t1; ?>"><?php echo $e_t1; ?></option>
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg != 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          if ($a['nama'] == $p_t1) {
                                            echo "<option value='$a[nama]' selected>$a[nama]</option>";
                                          } else {
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                            }
                                          ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Technician Name (2)</label>
                                      <select name="teknisi2" class="form-control">
                                        <option hidden="" value="<?php echo $e_t2; ?>"><?php echo $e_t2; ?></option>
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg != 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          if ($a['nama'] == $p_t1) {
                                            echo "<option value='$a[nama]' selected>$a[nama]</option>";
                                          } else {
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                            }
                                          ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Technician Name (3)</label>
                                      <select name="teknisi3" class="form-control">
                                        <option hidden="" value="<?php echo $e_t3; ?>"><?php echo $e_t3; ?></option>
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg != 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          if ($a['nama'] == $p_t1) {
                                            echo "<option value='$a[nama]' selected>$a[nama]</option>";
                                          } else {
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                            }
                                          ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Technician Name (4)</label>
                                      <select name="teknisi4" class="form-control">
                                        <option hidden="" value="<?php echo $e_t4; ?>"><?php echo $e_t4; ?></option>
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg != 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          if ($a['nama'] == $p_t1) {
                                            echo "<option value='$a[nama]' selected>$a[nama]</option>";
                                          } else {
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                            }
                                          ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Technician PKL (1)</label>
                                      <select name="pkl1" class="form-control">
                                        <option hidden="" value="<?php echo $e_pkl1; ?>"><?php echo $e_pkl1; ?></option>
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg = 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          if ($a['nama'] == $p_t1) {
                                            echo "<option value='$a[nama]' selected>$a[nama]</option>";
                                          } else {
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                            }
                                          ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Technician PKL (2)</label>
                                      <select name="pkl2" class="form-control">
                                        <option hidden="" value="<?php echo $e_pkl2; ?>"><?php echo $e_pkl2; ?></option>
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg = 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          if ($a['nama'] == $p_t1) {
                                            echo "<option value='$a[nama]' selected>$a[nama]</option>";
                                          } else {
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                            }
                                          ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Technician PKL (3)</label>
                                      <select name="pkl3" class="form-control">
                                        <option hidden="" value="<?php echo $e_pkl3; ?>"><?php echo $e_pkl3; ?></option>
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg = 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          if ($a['nama'] == $p_t1) {
                                            echo "<option value='$a[nama]' selected>$a[nama]</option>";
                                          } else {
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                            }
                                          ?>
                                      </select>
                                  </div>
                                  <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="<?php echo $p_submit; ?>">
                            </div>
                          </div>
                          <?php
                            } elseif ($mod == 'schedule') {

                          ?>
                          
                          <form class="form-horizontal" action="?id=add-project&mod=schedule" method="post"  role="form">
                          <input type="hidden" name="id_daftar" value="<?php echo $id_daftar; ?>"> 
                          <div class="panel panel-primary setup-content" id="step-1">
                              <div class="panel-heading">
                                   <h3 class="panel-title">Description</h3>
                              </div>
                              <div class="panel-body">
                                  <div class="form-group">
                                      <label class="control-label">Project Title</label>
                                      <input class="form-control" value="<?php echo $p_project; ?>" readonly/>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">WO ID</label>
                                      <input maxlength="100" name="id-wo" type="text" required="required" class="form-control" placeholder="Enter WO ID" value="<?php echo $p_id_wo; ?>" readonly/>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">SO ID</label>
                                      <input maxlength="100" name="id-so" type="text" required="required" class="form-control" placeholder="Enter SO ID" value="<?php echo $p_id_so; ?>" readonly/>
                                  </div>
                                  <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
                              </div>
                          </div>       
                          <div class="panel panel-primary setup-content" id="step-2">
                              <div class="panel-heading">
                                   <h3 class="panel-title">Schedule</h3>
                              </div>
                              <div class="panel-body">
                                  <div class="form-group">
                                      <input type='hidden' class="form-control" name="kd_jdwl" value="<?php echo $kd_jadwal; ?>" />
                                      <label class="control-label">Date</label>
                                      <div class='input-group date' id='datepicker1'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='text' class="form-control" name="jadwal" placeholder="YYYY/MM/DD" value="<?php echo $p_jadwal; ?>" />
                                      </div>
                                  </div>
                                  <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
                              </div>
                          </div>
                          
                          <div class="panel panel-primary setup-content" id="step-3">
                              <div class="panel-heading">
                                   <h3 class="panel-title">Technician</h3>
                              </div>
                              <div class="panel-body">
                                  <div class="form-group">
                                      <input type='hidden' class="form-control" name="kd_tkns" value="<?php echo $kd_teknisi; ?>" />
                                      <label class="control-label">Technician Name (1)</label>
                                      <select name="teknisi1" required class="form-control">
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg != 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          if ($a['nama'] == $p_t1) {
                                            echo "<option value='$a[nama]' selected>$a[nama]</option>";
                                          } else {
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                            }
                                          ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Technician Name (2)</label>
                                      <select name="teknisi2" class="form-control">
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg != 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          if ($a['nama'] == $p_t1) {
                                            echo "<option value='$a[nama]' selected>$a[nama]</option>";
                                          } else {
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                            }
                                          ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Technician Name (3)</label>
                                      <select name="teknisi3" class="form-control">
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg != 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          if ($a['nama'] == $p_t1) {
                                            echo "<option value='$a[nama]' selected>$a[nama]</option>";
                                          } else {
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                            }
                                          ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Technician Name (4)</label>
                                      <select name="teknisi4" class="form-control">
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg != 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          if ($a['nama'] == $p_t1) {
                                            echo "<option value='$a[nama]' selected>$a[nama]</option>";
                                          } else {
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                            }
                                          ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Technician PKL (1)</label>
                                      <select name="pkl1" class="form-control">
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg = 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          if ($a['nama'] == $p_t1) {
                                            echo "<option value='$a[nama]' selected>$a[nama]</option>";
                                          } else {
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                            }
                                          ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Technician PKL (2)</label>
                                      <select name="pkl2" class="form-control">
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg = 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          if ($a['nama'] == $p_t1) {
                                            echo "<option value='$a[nama]' selected>$a[nama]</option>";
                                          } else {
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                            }
                                          ?>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Technician PKL (3)</label>
                                      <select name="pkl3" class="form-control">
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg = 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          if ($a['nama'] == $p_t1) {
                                            echo "<option value='$a[nama]' selected>$a[nama]</option>";
                                          } else {
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                            }
                                          ?>
                                      </select>
                                  </div>
                                  <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="<?php echo $p_submit; ?>">
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