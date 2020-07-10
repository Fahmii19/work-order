          <?php
//memasukkan koneksi database
include("../config/koneksi.php");

//jika berhasil/ada post['id'], jika tidak ada ya tidak dijalankan
if(isset($_POST['id'])){
  //membuat variabel id berisi post['id']
  $id = $_POST['id'];
  //query standart select where id
  $view = $con->query("SELECT * FROM pegawai join bagian on bagian.kd_bag = pegawai.id_bag WHERE id = '$id' and id_bag='B004' OR id_bag='B005' OR id_bag='B006'") or die(mysqli_error($con));
  //jika ada datanya
  if($view->num_rows){
    //fetch data ke dalam veriabel $row_view
    $row_view = $view->fetch_assoc();
    //menampilkan data dengan table
  ?>

  <form name="form2" method="post" action="#">
              <input type="hidden" name="id_daftar" value="<?php echo $row_view['id']; ?>">
              <div class="form-group">
                <label class="control-label">NIK</label>
                <input maxlength="100" name="nik" type="text" required="required" class="form-control" placeholder="Enter NIK" value="<?php echo $row_view['nip']; ?>" readonly />
              </div>
              <div class="form-group">
                <label class="control-label">Nama</label>
                <input maxlength="100" name="nama" type="text" required="required" class="form-control" placeholder="Enter Name" value="<?php echo $row_view['nama'] ?>" readonly />
              </div>
              <div class="form-group">
                <label class="control-label">Jabatan</label>
                <input maxlength="100" name="jabatan" type="text" required="required" readonly class="form-control" placeholder="Enter No. Handphone" value="<?php echo $row_view['n_bag']; ?>" />
              </div>
              <div class="form-group">
                <label class="control-label">No. Handphone</label>
                <input maxlength="100" name="nohp" type="text" required="required" readonly class="form-control" placeholder="Enter No. Handphone" value="<?php echo $row_view['nohp']; ?>" />
              </div>
            </form>
<?php 
  }
}
?>