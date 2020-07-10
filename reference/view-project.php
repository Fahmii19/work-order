<?php
//memasukkan koneksi database
include("../config/koneksi.php");

  $p_edit     = "Update";

//jika berhasil/ada post['id'], jika tidak ada ya tidak dijalankan
if(isset($_POST['id'])){
  //membuat variabel id berisi post['id']
  $id = $_POST['id'];
  //query standart select where id
  $view = $con->query("SELECT * FROM project_wo WHERE id ='$id'");
  //jika ada datanya
  if($view->num_rows){
    //fetch data ke dalam veriabel $row_view
    $row_view = $view->fetch_assoc();
    //menampilkan data dengan table
  ?>
          <form name="form1" method="post" action="?id=project-title">
              <div class="form-group">
                <label class="control-label">ID</label>
                <input maxlength="100" name="id" value="<?php echo $row_view['id']; ?>" type="text" class="form-control" placeholder="ID Automatically" readonly />
              </div>
              <div class="form-group">
                <label class="control-label">Project Title</label>
                <input maxlength="100" name="project" type="text" required="required" value="<?php echo $row_view['nama_project']; ?>" class="form-control" placeholder="Enter Project Title"/>
              </div>
              <div class="form-group">
                <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="<?php echo $p_edit; ?>">
              </div>
            </form>
            <?php 
              }
            }
            ?>