<?php 
  error_reporting(0);

  include('config/koneksi.php');

  $mod      = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $id_del     = isset($_GET['id_n']) ? $_GET['id_n'] : NULL;

  if ($mod == "del") {
    $q_del = mysqli_query($con, "DELETE FROM tbl_ptjb WHERE id_ptjb = '$id_del'");

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
                    <h2>PTJB List <small>Cash Receipt</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <!-- <table id="datatable-responsive" class="table table-striped table-bordered table-responsive dt-responsive nowrap table-hover">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>WO ID</th>
                          <th>Technician</th>
                          <th>Amount</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        
                      <?php
                        
                        $no = 1;
                        $res = $con->query("SELECT * FROM tbl_ptjb join tbl_amount on tbl_amount.kode_amount_ptjb = tbl_ptjb.kode_amount_ptjb");
                        while($row = $res->fetch_assoc()){
                          $total = $row['amount1'] + $row['amount2'] + $row['amount3'] + $row['amount4'] + $row['amount5'] + $row['amount6'] + $row['amount7'] + $row['amount8'] + $row['amount9'] + $row['amount10'];
                          $price[]      = $total;
                          $amount_total = array_sum($price);
                          $rp = "Rp. ";
                      ?>

                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $row['wo_id']; ?></td>
                          <td><?php echo $row['nama']; ?></td>
                          <td><?php echo $rp, number_format($total, 0, ".", "."); ?></td>
                          <td>
                            <a data-rel="tooltip" title="View Detail" class="blue" href="?id=view-ptjb&mod=view&id_n=<?php echo $row['id_ptjb'];?>">
                              <span class="fa fa-list">
                            </a>                          
                            <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-ptjb&mod=edit&id_n=<?php echo $row['id_ptjb'];?>">
                              <span class="fa fa-edit">
                            </a>
                            <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=ptjb&mod=del&id_n=<?php echo $row['id_ptjb'];?>" onclick="return confirm('Menghapus Data <?php echo $row['id_ptjb'];?>')">
                              <span class="fa fa-trash-o">
                            </a>
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
                                    <th>No.</th>
                                    <th>WO ID</th>
                                    <th>Technician</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                  </tr>
                              </thead>
                          </table>
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
          "ajax": "serverside/response.php?view=ptjb-list-rm",
          "language": {                
            "infoFiltered": ""
          }
      } );
  } );
</script>