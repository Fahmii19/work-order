<?php 
  include('config/koneksi.php');

  // harap include SESSION <?php include('session.php'); //

  $mod         = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $id_daftar   = isset($_GET['id_n']) ? $_GET['id_n'] : "";
  $wo_id       = isset($_GET['wo_id']) ? $_GET['wo_id'] : "";
  $status      = isset($_GET['status']) ? $_GET['status'] : "";
  $p_tombol    = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
  $p_id_daftar = isset($_POST['id_daftar']) ? $_POST['id_daftar'] : "";
  $p_id_status = isset($_POST['kode_status']) ? $_POST['kode_status'] : "";
  $p_id_amount = isset($_POST['kode_amount']) ? $_POST['kode_amount'] : "";

  $title      = "Add Cash Receipt";

  $tahun = date('Y');
  $nomor = "-".$tahun;

  $today = date("Y/m/");

    $query = "SELECT max(no_vr) as maxKode FROM tbl_kasbon WHERE year(tgl_input) = '$tahun'";
    $hasil = mysqli_query($con,$query);
    $data  = mysqli_fetch_array($hasil);
    $kodevr = $data['maxKode'];

    $novr = (int) substr($kodevr, 11, 5);

    $novr++;
    $char = "LR/";
    $newvr = $char . $today . sprintf("%05s", $novr) . $nomor;

    $query2 = "SELECT max(kode_status) as maxKode FROM tbl_kasbon WHERE year(tgl_input) = '$tahun'";
    $hasil2 = mysqli_query($con,$query2);
    $data2  = mysqli_fetch_array($hasil2);
    $kodebon = $data2['maxKode'];

    $nobon = (int) substr($kodebon, 3, 5);

    $nobon++;
    $char = "BON";
    $newbon = $char . sprintf("%05s", $nobon) . $nomor;

    $query3 = "SELECT max(kode_amount) as maxKode FROM tbl_kasbon WHERE year(tgl_input) = '$tahun'";
    $hasil3 = mysqli_query($con,$query3);
    $data3  = mysqli_fetch_array($hasil3);
    $kodeamo = $data3['maxKode'];

    $noamo = (int) substr($kodeamo, 3, 5);

    $noamo++;
    $char = "AMO";
    $newamo = $char . sprintf("%05s", $noamo) . $nomor;
  
  $p_amount     = isset($_POST['amount']) ? $_POST['amount'] : "";
  $p_pic        = isset($_POST['teknisi']) ? $_POST['teknisi'] : ""; 
  $p_project    = isset($_POST['project']) ? $_POST['project'] : ""; 
  $p_id_wo      = isset($_POST['wo']) ? $_POST['wo'] : "";
  $p_id_so      = isset($_POST['so']) ? $_POST['so'] : ""; 
  $p_today      = date("Y-m-d");  
  $p_tgl        = isset($_POST['tgl']) ? $_POST['tgl'] : "";
  $p_end        = date('Y/m/d', strtotime('+7 days', strtotime($p_tgl)));
  $p_stbon      = isset($_POST['stbon']) ? $_POST['stbon'] : ""; 
  $p_stamount   = isset($_POST['stamount']) ? $_POST['stamount'] : ""; 
  $p_lunas      = isset($_POST['stlunas']) ? $_POST['stlunas'] : ""; 
  $p_ket1       = isset($_POST['keterangan1']) ? $_POST['keterangan1'] : "";
  $p_amount1    = isset($_POST['amount1']) ? $_POST['amount1'] : "";
  $p_ket2       = isset($_POST['keterangan2']) ? $_POST['keterangan2'] : "";
  $p_amount2    = isset($_POST['amount2']) ? $_POST['amount2'] : "";
  $p_ket3       = isset($_POST['keterangan3']) ? $_POST['keterangan3'] : "";
  $p_amount3    = isset($_POST['amount3']) ? $_POST['amount3'] : "";
  $p_ket4       = isset($_POST['keterangan4']) ? $_POST['keterangan4'] : "";
  $p_amount4    = isset($_POST['amount4']) ? $_POST['amount4'] : "";
  $p_ket5       = isset($_POST['keterangan5']) ? $_POST['keterangan5'] : "";
  $p_amount5    = isset($_POST['amount5']) ? $_POST['amount5'] : "";
  $p_ket6       = isset($_POST['keterangan6']) ? $_POST['keterangan6'] : "";
  $p_amount6    = isset($_POST['amount6']) ? $_POST['amount6'] : "";
  $p_ket7       = isset($_POST['keterangan7']) ? $_POST['keterangan7'] : "";
  $p_amount7    = isset($_POST['amount7']) ? $_POST['amount7'] : "";
  $p_ket8       = isset($_POST['keterangan8']) ? $_POST['keterangan8'] : "";
  $p_amount8    = isset($_POST['amount8']) ? $_POST['amount8'] : "";
  $p_ket9       = isset($_POST['keterangan9']) ? $_POST['keterangan9'] : "";
  $p_amount9    = isset($_POST['amount9']) ? $_POST['amount9'] : "";
  $p_ket10      = isset($_POST['keterangan10']) ? $_POST['keterangan10'] : "";
  $p_amount10   = isset($_POST['amount10']) ? $_POST['amount10'] : "";

  $p_submit   = "Tambah";

  if ($mod == "Tambah") {
    $tampil  = mysqli_query($con, "SELECT * FROM tbl_project_wo join tbl_schedule_wo on tbl_schedule_wo.kode_jadwal = tbl_project_wo.kode_jadwal join tbl_teknisi_wo on tbl_teknisi_wo.kode_teknisi = tbl_project_wo.kode_teknisi WHERE wo_id = '$wo_id'");
    $data  = mysqli_fetch_array($tampil);
    $id_wo      = $data['wo_id'];
    $id_so      = $data['so_id'];
    $pro        = $data['project_title'];  
    $tgl        = $data['tgl']; 
    $pic        = $data['pic'];   
    $t1         = $data['teknisi1'];
    $t2         = $data['teknisi2'];
    $t3         = $data['teknisi3'];
    $t4         = $data['teknisi4'];
    $pkl1       = $data['pkl1'];
    $pkl2       = $data['pkl2'];
    $pkl3       = $data['pkl3'];

    $p_submit   = "Tambah";
    $title      = "Add Cash Receipt";

  } elseif ($mod == "search") {

    $p_submit   = "Search";
    $title      = "Search Data";

  } elseif ($mod == "edit") {
    $q_data_edit  = mysqli_query($con, "SELECT * FROM tbl_kasbon join tbl_amount_kasbon on tbl_amount_kasbon.kode_amount = tbl_kasbon.kode_amount WHERE id_kasbon = '$id_daftar'");
    $a_data_edit  = mysqli_fetch_array($q_data_edit);
    $e_id_daftar    = $a_data_edit['id_kasbon'];
    $e_kd_amount    = $a_data_edit['kode_amount'];
    $e_kd_status    = $a_data_edit['kode_status'];
    $e_id_wo        = $a_data_edit['wo_id'];
    $e_id_so        = $a_data_edit['so_id'];
    $e_tgl          = $a_data_edit['tgl_jalan']; 
    $e_amount       = $a_data_edit['jmlh_amount'];
    $e_pro          = $a_data_edit['nama_project']; 
    $e_pic          = $a_data_edit['nama'];

    $p_submit   = "Edit";
    $title      = "Edit Cash Receipt";

  }  elseif ($mod == "update") {
    $update  = mysqli_query($con, "SELECT * FROM tbl_kasbon join tbl_project_wo on tbl_project_wo.wo_id = tbl_kasbon.wo_id join tbl_status_kasbon on tbl_status_kasbon.kode_status = tbl_kasbon.kode_status join tbl_amount_kasbon on tbl_amount_kasbon.kode_amount = tbl_kasbon.kode_amount WHERE id_kasbon = '$id_daftar'");
    $row  = mysqli_fetch_array($update);
    $id_daftar  = $row['id_kasbon'];
    $id_status  = $row['kode_status'];
    $id_amount  = $row['kode_amount'];
    $id_wo      = $row['wo_id'];
    $id_so      = $row['so_id'];
    $pro        = $row['project_title'];   
    $no_vr      = $row['no_vr'];    
    $tgl        = $row['tgl_input'];    
    $pic        = $row['nama'];
    $jmlh       = $row['jmlh_amount']; 
    $amount1    = $row['amount1'];  
    $ket1       = $row['keterangan1'];
    $amount2    = $row['amount2'];  
    $ket2       = $row['keterangan2'];
    $amount3    = $row['amount3'];  
    $ket3       = $row['keterangan3'];
    $amount4    = $row['amount4'];  
    $ket4       = $row['keterangan4'];
    $amount5    = $row['amount5'];  
    $ket5       = $row['keterangan5'];
    $amount6    = $row['amount6'];  
    $ket6       = $row['keterangan6'];
    $amount7    = $row['amount7'];  
    $ket7       = $row['keterangan7'];
    $amount8    = $row['amount8'];  
    $ket8       = $row['keterangan8'];
    $amount9    = $row['amount9'];  
    $ket9       = $row['keterangan9'];
    $amount10   = $row['amount10'];  
    $ket10      = $row['keterangan10'];


    $p_submit   = "Update";
    $title      = "Update Cash Receipt";

  }

  if ($p_tombol == "Tambah") {

      $q_tmb1 = mysqli_query($con, "INSERT INTO tbl_kasbon VALUES ('', '$newbon', '$newamo', '$p_id_wo', '$p_id_so', '$newvr', '$p_tgl', '$p_today', '$p_pic', '$p_project')");
      $q_tmb2 = mysqli_query($con, "INSERT INTO tbl_amount_kasbon VALUES ('$newamo', '$p_amount', '0', '-', '0', '-', '0', '-', '0', '-', '0', '-', '0', '-', '0', '-', '0', '-', '0', '-', '0', '-', '0')");
      $q_tmb3 = mysqli_query($con, "INSERT INTO tbl_status_kasbon VALUES ('$newbon', '$p_pic', 'BELUM DIKEMBALIKAN', 'BELUM DIKEMBALIKAN', 'BELUM SELESAI')");
      
      if ($q_tmb1 == true && $q_tmb2 == true && $q_tmb3 == true) {
      echo "<div class='alert alert-success'><strong>SUCCESS</strong> Data Berhasil di Tambahkan <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button><a href='?id=cash-receipt' class='btn btn-primary' style='float: right;'><i class='ace-icon fa fa-folder-open'></i> Show Data</a></div>";
      }

  } elseif ($p_tombol == "Edit") {

    $q_edt1  = mysqli_query($con, "UPDATE tbl_kasbon SET nama = '$p_pic', tgl_jalan = '$p_tgl', nama_project = '$p_project' WHERE id_kasbon = '$p_id_daftar'");
    $q_edt2  = mysqli_query($con, "UPDATE tbl_amount_kasbon SET jmlh_amount = '$p_amount' WHERE kode_amount = '$p_id_amount'");
    $q_edt3  = mysqli_query($con, "UPDATE tbl_status_kasbon SET nama = '$p_pic' WHERE kode_status = '$p_id_status'");

    if ($q_edt1 == true && $q_edt2 == true && $q_edt3 == true) {
      echo "<div id='gagal' class='alert alert-success'><strong>SUCCESS</strong> Data Berhasil di Edit <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button><a href='?id=cash-receipt&mod=ptjb' class='btn btn-primary' style='float: right;'><i class='ace-icon fa fa-mail-reply'></i> Back</a></div>";
    } else {
      echo "<div id='gagal' class='alert alert-danger'><strong>Data Gagal di Edit ! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    }

  } elseif ($p_tombol == "Update") {
    
    $q_upd1 = mysqli_query($con, "UPDATE tbl_status_kasbon SET st_bon = '$p_stbon', st_amount = '$p_stamount', st_lunas = '$p_lunas' WHERE kode_status = '$p_id_status'");
    $q_upd2 = mysqli_query($con, "UPDATE tbl_amount_kasbon SET amount1 = '$p_amount1', amount2 = '$p_amount2', amount3 = '$p_amount3', amount4 = '$p_amount4', amount5 = '$p_amount5', amount6 = '$p_amount6', amount7 = '$p_amount7', amount8 = '$p_amount8', amount9 = '$p_amount9', amount10 = '$p_amount10', keterangan1 = '$p_ket1', keterangan2 = '$p_ket2', keterangan3 = '$p_ket3', keterangan4 = '$p_ket4', keterangan5 = '$p_ket5', keterangan6 = '$p_ket6', keterangan7 = '$p_ket7', keterangan8 = '$p_ket8', keterangan9 = '$p_ket9', keterangan10 = '$p_ket10' WHERE kode_amount = '$p_id_amount'");

    if ($q_upd1 == true && $q_upd2 == true) {
      echo "<div id='gagal' class='alert alert-success'><strong>SUCCESS</strong> Data Berhasil di Update <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button><a href='?id=cash-receipt&mod=ptjb' class='btn btn-primary' style='float: right;'><i class='ace-icon fa fa-mail-reply'></i> Show Data</a></div>";
    } else {
      echo "<div id='gagal' class='alert alert-danger'><strong>Data Gagal di Edit ! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
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
                              
                              if ($mod == 'Tambah') {
                               
                          ?>
            
                      <form class="form-horizontal" action="?id=add-cash-receipt&mod=Tambah" method="post" name="latihan"  role="form">
                          <div class="panel panel-primary setup-content">
                              <div class="panel-heading">
                                   <h3 class="panel-title">Input Cash Receipt</h3>
                              </div>
                              <div class="panel-body">
                                  <div class="form-group">
                                    <div class="col-xs-6 col-lg-6">
                                      <label for="wo">ID WO</label>
                                        <input type="text" name="wo" value="<?= $id_wo?>" class="form-control" readonly>
                                    </div>
                                    <div class="col-xs-6 col-lg-6">
                                      <label for="so">ID SO</label>
                                        <input type="text" name="so" value="<?= $id_so?>" class="form-control" readonly>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-xs-6 col-lg-6">
                                      <label for="date">Tanggal Jalan</label>
                                        <div class='input-group date' id='datepicker1'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='text' class="form-control" name="tgl" placeholder="YYYY/MM/DD" value="<?= $tgl?>" placeholder="" ="Input Tanggal" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-6">
                                      <label for="project">Nama Project</label>
                                        <input type="text" name="project" class="form-control" placeholder="Nama Project" value="<?= $pro?>" readonly="">
                                    </div>
                                  </div><hr>
                                  <div class="form-group">
                                  <div class="col-lg-6 col-xs-6">
                                       <label for="price">Nama Teknisi</label>
                                        <select name="teknisi" required class="form-control">
                                        <option hidden="" ></option>
                                          <?php
                                            include('select_teknisi_kasbon.php');
                                          ?>
                                      </select>
                                  </div>
                                  <div class="col-lg-6 col-xs-6">
                                       <label for="price">Amount</label>
                                        <input type="text" name="amount" class="form-control" value="0"  placeholder="Jumlah Kasbon" required>
                                  </div>
                                  </div>
                                  <br>
                                  <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="<?php echo $p_submit; ?>">
                                  <a href="?id=cash-receipt&mod=ptjb"><button type="button" class="btn btn-warning pull-left"><span class="fa fa-arrow-left"> Back</span></button></a>
                                </div>
                            </div>
                          </form>

                          <?php 
                              } elseif ($mod == 'search') {                            
                          ?>
                            
                        <form class="form-horizontal" action="?id=add-cash-receipt&mod=Tambah" method="post"  role="form">
                          <input type="hidden" name="id_daftar" value="<?php echo $id_daftar; ?>">
                          <div class="panel panel-primary setup-content">
                              <div class="panel-heading">
                                   <h3 class="panel-title">Search ID WO</h3>
                              </div>
                              <div class="panel-body">
                                  <div class="form-group">
                                      <div class="col-xs-6 col-lg-6">
                                        <label for="wo">Input WO ID</label>
                                        <input type="text" name="wo" class="form-control" id="wo">
                                      </div>
                                      <div class="col-xs-6 col-lg-6">
                                        <label for="date">Tanggal Jalan</label>
                                        <div class='input-group date'>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='text' class="form-control" name="tgl" id="tgl" placeholder="YYYY/MM/DD" />
                                      </div>
                                    </div>
                                  </div>
                                  <hr>
                                  <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="<?php echo $p_submit; ?>">
                                </div>
                            </div>                          
                        </form>
  
                          <?php 

                              } elseif ($mod == 'edit') {                            
                          
                          ?>
                            
                        <form class="form-horizontal" action="?id=add-cash-receipt&mod=edit" method="post" role="form">
                          <input type="hidden" name="id_daftar" value="<?php echo $e_id_daftar; ?>">
                          <input type="hidden" name="kode_amount" value="<?php echo $e_kd_amount; ?>">
                          <input type="hidden" name="kode_status" value="<?php echo $e_kd_status; ?>">
                          <div class="panel panel-primary setup-content">
                              <div class="panel-heading">
                                   <h3 class="panel-title">Input Cash Receipt</h3>
                              </div>
                              <div class="panel-body">
                                  <div class="form-group">
                                    <div class="col-xs-6 col-lg-6">
                                      <label for="wo">ID WO</label>
                                        <input type="text" name="wo" class="form-control" value="<?php echo $e_id_wo; ?>" readonly>
                                    </div>
                                    <div class="col-xs-6 col-lg-6">
                                      <label for="so">ID SO</label>
                                        <input type="text" name="so" class="form-control" value="<?php echo $e_id_so; ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-xs-6 col-lg-6">
                                      <label for="date">Tanggal Jalan</label>
                                        <div class='input-group date' id="datepicker1">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='text' class="form-control" name="tgl" placeholder="YYYY/MM/DD" value="<?php echo $e_tgl; ?>" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-6">
                                      <label for="project">Nama Project</label>
                                        <input type="text" name="project" class="form-control" value="<?php echo $e_pro; ?>" readonly>
                                    </div>
                                  </div><hr>
                                  <div class="form-group">
                                  <div class="col-lg-6 col-xs-6">
                                       <label for="price">Nama Teknisi</label>
                                        <input type="text" name="teknisi" class="form-control" value="<?php echo $e_pic; ?>" readonly>
                                  </div>
                                  <div class="col-lg-6 col-xs-6">
                                       <label for="price">Amount</label>
                                        <input type="text" name="amount" class="form-control" placeholder="Jumlah Kasbon" value="<?php echo $e_amount; ?>" required>
                                  </div>
                                  </div>
                                  <br>
                                  <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="<?php echo $p_submit; ?>">
                                  <a href="?id=cash-receipt&mod=ptjb"><button type="button" class="btn btn-warning pull-left"><span class="fa fa-arrow-left"> Back</span></button></a>
                                </div>
                            </div>                          
                      </form>

                      <?php 
                        } elseif ($mod == 'update') {
                      ?>

                      <form class="form-horizontal" action="?id=add-cash-receipt&mod=update" method="post" name="latihan"  role="form">
                          <input type="hidden" name="id_daftar" value="<?php echo $id_daftar; ?>">                          
                          <input type="hidden" name="kode_status" value="<?php echo $id_status; ?>">                       
                          <input type="hidden" name="kode_amount" value="<?php echo $id_amount; ?>">
                          <div class="panel panel-primary setup-content">
                              <div class="panel-heading">
                                   <h3 class="panel-title">Update Cash Receipt</h3>
                              </div>
                              <div class="panel-body">
                                <h3><b>DETAIL KASBON</b></h3><br>
                                <table class="table table-striped table-responsive" >
                                    <tr>
                                      <th style="text-align: left; width: 20%; font-size: 15px;">ID WO</th>
                                      <td style="text-align: left; width: 5%; font-size: 15px;">:</td>
                                      <td style="text-align: left; width: 75%; font-size: 15px;"><?php echo $id_wo; ?></td>
                                    </tr>

                                    <tr>
                                      <th style="text-align: left; width: 20%; font-size: 15px;">ID SO</th>
                                      <td style="text-align: left; width: 5%; font-size: 15px;">:</td>
                                      <td style="text-align: left; width: 75%; font-size: 15px;"><?php echo $id_so; ?></td>
                                    </tr>
                                    
                                    <tr>
                                      <th style="text-align: left; width: 20%; font-size: 15px;">Tanggal Kasbon</th>
                                      <td style="text-align: left; width: 5%; font-size: 15px;">:</td>
                                      <td style="text-align: left; width: 75%; font-size: 15px;"><?php echo $tgl; ?></td>
                                    </tr>

                                    <tr>
                                      <th style="text-align: left; width: 20%; font-size: 15px;">No VR</th>
                                      <td style="text-align: left; width: 5%; font-size: 15px;">:</td>
                                      <td style="text-align: left; width: 75%; font-size: 15px;"><?php echo $no_vr; ?></td>
                                    </tr>

                                    <tr>
                                      <th style="text-align: left; width: 20%; font-size: 15px;">Nama Teknisi</th>
                                      <td style="text-align: left; width: 5%; font-size: 15px;">:</td>
                                      <td style="text-align: left; width: 75%; font-size: 15px;"><?php echo $pic; ?></td>
                                    </tr>

                                    <tr>
                                      <th style="text-align: left; width: 20%; font-size: 15px;">Jumlah Kasbon</th>
                                      <td style="text-align: left; width: 5%; font-size: 15px;">:</td>
                                      <td style="text-align: left; width: 75%; font-size: 15px;">Rp. <?php echo number_format($jmlh, 0, ".", "."); ?></td>
                                    </tr>
                                </table>
                                <hr>
                                <div class="panel-body">
                                  <h3><b>DETAIL STATUS</b></h3><br>
                                  <div class="form-group">
                                    <div class="col-md-4">
                                      <label>STATUS BON</label>
                                      <select name="stbon" class="form-control">
                                        <option value="SUDAH DIKEMBALIKAN" <?php if($row['st_bon'] == 'SUDAH DIKEMBALIKAN'){ echo 'selected'; } ?>>SUDAH DIKEMBALIKAN</option>
                                        <option value="BELUM DIKEMBALIKAN" <?php if($row['st_bon'] == 'BELUM DIKEMBALIKAN'){ echo 'selected'; } ?>>BELUM DIKEMBALIKAN</option>
                                      </select>
                                    </div>
                                    <div class="col-md-4">
                                      <label>STATUS UANG</label>
                                      <select name="stamount" class="form-control">
                                        <option value="SUDAH DIKEMBALIKAN" <?php if($row['st_amount'] == 'SUDAH DIKEMBALIKAN'){ echo 'selected'; } ?>>SUDAH DIKEMBALIKAN</option>
                                        <option value="BELUM DIKEMBALIKAN" <?php if($row['st_amount'] == 'BELUM DIKEMBALIKAN'){ echo 'selected'; } ?>>BELUM DIKEMBALIKAN</option>
                                      </select>
                                    </div>
                                    <div class="col-md-4">
                                      <label>STATUS KASBON</label>
                                      <select name="stlunas" class="form-control">
                                        <option value="SELESAI" <?php if($row['st_lunas'] == 'SELESAI'){ echo 'selected'; } ?>>SELESAI</option>
                                        <option value="PENDING" <?php if($row['st_lunas'] == 'PENDING'){ echo 'selected'; } ?>>PENDING</option>
                                        <option value="BELUM SELESAI" <?php if($row['st_lunas'] == 'BELUM SELESAI'){ echo 'selected'; } ?>>BELUM SELESAI</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <hr>
                                <div class="panel-body">
                                  <h3><b>DETAIL AMOUNT</b></h3><br>
                                  <div class="form-group">
                                    <div class="col-lg-6 col-xs-12" style="margin-bottom: 10px;">
                                       <label for="price">Amount</label>
                                        <input type="text" name="amount1" class="form-control" value="<?php echo $amount1; ?>"  placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan1" class="form-control">
                                        <option hidden="" value="<?php echo $ket1; ?>"><?php echo $ket1; ?></option>
                                        <option value="-"> </option>
                                        <?php
                                          $q = mysqli_query($con, "SELECT * FROM project_kasbon"); 

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
                                  </div>
                                    <div class="form-group">
                                    <div class="col-lg-6 col-xs-12" style="margin-bottom: 10px;">
                                       <label for="price">Amount</label>
                                        <input type="text" name="amount2" class="form-control" value="<?php echo $amount2; ?>" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan2" class="form-control">
                                        <option hidden="" value="<?php echo $ket2; ?>"><?php echo $ket2; ?></option>
                                        <option value="-"> </option>
                                        <?php
                                          $q = mysqli_query($con, "SELECT * FROM project_kasbon"); 

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
                                  </div>
                                    <div class="form-group">
                                    <div class="col-lg-6 col-xs-12" style="margin-bottom: 10px;">
                                       <label for="price">Amount</label>
                                        <input type="text" name="amount3" class="form-control" value="<?php echo $amount3; ?>" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan3" class="form-control">
                                        <option hidden="" value="<?php echo $ket3; ?>"><?php echo $ket3; ?></option>
                                        <option value="-"> </option>
                                        <?php
                                          $q = mysqli_query($con, "SELECT * FROM project_kasbon"); 

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
                                  </div>
                                    <div class="form-group">
                                    <div class="col-lg-6 col-xs-12" style="margin-bottom: 10px;">
                                       <label for="price">Amount</label>
                                        <input type="text" name="amount4" class="form-control" value="<?php echo $amount4; ?>" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan4" class="form-control">
                                        <option hidden="" value="<?php echo $ket4; ?>"><?php echo $ket4; ?></option>
                                        <option value="-"> </option>
                                        <?php
                                          $q = mysqli_query($con, "SELECT * FROM project_kasbon"); 

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
                                  </div>
                                    <div class="form-group">
                                    <div class="col-lg-6 col-xs-12" style="margin-bottom: 10px;">
                                       <label for="price">Amount</label>
                                        <input type="text" name="amount5" class="form-control" value="<?php echo $amount5; ?>" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan5" class="form-control">
                                        <option hidden="" value="<?php echo $ket5; ?>"><?php echo $ket5; ?></option>
                                        <option value="-"> </option>
                                        <?php
                                          $q = mysqli_query($con, "SELECT * FROM project_kasbon"); 

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
                                  </div>
                                    <div class="form-group">
                                    <div class="col-lg-6 col-xs-12" style="margin-bottom: 10px;">
                                       <label for="price">Amount</label>
                                        <input type="text" name="amount6" class="form-control" value="<?php echo $amount6; ?>" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan6" class="form-control">
                                        <option hidden="" value="<?php echo $ket6; ?>"><?php echo $ket6; ?></option>
                                        <option value="-"> </option>
                                        <?php
                                          $q = mysqli_query($con, "SELECT * FROM project_kasbon"); 

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
                                  </div>
                                    <div class="form-group">
                                    <div class="col-lg-6 col-xs-12" style="margin-bottom: 10px;">
                                       <label for="price">Amount</label>
                                        <input type="text" name="amount7" class="form-control" value="<?php echo $amount7; ?>" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan7" class="form-control">
                                        <option hidden="" value="<?php echo $ket7; ?>"><?php echo $ket7; ?></option>
                                        <option value="-"> </option>
                                        <?php
                                          $q = mysqli_query($con, "SELECT * FROM project_kasbon"); 

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
                                  </div>
                                    <div class="form-group">
                                    <div class="col-lg-6 col-xs-12" style="margin-bottom: 10px;">
                                       <label for="price">Amount</label>
                                        <input type="text" name="amount8" class="form-control" value="<?php echo $amount8; ?>" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan8" class="form-control">
                                        <option hidden="" value="<?php echo $ket8; ?>"><?php echo $ket8; ?></option>
                                        <option value="-"> </option>
                                        <?php
                                          $q = mysqli_query($con, "SELECT * FROM project_kasbon"); 

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
                                  </div>
                                    <div class="form-group">
                                    <div class="col-lg-6 col-xs-12" style="margin-bottom: 10px;">
                                       <label for="price">Amount</label>
                                        <input type="text" name="amount9" class="form-control" value="<?php echo $amount9; ?>" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan9" class="form-control">
                                        <option hidden="" value="<?php echo $ket9; ?>"><?php echo $ket9; ?></option>
                                        <option value="-"> </option>
                                        <?php
                                          $q = mysqli_query($con, "SELECT * FROM project_kasbon"); 

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
                                  </div>
                                    <div class="form-group">
                                    <div class="col-lg-6 col-xs-12" style="margin-bottom: 10px;">
                                       <label for="price">Amount</label>
                                        <input type="text" name="amount10" class="form-control" value="<?php echo $amount10; ?>" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan10" class="form-control">
                                        <option hidden="" value="<?php echo $ket10; ?>"><?php echo $ket10; ?></option>
                                        <option value="-"> </option>
                                        <?php
                                          $q = mysqli_query($con, "SELECT * FROM project_kasbon"); 

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
                                  </div>
                                </div>
                                  <br>
                                  <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="<?php echo $p_submit; ?>">
                                  <a href="?id=cash-receipt"><button type="button" class="btn btn-warning pull-left"><span class="fa fa-arrow-left"> Back</span></button></a>
                                </div>
                            </div>
                          </form>

                      <?php
                        }
                      ?>
                  </div>
                  </div>
                </div>
              </div>
          </div>
