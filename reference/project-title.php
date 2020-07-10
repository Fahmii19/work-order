<?php 

  include('config/koneksi.php');

  $nipmax=mysqli_fetch_array(mysqli_query($con, "SELECT max(nik) FROM tbl_pkl"));
  $nomor_nip=$nipmax[0];

  $mod         = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $id_daftar   = isset($_GET['id_n']) ? $_GET['id_n'] : NULL;
  $p_tombol    = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";

  $p_id   = isset($_POST['id']) ? $_POST['id'] : "";    
  $p_project   = isset($_POST['project']) ? $_POST['project'] : "";    

  $p_tambah   = "Add";
  $p_edit     = "Update";


  if ($mod == "del") {
    $q_del = mysqli_query($con, "DELETE FROM project_wo WHERE id = '$id_daftar'");

    if ($q_del) {
      echo "<div id='gagal' class='alert alert-success'><strong>SUCCESS</strong> Project Title Berhasil di hapus <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    } else {
      echo "<div id='gagal' class='alert alert-danger'><strong>SORRY! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    }
  }

  if ($p_tombol == "Add") {

    $q_tmb = mysqli_query($con, "INSERT INTO project_wo VALUES(NULL,'$p_project')");
    

    if ($q_tmb) {
      echo "<div id='gagal' class='alert alert-success'><strong>SUCCESS</strong> Judul Project Berhasil di simpan <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    } else {
      echo "<div id='gagal' class='alert alert-danger'><strong>SORRY! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    }
  } elseif ($p_tombol == "Update") {

    $q_edt = mysqli_query($con, "UPDATE project_wo SET nama_project = '$p_project' WHERE id = '$p_id'");
    

    if ($q_edt) {
      echo "<div id='gagal' class='alert alert-success'><strong>SUCCESS</strong> Judul Project Berhasil di update <i class=' ace-icon fa fa-check'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    } else {
      echo "<div id='gagal' class='alert alert-danger'><strong>SORRY! </strong>".mysqli_error($con)." <i class='ace-icon fa fa-times'></i><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button></div>";
    }
  }
?>

<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Project Title <small>Judul Proyek</small></h2>
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
                  <a href="?id=project-title" class="btn btn-app btn-success btn-xs"  data-toogle="tooltip" title="Refresh Window">
                      <i class="ace-icon fa fa-refresh bigger-160"></i>
                      Refresh
                    </a>
                  <div class="x_content">

                    <table width='100%' id="datatable-responsive" class='table table-striped table-hover table-responsive dt-responsive nowrap table-bordered'>
                      <thead>
                        <tr>
                          <th width='5%'>NO</th>
                          <th width='70%'>Project Title</th>
                          <th width='25%'>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 

                          $query=mysqli_query($con,"SELECT * FROM project_wo") or die(mysqli_error($con));
                          $no = 0;
                          while($row=mysqli_fetch_array($query)){
                            $no++;
                            ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $row['nama_project']; ?></td>
                              <td>
                                <a href="#&id_n=<?php echo $row[0];?>" class="view_data2 green" data-toggle="modal" id="<?php echo $row[0]; ?>" data-target="#myModal2">
                                  <i class="ace-icon fa fa-pencil-square-o bigger-160"></i>
                                </a>
                                <a data-rel="tooltip" title="Hapus Data" class="red" href="?id=project-title&mod=del&id_n=<?php echo $row[0];?>" onclick="return confirm('Menghapus Data <?php echo $row[1];?>')">
                              <span class="fa fa-trash-o">
                            </a>
                              </td>
                            </tr>
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
          <h4 class="modal-title">Add Project Title</h4>
        </div>
        <form name="form1" method="post" action="?id=project-title">
          <div class="modal-body">
            <div class="form-group">
              <label class="control-label">ID</label>
              <input maxlength="100" name="id" type="text" class="form-control" placeholder="ID Automatically" readonly />
            </div>
            <div class="form-group">
              <label class="control-label">Project Title</label>
              <input maxlength="100" name="project" type="text" required="required" class="form-control" placeholder="Enter Project Title"/>
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
          <h4 class="modal-title" id="myModalLabel">Edit Project Title</h4>
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
    $('.view_data2').click(function(){
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