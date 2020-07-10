<?php
//memasukkan koneksi database
include("../config/koneksi.php");

  $p_edit     = "Update";

//jika berhasil/ada post['id'], jika tidak ada ya tidak dijalankan
if(isset($_POST['id'])){
  //membuat variabel id berisi post['id']
  $id = $_POST['id'];
  //query standart select where id
  $view = $con->query("SELECT * FROM project_kasbon WHERE id ='$id'");
  //jika ada datanya
  if($view->num_rows){
    //fetch data ke dalam veriabel $row_view
    $row_view = $view->fetch_assoc();
    //menampilkan data dengan table
  ?>
          <form name="form" method="post" action="?id=kategori">
              <div class="form-group">
                <label class="control-label">ID</label>
                <input maxlength="100" name="id" value="<?php echo $row_view['id']; ?>" type="text" class="form-control" placeholder="ID Automatically" readonly />
              </div>
              <div class="form-group">
                <label class="control-label">Kategori Kasbon</label>
                <input maxlength="100" name="kategori" type="text" required="required" value="<?php echo $row_view['kategori']; ?>" class="form-control" placeholder="Masukkan Kategori"/>
              </div>
              <div class="form-group">
                <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="<?php echo $p_edit; ?>">
              </div>
            </form>
            <?php 
              }
            }
            ?>