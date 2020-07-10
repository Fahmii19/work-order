<?php
  error_reporting(0);
  include('config/koneksi.php');

  $mod       = isset($_GET['mod']) ? $_GET['mod'] : "";
  $id_daftar = isset($_GET['id_n']) ? $_GET['id_n'] : "";

    if ($mod == "view") {

      $p_tampil     = mysqli_query($con, "SELECT * FROM tbl_project_wo join tbl_schedule_wo on tbl_schedule_wo.kode_jadwal = tbl_project_wo.kode_jadwal join tbl_teknisi_wo on tbl_teknisi_wo.kode_teknisi = tbl_project_wo.kode_teknisi WHERE id_project = '$id_daftar'");
      $p_lihat      = mysqli_fetch_array($p_tampil);
      $id_daftar    = $p_lihat['id_project'];
      $kd_jadwal    = $p_lihat['kode_jadwal'];
      $kd_teknisi   = $p_lihat['kode_teknisi'];
      $p_date       = $p_lihat['tgl_project'];  
      $p_project    = $p_lihat['project_title'];    
      $p_id_wo      = $p_lihat['wo_id'];
      $p_id_so      = $p_lihat['so_id'];    
      $p_customer   = $p_lihat['customer'];  
      $p_pic        = $p_lihat['pic']; 
      $p_tgl        = $p_lihat['tgl']; 
      $p_lokasi     = $p_lihat['lokasi']; 
      $p_t1         = $p_lihat['teknisi1']; 
      $p_t2         = $p_lihat['teknisi2']; 
      $p_t3         = $p_lihat['teknisi3']; 
      $p_t4         = $p_lihat['teknisi4']; 
      $p_pkl1       = $p_lihat['pkl1'];
      $p_pkl2       = $p_lihat['pkl2'];
      $p_pkl3       = $p_lihat['pkl3'];
    }
?>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-align-left"></i> View Project Detail</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="card">
                      <h3><b>Detail of Project</b></h3><hr>

                        <table class="table table-striped" >
                            <tr>
                              <th class="col-sm-3">Project Date Received</th>
                              <td class="col-sm-1">:</td>
                              <td class="col-sm-4"><?php echo $p_date; ?></td>
                              <td class="col-sm-4"></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3">Project Name</th>
                              <td class="col-sm-1">:</td>
                              <td class="col-sm-4"><?php echo $p_project; ?></td>
                              <td class="col-sm-4"></td>
                            </tr>
                            
                            <tr>
                              <th class="col-sm-3">ID WO</th>
                              <td class="col-sm-1">:</td>
                              <td class="col-sm-4"><?php echo $p_id_wo; ?></td>
                              <td class="col-sm-4"></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3">ID SO</th>
                              <td class="col-sm-1">:</td>
                              <td class="col-sm-4"><?php echo $p_id_so; ?></td>
                              <td class="col-sm-4"></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3">Customer Name</th>
                              <td class="col-sm-1">:</td>
                              <td class="col-sm-4"><?php echo $p_customer; ?></td>
                              <td class="col-sm-4"></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3">Location</th>
                              <td class="col-sm-1">:</td>
                              <td class="col-sm-4"><?php echo $p_lokasi; ?></td>
                              <td class="col-sm-4"></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3">PIC Indosat</th>
                              <td class="col-sm-1">:</td>
                              <td class="col-sm-4"><?php echo $p_pic; ?></td>
                              <td class="col-sm-4"></td>
                            </tr>
                        </table>
                    </div>

                    <br><h3><b>Schedule of Project</b></h3><hr>

                    <!-- start accordion -->
                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                      <?php
                          
                            $no = 0;
                            $res = $con->query("SELECT * FROM tbl_project_wo join tbl_schedule_wo on tbl_schedule_wo.kode_jadwal = tbl_project_wo.kode_jadwal join tbl_teknisi_wo on tbl_teknisi_wo.kode_teknisi = tbl_project_wo.kode_teknisi WHERE tbl_project_wo.wo_id like '%".$p_id_wo."%' AND tbl_project_wo.so_id like '%".$p_id_so."%'");
                            while($row = $res->fetch_array()){
                              $no++
                          ?>
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="heading<?php echo $no;?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $no;?>" aria-expanded="false" aria-controls="collapse<?php echo $no;?>">
                          <h4 class="panel-title"><b>Schedule <?php echo $no;?> <i class="fa fa-arrow-circle-right"></i> <?php echo $row['tgl']; ?></b></h4>
                        </a>
                        <div id="collapse<?php echo $no;?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?php echo $no;?>">
                          <div class="panel-body">
                            <h5 class="panel-title">Kegiatan <i class="fa fa-arrow-circle-right"></i> <?php echo $row['project_title']; ?></h4><hr>
                            <table class="table table-striped" >
                            <tr>
                              <th class="col-sm-3">Technician 1</th>
                              <td class="col-sm-1">:</td>
                              <td class="col-sm-4"><?php echo $row['teknisi1']; ?></td>
                              <td class="col-sm-4"></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3">Technician 2</th>
                              <td class="col-sm-1">:</td>
                              <td class="col-sm-4"><?php echo $row['teknisi2']; ?></td>
                              <td class="col-sm-4"></td>
                            </tr>
                            
                            <tr>
                              <th class="col-sm-3">Technician 3</th>
                              <td class="col-sm-1">:</td>
                              <td class="col-sm-4"><?php echo $row['teknisi3']; ?></td>
                              <td class="col-sm-4"></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3">Technician 4</th>
                              <td class="col-sm-1">:</td>
                              <td class="col-sm-4"><?php echo $row['teknisi4']; ?></td>
                              <td class="col-sm-4"></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3">Apprentice Technician 1</th>
                              <td class="col-sm-1">:</td>
                              <td class="col-sm-4"><?php echo $row['pkl1']; ?></td>
                              <td class="col-sm-4"></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3">Apprentice Technician 2</th>
                              <td class="col-sm-1">:</td>
                              <td class="col-sm-4"><?php echo $row['pkl2']; ?></td>
                              <td class="col-sm-4"></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3">Apprentice Technician 3</th>
                              <td class="col-sm-1">:</td>
                              <td class="col-sm-4"><?php echo $row['pkl3']; ?></td>
                              <td class="col-sm-4"></td>
                            </tr>
                        </table>
                          </div>
                        </div>
                      </div>
                      <?php
                        }
                      ?>
                    <!-- end of accordion -->


                  </div>
                </div>
                <a href="?id=project"><button type="button" class="btn btn-primary">BACK</button></a>
              </div>
        </div>