          <?php
//memasukkan koneksi database
include("../config/koneksi.php");


  $p_edit     = "Update";

//jika berhasil/ada post['id'], jika tidak ada ya tidak dijalankan
if(isset($_POST['id'])){
  //membuat variabel id berisi post['id']
  $id = $_POST['id'];
  //query standart select where id
  $view = $con->query("SELECT * FROM tbl_pkl WHERE id='$id'");
  //jika ada datanya
  if($view->num_rows){
    //fetch data ke dalam veriabel $row_view
    $row_view = $view->fetch_assoc();
    //menampilkan data dengan table
  ?>

  <form name="form2" method="post" action="?id=technician-pkl">
              <input type="hidden" name="id_daftar" value="<?php echo $row_view['id']; ?>">
              <div class="form-group">
                <label class="control-label">NIK</label>
                <input maxlength="100" name="nik" type="text" required="required" class="form-control" placeholder="Enter NIK" value="<?php echo $row_view['nik']; ?>" />
              </div>
              <div class="form-group">
                <label class="control-label">Nama</label>
                <input maxlength="100" name="nama" type="text" required="required" class="form-control" placeholder="Enter Name" value="<?php echo $row_view['nama'] ?>" />
              </div>
              <div class="form-group">
                <label class="control-label">Jabatan</label>
                <select name="jabatan" class="form-control" value="">
                          <option>-- Jabatan --</option>
                            <?php
                          $q = mysqli_query($con, "select * from bagian order by n_bag"); 

                            while ($a = mysqli_fetch_array($q)){
                            if ($a[1] ==$row_view['jabatan']) {
                              echo "<option value='$a[1]' selected>$a[2]</option>";
                            } else {
                            echo "<option value='$a[1]'>$a[2]</option>";
                            }
                              }
                            ?>
                        </select>
              </div>
              <div class="form-group">
                <label class="control-label">Status</label>
                <input type="text" class="form-control" name="status" value="PKL" readonly>
              </div>
              <div class="form-group">
                <label class="control-label">No. Handphone</label>
                <input maxlength="100" name="nohp" type="text" required="required" class="form-control" placeholder="Enter No. Handphone" value="<?php echo $row_view['nohp']; ?>" />
              </div>
              <input type="submit" name="kirim_daftar" class="btn btn-primary pull-right" value="<?php echo $p_edit; ?>">
            </form>
<?php 
  }
}
?>