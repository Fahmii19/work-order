<?php
session_start();
if (@$_SESSION['namauser'] == "RISKA ADRINI") {
    echo "<script>alert('Anda sudah login sebagai Super Admin'); window.location = 'work-order.php'</script>";
} elseif (@$_SESSION['namauser'] == "RIAN ANANG PRAKOSO") {
    echo "<script>alert('Anda sudah login sebagai Admin'); window.location = 'admin-wo.php'</script>";
} elseif (@$_SESSION['namauser'] == "IRWAN SETIAWAN") {
    echo "<script>alert('Anda sudah login sebagai Admin'); window.location = 'admin-wo.php'</script>";
} elseif (@$_SESSION['namauser'] == "AGNES EKA LESTIA") {
    echo "<script>alert('Anda sudah login sebagai Admin'); window.location = 'admin.php'</script>";
} elseif (@$_SESSION['namauser'] == "DEA RACHMAYATI HANDIARTO") {
    echo "<script>alert('Anda sudah login sebagai Admin'); window.location = 'admin.php'</script>";
} elseif (@$_SESSION['namauser'] == "RAHMANIA RAMADHANI") {
    echo "<script>alert('Anda sudah login sebagai Admin Finance'); window.location = 'admin-finance.php'</script>";
} elseif (@$_SESSION['namauser'] == "ETI FITRIANI") {
    echo "<script>alert('Anda sudah login sebagai Admin Finance'); window.location = 'admin-finance.php'</script>";
} else {
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Aplikasi Work Order | Login Page</title>

    <link rel="icon" href="images/icon.png" type="image/ico" />
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    
    <style>
        .img {
            margin-top: 40px;
            margin-bottom: -50px;
        }
        
        @media (max-width: 768px) {
          .img {
              width : 75%;
              margin-bottom: 0px;
              margin-top: 20px;
          }
        }
    </style>
  </head>

  <body class="login">
    <div>  
      <center><img src="images/LR-3.png" class="img" width="25%" height="50%">
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form role="login" name="login" method="post" action="cek-login.php">
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" name="username" placeholder="Username" required="" autocomplete="off" />
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" required="" autocomplete="off" />
              </div>
              <div>
                <button type="submit" name="login" class="btn btn-default submit"> Log in </span></button>
              </div>
            </form>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-pencil-square-o"></i>&nbsp Work Order Aplication</h1>
                  <p>©2018 All Rights Reserved. <br> PT. Lumbung Riang Communcation</p>
                </div>
              </div>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>

<?php
}
?>