<?php 

  include('config/koneksi.php');

  $nipmax=mysqli_fetch_array(mysqli_query($con, "SELECT max(nik) FROM tbl_pkl"));
  $nomor_nip=$nipmax[0];

  $mod         = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $id_daftar   = isset($_GET['id_n']) ? $_GET['id_n'] : NULL;
  $p_tombol    = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";

  $p_id   = isset($_POST['id']) ? $_POST['id'] : "";    
  $p_kasbon   = isset($_POST['kategori']) ? $_POST['kategori'] : "";    

  $p_tambah   = "Add";
  $p_edit     = "Update";


  if ($mod == "del") {
    $q_del = mysqli_query($con, "DELETE FROM project_kasbon WHERE id = '$id_daftar'");

    if ($q_del) {
      echo "<div id='gagal' class='alert alert-success'><strong>SUCCESS</strong> Kategori Berhasil di Hapus <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    } else {
      echo "<div id='gagal' class='alert alert-danger'><strong>Gagal! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    }
  }

  if ($p_tombol == "Add") {

    $q_tmb = mysqli_query($con, "INSERT INTO project_kasbon VALUES(NULL,'$p_kasbon')");
    

    if ($q_tmb) {
      echo "<div id='gagal' class='alert alert-success'><strong>SUCCESS</strong> Kategori Berhasil di Simpan <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    } else {
      echo "<div id='gagal' class='alert alert-danger'><strong>Gagal! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    }
  } elseif ($p_tombol == "Update") {

    $q_edt = mysqli_query($con, "UPDATE project_kasbon SET kategori = '$p_kasbon' WHERE id = '$p_id'");
    

    if ($q_edt) {
      echo "<div id='gagal' class='alert alert-success'><strong>SUCCESS</strong> Kategori Berhasil di Ubah <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    } else {
      echo "<div id='gagal' class='alert alert-danger'><strong>SORRY! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    }
  }
?>

<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kategori Keterangan Kasbon</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <a href="#&mod=tambah" class="btn btn-app btn-success btn-xs" id="myBtn" data-toogle="tooltip" title="Add Kategori">
                      <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
                      Add
                    </a>
                  <a href="?id=kategori" class="btn btn-app btn-success btn-xs"  data-toogle="tooltip" title="Refresh">
                      <i class="ace-icon fa fa-refresh bigger-160"></i>
                      Refresh
                    </a>
                  <div class="x_content">

                    <table width='100%' id="datatable-responsive" class='table table-striped table-hover table-responsive dt-responsive nowrap table-bordered'>
                      <thead>
                        <tr>
                          <th width='5%'>NO</th>
                          <th width='70%'>Kategori Kasbon</th>
                          <th width='25%'>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 

                          $query=mysqli_query($con,"SELECT * FROM project_kasbon") or die(mysqli_error($con));
                          $no = 0;
                          while($row=mysqli_fetch_array($query)){
                            $no++;
                            ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $row['kategori']; ?></td>
                              <td>
                                <a href="#&id_n=<?php echo $row[0];?>" class="view_data3 green" data-toggle="modal" id="<?php echo $row[0]; ?>" data-target="#myModal2">
                                  <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
                                </a>
                                <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=kategori&mod=del&id_n=<?php echo $row[0];?>" onclick="return confirm('Menghapus Data <?php echo $row[1];?>')">
                                  <span class="fa fa-trash-o">
                                </a>
                              </td>
                            </tr>
                            <?php
                          }
                   
                        ?>
                      </tbody>
                    </table>

                    <!--Ajax Processing  -->
                       <!-- <div class="table-responsive">
                        <table id="example-1" class="table table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                    <th width='5%'>NO</th>
                                    <th width='70%'>Kategori Kasbon</th>
                                    <th width='25%'>Action</th>
                                  </tr>
                              </thead>
                          </table>
                        </div> -->
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
          <h4 class="modal-title">Add Kategori Kasbon</h4>
        </div>
        <form name="form1" method="post" action="?id=kategori">
          <div class="modal-body">
            <div class="form-group">
              <label class="control-label">ID</label>
              <input maxlength="100" name="id" type="text" class="form-control" placeholder="ID Automatically" readonly />
            </div>
            <div class="form-group">
              <label class="control-label">Kategori Kasbon</label>
              <input maxlength="100" name="kategori" type="text" required="required" class="form-control" placeholder="Masukkan Kategori"/>
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

     <!-- Modal -->
  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Edit Kategori Kasbon</h4>
        </div>
        
        <!-- memulai untuk konten dinamis -->
        <!-- lihat id="data_siswa", ini yang di pangging pada ajax di bawah -->

        <div class="modal-body" id="data_siswa">
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal({show: true});
    });
    $("#myBtn2").click(function(){
        $("#myModal2").modal({show: true});
    });
});
</script>


<script>
  // ini menyiapkan dokumen agar siap grak :)
  $(document).ready(function(){
    // yang bawah ini bekerja jika tombol lihat data (class="view_data") di klik
    $('.view_data3').click(function(){
      // membuat variabel id, nilainya dari attribut id pada button
      // id="'.$row['id'].'" -> data id dari database ya sob, jadi dinamis nanti id nya
      var id = $(this).attr("id");

      $id = document.getElementById('id');
      
      // memulai ajax
      $.ajax({
        success:function(){   // kode dibawah ini jalan kalau sukses
          $('#myModal2').modal("show");  // menampilkan dialog modal nya
        }
      });
    });
  });
  </script>

  <script>
        $(function(){
            $(document).on('click','.edit-record',function(e){
                e.preventDefault();
                $("#myModal2").modal('show');
                $.post('reference/view.php',
                    {id:$(this).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }   
                );
            });
        });
    </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    $(document).ready(function() {
     $('#example-1').DataTable( {
          "bProcessing": true,
          "bServerSide": true,
          "ajax": "serverside/response.php?view=kategori-kasbon",
          "language": {                
            "infoFiltered": ""
          }
      } );
  } );
</script>