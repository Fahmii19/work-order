<?php 
  include('config/koneksi.php');

  // harap include SESSION <?php include('session.php'); //

  $mod         = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $id_daftar   = isset($_GET['id_n']) ? $_GET['id_n'] : "";
  $p_tombol    = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
  $p_id_daftar = isset($_POST['id_daftar']) ? $_POST['id_daftar'] : "";  
  $p_id_wo     = isset($_POST['wo']) ? $_POST['wo'] : "";
  $p_id_so     = isset($_POST['so']) ? $_POST['so'] : "";
?>

      
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Income by WO  <small>Laporan Income</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <?php
        
          if ($mod == 'search') {
                                     
      ?>
      <form class="form-horizontal" action="?id=incomeWO&mod=view" method="post"  role="form">
        <input type="hidden" name="id_daftar" value="<?php echo $id_daftar; ?>">
        <div class="panel panel-primary setup-content">
          <div class="panel-heading">
            <h3 class="panel-title">Search by ID WO</h3>
          </div>
          <div class="panel-body">
            <div class="form-group">
              <div class="col-xs-24 col-lg-12">
                <label for="wo">ID WO</label>
                <input type="text" name="wo" class="form-control" id="woid" ><br/>
            </div>
            <div class="form-group">
              <br/>
              <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="SUBMIT">              
            </div>
          </div>
        </div>
      </div>                          
    </form>

       <?php
         } 
         if ($mod == "view") {
      ?>                      

                        <h3><b>WO ID : <?php echo $p_id_wo; ?></b></h3>
                         <form class="form-horizontal" action="report/excel-income-wo.php" method="post"  role="form">
                          <input type="hidden" name="wo" value="<?= $p_id_wo ?>">
                          
                          <input type="submit" name="kirim_daftar" class="btn btn-primary" value="EXPORT">
                        <hr>
      
                        <!--Ajax Processing  -->
                        <div class="table-responsive">
                          <table id="example" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
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
                                  $view = mysqli_query($con, "SELECT * FROM tbl_kode_income JOIN tbl_income ON tbl_kode_income.kd_income = tbl_income.kd_income JOIN tbl_income_detail ON tbl_kode_income.kd_detail = tbl_income_detail.kd_detail JOIN tbl_project_wo ON tbl_project_wo.wo_id = tbl_income.wo_id WHERE tbl_income.wo_id LIKE '%".$p_id_wo."%'");
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
                        </div>
                          
                        <?php }?>
                        <hr>
           
        </div>
      </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- <script>
    $(document).ready(function() {
     $('#example').DataTable( {
          "bProcessing": true,
          "bServerSide": true,
          "ajax": "serverside/response.php?view=income-wo?wo_id=<?= $p_id_wo ?>",
          "language": {                
            "infoFiltered": ""
          }
      } );
  } );
</script> -->


                        