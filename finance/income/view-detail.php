<?php
  include('config/koneksi.php');

  $mod         = isset($_GET['mod']) ? $_GET['mod'] : "";
  $hps         = isset($_GET['hps']) ? $_GET['hps'] : "";
  $id_daftar_g = isset($_GET['id_n']) ? $_GET['id_n'] : "";
  $id_delete   = isset($_GET['id_d']) ? $_GET['id_d'] : "";

    if ($mod == "view") {

      $p_tampil     = mysqli_query($con, "SELECT * FROM tbl_kode_income join tbl_income on tbl_income.kd_income = tbl_kode_income.kd_income join tbl_income_detail on tbl_income_detail.kd_detail = tbl_kode_income.kd_detail WHERE id_income = '$id_daftar_g'");
      $p_lihat      = mysqli_fetch_array($p_tampil);
      $id_daftar    = $p_lihat['id_income'];
      $kd_income    = $p_lihat['kd_income'];
      $kd_detail    = $p_lihat['kd_detail'];
      $p_id_wo      = $p_lihat['wo_id'];
      $p_id_so      = $p_lihat['so_id'];
      $p_ba         = $p_lihat['no_ba'];  
      $p_boq        = $p_lihat['no_boq']; 
      $p_tglba      = $p_lihat['tglba']; 
      $p_desk       = $p_lihat['deskripsi']; 
      $p_pm         = $p_lihat['pm']; 
      $p_verif      = $p_lihat['verifikasi'];
      $p_nopb       = $p_lihat['no_pb'];
      $p_pbdate     = $p_lihat['pb_date'];
      $p_hand       = $p_lihat['handover'];
      $p_pono       = $p_lihat['po_no'];
      $p_podate     = $p_lihat['po_date'];
      $p_reqgr      = $p_lihat['req_gr'];
      $p_invno      = $p_lihat['inv_no'];
      $p_paystat    = $p_lihat['pay_stat'];
      $p_paydate    = $p_lihat['pay_date'];
      $p_final      = $p_lihat['final_stat'];
      $p_notes      = $p_lihat['notes'];

      $sql = $con->query("SELECT * FROM tbl_income where no_ba = '$p_ba'");
      while($data = $sql->fetch_assoc()){
        $rp = "Rp. ";
        $price[] = $data['price'];
        $nominal[] = $data['price'];
        $amount = array_sum($price);
        $p_nominal = array_sum($nominal);
      }

    } elseif ($mod == "more") {
      $m_tampil     = mysqli_query($con, "SELECT * FROM tbl_kode_income join tbl_income on tbl_income.kd_income = tbl_kode_income.kd_income join tbl_income_detail on tbl_income_detail.kd_detail = tbl_kode_income.kd_detail WHERE no_ba = '$id_daftar_g'");
      $m_lihat      = mysqli_fetch_array($m_tampil);
      $mid_daftar   = $m_lihat['id_income'];
      $mkd_income   = $m_lihat['kd_income'];
      $mkd_detail   = $m_lihat['kd_detail'];
      $m_id_wo      = $m_lihat['wo_id'];
      $m_id_so      = $m_lihat['so_id'];
      $m_ba         = $m_lihat['no_ba'];  
      $m_boq        = $m_lihat['no_boq']; 
      $m_tglba      = $m_lihat['tglba']; 
      $m_desk       = $m_lihat['deskripsi']; 
      $m_pm         = $m_lihat['pm']; 
      $m_verif      = $m_lihat['verifikasi'];
      $m_nopb       = $m_lihat['no_pb'];
      $m_pbdate     = $m_lihat['pb_date'];
      $m_hand       = $m_lihat['handover'];
      $m_pono       = $m_lihat['po_no'];
      $m_podate     = $m_lihat['po_date'];
      $m_reqgr      = $m_lihat['req_gr'];
      $m_invno      = $m_lihat['inv_no'];
      $m_paystat    = $m_lihat['pay_stat'];
      $m_paydate    = $m_lihat['pay_date'];
      $m_final      = $m_lihat['final_stat'];
      $m_notes      = $m_lihat['notes'];

            $query = $con->query("SELECT * FROM tbl_income where no_ba = '$m_ba'");
              while($show = $query->fetch_assoc()){
                $rp = "Rp. ";
                $nominal[] = $show['price'];
                $p_nominal = array_sum($nominal);
              }

    } elseif ($mod == "detail") {
      $d_tampil     = mysqli_query($con, "SELECT * FROM tbl_kode_income join tbl_income on tbl_income.kd_income = tbl_kode_income.kd_income join tbl_income_detail on tbl_income_detail.kd_detail = tbl_kode_income.kd_detail WHERE id_income = '$id_daftar_g'");
      $d_lihat      = mysqli_fetch_array($d_tampil);
      $did_daftar   = $d_lihat['id_income'];
      $dkd_income   = $d_lihat['kd_income'];
      $dkd_detail   = $d_lihat['kd_detail'];
      $d_id_wo      = $d_lihat['wo_id'];
      $d_id_so      = $d_lihat['so_id'];
      $d_ba         = $d_lihat['no_ba'];
      $d_price      = $d_lihat['price'];  
      $d_boq        = $d_lihat['no_boq']; 
      $d_tglba      = $d_lihat['tglba']; 
      $d_desk       = $d_lihat['deskripsi']; 
      $d_pm         = $d_lihat['pm']; 
      $d_verif      = $d_lihat['verifikasi'];
      $d_nopb       = $d_lihat['no_pb'];
      $d_pbdate     = $d_lihat['pb_date'];
      $d_hand       = $d_lihat['handover'];
      $d_pono       = $d_lihat['po_no'];
      $d_podate     = $d_lihat['po_date'];
      $d_reqgr      = $d_lihat['req_gr'];
      $d_invno      = $d_lihat['inv_no'];
      $d_paystat    = $d_lihat['pay_stat'];
      $d_paydate    = $d_lihat['pay_date'];
      $d_final      = $d_lihat['final_stat'];
      $d_notes      = $d_lihat['notes'];

    } elseif ($mod == "edit") {
      # code...

    }

    if ($hps == "del") {
      $q_del = mysqli_query($con, "DELETE FROM tbl_kode_income WHERE id_income = '$id_delete'");

      if ($q_del) {
        echo "<div id='gagal' class='alert alert-success'><strong>SUCCESS</strong> Data Order Berhasil di hapus <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
      } else {
        echo "<div id='gagal' class='alert alert-danger'><strong>SORRY! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
      }

    }
    
?>
   
      <?php
        if ($mod == "view") {
      ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View Income Detail</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="container">
                      <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">
                        <form>
                        
                        <table class="table table-striped" >
                            <tr>
                              <th class="col-sm-3 left">NOMOR BA</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $p_ba; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">TANGGAL BA</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $p_tglba; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">PM</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $p_pm; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">NOMINAL</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $rp, number_format($amount, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">DESKRIPSI</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $p_desk; ?></td>
                            </tr>
                        </table><br>
                        <a href="?id=view-income&mod=more&id_n=<?php echo $p_ba; ?>"><button type="button" class="btn btn-primary pull-right">VIEW MORE</button></a>
                        <hr><br>
                        <div class="x_content">
                          <table id="datatable-responsive" class="table table-striped table-bordered table-responsive dt-responsive nowrap table-hover">
                          <thead>
                            <tr>
                              <th>No BOQ</th>
                              <th>WO ID</th>
                              <th>SO ID</th>
                              <th>TOTAL BIAYA</th>
                              <th>Action</th>
                            </tr>
                          </thead>

                          <tbody>
                            <?php
                              
                              $res = $con->query("SELECT * FROM tbl_income JOIN tbl_kode_income ON tbl_kode_income.kd_income = tbl_income.kd_income where no_ba = '$p_ba'");
                              while($row = $res->fetch_assoc()){
                                $rp = "Rp. ";
                                $jmlh = $row['price'];
                            ?>

                            <tr>
                              <td><?php echo $row['no_boq']; ?></td>
                              <td><?php echo $row['wo_id']; ?></td>
                              <td><?php echo $row['so_id']; ?></td>
                              <td><?php echo $rp, number_format($jmlh, 0, ".", "."); ?></td>
                              <td>
                                <a data-rel="tooltip" title="View Detail" class="blue" href="?id=view-income&mod=detail&id_n=<?php echo $row['id_income'];?>">
                                  <span class="fa fa-list">
                                </a>
                                <a data-rel="tooltip" title="Edit Data" class="green" href="?id=add-income&mod=edit&id_n=<?php echo $row['id_income'];?>">
                                  <span class="fa fa-pencil">
                                </a>
                                <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=view-income&mod=view&id_n=<?php echo $id_daftar_g; ?>&hps=del&id_d=<?php echo $row['id_income'];?>" onclick="return confirm('Menghapus BOQ <?php echo $row['no_boq'];?>?')">
                                  <span class="fa fa-trash-o">
                                </a>
                              </td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>

                        <!--Ajax Processing  -->
                         <!-- <div class="table-responsive">
                          <table id="example" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                      <th>No BOQ</th>
                                      <th>WO ID</th>
                                      <th>SO ID</th>
                                      <th>TOTAL BIAYA</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>

                            </table>
                          </div> -->

                        </div>

                        <a href="javascript:history.back()"><button type="button" class="btn btn-primary">BACK</button></a>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <?php 
          } elseif ($mod == "detail") {
        ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>More Income Detail</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="container">
                      <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">
                        <form>
                        
                        <table class="table table-striped" >
                            <tr>
                              <th class="col-sm-3 left">ID WO</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $d_id_wo; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">ID SO</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $d_id_so; ?></td>
                            </tr>
                            
                            <tr>
                              <th class="col-sm-3 left">NOMOR BA</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $d_ba; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">TANGGAL BA</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $d_tglba; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">PM</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $d_pm; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">NOMINAL</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo 'Rp. ', number_format($d_price, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">DESKRIPSI</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $d_desk; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">VERIFIKASI</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $d_verif; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">NOMOR PB</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $d_nopb; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">PB DATE</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $d_pbdate; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">SC/HANDOVER</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $d_hand; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">NOMOR PO</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $d_pono; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">PO DATE</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $d_podate; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">REQUEST GR</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $d_reqgr; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">NOMOR INVOICE</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $d_invno; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">PAYMENT STATUS</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $d_paystat; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">PAYMENT DATE</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $d_paydate; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">FINAL STATUS</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $d_final; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">NOTES</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $d_notes; ?></td>
                            </tr>
                        </table>
                        </form>
                        </div>
                        <a href="javascript:history.back()"><button type="button" class="btn btn-primary">BACK</button></a>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <?php } elseif ($mod == "more") {
        ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>More Income Detail</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="container">
                      <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">
                        <form>
                        
                        <table class="table table-striped" >
                            <tr>
                              <th class="col-sm-3 left">NOMOR BA</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $m_ba; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">TANGGAL BA</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $m_tglba; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">PM</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $m_pm; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">NOMINAL</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $rp, number_format($p_nominal, 0, ".", "."); ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">DESKRIPSI</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $m_desk; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">VERIFIKASI</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $m_verif; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">NOMOR PB</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $m_nopb; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">PB DATE</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $m_pbdate; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">SC/HANDOVER</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $m_hand; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">NOMOR PO</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $m_pono; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">PO DATE</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $m_podate; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">REQUEST GR</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $m_reqgr; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">NOMOR INVOICE</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $m_invno; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">PAYMENT STATUS</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $m_paystat; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">PAYMENT DATE</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $m_paydate; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">FINAL STATUS</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $m_final; ?></td>
                            </tr>

                            <tr>
                              <th class="col-sm-3 left">NOTES</th>
                              <td class="col-sm-1 left">:</td>
                              <td class="col-sm-8 left"><?php echo $m_notes; ?></td>
                            </tr>
                        </table>
                        </form>
                        </div>
                        <a href="javascript:history.back()"><button type="button" class="btn btn-primary">BACK</button></a>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <?php } ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    $(document).ready(function() {
     $('#example').DataTable( {
          "bProcessing": true,
          "bServerSide": true,
          "ajax": "serverside/response.php?view=boq-list&no_ba=<?= $p_ba ?>",
      } );
  } );
</script>