<?php 
  error_reporting(0);

  include('config/koneksi.php');

  $mod      = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $id_del     = isset($_GET['id_n']) ? $_GET['id_n'] : NULL;

  if ($mod == "del") {
    $q_del = mysqli_query($con, "DELETE FROM tbl_kasbon WHERE id_kasbon = '$id_del'");

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
                    <h2>Kasbon List <small>Cash Receipt</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <?php
                    if ($mod == 'selesai') {
                  ?>
                  
                  <center>
                    <a href="?id=cash-receipt"><button type="button" class="btn btn-success">ALL</button></a>
                    <a href="?id=kasbon&mod=selesai"><button type="button" class="btn btn-primary">SELESAI</button></a>
                    <a href="?id=kasbon&mod=pending"><button type="button" class="btn btn-warning" >PENDING</button></a>
                    <a href="?id=kasbon&mod=belum"><button type="button" class="btn btn-danger">BELUM SELESAI</button></a>
                  </center>
                  <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered table-responsive dt-responsive nowrap table-hover">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Project Name</th>
                          <th>WO ID</th>
                          <th>Technician</th>
                          <th>Tgl Kasbon</th>
                          <th>Kasbon</th>
                          <th>Terpakai</th>
                          <th>Sisa</th>
                          <th>Keterangan</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        
                      <?php
                        
                        $no = 1;
                        $res = $con->query("SELECT * FROM tbl_kasbon join tbl_amount_kasbon on tbl_amount_kasbon.kode_amount = tbl_kasbon.kode_amount join tbl_status_kasbon on tbl_status_kasbon.kode_status = tbl_kasbon.kode_status WHERE st_lunas = 'SELESAI'");
                        while($row = $res->fetch_assoc()){

                          $jmlh = $row['jmlh_amount'];  
                          $rp = "Rp. ";
                          $total = $row['amount1'] + $row['amount2'] + $row['amount3'] + $row['amount4'] + $row['amount5'] + $row['amount6'] + $row['amount7'] + $row['amount8'] + $row['amount9'] + $row['amount10'];
                          $sisa = $row['jmlh_amount'] - $total;                     
                        
                      ?>
                      
                      <tr>
                          <td><?php echo $no; ?></td>
                          <td style="text-align: left;"><?php echo $row['nama_project']; ?></td>
                          <td><?php echo $row['wo_id']; ?></td>
                          <td><?php echo $row['nama']; ?></td>
                          <td><?php echo $row['tgl_jalan']; ?></td>
                          <td><?php echo $rp, number_format($jmlh, 0, ".", "."); ?></td>
                          <td><?php echo $rp, number_format($total, 0, ".", "."); ?></td>
                          <td><?php echo $rp, number_format($sisa, 0, ".", "."); ?></td>
                          <td><?php echo $row['st_lunas']; ?></td>
                          <td>
                            <a data-rel="tooltip" title="View Detail" class="blue" href="?id=view-kasbon&mod=view&id_n=<?php echo $row['id_kasbon'];?>">
                              <span class="fa fa-list">
                            </a>
                            <a data-rel="tooltip" title="Update Detail" class="purple" href="?id=add-cash-receipt&mod=update&id_n=<?php echo $row['id_kasbon'];?>">
                              <span class="fa fa-plus-square">
                            </a>
                            <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-cash-receipt&mod=edit&id_n=<?php echo $row['id_kasbon'];?>">
                              <span class="fa fa-edit">
                            </a>
                            <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=cash-receipt&mod=del&id_n=<?php echo $row['id_kasbon'];?>" onclick="return confirm('Menghapus Data <?php echo $row['id_kasbon'];?>')">
                              <span class="fa fa-trash-o">
                            </a>
                          </td>
                        </tr>
                    <?php $no++; } ?>
                      </tbody>
                    </table>

                    <!--Ajax Processing  -->
                       <!-- <div class="table-responsive">
                        <table id="example-1" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                    <th>No.</th>
                                    <th>Project Name</th>
                                    <th>WO ID</th>
                                    <th>Technician</th>
                                    <th>Tgl Kasbon</th>
                                    <th>Kasbon</th>
                                    <th>Terpakai</th>
                                    <th>Sisa</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                  </tr>
                              </thead>
                          </table>
                        </div> -->
                  </div>

                  <?php
                    } elseif ($mod == 'pending') {
                  ?>
                  
                  <center>
                    <a href="?id=cash-receipt"><button type="button" class="btn btn-success">ALL</button></a>
                    <a href="?id=kasbon&mod=selesai"><button type="button" class="btn btn-primary">SELESAI</button></a>
                    <a href="?id=kasbon&mod=pending"><button type="button" class="btn btn-warning" >PENDING</button></a>
                    <a href="?id=kasbon&mod=belum"><button type="button" class="btn btn-danger">BELUM SELESAI</button></a>
                  </center>
                  <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered table-responsive dt-responsive nowrap table-hover">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Project Name</th>
                          <th>WO ID</th>
                          <th>Technician</th>
                          <th>Tgl Kasbon</th>
                          <th>Kasbon</th>
                          <th>Terpakai</th>
                          <th>Sisa</th>
                          <th>Keterangan</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        
                      <?php
                        
                        $no = 1;
                        $res = $con->query("SELECT * FROM tbl_kasbon join tbl_amount_kasbon on tbl_amount_kasbon.kode_amount = tbl_kasbon.kode_amount join tbl_status_kasbon on tbl_status_kasbon.kode_status = tbl_kasbon.kode_status WHERE st_lunas = 'PENDING'");
                        while($row = $res->fetch_assoc()){

                          $jmlh = $row['jmlh_amount'];  
                          $rp = "Rp. ";
                          $total = $row['amount1'] + $row['amount2'] + $row['amount3'] + $row['amount4'] + $row['amount5'] + $row['amount6'] + $row['amount7'] + $row['amount8'] + $row['amount9'] + $row['amount10'];
                          $sisa = $row['jmlh_amount'] - $total;                     
                        
                      ?>
                      
                      <tr>
                          <td><?php echo $no; ?></td>
                          <td style="text-align: left;"><?php echo $row['nama_project']; ?></td>
                          <td><?php echo $row['wo_id']; ?></td>
                          <td><?php echo $row['nama']; ?></td>
                          <td><?php echo $row['tgl_jalan']; ?></td>
                          <td><?php echo $rp, number_format($jmlh, 0, ".", "."); ?></td>
                          <td><?php echo $rp, number_format($total, 0, ".", "."); ?></td>
                          <td><?php echo $rp, number_format($sisa, 0, ".", "."); ?></td>
                          <td><?php echo $row['st_lunas']; ?></td>
                          <td>
                            <a data-rel="tooltip" title="View Detail" class="blue" href="?id=view-kasbon&mod=view&id_n=<?php echo $row['id_kasbon'];?>">
                              <span class="fa fa-list">
                            </a>
                            <a data-rel="tooltip" title="Update Detail" class="purple" href="?id=add-cash-receipt&mod=update&id_n=<?php echo $row['id_kasbon'];?>">
                              <span class="fa fa-plus-square">
                            </a>
                            <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-cash-receipt&mod=edit&id_n=<?php echo $row['id_kasbon'];?>">
                              <span class="fa fa-edit">
                            </a>
                            <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=cash-receipt&mod=del&id_n=<?php echo $row['id_kasbon'];?>" onclick="return confirm('Menghapus Data <?php echo $row['id_kasbon'];?>')">
                              <span class="fa fa-trash-o">
                            </a>
                          </td>
                        </tr>
                    <?php $no++; } ?>
                      </tbody>
                    </table>

                    <!--Ajax Processing  -->
                       <!-- <div class="table-responsive">
                        <table id="example-2" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                    <th>No.</th>
                                    <th>Project Name</th>
                                    <th>WO ID</th>
                                    <th>Technician</th>
                                    <th>Tgl Kasbon</th>
                                    <th>Kasbon</th>
                                    <th>Terpakai</th>
                                    <th>Sisa</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                  </tr>
                              </thead>
                          </table>
                        </div> -->
                  </div>

                  <?php 
                    } elseif ($mod == 'belum') {
                  ?>
                  
                  <center>
                    <a href="?id=cash-receipt"><button type="button" class="btn btn-success">ALL</button></a>
                    <a href="?id=kasbon&mod=selesai"><button type="button" class="btn btn-primary">SELESAI</button></a>
                    <a href="?id=kasbon&mod=pending"><button type="button" class="btn btn-warning" >PENDING</button></a>
                    <a href="?id=kasbon&mod=belum"><button type="button" class="btn btn-danger">BELUM SELESAI</button></a>
                  </center>           
                  <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered table-responsive dt-responsive nowrap table-hover">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Project Name</th>
                          <th>WO ID</th>
                          <th>Technician</th>
                          <th>Tgl Kasbon</th>
                          <th>Kasbon</th>
                          <th>Terpakai</th>
                          <th>Sisa</th>
                          <th>Keterangan</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        
                      <?php
                        $no = 1;
                        $res = $con->query("SELECT * FROM tbl_kasbon join tbl_amount_kasbon on tbl_amount_kasbon.kode_amount = tbl_kasbon.kode_amount join tbl_status_kasbon on tbl_status_kasbon.kode_status = tbl_kasbon.kode_status WHERE st_lunas = 'BELUM SELESAI'");
                        while($row = $res->fetch_assoc()){

                          $jmlh = $row['jmlh_amount'];  
                          $rp = "Rp. ";
                          $total = $row['amount1'] + $row['amount2'] + $row['amount3'] + $row['amount4'] + $row['amount5'] + $row['amount6'] + $row['amount7'] + $row['amount8'] + $row['amount9'] + $row['amount10'];
                          $sisa = $row['jmlh_amount'] - $total;                     
                        
                      ?>
                      
                      <tr>
                          <td><?php echo $no; ?></td>
                          <td style="text-align: left;"><?php echo $row['nama_project']; ?></td>
                          <td><?php echo $row['wo_id']; ?></td>
                          <td><?php echo $row['nama']; ?></td>
                          <td><?php echo $row['tgl_jalan']; ?></td>
                          <td><?php echo $rp, number_format($jmlh, 0, ".", "."); ?></td>
                          <td><?php echo $rp, number_format($total, 0, ".", "."); ?></td>
                          <td><?php echo $rp, number_format($sisa, 0, ".", "."); ?></td>
                          <td><?php echo $row['st_lunas']; ?></td>
                          <td>
                            <a data-rel="tooltip" title="View Detail" class="blue" href="?id=view-kasbon&mod=view&id_n=<?php echo $row['id_kasbon'];?>">
                              <span class="fa fa-list">
                            </a>
                            <a data-rel="tooltip" title="Update Detail" class="purple" href="?id=add-cash-receipt&mod=update&id_n=<?php echo $row['id_kasbon'];?>">
                              <span class="fa fa-plus-square">
                            </a>
                            <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-cash-receipt&mod=edit&id_n=<?php echo $row['id_kasbon'];?>">
                              <span class="fa fa-edit">
                            </a>
                            <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=cash-receipt&mod=del&id_n=<?php echo $row['id_kasbon'];?>" onclick="return confirm('Menghapus Data <?php echo $row['id_kasbon'];?>')">
                              <span class="fa fa-trash-o">
                            </a>
                          </td>
                        </tr>
                    <?php $no++; } ?>
                      </tbody>
                    </table>

                    <!--Ajax Processing  -->
                       <!-- <div class="table-responsive">
                        <table id="example-3" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                    <th>No.</th>
                                    <th>Project Name</th>
                                    <th>WO ID</th>
                                    <th>Technician</th>
                                    <th>Tgl Kasbon</th>
                                    <th>Kasbon</th>
                                    <th>Terpakai</th>
                                    <th>Sisa</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                  </tr>
                              </thead>
                          </table>
                        </div> -->
                  </div>
                  
                  <?php
                    }
                  ?>
                </div>
              </div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    $(document).ready(function() {
     $('#example-1').DataTable( {
          "bProcessing": true,
          "bServerSide": true,
          "ajax": "serverside/response.php?view=kasbon-list-selesai",
      } );
  } );
</script>
<script>
    $(document).ready(function() {
     $('#datatable-responsive-2').DataTable( {
          "bProcessing": true,
          "bServerSide": true,
          "ajax": "serverside/response.php?view=kasbon-list-pending",
      } );
  } );
</script>
<script>
    $(document).ready(function() {
     $('#datatable-responsive-3').DataTable( {
          "bProcessing": true,
          "bServerSide": true,
          "ajax": "serverside/response.php?view=kasbon-list-belum",
      } );
  } );
</script> -->