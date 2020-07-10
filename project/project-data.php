<?php 
  error_reporting(0);

  include('config/koneksi.php');

  $tampil     = isset($_GET['view']) ? $_GET['view'] : NULL;
  $mod        = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $id_del     = isset($_GET['id_n']) ? $_GET['id_n'] : NULL;

  $p_bulan     = isset($_GET['bulan']) ? $_GET['bulan'] : "";
  $p_tahun     = isset($_GET['tahun']) ? $_GET['tahun'] : "";

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
        }

  if ($mod == "del") {
    $q_del = mysqli_query($con, "DELETE FROM tbl_project_wo WHERE kode_project = '$id_del'");

    if ($q_del) {
      echo "<div id='gagal' class='alert alert-success'><strong>SUCCESS</strong> Data Order Berhasil di hapus <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    } else {
      echo "<div id='gagal' class='alert alert-danger'><strong>SORRY! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    }
  }
?>

<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Project List <small>Project Order</small></h2>
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

                    <?php 
                      if ($tampil == 'project') { ?>
                        <!-- <table id="datatable-buttons" class="table table-striped table-bordered table-responsive table-hover">
                          <thead>
                            <tr>
                              <th>NO</th>
                              <th>Project Date Received</th>
                              <th>Project Name</th>
                              <th>Customer Name</th>
                              <th>WO ID</th>
                              <th>SO ID</th>
                              <th>Schedule</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          
                          <tbody>
                            
                          <?php
                            
                            $no = 1;
                            $res = $con->query("SELECT * FROM tbl_project_wo join tbl_schedule_wo on tbl_schedule_wo.kode_jadwal = tbl_project_wo.kode_jadwal join tbl_teknisi_wo on tbl_teknisi_wo.kode_teknisi = tbl_project_wo.kode_teknisi");
                            while($row = $res->fetch_assoc()){
                          ?>

                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $row['tgl_project']; ?></td>
                              <td><?php echo $row['project_title']; ?></td>
                              <td><?php echo $row['customer']; ?></td>
                              <td><?php echo $row['wo_id']; ?></td>
                              <td><?php echo $row['so_id']; ?></td>
                              <td><?php echo $row['tgl']; ?></td>
                              <td class="left">
                                <?php 
                                  if ($row['status'] == 'first') { ?>
                                    <a data-rel="tooltip" title="View Detail" class="blue" href="?id=view&mod=view&id_n=<?php echo $row['id_project'];?>">
                                      <span class="fa fa-list">
                                    </a>
                                    <a data-rel="tooltip" title="Add Detail" class="purple" href="?id=add-project&mod=schedule&id_n=<?php echo $row['id_project'];?>">
                                      <span class="fa fa-plus-square">
                                    </a>
                                    <a data-rel="tooltip" title="Add Cash Receipt" class="purple" href="?id=add-cash-receipt&mod=Tambah&wo_id=<?php echo $row['wo_id'];?>">
                                      <span class="fa fa-plus-square">
                                    </a>
                                    <a data-rel="tooltip" title="Add PTJB" class="purple" href="?id=add-ptjb&mod=Tambah&wo_id=<?php echo $row['wo_id'];?>">
                                      <span class="fa fa-plus-square">
                                    </a>
                                    <a data-rel="tooltip" title="Add Income" class="purple" href="?id=add-income&mod=Tambah&wo_id=<?php echo $row['wo_id'];?>">
                                      <span class="fa fa-plus-square">
                                    </a>
                                    <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-project&mod=edit&id_n=<?php echo $row['id_project'];?>">
                                      <span class="fa fa-edit">
                                    </a>
                                    <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=project&mod=del&id_n=<?php echo $row['kode_project'];?>&view=project" onclick="return confirm('Menghapus Data <?php echo $row['kode_project'];?>')">
                                      <span class="fa fa-trash-o">
                                    </a>
                                    <?php
                                  } else { ?>
                                    <a data-rel="tooltip" title="Add Cash Receipt" class="purple" href="?id=add-cash-receipt&mod=Tambah&wo_id=<?php echo $row['wo_id'];?>">
                                      <span class="fa fa-plus-square">
                                    </a>
                                    <a data-rel="tooltip" title="Add PTJB" class="purple" href="?id=add-ptjb&mod=Tambah&wo_id=<?php echo $row['wo_id'];?>">
                                      <span class="fa fa-plus-square">
                                    </a>
                                    <a data-rel="tooltip" title="Add Income" class="purple" href="?id=add-income&mod=Tambah&wo_id=<?php echo $row['wo_id'];?>">
                                      <span class="fa fa-plus-square">
                                    </a>
                                    <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-project&mod=edit&id_n=<?php echo $row['id_project'];?>">
                                      <span class="fa fa-edit">
                                    </a>
                                    <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=project&mod=del&id_n=<?php echo $row['kode_project'];?>&view=project" onclick="return confirm('Menghapus Data <?php echo $row['kode_project'];?>')">
                                      <span class="fa fa-trash-o">
                                    </a>
                                <?php
                                  }
                                ?>
                                
                              </td>
                            </tr>
                        <?php $no++; } ?>
                          </tbody>
                        </table> -->

                       <!--Ajax Processing  -->
                       <div class="table-responsive">
                        <table id="example-1" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                    <th>NO</th>
                                    <th>Project Date Received</th>
                                    <th>Project Name</th>
                                    <th>Customer</th>
                                    <th>WO ID</th>
                                    <th>SO ID</th>
                                    <th>Schedule</th>
                                    <th>Action</th>
                                  </tr>
                              </thead>
                          </table>
                        </div>

                    <?php
                      } else if ($tampil == 'kasbon') { ?>
                        <!-- <table id="datatable-buttons" class="table table-striped table-bordered table-responsive table-hover">
                      <thead>
                        <tr>
                          <th>NO</th>
                          <th>Project Date Received</th>
                          <th>Project Name</th>
                          <th>Customer Name</th>
                          <th>WO ID</th>
                          <th>SO ID</th>
                          <th>Schedule</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        
                      <?php
                        
                        $no = 1;
                        $res = $con->query("SELECT * FROM tbl_project_wo join tbl_schedule_wo on tbl_schedule_wo.kode_jadwal = tbl_project_wo.kode_jadwal join tbl_teknisi_wo on tbl_teknisi_wo.kode_teknisi = tbl_project_wo.kode_teknisi");
                        while($row = $res->fetch_assoc()){
                      ?>

                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $row['tgl_project']; ?></td>
                          <td><?php echo $row['project_title']; ?></td>
                          <td><?php echo $row['customer']; ?></td>
                          <td><?php echo $row['wo_id']; ?></td>
                          <td><?php echo $row['so_id']; ?></td>
                          <td><?php echo $row['tgl']; ?></td>
                          <td class="left">
                              <a data-rel="tooltip" title="Add Cash Receipt" class="purple" href="?id=add-cash-receipt&mod=Tambah&wo_id=<?php echo $row['wo_id'];?>">
                                <span class="fa fa-plus-square">
                                </span>
                              </a>
                          </td>
                        </tr>
                    <?php $no++; } ?>
                      </tbody>
                    </table> -->

                    <!--Ajax Processing  -->
                       <div class="table-responsive">
                        <table id="example-2" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                    <th>NO</th>
                                    <th>Project Date Received</th>
                                    <th>Project Name</th>
                                    <th>Customer</th>
                                    <th>WO ID</th>
                                    <th>SO ID</th>
                                    <th>Schedule</th>
                                    <th>Action</th>
                                  </tr>
                              </thead>
                          </table>
                        </div>
                    <?php
                      } else if ($tampil == 'ptjb') { ?>
                        <!-- <table id="datatable-buttons" class="table table-striped table-bordered table-responsive table-hover">
                      <thead>
                        <tr>
                          <th>NO</th>
                          <th>Project Date Received</th>
                          <th>Project Name</th>
                          <th>Customer Name</th>
                          <th>WO ID</th>
                          <th>SO ID</th>
                          <th>Schedule</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        
                      <?php
                        
                        $no = 1;
                        $res = $con->query("SELECT * FROM tbl_project_wo join tbl_schedule_wo on tbl_schedule_wo.kode_jadwal = tbl_project_wo.kode_jadwal join tbl_teknisi_wo on tbl_teknisi_wo.kode_teknisi = tbl_project_wo.kode_teknisi");
                        while($row = $res->fetch_assoc()){
                      ?>

                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $row['tgl_project']; ?></td>
                          <td><?php echo $row['project_title']; ?></td>
                          <td><?php echo $row['customer']; ?></td>
                          <td><?php echo $row['wo_id']; ?></td>
                          <td><?php echo $row['so_id']; ?></td>
                          <td><?php echo $row['tgl']; ?></td>
                          <td class="left">
                            <a data-rel="tooltip" title="Add PTJB" class="purple" href="?id=add-ptjb&mod=Tambah&wo_id=<?php echo $row['wo_id'];?>">
                              <span class="fa fa-plus-square">
                            </a>
                          </td>
                        </tr>
                    <?php $no++; } ?>
                      </tbody>
                    </table> -->

                    <!--Ajax Processing  -->
                       <div class="table-responsive">
                        <table id="example-3" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                    <th>NO</th>
                                    <th>Project Date Received</th>
                                    <th>Project Name</th>
                                    <th>Customer</th>
                                    <th>WO ID</th>
                                    <th>SO ID</th>
                                    <th>Schedule</th>
                                    <th>Action</th>
                                  </tr>
                              </thead>
                          </table>
                        </div>
                    <?php
                      } else if ($tampil == 'income') { ?>
                        <!-- <table id="datatable-buttons" class="table table-striped table-bordered table-responsive table-hover">
                      <thead>
                        <tr>
                          <th>NO</th>
                          <th>Project Date Received</th>
                          <th>Project Name</th>
                          <th>Customer Name</th>
                          <th>WO ID</th>
                          <th>SO ID</th>
                          <th>Schedule</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        
                      <?php
                        
                        $no = 1;
                        $res = $con->query("SELECT * FROM tbl_project_wo join tbl_schedule_wo on tbl_schedule_wo.kode_jadwal = tbl_project_wo.kode_jadwal join tbl_teknisi_wo on tbl_teknisi_wo.kode_teknisi = tbl_project_wo.kode_teknisi WHERE status = 'first'");
                        while($row = $res->fetch_assoc()){
                      ?>

                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $row['tgl_project']; ?></td>
                          <td><?php echo $row['project_title']; ?></td>
                          <td><?php echo $row['customer']; ?></td>
                          <td><?php echo $row['wo_id']; ?></td>
                          <td><?php echo $row['so_id']; ?></td>
                          <td class="left">
                            <a data-rel="tooltip" title="Add Income" class="purple" href="?id=add-income&mod=Tambah&wo_id=<?php echo $row['wo_id'];?>">
                              <span class="fa fa-plus-square">
                            </a>
                          </td>
                        </tr>
                    <?php $no++; } ?>
                      </tbody>
                    </table> -->

                    <!--Ajax Processing  -->
                       <div class="table-responsive">
                        <table id="example-4" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                    <th>NO</th>
                                    <th>Project Date Received</th>
                                    <th>Project Name</th>
                                    <th>Customer</th>
                                    <th>WO ID</th>
                                    <th>SO ID</th>
                                    <th>Action</th>
                                  </tr>
                              </thead>
                          </table>
                        </div>
                    <?php 
                      } else if ($tampil == 'order-w-t') { ?>
                        <div class="panel-heading">
                          <h1 class="panel-title"><b>Order Without Technician : <?php echo $bulan," ", $p_tahun; ?> </b></h1>
                        </div><br>
                        <!-- <div class="table-responsive">
                          <table id="datatable-buttons" class="table table-striped table-bordered table-responsive table-hover">
                        <thead>
                          <tr>
                            <th>NO</th>
                            <th>Project Date Received</th>
                            <th>Project Name</th>
                            <th>Customer Name</th>
                            <th>WO ID</th>
                            <th>SO ID</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        
                        <tbody>
                          
                        <?php
                          
                          $no = 1;
                          $res = $con->query("SELECT * FROM tbl_project_wo JOIN tbl_schedule_wo ON tbl_project_wo.kode_jadwal = tbl_schedule_wo.kode_jadwal JOIN tbl_teknisi_wo ON tbl_project_wo.kode_teknisi = tbl_teknisi_wo.kode_teknisi WHERE tbl_schedule_wo.tgl = '' AND tbl_teknisi_wo.teknisi1 = '' AND tbl_teknisi_wo.teknisi2 = '' AND tbl_teknisi_wo.teknisi3 = '' AND tbl_teknisi_wo.teknisi4 = '' AND tbl_teknisi_wo.pkl1 = '' AND tbl_teknisi_wo.pkl2 = '' AND tbl_teknisi_wo.pkl3 = '' AND month(tbl_project_wo.tgl_project) = '$p_bulan' AND year(tbl_project_wo.tgl_project) = '$p_tahun' ");
                          while($row = $res->fetch_assoc()){
                        ?>

                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row['tgl_project']; ?></td>
                            <td><?php echo $row['project_title']; ?></td>
                            <td><?php echo $row['customer']; ?></td>
                            <td><?php echo $row['wo_id']; ?></td>
                            <td><?php echo $row['so_id']; ?></td>
                            <td class="left">
                              <a data-rel="tooltip" title="View Detail" class="blue" href="?id=view&mod=view&id_n=<?php echo $row['id_project'];?>">
                                <span class="fa fa-list">
                              </a>
                            </td>
                          </tr>
                      <?php $no++; } ?>
                        </tbody>
                      </table>
                    </div> -->
                      <!-- Ajax Processing  -->
                       <div class="table-responsive">
                        <table id="example-5" class="table table-bordered table-hover table-responsive" cellspacing="1" width="100%">
                              <thead>
                                  <tr>
                                    <th>NO</th>
                                    <th>Project Date Received</th>
                                    <th>Project Name</th>
                                    <th>Customer</th>
                                    <th>WO ID</th>
                                    <th>SO ID</th>
                                    <th>Action</th>
                                  </tr>
                              </thead>
                          </table>
                        </div>
                    <?php
                      }

                    ?>
                  </div>
                  </div>
                </div>
              </div>
      
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    $(document).ready(function() {
     $('#example-1').DataTable( {
          "bProcessing": true,
          "bServerSide": true,
          "ajax": "serverside/response.php?view=project",
          "language": {                
            "infoFiltered": ""
          }
      } );
  } );
</script>
<script>
    $(document).ready(function() {
     $('#example-2').DataTable( {
          "bProcessing": true,
          "bServerSide": true,
          "ajax": "serverside/response.php?view=kasbon",
          "language": {                
            "infoFiltered": ""
          }
      } );
  } );
</script>
<script>
    $(document).ready(function() {
     $('#example-3').DataTable( {
          "bProcessing": true,
          "bServerSide": true,
          "ajax": "serverside/response.php?view=ptjb",
          "language": {                
            "infoFiltered": ""
          }
      } );
  } );
</script>
<script>
    $(document).ready(function() {
     $('#example-4').DataTable( {
          "bProcessing": true,
          "bServerSide": true,
          "ajax": "serverside/response.php?view=income",
          "language": {                
            "infoFiltered": ""
          }
      } );
  } );
</script>
<script>
    $(document).ready(function() {
     $('#example-5').DataTable( {
          "bProcessing": true,
          "bServerSide": true,
          "ajax": "serverside/response.php?view=order-w-t&bulan=<?php echo $p_bulan;?>&tahun=<?php echo $p_tahun;?>",
          "language": {                
            "infoFiltered": ""
          }
      } );
  } );
</script>