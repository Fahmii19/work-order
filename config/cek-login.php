<?php
include "config/koneksi.php";

$user = @$_POST['username'];
$pass = @md5($_POST['password']);


$login=mysqli_query($connect, "SELECT * FROM tbl_user_wo WHERE username='$user' AND password='$pass'") or die(mysqli_error($connect));
$ketemu  = mysqli_num_rows($login);
$r       = mysqli_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  $_SESSION['kode']      = $r['id'];
  $_SESSION['namauser']  = $r['username'];
  $_SESSION['passuser']  = $r['password'];
  $_SESSION['leveluser'] = $r['level'];
  $_SESSION['w_login']   = $r['w_login'];
  $id_user               =$_SESSION['kode'];	
  
  
  
  if($_SESSION['leveluser'] == "Super Admin"){
	echo "<script> alert('Login Berhasil !')</script><script>window.location ='work-order.php?id=home'</script>";
	mysqli_query($connect, "update tbl_user_wo set w_login=NOW() where id='$id_user'");
  } else if($_SESSION['leveluser'] == "Admin"){
      echo "<script> alert('Login Berhasil !')</script><script>window.location ='admin.php?id=home'</script>";
	mysqli_query($connect, "update tbl_user_wo set w_login=NOW() where id='$id_user'");
  } if($_SESSION['leveluser'] == "Admin WO"){
        echo "<script> alert('Login Berhasil !')</script><script>window.location ='admin-wo.php?id=home'</script>";
	mysqli_query($connect, "update tbl_user_wo set w_login=NOW() where id='$id_user'");
  } if($_SESSION['leveluser'] == "Admin Finance"){
        echo "<script> alert('Login Berhasil !')</script><script>window.location ='admin-finance.php?id=home'</script>";
	mysqli_query($connect, "update tbl_user_wo set w_login=NOW() where id='$id_user'");
  }
}
else{

  echo '<script> alert("Username Dan Password Yang Anda Masukkan Salah Silahkan Ulangi Lagi !");</script>';
            echo '<script type="text/javascript">window.history.back()</script>';
}

?>