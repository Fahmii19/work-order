<?php 
  include('config/koneksi.php');

  // harap include SESSION <?php include('session.php'); //

  $mod         = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $id_daftar   = isset($_GET['id_n']) ? $_GET['id_n'] : "";
  $p_tombol    = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
  $wo_id       = isset($_GET['wo_id']) ? $_GET['wo_id'] : "";
  $p_id_daftar = isset($_POST['id_daftar']) ? $_POST['id_daftar'] : "";
  $p_kode_ptjb = isset($_POST['kode_ptjb']) ? $_POST['kode_ptjb'] : "";

  $title      = "Add Cash Receipt(PTJB)";

  $today = date("Y/m/");
  $tahun = date('Y');
  $nomor = "-".$tahun;


    $query = "SELECT max(no_vr) as maxKode FROM tbl_ptjb WHERE year(tgl_input) = '$tahun'";
    $hasil = mysqli_query($con,$query);
    $data  = mysqli_fetch_array($hasil);
    $kodevr = $data['maxKode'];

    $novr = (int) substr($kodevr, 11, 5);

    $novr++;
    $char = "LR/";
    $newvr = $char . $today . sprintf("%05s", $novr) . $nomor;

    $query2 = "SELECT max(kode_amount_ptjb) as maxKode FROM tbl_ptjb WHERE year(tgl_input) = '$tahun'";
    $hasil2 = mysqli_query($con,$query2);
    $data2  = mysqli_fetch_array($hasil2);
    $kodeptjb = $data2['maxKode'];

    $noptjb = (int) substr($kodeptjb, 4, 5);

    $noptjb++;
    $char = "PTJB";
    $newptjb = $char . sprintf("%05s", $noptjb) . $nomor;
  
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
  $p_pic        = isset($_POST['teknisi']) ? $_POST['teknisi'] : ""; 
  $p_id_wo      = isset($_POST['wo']) ? $_POST['wo'] : "";
  $p_id_so      = isset($_POST['so']) ? $_POST['so'] : "";
  $p_project    = isset($_POST['project']) ? $_POST['project'] : "";
  $p_today      = date("Y/m/d");
  $p_input      = date("Y-m-d");  
  $p_tgl        = isset($_POST['tgl']) ? $_POST['tgl'] : "";
  $p_end        = date('Y/m/d', strtotime('+7 days', strtotime($p_tgl)));

  $p_submit   = "Tambah";

  if ($mod == "Tambah") {
    $tampil  = mysqli_query($con, "SELECT * FROM tbl_project_wo join tbl_schedule_wo on tbl_schedule_wo.kode_jadwal = tbl_project_wo.kode_jadwal join tbl_teknisi_wo on tbl_teknisi_wo.kode_teknisi = tbl_project_wo.kode_teknisi WHERE wo_id = '$wo_id'");
    $data  = mysqli_fetch_array($tampil);
    $id_daftar  = $data['id_ptjb'];
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
    $q_data_edit  = mysqli_query($con, "SELECT * FROM tbl_ptjb JOIN tbl_amount ON tbl_amount.kode_amount_ptjb = tbl_ptjb.kode_amount_ptjb WHERE id_ptjb = '$id_daftar'");
    $a_data_edit  = mysqli_fetch_array($q_data_edit);
    $id_daftar    = $a_data_edit['id_ptjb'];
    $id_amount    = $a_data_edit['kode_amount_ptjb'];
    $e_id_wo      = $a_data_edit['wo_id'];
    $e_id_so      = $a_data_edit['so_id'];
    $e_pro        = $a_data_edit['project_name'];  
    $e_tgl        = $a_data_edit['start_date'];  
    $e_pic        = $a_data_edit['nama']; 
    $e_amount1    = $a_data_edit['amount1'];
    $e_ket1       = $a_data_edit['keterangan1'];
    $e_amount2    = $a_data_edit['amount2'];
    $e_ket2       = $a_data_edit['keterangan2'];
    $e_amount3    = $a_data_edit['amount3'];
    $e_ket3       = $a_data_edit['keterangan3'];
    $e_amount4    = $a_data_edit['amount4'];
    $e_ket4       = $a_data_edit['keterangan4'];
    $e_amount5    = $a_data_edit['amount5'];
    $e_ket5       = $a_data_edit['keterangan5'];
    $e_amoun6     = $a_data_edit['amount6'];
    $e_ket6       = $a_data_edit['keterangan6'];
    $e_amount7    = $a_data_edit['amount7'];
    $e_ket7       = $a_data_edit['keterangan7'];
    $e_amount8    = $a_data_edit['amount8'];
    $e_ket8       = $a_data_edit['keterangan8'];
    $e_amount9    = $a_data_edit['amount9'];
    $e_ket9       = $a_data_edit['keterangan9'];
    $e_amount10   = $a_data_edit['amount10'];
    $e_ket10      = $a_data_edit['keterangan10'];

    $p_submit   = "Edit";
    $title      = "Edit Cash Receipt";

  }

  if ($p_tombol == "Tambah") {

      $q_tmb1 = mysqli_query($con, "INSERT INTO tbl_ptjb VALUES (NULL,'$p_project', '$p_id_wo', '$p_id_so', '$p_pic', '$p_tgl', '$p_today', '$p_end', '$p_input', '$newvr', '$newptjb')");
      $q_tmb2 = mysqli_query($con, "INSERT INTO tbl_amount VALUES ('$newptjb', '$p_amount1', '$p_ket1', '$p_amount2', '$p_ket2', '$p_amount3', '$p_ket3', '$p_amount4', '$p_ket4', '$p_amount5', '$p_ket5', '$p_amount6', '$p_ket6', '$p_amount7', '$p_ket7', '$p_amount8', '$p_ket8', '$p_amount9', '$p_ket9', '$p_amount10', '$p_ket10' )");
      
      if ($q_tmb1 == true && $q_tmb2 == true) {
      echo "<div class='alert alert-success'><strong>SUCCESS</strong> Data Berhasil di Tambahkan <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button><a href='?id=ptjb' class='btn btn-primary' style='float: right;'><i class='ace-icon fa fa-mail-reply'></i> Back</a></div>";
      } else {
        echo "<div id='gagal' class='alert alert-danger'><strong>Data Gagal di Tambahkan ! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
      }
  } elseif ($p_tombol == "Edit") {

    $q_edt1  = mysqli_query($con, "UPDATE tbl_ptjb SET nama = '$p_pic', start_date = '$p_tgl' WHERE id_ptjb = '$p_id_daftar'");
    $q_edt2  = mysqli_query($con, "UPDATE tbl_amount SET amount1 = '$p_amount1', amount2 = '$p_amount2', amount3 = '$p_amount3', amount4 = '$p_amount4', amount5 = '$p_amount5', amount6 = '$p_amount6', amount7 = '$p_amount7', amount8 = '$p_amount8', amount9 = '$p_amount9', amount10 = '$p_amount10', keterangan1 = '$p_ket1', keterangan2 = '$p_ket2', keterangan3 = '$p_ket3', keterangan4 = '$p_ket4', keterangan5 = '$p_ket5', keterangan6 = '$p_ket6', keterangan7 = '$p_ket7', keterangan8 = '$p_ket8', keterangan9 = '$p_ket9', keterangan10 = '$p_ket10' WHERE kode_amount_ptjb = '$p_kode_ptjb'");

    if ($q_edt1 == true && $q_edt2 == true) {
      echo "<div id='gagal' class='alert alert-success'><strong>SUCCESS</strong> Data Order Berhasil di Edit <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button><a href='?id=ptjb' class='btn btn-primary' style='float: right;'><i class='ace-icon fa fa-mail-reply'></i> Back</a></div>";
    } else {
      echo "<div id='gagal' class='alert alert-danger'><strong>Data Gagal di Edit ! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button><a href='?id=ptjb' class='btn btn-primary' style='float: right;'><i class='ace-icon fa fa-mail-reply'></i> Back</a></div>";
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
            
                      <form class="form-horizontal" action="?id=add-ptjb&mod=Tambah" method="post" name="latihan"  role="form">
                          <div class="panel panel-primary setup-content">
                              <div class="panel-heading">
                                   <h3 class="panel-title">Input Cash Receipt</h3>
                              </div>
                              <div class="panel-body">
                                  <div class="form-group">
                                    <div class="col-xs-6 col-lg-6">
                                      <label for="wo">ID WO</label>
                                        <input type="text" name="wo" class="form-control" id="wo" value="<?php echo $id_wo; ?>" readonly >
                                    </div>
                                    <div class="col-xs-6 col-lg-6">
                                      <label for="so">ID SO</label>
                                        <input type="text" name="so" class="form-control" id="so" value="<?php echo $id_so; ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-xs-6 col-lg-6">
                                      <label for="date">Tanggal Jalan</label>
                                        <div class='input-group date' id="datepicker1">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='text' class="form-control" name="tgl" placeholder="YYYY/MM/DD" value="<?php echo $tgl; ?>" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-6">
                                      <label for="project">Nama Project</label>
                                        <input type="text" name="project" class="form-control" id="project" value="<?php echo $pro; ?>" readonly>
                                    </div>
                                  </div><hr>
                                  <div class="form-group">
                                  <label for="project">Nama Teknisi</label><br>
                                  <div class="col-md-12">
                                        <select name="teknisi" required class="form-control">
                                        <option hidden="" ></option>
                                          <?php
                                            include('select_teknisi_kasbon.php');
                                          ?>
                                      </select>
                                  </div>
                                  </div>
                                    <div class="form-group">
                                    <div class="col-lg-6 col-xs-12" style="margin-bottom: 10px;">
                                       <label for="price">Amount</label>
                                        <input type="text" name="amount1" class="form-control" value="0"  placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan1" class="form-control">
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
                                        <input type="text" name="amount2" class="form-control" value="0" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan2" class="form-control">
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
                                        <input type="text" name="amount3" class="form-control" value="0" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan3" class="form-control">
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
                                        <input type="text" name="amount4" class="form-control" value="0" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan4" class="form-control">
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
                                        <input type="text" name="amount5" class="form-control" value="0" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan5" class="form-control">
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
                                        <input type="text" name="amount6" class="form-control" value="0" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan6" class="form-control">
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
                                        <input type="text" name="amount7" class="form-control" value="0" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan7" class="form-control">
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
                                        <input type="text" name="amount8" class="form-control" value="0" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan8" class="form-control">
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
                                        <input type="text" name="amount9" class="form-control" value="0" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan9" class="form-control">
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
                                        <input type="text" name="amount10" class="form-control" value="0" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan10" class="form-control">
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
                                  <br>
                                  <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="<?php echo $p_submit; ?>">
                                  <a href="?id=ptjb"><button type="button" class="btn btn-warning pull-left"><span class="fa fa-arrow-left"> Back</span></button></a>
                                </div>
                            </div>
                          </form>

                          <?php 
                              } elseif ($mod == 'search') {                            
                          ?>
                            
                        <form class="form-horizontal" action="?id=add-ptjb&mod=Tambah" method="post"  role="form">
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
                            
                        <form class="form-horizontal" action="?id=add-ptjb&mod=edit" method="post"  role="form">
                          <input type="hidden" name="id_daftar" value="<?php echo $id_daftar; ?>">
                          <input type="hidden" name="kode_ptjb" value="<?php echo $id_amount; ?>">
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
                                  <label for="project">Nama Teknisi</label><br>
                                  <div class="col-md-12">
                                        <input type="text" name="teknisi" class="form-control" id="pic" placeholder="Nama Teknisi" value="<?php echo $e_pic; ?>" required readonly>
                                  </div>
                                  </div>
                                   <div class="form-group">
                                    <div class="col-lg-6 col-xs-12" style="margin-bottom: 10px;">
                                       <label for="price">Amount</label>
                                        <input type="text" name="amount1" class="form-control" value="<?php echo $e_amount1; ?>"  placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan1" class="form-control">
                                        <option hidden="" value="<?php echo $e_ket1; ?>"><?php echo $e_ket1; ?></option>
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
                                        <input type="text" name="amount2" class="form-control" value="<?php echo $e_amount2; ?>" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan2" class="form-control">
                                        <option hidden="" value="<?php echo $e_ket2; ?>"><?php echo $e_ket2; ?></option>
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
                                        <input type="text" name="amount3" class="form-control" value="<?php echo $e_amount3; ?>" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan3" class="form-control">
                                        <option hidden="" value="<?php echo $e_ket3; ?>"><?php echo $e_ket3; ?></option>
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
                                        <input type="text" name="amount4" class="form-control" value="<?php echo $e_amount4; ?>" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan4" class="form-control">
                                        <option hidden="" value="<?php echo $e_ket4; ?>"><?php echo $e_ket4; ?></option>
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
                                        <input type="text" name="amount5" class="form-control" value="<?php echo $e_amount5; ?>" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan5" class="form-control">
                                        <option hidden="" value="<?php echo $e_ket5; ?>"><?php echo $e_ket5; ?></option>
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
                                        <input type="text" name="amount6" class="form-control" value="<?php echo $e_amount6; ?>" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan6" class="form-control">
                                        <option hidden="" value="<?php echo $e_ket6; ?>"><?php echo $e_ket6; ?></option>
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
                                        <input type="text" name="amount7" class="form-control" value="<?php echo $e_amount7; ?>" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan7" class="form-control">
                                        <option hidden="" value="<?php echo $e_ket7; ?>"><?php echo $e_ket7; ?></option>
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
                                        <input type="text" name="amount8" class="form-control" value="<?php echo $e_amount8; ?>" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan8" class="form-control">
                                        <option hidden="" value="<?php echo $e_ket8; ?>"><?php echo $e_ket8; ?></option>
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
                                        <input type="text" name="amount9" class="form-control" value="<?php echo $e_amount9; ?>" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan9" class="form-control">
                                        <option hidden="" value="<?php echo $e_ket9; ?>"><?php echo $e_ket9; ?></option>
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
                                        <input type="text" name="amount10" class="form-control" value="<?php echo $e_amount10; ?>" placeholder="Jumlah Kasbon">
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                       <label for="price">Keterangan</label>
                                       <select name="keterangan10" class="form-control">
                                        <option hidden="" value="<?php echo $e_ket10; ?>"><?php echo $e_ket10; ?></option>
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
                                  <br>
                                  <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="<?php echo $p_submit; ?>">
                                  <a href="?id=ptjb"><button type="button" class="btn btn-warning pull-left"><span class="fa fa-arrow-left"> Back</span></button></a>
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
