<?php 

  include('config/koneksi.php');

  $nipmax=mysqli_fetch_array(mysqli_query($con, "SELECT max(nik) FROM tbl_pkl"));
  $nomor_nip=$nipmax[0];

  $mod         = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $id_daftar   = isset($_GET['id_n']) ? $_GET['id_n'] : NULL;
  $p_tombol    = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";

  $p_id         = isset($_POST['id']) ? $_POST['id'] : "";
  $p_nip        = isset($_POST['nip']) ? $_POST['nip'] : "";
  $p_username   = isset($_POST['username']) ? $_POST['username'] : "";    
  $p_password   = isset($_POST['password']) ? $_POST['password'] : "";
  $p_cpassword  = isset($_POST['cpassword']) ? $_POST['cpassword'] : "";
  $p_nama       = isset($_POST['nama']) ? $_POST['nama'] : "";    
  $p_level      = isset($_POST['level']) ? $_POST['level'] : "";

  $p_tambah   = "Add";
  $p_edit     = "Update";


  if ($mod == "del") {
    $q_del = mysqli_query($con, "DELETE FROM tbl_user_wo WHERE id = '$id_daftar'");

    if ($q_del) {
      echo "<div id='gagal' class='alert alert-success'><strong>SUCCESS</strong> User Berhasil di hapus <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    } else {
      echo "<div id='gagal' class='alert alert-danger'><strong>SORRY! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    }
  } elseif ($mod == "edit") {
    
  }

  if ($p_tombol == "Add") {

    $cek_nip = mysqli_query($con, "SELECT * FROM tbl_pegawai WHERE nik = '$p_nip'");
    $ketemu  = mysqli_num_rows($cek_nip);
    if ($ketemu > 0) {
      $cek_nip2 = mysqli_query($con, "SELECT * FROM tbl_user_wo WHERE id = '$p_nip'");
      $ketemu2  = mysqli_num_rows($cek_nip2);
      if ($ketemu2 > 1) {
        echo "<div id='gagal' class='alert alert-danger'><strong>SORRY! </strong>NIP Pegawai Tidak Terdaftar <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
      } else {
        if ($p_password == $p_cpassword) {
          $q_tmb = mysqli_query($con, "INSERT INTO tbl_user_wo (id, username, password, level) VALUES('$p_nip','$p_username','$p_password','$p_level')");

          if ($q_tmb) {
          echo "<div id='gagal' class='alert alert-success'><strong>SUCCESS</strong> Data User Berhasil di simpan <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
          } else {
            echo "<div id='gagal' class='alert alert-danger'><strong>SORRY! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
          }
        } else {
          echo "<div id='gagal' class='alert alert-danger'><strong>SORRY! </strong>Konfirmasi Password Tidak Sesuai <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
        }
      }
    } else {
      echo "<div id='gagal' class='alert alert-danger'><strong>SORRY! </strong>NIP Pegawai Tidak Terdaftar <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    }
    
  } elseif ($p_tombol == "Update") {

      $q_edt = mysqli_query($con, "UPDATE tbl_user_wo SET username = '$p_username', password = '$p_password', level = '$p_level' WHERE id = '$p_nip' ") or die (mysqli_error($con));

      if ($q_edt) {
        echo "<div id='gagal' class='alert alert-success'><strong>SUCCESS</strong> Data User Berhasil di update <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
      } else {
        echo "<div id='gagal' class='alert alert-danger'><strong>SORRY! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
      }
  }
?>

<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List User <small>Daftar Pengguna</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <a href="#&mod=tambah" class="btn btn-app btn-success btn-xs" id="myBtn" data-toogle="tooltip" title="Add Technician">
                      <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
                      Add
                    </a>
                  <a href="?id=list-user" class="btn btn-app btn-success btn-xs"  data-toogle="tooltip" title="Refresh Window">
                      <i class="ace-icon fa fa-refresh bigger-160"></i>
                      Refresh
                    </a>
                  <div class="x_content">

                    <table width='100%' class='table table-striped table-hover table-responsive dt-responsive nowrap'>
                      <thead>
                        <tr>
                          <th width='5%'>No</th>
                          <th width='35%'>Name</th>
                          <th width='15%'>Name</th>
                          <th width='30%'>Waktu Login Terakhir</th>
                          <th width='15%'>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 

                          $query=mysqli_query($con,"SELECT * FROM tbl_user_wo join tbl_pegawai on tbl_pegawai.nik = tbl_user_wo.id") or die(mysqli_error($con));
                          $no = 0;
                          while($row=mysqli_fetch_array($query)){
                            $no++;
                            ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $row['nama']; ?></td>
                              <td><?php echo $row['level']; ?></td>
                              <td><?php echo $row['w_login']; ?></td>
                              <td>
                                <a href="#<?php echo $row[0];?>" data-toggle="modal" title="Edit User" data-target="#myModalEdit<?php echo $row[0];?>" class="green"><span class="fa fa-edit"></span></a>
                                <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=list-user&mod=del&id_n=<?php echo $row[0];?>" onclick="return confirm('Menghapus Data <?php echo $row[3];?>')">
                              <span class="fa fa-trash-o">
                            </a>
                              </td>
                            </tr>

                            <div class="modal fade" id="myModalEdit<?php echo $row[0];?>" tabindex="-1" role="modal" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                                <div class="modal-dialog" role="document ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Edit User</h4>
                                        </div>
                                        <div class="modal-body">
                                           <form name="form1" method="post" action="?id=list-user" role="form">
                                            <div class="modal-body">
                                              <input type="hidden" name="nip" value="<?php echo $row[0]; ?>">
                                              <div class="form-group">
                                                <label class="control-label">Username</label>
                                                <input maxlength="100" name="username" type="text" class="form-control" placeholder="Enter Username" value="<?php echo $row['username']; ?>" />
                                              </div>
                                              <div class="form-group">
                                                <label class="control-label">Password</label>
                                                <input maxlength="100" name="password" type="password" required="required" class="form-control" placeholder="Enter Password"/>
                                              </div>
                                              <div class="form-group">
                                                <label class="control-label">Name</label>
                                                <input maxlength="100" name="nama" type="text" required="required" class="form-control" placeholder="Enter Name" value="<?php echo $row['nama']; ?>" readonly/>
                                              </div>
                                              <div class="form-group">
                                                <label class="control-label">Level</label>
                                                  <select name="level" class="form-control" required>
                                                    <option value="">-- Level --</option>
                                                    <option value="Super Admin" <?php if($row['level'] == 'Super Admin'){ echo 'selected'; } ?>>Super Admin</option>
                                                    <option value="Admin" <?php if($row['level'] == 'Admin'){ echo 'selected'; } ?>>Admin</option>
                                                    <option value="Admin Finance" <?php if($row['level'] == 'Admin Finance'){ echo 'selected'; } ?>>Admin Finance</option>
                                                    <option value="Admin WO" <?php if($row['level'] == 'Admin WO'){ echo 'selected'; } ?>>Admin Technician</option>
                                                    <option value="Admin Collection" <?php if($row['level'] == 'Admin Collection'){ echo 'selected'; } ?>>Admin Collection</option>
                                                    <option value="Admin RM" <?php if($row['level'] == 'Admin RM'){ echo 'selected'; } ?>>Admin RM</option>
                                                  </select>
                                              </div>
                                              <div class="modal-footer">
                                                <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="<?php echo $p_edit; ?>">
                                              </div>
                                            </div>
                                          </form> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                          }
                   
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="clearfix"></div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add User</h4>
        </div>
        <form name="form1" method="post" action="?id=list-user">
          <div class="modal-body">
            <div class="form-group">
              <label class="control-label">NIP</label>
              <input maxlength="100" name="nip" type="text" class="form-control" placeholder="Enter NIP"/>
            </div>
            <div class="form-group">
              <label class="control-label">Username</label>
              <input maxlength="100" name="username" type="text" class="form-control" placeholder="Enter Username"/>
            </div>
            <div class="form-group">
              <label class="control-label">Password</label>
              <input maxlength="100" name="password" type="password" required="required" class="form-control" placeholder="Enter Password"/>
            </div>
             <div class="form-group">
              <label class="control-label">Confirm Password</label>
              <input maxlength="100" name="cpassword" type="password" required="required" class="form-control" placeholder="Enter Confirm Password"/>
            </div>
            <div class="form-group">
              <label class="control-label">Level</label>
                <select name="level" class="form-control" required>
                  <option value="">-- Level User --</option>
                  <option value="Super Admin">Super Admin</option>
                  <option value="Admin">Admin</option>
                  <option value="Admin Finance">Admin Finance</option>
                  <option value="Admin WO">Admin Technician</option>
                  <option value="Admin Collection">Admin Collection</option>
                  <option value="Admin RM">Admin RM</option>
                </select>
            </div>
          </div>
          <div class="modal-footer">
            <input type="submit" name="kirim_daftar" class="btn btn-primary" value="<?php echo $p_tambah; ?>">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>

<script type="text/javascript">
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal({show: true});
    });
});
</script>