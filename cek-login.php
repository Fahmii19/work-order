<?php
session_start();

if (isset($_POST['login'])) {
include "config/koneksi.php";


$user = $_POST['username'];
$pass = $_POST['password'];


$login   = mysqli_query ($con, "SELECT * FROM tbl_user_wo join tbl_pegawai on tbl_pegawai.nik = tbl_user_wo.id WHERE username = '$user' AND password ='$pass'") or die(mysqli_error($con));
$ketemu  = mysqli_num_rows($login);
$r       = mysqli_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  $_SESSION['kode']      = $r['id'];
  $_SESSION['username']  = $r['username'];
  $_SESSION['password']  = $r['password'];
  $_SESSION['namauser']  = $r['nama'];
  $_SESSION['level']     = $r['level'];
  $id_user               = $_SESSION['kode'];	
  
  if($_SESSION['level'] == "Super Admin"){
	echo "<script> alert('Login Berhasil !')</script><script>window.location ='work-order.php?id=home'</script>";
	mysqli_query($con, "update tbl_user_wo set w_login=NOW() where id = '$id_user'");
  } else if($_SESSION['level'] == "Admin WO"){
  echo "<script> alert('Login Berhasil !')</script><script>window.location ='admin-wo.php?id=home'</script>";
  mysqli_query($con, "update tbl_user_wo set w_login=NOW() where id = '$id_user'");
  } else if($_SESSION['level'] == "Admin"){
  echo "<script> alert('Login Berhasil !')</script><script>window.location ='admin.php?id=home'</script>";
	mysqli_query($con, "update tbl_user_wo set w_login=NOW() where id='$id_user'");
  } else if($_SESSION['level'] == "Admin Finance"){
  echo "<script> alert('Login Berhasil !')</script><script>window.location ='admin-finance.php?id=home'</script>";
	mysqli_query($con, "update tbl_user_wo set w_login=NOW() where id='$id_user'");
  } else if($_SESSION['level'] == "Admin Collection"){
  echo "<script> alert('Login Berhasil !')</script><script>window.location ='admin-collection.php?id=home'</script>";
  mysqli_query($con, "update tbl_user_wo set w_login=NOW() where id='$id_user'");
  } else if($_SESSION['level'] == "Admin RM"){
  echo "<script> alert('Login Berhasil !')</script><script>window.location ='admin-rm.php?id=home'</script>";
  mysqli_query($con, "update tbl_user_wo set w_login=NOW() where id='$id_user'");
  }

} else {
  echo '<script> alert("Username Dan Password Yang Anda Masukkan Salah Silahkan Ulangi Lagi !");</script>';
            echo '<script type="text/javascript">window.history.back()</script>';
}

}

?>