<?php
//memasukkan koneksi database
include("../config/koneksi.php");

  $p_edit     = "Update";

//jika berhasil/ada post['id'], jika tidak ada ya tidak dijalankan
if(isset($_POST['id'])){
  //membuat variabel id berisi post['id']
  $id = $_POST['id'];
  //query standart select where id
  $view = $con->query("SELECT * FROM tbl_user_wo WHERE id='$id'");
  //jika ada datanya
  if($view->num_rows){
    //fetch data ke dalam veriabel $row_view
    $row_view = $view->fetch_assoc();
    //menampilkan data dengan table
  ?>
          <form name="form1" method="post" action="?id=list-user" role="form">
            <input type="hidden" name="id" value="<?php echo $row_view['id']; ?>">
            <div class="form-group">
              <label class="control-label">Username</label>
              <input maxlength="100" name="username" type="text" class="form-control" placeholder="Enter Username" value="<?php echo $row_view['username']; ?>" />
            </div>
            <div class="form-group">
              <label class="control-label">Password</label>
              <input maxlength="100" name="password" type="text" required="required" class="form-control" placeholder="Enter Password"/>
            </div>
            <div class="form-group">
              <label class="control-label">Name</label>
              <input maxlength="100" name="nama" type="text" required="required" class="form-control" placeholder="Enter Name" value="<?php echo $row_view['nama']; ?>"/>
            </div>
            <div class="form-group">
              <label class="control-label">Level</label>
                <select name="level" class="form-control" required>
                  <option value="">-- Level --</option>
                  <option value="Super Admin" <?php if($row_view['level'] == 'Super Admin'){ echo 'selected'; } ?>>Super Admin</option>
                  <option value="Admin" <?php if($row_view['level'] == 'Admin'){ echo 'selected'; } ?>>Admin</option>
                  <option value="Admin Finance" <?php if($row_view['level'] == 'Admin Finance'){ echo 'selected'; } ?>>Admin Finance</option>
                  <option value="Admin WO" <?php if($row_view['level'] == 'Admin WO'){ echo 'selected'; } ?>>Admin Technician</option>
                </select>
            </div>
            <div class="form-group">
              <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="<?php echo $p_edit; ?>">
            </div>
            </form>
            <?php 
              }
            }
            ?>