<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Report Order <small>Laporan Order</small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <form class="form-horizontal" action="report/Book-Of-Live.php" method="post"  role="form">
        <div class="panel panel-primary setup-content">
          <div class="panel-heading">
          <h3 class="panel-title">Lihat Order per-Bulan</h3>
          </div>
          <div class="panel-body">
            <div class="form-group">
              <div class="col-xs-12 col-lg-6">
                <label for="wo">Bulan</label>
                <select class="form-control" name="bulan" required>
                  <option value="" hidden>Pilih Bulan</option>
                  <option value="01" >Januari</option>
                  <option value="02" >Februari</option>
                  <option value="03" >Maret</option>
                  <option value="04" >April</option>
                  <option value="05" >Mei</option>
                  <option value="06" >Juni</option>
                  <option value="07" >Juli</option>
                  <option value="08" >Agustus</option>
                  <option value="09" >September</option>
                  <option value="10" >Oktober</option>
                  <option value="11" >November</option>
                  <option value="12" >Desember</option>
                </select>
              </div>
              <div class="col-xs-12 col-lg-6">
                <label for="wo">Tahun</label>
                <select name="tahun" class="form-control" required>
                    <option value="" hidden>Pilih Tahun</option>
                    <?php
                    $thn_skr = date('Y');
                    for ($x = $thn_skr; $x >= 2010; $x--) {
                    ?>
                        <option value="<?php echo $x ?>"><?php echo $x ?></option>
                    <?php
                    }
                    ?>
                </select>
              </div>
            </div>
            <hr>
            <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="SUBMIT">
          </div>
        </div>                          
      </form>
    </div>
  </div>
</div>