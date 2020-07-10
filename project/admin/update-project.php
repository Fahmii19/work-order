<?php 
  include('config/koneksi.php');

  // harap include SESSION <?php include('session.php'); //

  $mod         = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $id_daftar   = isset($_GET['id_n']) ? $_GET['id_n'] : "";
  $p_tombol    = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
  $p_id_daftar = isset($_POST['id_daftar']) ? $_POST['id_daftar'] : "";

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

  
  $p_kdpro     = isset($_POST['kodeproject']) ? $_POST['kodeproject'] : "";
  $p_kdtek     = isset($_POST['kodeteknisi']) ? $_POST['kodeteknisi'] : "";
  $p_level     = isset($_POST['level']) ? $_POST['level'] : "";
  $p_date      = isset($_POST['date']) ? $_POST['date'] : "";  
  $p_project   = isset($_POST['project']) ? $_POST['project'] : "";  
  $p_id_wo     = isset($_POST['wo']) ? $_POST['wo'] : "";
  $p_id_so     = isset($_POST['so']) ? $_POST['so'] : "";
  $p_customer  = isset($_POST['customer']) ? $_POST['customer'] : "";  
  $p_pic       = isset($_POST['pic']) ? $_POST['pic'] : "";  
  $p_jadwal    = isset($_POST['tanggal']) ? $_POST['tanggal'] : "";  
  $p_lokasi    = isset($_POST['lokasi']) ? $_POST['lokasi'] : "";  
  $p_teknisi1  = isset($_POST['t1']) ? $_POST['t1'] : "";
  $p_teknisi2  = isset($_POST['t2']) ? $_POST['t2'] : "";  
  $p_teknisi3  = isset($_POST['t3']) ? $_POST['t3'] : "";  
  $p_teknisi4  = isset($_POST['t4']) ? $_POST['t4'] : "";    
  $p_pkl1      = isset($_POST['pkl1']) ? $_POST['pkl1'] : "";    
  $p_pkl2      = isset($_POST['pkl2']) ? $_POST['pkl2'] : "";    
  $p_pkl3      = isset($_POST['pkl3']) ? $_POST['pkl3'] : ""; 
  $p_waktu     = date("Y-m-d H:i:s");

  $new = date("y.m.d.i.s");
  $newwo = '-'.$new;

  $p_submit   = "Update";

  if ($mod == "update") {

    $p_submit   = "Update";
    $title      = "Update Project";

  } 

  if ($p_tombol == "Update") {
      
    $q_tmb2 = mysqli_query($con, "INSERT INTO tbl_teknisi_wo VALUES ('$newtch', '$p_teknisi1', '$p_teknisi2', '$p_teknisi3', '$p_teknisi4', '$p_pkl1', '$p_pkl2', '$p_pkl3','$p_waktu')");

    $q_tmb = mysqli_query($con, "INSERT INTO tbl_project_wo VALUES ('', '$newpro', '$newsch', '$newtch', '$p_level', '$p_date', '$p_project', '$p_id_wo$newwo', '$p_id_so', '$p_customer', '$p_lokasi', '$p_pic', '','$p_waktu')");
    $q_tmb1 = mysqli_query($con, "INSERT INTO tbl_schedule_wo VALUES ('$newsch', '$p_jadwal','$p_waktu')");
    
    if ($q_tmb && $q_tmb1 && $q_tmb2) {
      echo "<div class='alert alert-success'><strong>SUCCESS</strong> Data Order Berhasil di Update <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button><a href='?id=project&view=project' class='btn btn-primary' style='float: right;'><i class='ace-icon fa fa-folder-open'></i> Show Data</a></div>";
    } else {
      echo "<div class='alert alert-danger'><strong>Data Gagal di Update! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
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

                              if ($mod == 'update') {
                               
                          ?>
                      <form class="form-horizontal" action="?id=upd-project&mod=update" method="post" role="form">
                          <div class="panel panel-primary setup-content">
                              <div class="panel-heading">
                                   <h3 class="panel-title">Detail Project</h3>
                              </div>
                              <div class="panel-body">
                                  <div class="form-group">
                                      <label for="wo">Input WO ID</label>
                                        <input type="text" name="wo" class="form-control" id="wo">
                                  </div>
                                  <hr>
                                  <div class="form-group">
                                    <input type="hidden" name="kodeproject" class="form-control" id="kodeproject" readonly>
                                    <input type="hidden" name="kodeteknisi" class="form-control" id="kodeteknisi" readonly>
                                    <input type="hidden" name="level" class="form-control" id="level" readonly>
                                  </div>
                                  <div class="form-group">
                                      <label for="date">Date</label>
                                        <div class='input-group date' id='datepicker1'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='text' class="form-control" style=" background: white;" name="date" placeholder="YYYY/MM/DD" id="date"/>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="project">Projet Title</label>
                                        <select name="project" required class="form-control"  id="project">
                                          <option></option>
                                          <?php
                                          $q = mysqli_query($con, "SELECT * FROM project_wo order by nama_project ASC"); 

                                          while ($a = mysqli_fetch_array($q)){
                                          echo "<option value ='$a[1]'> $a[1] </option>";
                                          }
                                        ?>
                                        </select>
                                        
                                  </div>
                                  <div class="form-group">
                                       <label for="so">SO ID</label>
                                        <input type="text" name="so" class="form-control" style="border: none; background: white;" id="so" readonly>
                                  </div>
                                  <div class="form-group">
                                       <label for="customer">Customer</label>
                                        <input type="text" name="customer" class="form-control" style="border: none; background: white;" id="customer" readonly>
                                  </div>
                                  <div class="form-group">
                                       <label for="lokasi">Location</label>
                                        <textarea class="form-control" name="lokasi" id="lokasi" style="border: none; background: white;" readonly></textarea>
                                  </div>
                                  <div class="form-group">
                                       <label for="pic">PIC Indosat</label>
                                        <input type="text" name="pic" class="form-control" style="border: none; background: white;" id="pic" readonly>
                                  </div>
                              </div>
                          </div>
                          
                           <div class="panel panel-primary setup-content">
                              <div class="panel-heading">
                                   <h3 class="panel-title">Schedule of Project</h3>
                              </div>
                                <div class="panel-body">
                                  <div class="form-group">
                                      <label for="wo">Schedule</label>
                                       <div class='input-group date' id='datepicker'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='text' class="form-control" name="tanggal" placeholder="YYYY/MM/DD" value="<?php echo $p_date; ?>"/>
                                      </div>
                                  </div>
                                </div>
                            </div>

                            <div class="panel panel-primary setup-content">
                              <div class="panel-heading">
                                   <h3 class="panel-title">Technician of Project</h3>
                              </div>
                                <div class="panel-body">
                                  <div class="form-group">
                                      <label for="project">Technicians</label><br>
                                        <div class="col-sm-3">
                                        <select name="t1" required class="form-control" >
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg != 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          
                                          echo "<option value='$a[nama]'>$a[nama]</option>";

                                            }
                                          ?>
                                        </select>
                                        </div>
                                        <div class="col-sm-3">
                                        <select name="t2" class="form-control" >
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg != 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                          ?>
                                        </select>
                                        </div>
                                        <div class="col-sm-3">
                                        <select name="t3" class="form-control">
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg != 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                          ?>
                                        </select>
                                        </div>
                                        <div class="col-sm-3">
                                        <select name="t4" class="form-control">
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg != 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                          ?>
                                        </select>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="project">Apprentice Technicians</label><br>
                                        <div class="col-sm-4">
                                        <select name="pkl1" class="form-control">
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg = 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                          ?>
                                        </select>
                                        </div>
                                        <div class="col-sm-4">
                                        <select name="pkl2" class="form-control">
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg = 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                          ?>
                                        </select>
                                        </div>
                                        <div class="col-sm-4">
                                        <select name="pkl3" class="form-control">
                                        <option value=""> </option>
                                          <?php
                                        $q = mysqli_query($con, "select * from tbl_pegawai, tbl_status WHERE tbl_pegawai.id_status = tbl_status.id_status AND tbl_status.status_peg = 'STP0003' "); 

                                          while ($a = mysqli_fetch_array($q)){
                                          echo "<option value='$a[nama]'>$a[nama]</option>";
                                          }
                                          ?>
                                        </select>
                                        </div>
                                  </div>
                                  <br><br>
                                  <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="<?php echo $p_submit; ?>">
                                  <a href="?id=project"><button type="button" class="btn btn-warning pull-left"><span class="fa fa-arrow-left"> Back</span></button></a>
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