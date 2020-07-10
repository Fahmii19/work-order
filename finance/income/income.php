<?php 
  error_reporting(0);

  include('config/koneksi.php');

  $mod      = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $id_del     = isset($_GET['id_n']) ? $_GET['id_n'] : NULL;

  if ($mod == "del") {
    $q_del = mysqli_query($con, "DELETE FROM tbl_kode_income WHERE id_income = '$id_del'");

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
                    <h2>Income List <small>Project Order</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <!-- <table id="datatable-buttons" class="table table-striped table-bordered table-responsive table-hover">
                      <thead>
                        <tr>
                          <th>NO</th>
                          <th>Nomor BA</th>
                          <th>Tanggal BA</th>
                          <th>Deskripsi</th>
                          <th>PM</th>
                          <th>Notes</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        
                      <?php
                        $no = 1;
                        $res = $con->query("SELECT * FROM tbl_kode_income join tbl_income on tbl_income.kd_income = tbl_kode_income.kd_income join tbl_income_detail on tbl_income_detail.kd_detail = tbl_kode_income.kd_detail WHERE ket = 'first'");
                        while($row = $res->fetch_assoc()){
                          $ba = $row['no_ba'];
                          $sql = $con->query("SELECT * FROM tbl_income where no_ba = '$ba'");
                          while($data = $sql->fetch_assoc()){
                            $rp = "Rp. ";
                            $price[] = $data['price'];
                            $nominal[] = $data['price'];
                            $amount = array_sum($price);
                            $p_nominal = array_sum($nominal);
                          }
                      ?>

                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $row['no_ba']; ?></td>
                          <td><?php echo $row['tglba']; ?></td>
                          <td><?php echo $row['deskripsi']; ?></td>
                          <td><?php echo $row['pm']; ?></td>
                          <td><?php echo $row['notes']; ?></td>
                          <td>
                            <a data-rel="tooltip" title="View Detail" class="blue" href="?id=view-income&mod=view&id_n=<?php echo $row['no_ba'];?>">
                              <span class="fa fa-list">
                            </a>
                            <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-income&mod=edit&id_n=<?php echo $row['id_income'];?>">
                              <span class="fa fa-pencil">
                            </a>
                            <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=income&mod=del&id_n=<?php echo $row['id_income'];?>" onclick="return confirm('Menghapus Data <?php echo $row['id_income'];?>')">
                              <span class="fa fa-trash-o">
                            </a>
                          </td>
                        </tr>
                    <?php $no++; } ?>
                      </tbody>
                      
                      <thead>
                        <tr>
                          <th colspan="5"><h3>Total BA : </h3></th>
                          <th colspan="2"><h3><?php echo $rp, number_format($amount, 0, ".", "."); ?></h3></th>
                        </tr>
                      </thead>
                    </table> -->

                    <!--Ajax Processing  -->
                       <div class="table-responsive">
                        <table id="example" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                    <th>NO</th>
                                    <th>Nomor BA</th>
                                    <th>Tanggal BA</th>
                                    <th>Deskripsi</th>
                                    <th>PM</th>
                                    <th>Notes</th>
                                    <th>Action</th>
                                  </tr>
                              </thead>

                            <tfoot>
                              <?php
                              $no = 1;
                              $res = $con->query("SELECT * FROM tbl_kode_income join tbl_income on tbl_income.kd_income = tbl_kode_income.kd_income join tbl_income_detail on tbl_income_detail.kd_detail = tbl_kode_income.kd_detail WHERE ket = 'first'");
                              while($row = $res->fetch_assoc()){
                                $ba = $row['no_ba'];
                                $sql = $con->query("SELECT * FROM tbl_income where no_ba = '$ba'");
                                while($data = $sql->fetch_assoc()){
                                  $rp = "Rp. ";
                                  $price[] = $data['price'];
                                  $nominal[] = $data['price'];
                                  $amount = array_sum($price);
                                  $p_nominal = array_sum($nominal);
                                }
                              }
                            ?>
                              <tr>
                                <th colspan="5"><h3>Total BA : </h3></th>
                                <th colspan="2"><h3><?php echo $rp, number_format($amount, 0, ".", "."); ?></h3></th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                  </div>
                </div>
              </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    $(document).ready(function() {
     $('#example').DataTable( {
          "bProcessing": true,
          "bServerSide": true,
          "ajax": "serverside/response.php?view=income-list",
          "language": {                
            "infoFiltered": ""
          }
      } );
  } );
</script>
      
              