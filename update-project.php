<?php

  $dns    = "mysql:host=localhost;dbname=portofolio";
  $db_user  = "root";
  $db_pass  = "";
 
  try {
        $pdo = new PDO($dns, $db_user, $db_pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));      
    } catch (PDOException $e) {
        echo "Koneksi ke database gagal: ".$e->getMessage();
        die();
    } 

    session_start();
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    require'config/koneksi.php';
    if (!$_SESSION['kode']) {
        echo "<script>alert ('Anda harus login terlebih dahulu'); window.location.href = 'index.php'</script>";
    }

  $nav            ="";
  $ambil          ="home.php";
  $class          ="";
  $ambilcss1      ="";
  $ambilcss2      ="";
  $ambilcss3      ="";
  $ambilcss4      ="";
  $ambilcss5      ="";
  $ambilcss6      ="";
  $ambilcss7      ="";
  $ambilcss8      ="";
  $ambilcss9      ="";
  $ambilcss10     ="";

  $ambiljs0       ="";
  $ambiljs1       ="";
  $ambiljs2       ="";
  $ambiljs3       ="";
  $ambiljs4       ="";
  $ambiljs5       ="";
  $ambiljs6       ="";
  $ambiljs7       ="";
  $ambiljs8       ="";
  $ambiljs9       ="";
  $ambiljs10      ="";
  $ambiljs11      ="";
  $ambiljs12      ="";
  $ambilfungsi    ="";
  $ambilfungsi2   ="";

  $id         = isset($_GET['id']) ? $_GET['id'] : "";
  if ($id == "") {
    $nav         = "Dashboard";
    $ambil       = "home.php";
    $class       = "active";
    $ambilcss1   = "";
    $ambilcss2   = "";
    $ambiljs0    = "vendors/echarts/map/js/world.js";
    $ambiljs1    = "vendors/echarts/dist/echarts.min.js";
  } elseif ($id == "add-project") {
    $nav         = "Add Project";
    $ambil       = "project/add-project.php";
    $class       = "active";
    $ambilcss1   = "vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css";
    $ambilcss2   = "vendors/normalize-css/normalize.css";
    $ambilcss3   = "project/css/style.css";
    $ambilcss4   = "vendors/bootstrap-daterangepicker/daterangepicker.css";
    $ambiljs0    = "project/script/wizard.js";
    $ambiljs1    = "project/script/date-picker.js";
    $ambiljs2    = "vendors/moment/min/moment.min.js";
    $ambiljs3    = "vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js";
  } elseif ($id == "add-income") {
    $nav         = "Add Income";
    $ambil       = "finance/add-income.php";
    $class       = "active";
    $ambilcss1   = "vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css";
    $ambilcss2   = "vendors/normalize-css/normalize.css";
    $ambilcss3   = "project/css/style.css";
    $ambilcss4   = "vendors/bootstrap-daterangepicker/daterangepicker.css";
    $ambiljs0    = "project/script/wizard.js";
    $ambiljs1    = "project/script/date-picker.js";
    $ambiljs2    = "vendors/moment/min/moment.min.js";
    $ambiljs3    = "vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js";
  } elseif ($id == "add-cash-receipt") {
    $nav         = "Add Cash Receipt";
    $ambil       = "finance/add-kasbon.php";
    $class       = "active";
    $ambilcss1   = "vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css";
    $ambilcss2   = "vendors/normalize-css/normalize.css";
    $ambilcss3   = "project/css/style.css";
    $ambilcss4   = "vendors/bootstrap-daterangepicker/daterangepicker.css";
    $ambiljs0    = "project/script/wizard.js";
    $ambiljs1    = "project/script/date-picker.js";
    $ambiljs2    = "vendors/moment/min/moment.min.js";
    $ambiljs3    = "vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js";
  } elseif ($id == "project") {
    $nav         = "Project List";
    $ambil       = "project/project-data.php";
    $class       = "active";
    $ambilcss1   = "vendors/datatables.net-bs/css/dataTables.bootstrap.min.css";
    $ambilcss2   = "vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css";
    $ambilcss3   = "vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css";
    $ambilcss4   = "vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css";
    $ambilcss5   = "vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css";
    $ambilcss6   = "vendors/iCheck/skins/flat/green.css";
    $ambilcss6   = "vendors/normalize-css/normalize.css";
    $ambiljs0    = "vendors/iCheck/icheck.min.js";
    $ambiljs1    = "vendors/datatables.net/js/jquery.dataTables.min.js";
    $ambiljs2    = "vendors/datatables.net-bs/js/dataTables.bootstrap.min.js";
    $ambiljs3    = "vendors/datatables.net-buttons/js/dataTables.buttons.min.js";
    $ambiljs4    = "vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js";
    $ambiljs5    = "vendors/datatables.net-buttons/js/buttons.flash.min.js";
    $ambiljs6    = "vendors/datatables.net-buttons/js/buttons.html5.min.js";
    $ambiljs7    = "vendors/datatables.net-buttons/js/buttons.print.min.js";
    $ambiljs8    = "vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js";
    $ambiljs9    = "vendors/datatables.net-keytable/js/dataTables.keyTable.min.js";
    $ambiljs10    = "vendors/datatables.net-responsive/js/dataTables.responsive.min.js";
    $ambiljs11    = "vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js";
    $ambiljs12    = "vendors/datatables.net-scroller/js/dataTables.scroller.min.js";
    $ambiljs13    = "vendors/jszip/dist/jszip.min.js";
    $ambiljs14    = "vendors/pdfmake/build/pdfmake.min.js";
    $ambiljs15    = "vendors/pdfmake/build/vfs_fonts.js";
  } elseif ($id == "view") {
    $nav         = "Detail Project";
    $ambil       = "project/view-detail.php";
    $class       = "active";
    $ambilcss1   = "vendors/datatables.net-bs/css/dataTables.bootstrap.min.css";
    $ambilcss2   = "vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css";
    $ambilcss3   = "vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css";
    $ambilcss4   = "vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css";
    $ambilcss5   = "vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css";
    $ambilcss6   = "vendors/iCheck/skins/flat/green.css";
    $ambilcss6   = "vendors/normalize-css/normalize.css";
    $ambiljs0    = "vendors/iCheck/icheck.min.js";
    $ambiljs1    = "vendors/datatables.net/js/jquery.dataTables.min.js";
    $ambiljs2    = "vendors/datatables.net-bs/js/dataTables.bootstrap.min.js";
    $ambiljs3    = "vendors/datatables.net-buttons/js/dataTables.buttons.min.js";
    $ambiljs4    = "vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js";
    $ambiljs5    = "vendors/datatables.net-buttons/js/buttons.flash.min.js";
    $ambiljs6    = "vendors/datatables.net-buttons/js/buttons.html5.min.js";
    $ambiljs7    = "vendors/datatables.net-buttons/js/buttons.print.min.js";
    $ambiljs8    = "vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js";
    $ambiljs9    = "vendors/datatables.net-keytable/js/dataTables.keyTable.min.js";
    $ambiljs10    = "vendors/datatables.net-responsive/js/dataTables.responsive.min.js";
    $ambiljs11    = "vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js";
    $ambiljs12    = "vendors/datatables.net-scroller/js/dataTables.scroller.min.js";
    $ambiljs13    = "vendors/jszip/dist/jszip.min.js";
    $ambiljs14    = "vendors/pdfmake/build/pdfmake.min.js";
    $ambiljs15    = "vendors/pdfmake/build/vfs_fonts.js";
  } elseif ($id == "income") {
    $nav         = "Incoming Founds";
    $ambil       = "finance/income.php";
    $class       = "active";
    $ambilcss1   = "vendors/datatables.net-bs/css/dataTables.bootstrap.min.css";
    $ambilcss2   = "vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css";
    $ambilcss3   = "vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css";
    $ambilcss4   = "vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css";
    $ambilcss5   = "vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css";
    $ambilcss6   = "vendors/iCheck/skins/flat/green.css";
    $ambilcss6   = "vendors/normalize-css/normalize.css";
    $ambiljs0    = "vendors/iCheck/icheck.min.js";
    $ambiljs1    = "vendors/datatables.net/js/jquery.dataTables.min.js";
    $ambiljs2    = "vendors/datatables.net-bs/js/dataTables.bootstrap.min.js";
    $ambiljs3    = "vendors/datatables.net-buttons/js/dataTables.buttons.min.js";
    $ambiljs4    = "vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js";
    $ambiljs5    = "vendors/datatables.net-buttons/js/buttons.flash.min.js";
    $ambiljs6    = "vendors/datatables.net-buttons/js/buttons.html5.min.js";
    $ambiljs7    = "vendors/datatables.net-buttons/js/buttons.print.min.js";
    $ambiljs8    = "vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js";
    $ambiljs9    = "vendors/datatables.net-keytable/js/dataTables.keyTable.min.js";
    $ambiljs10    = "vendors/datatables.net-responsive/js/dataTables.responsive.min.js";
    $ambiljs11    = "vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js";
    $ambiljs12    = "vendors/datatables.net-scroller/js/dataTables.scroller.min.js";
    $ambiljs13    = "vendors/jszip/dist/jszip.min.js";
    $ambiljs14    = "vendors/pdfmake/build/pdfmake.min.js";
    $ambiljs15    = "vendors/pdfmake/build/vfs_fonts.js";
  } elseif ($id == "cash-receipt") {
    $nav         = "Cash Receipt";
    $ambil       = "finance/kasbon.php";
    $class       = "active";
    $ambilcss1   = "vendors/datatables.net-bs/css/dataTables.bootstrap.min.css";
    $ambilcss2   = "vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css";
    $ambilcss3   = "vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css";
    $ambilcss4   = "vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css";
    $ambilcss5   = "vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css";
    $ambilcss6   = "vendors/iCheck/skins/flat/green.css";
    $ambilcss6   = "vendors/normalize-css/normalize.css";
    $ambiljs0    = "vendors/iCheck/icheck.min.js";
    $ambiljs1    = "vendors/datatables.net/js/jquery.dataTables.min.js";
    $ambiljs2    = "vendors/datatables.net-bs/js/dataTables.bootstrap.min.js";
    $ambiljs3    = "vendors/datatables.net-buttons/js/dataTables.buttons.min.js";
    $ambiljs4    = "vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js";
    $ambiljs5    = "vendors/datatables.net-buttons/js/buttons.flash.min.js";
    $ambiljs6    = "vendors/datatables.net-buttons/js/buttons.html5.min.js";
    $ambiljs7    = "vendors/datatables.net-buttons/js/buttons.print.min.js";
    $ambiljs8    = "vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js";
    $ambiljs9    = "vendors/datatables.net-keytable/js/dataTables.keyTable.min.js";
    $ambiljs10    = "vendors/datatables.net-responsive/js/dataTables.responsive.min.js";
    $ambiljs11    = "vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js";
    $ambiljs12    = "vendors/datatables.net-scroller/js/dataTables.scroller.min.js";
    $ambiljs13    = "vendors/jszip/dist/jszip.min.js";
    $ambiljs14    = "vendors/pdfmake/build/pdfmake.min.js";
    $ambiljs15    = "vendors/pdfmake/build/vfs_fonts.js";
  } elseif ($id == "technician") {
    $nav         = "PKL Technician Name";
    $ambil       = "reference/technician-name.php";
    $class       = "active";
    $ambilcss1   = "vendors/datatables.net-bs/css/dataTables.bootstrap.min.css";
    $ambilcss2   = "vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css";
    $ambilcss3   = "vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css";
    $ambilcss4   = "vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css";
    $ambilcss5   = "vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css";
    $ambilcss6   = "vendors/iCheck/skins/flat/green.css";
    $ambilcss6   = "vendors/normalize-css/normalize.css";
    $ambiljs0    = "vendors/iCheck/icheck.min.js";
    $ambiljs1    = "vendors/datatables.net/js/jquery.dataTables.min.js";
    $ambiljs2    = "vendors/datatables.net-bs/js/dataTables.bootstrap.min.js";
    $ambiljs3    = "vendors/datatables.net-buttons/js/dataTables.buttons.min.js";
    $ambiljs4    = "vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js";
    $ambiljs5    = "vendors/datatables.net-buttons/js/buttons.flash.min.js";
    $ambiljs6    = "vendors/datatables.net-buttons/js/buttons.html5.min.js";
    $ambiljs7    = "vendors/datatables.net-buttons/js/buttons.print.min.js";
    $ambiljs8    = "vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js";
    $ambiljs9    = "vendors/datatables.net-keytable/js/dataTables.keyTable.min.js";
    $ambiljs10    = "vendors/datatables.net-responsive/js/dataTables.responsive.min.js";
    $ambiljs11    = "vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js";
    $ambiljs12    = "vendors/datatables.net-scroller/js/dataTables.scroller.min.js";
    $ambiljs13    = "vendors/jszip/dist/jszip.min.js";
    $ambiljs14    = "reference/script/modal.js";
    $ambiljs15    = "vendors/pdfmake/build/vfs_fonts.js";
  } elseif ($id == "technician-pkl") {
    $nav         = "PKL Technician Name";
    $ambil       = "reference/technician-pkl-name.php";
    $class       = "active";
    $ambilcss1   = "vendors/datatables.net-bs/css/dataTables.bootstrap.min.css";
    $ambilcss2   = "vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css";
    $ambilcss3   = "vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css";
    $ambilcss4   = "vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css";
    $ambilcss5   = "vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css";
    $ambilcss6   = "vendors/iCheck/skins/flat/green.css";
    $ambilcss6   = "vendors/normalize-css/normalize.css";
    $ambiljs0    = "vendors/iCheck/icheck.min.js";
    $ambiljs1    = "vendors/datatables.net/js/jquery.dataTables.min.js";
    $ambiljs2    = "vendors/datatables.net-bs/js/dataTables.bootstrap.min.js";
    $ambiljs3    = "vendors/datatables.net-buttons/js/dataTables.buttons.min.js";
    $ambiljs4    = "vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js";
    $ambiljs5    = "vendors/datatables.net-buttons/js/buttons.flash.min.js";
    $ambiljs6    = "vendors/datatables.net-buttons/js/buttons.html5.min.js";
    $ambiljs7    = "vendors/datatables.net-buttons/js/buttons.print.min.js";
    $ambiljs8    = "vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js";
    $ambiljs9    = "vendors/datatables.net-keytable/js/dataTables.keyTable.min.js";
    $ambiljs10    = "vendors/datatables.net-responsive/js/dataTables.responsive.min.js";
    $ambiljs11    = "vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js";
    $ambiljs12    = "vendors/datatables.net-scroller/js/dataTables.scroller.min.js";
    $ambiljs13    = "vendors/jszip/dist/jszip.min.js";
    $ambiljs14    = "reference/script/modal.js";
    $ambiljs15    = "vendors/pdfmake/build/vfs_fonts.js";
  } elseif ($id == "project-title") {
    $nav         = "Project Title";
    $ambil       = "reference/project-title.php";
    $class       = "active";
    $ambilcss1   = "vendors/datatables.net-bs/css/dataTables.bootstrap.min.css";
    $ambilcss2   = "vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css";
    $ambilcss3   = "vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css";
    $ambilcss4   = "vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css";
    $ambilcss5   = "vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css";
    $ambilcss6   = "vendors/iCheck/skins/flat/green.css";
    $ambilcss6   = "vendors/normalize-css/normalize.css";
    $ambiljs0    = "vendors/iCheck/icheck.min.js";
    $ambiljs1    = "vendors/datatables.net/js/jquery.dataTables.min.js";
    $ambiljs2    = "vendors/datatables.net-bs/js/dataTables.bootstrap.min.js";
    $ambiljs3    = "vendors/datatables.net-buttons/js/dataTables.buttons.min.js";
    $ambiljs4    = "vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js";
    $ambiljs5    = "vendors/datatables.net-buttons/js/buttons.flash.min.js";
    $ambiljs6    = "vendors/datatables.net-buttons/js/buttons.html5.min.js";
    $ambiljs7    = "vendors/datatables.net-buttons/js/buttons.print.min.js";
    $ambiljs8    = "vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js";
    $ambiljs9    = "vendors/datatables.net-keytable/js/dataTables.keyTable.min.js";
    $ambiljs10    = "vendors/datatables.net-responsive/js/dataTables.responsive.min.js";
    $ambiljs11    = "vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js";
    $ambiljs12    = "vendors/datatables.net-scroller/js/dataTables.scroller.min.js";
    $ambiljs13    = "vendors/jszip/dist/jszip.min.js";
    $ambiljs14    = "reference/script/modal.js";
    $ambiljs15    = "vendors/pdfmake/build/vfs_fonts.js";
  } elseif ($id == "list-user") {
    $nav         = "List User";
    $ambil       = "reference/list-user.php";
    $class       = "active";
    $ambilcss1   = "vendors/datatables.net-bs/css/dataTables.bootstrap.min.css";
    $ambilcss2   = "vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css";
    $ambilcss3   = "vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css";
    $ambilcss4   = "vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css";
    $ambilcss5   = "vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css";
    $ambilcss6   = "vendors/iCheck/skins/flat/green.css";
    $ambilcss6   = "vendors/normalize-css/normalize.css";
    $ambiljs0    = "vendors/iCheck/icheck.min.js";
    $ambiljs1    = "vendors/datatables.net/js/jquery.dataTables.min.js";
    $ambiljs2    = "vendors/datatables.net-bs/js/dataTables.bootstrap.min.js";
    $ambiljs3    = "vendors/datatables.net-buttons/js/dataTables.buttons.min.js";
    $ambiljs4    = "vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js";
    $ambiljs5    = "vendors/datatables.net-buttons/js/buttons.flash.min.js";
    $ambiljs6    = "vendors/datatables.net-buttons/js/buttons.html5.min.js";
    $ambiljs7    = "vendors/datatables.net-buttons/js/buttons.print.min.js";
    $ambiljs8    = "vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js";
    $ambiljs9    = "vendors/datatables.net-keytable/js/dataTables.keyTable.min.js";
    $ambiljs10    = "vendors/datatables.net-responsive/js/dataTables.responsive.min.js";
    $ambiljs11    = "vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js";
    $ambiljs12    = "vendors/datatables.net-scroller/js/dataTables.scroller.min.js";
    $ambiljs13    = "vendors/jszip/dist/jszip.min.js";
    $ambiljs14    = "reference/script/modal.js";
    $ambiljs15    = "vendors/pdfmake/build/vfs_fonts.js";
  } elseif ($id == "report-order") {
    $nav         = "Report Book Of Life";
    $ambil       = "report/order.php";
    $class       = "active";
    $ambilcss1   = "vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css";
    $ambilcss2   = "vendors/normalize-css/normalize.css";
    $ambilcss3   = "project/css/style.css";
    $ambilcss4   = "vendors/bootstrap-daterangepicker/daterangepicker.css";
    $ambiljs0    = "project/script/wizard.js";
    $ambiljs1    = "date-picker.js";
    $ambiljs2    = "vendors/moment/min/moment.min.js";
    $ambiljs3    = "vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js";
  } elseif ($id == "report-technician") {
    $nav         = "Report Technician";
    $ambil       = "report/technician.php";
    $class       = "active";
    $ambilcss1   = "vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css";
    $ambilcss2   = "vendors/normalize-css/normalize.css";
    $ambilcss3   = "project/css/style.css";
    $ambilcss4   = "vendors/bootstrap-daterangepicker/daterangepicker.css";
    $ambiljs0    = "project/script/wizard.js";
    $ambiljs1    = "date-picker.js";
    $ambiljs2    = "vendors/moment/min/moment.min.js";
    $ambiljs3    = "vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js";
  } elseif ($id == "report-income-ex") {
    $nav         = "Report Finance";
    $ambil       = "report/finance.php";
    $class       = "active";
    $ambilcss1   = "vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css";
    $ambilcss2   = "vendors/normalize-css/normalize.css";
    $ambilcss3   = "project/css/style.css";
    $ambilcss4   = "vendors/bootstrap-daterangepicker/daterangepicker.css";
    $ambiljs0    = "project/script/wizard.js";
    $ambiljs1    = "date-picker.js";
    $ambiljs2    = "vendors/moment/min/moment.min.js";
    $ambiljs3    = "vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js";
  } elseif ($id == "report-order-w-t") {
    $nav         = "Report Order Without Technician";
    $ambil       = "report/order-without-technician.php";
    $class       = "active";
    $ambilcss1   = "vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css";
    $ambilcss2   = "vendors/normalize-css/normalize.css";
    $ambilcss3   = "project/css/style.css";
    $ambilcss4   = "vendors/bootstrap-daterangepicker/daterangepicker.css";
    $ambiljs0    = "project/script/wizard.js";
    $ambiljs1    = "date-picker.js";
    $ambiljs2    = "vendors/moment/min/moment.min.js";
    $ambiljs3    = "vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js";
  } elseif ($id == "report-id-wo-n-i") {
    $nav         = "Report Id WO No Incoming Founds";
    $ambil       = "report/id-wo-no-income.php";
    $class       = "active";
    $ambilcss1   = "vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css";
    $ambilcss2   = "vendors/normalize-css/normalize.css";
    $ambilcss3   = "project/css/style.css";
    $ambilcss4   = "vendors/bootstrap-daterangepicker/daterangepicker.css";
    $ambiljs0    = "project/script/wizard.js";
    $ambiljs1    = "date-picker.js";
    $ambiljs2    = "vendors/moment/min/moment.min.js";
    $ambiljs3    = "vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js";
  } else {
    $nav         = "Dashboard";
    $ambil       = "home.php";
    $class       = "active";
    $ambilcss1   = "";
    $ambilcss2   = "";
    $ambiljs0    = "vendors/echarts/map/js/world.js";
    $ambiljs1    = "vendors/echarts/dist/echarts.min.js";
  }


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/icon.png" type="image/ico" />

    <title>Aplikasi Work Order </title>

    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.css" rel="stylesheet">

    <link href="<?php echo $ambilcss1; ?>" rel="stylesheet">
    <link href="<?php echo $ambilcss2; ?>" rel="stylesheet">
    <link href="<?php echo $ambilcss3; ?>" rel="stylesheet">
    <link href="<?php echo $ambilcss4; ?>" rel="stylesheet">
    <link href="<?php echo $ambilcss5; ?>" rel="stylesheet">
    <link href="<?php echo $ambilcss6; ?>" rel="stylesheet">
    <link href="<?php echo $ambilcss7; ?>" rel="stylesheet">
    <link href="<?php echo $ambilcss8; ?>" rel="stylesheet">
    <link href="<?php echo $ambilcss9; ?>" rel="stylesheet">
    <link href="<?php echo $ambilcss10 ;?>" rel="stylesheet">
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="?id=home" class="site_title"><i class="fa fa-line-chart"></i> <span>Work-Order</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/avatar.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $_SESSION['namauser']; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li class=""><a href="?id=home"><i class="fa fa-dashboard"></i> Dashboard</a>
                  </li>

                  <li class=""><a><i class="fa fa-desktop"></i> Reference <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="?id=technician">Technician Name</a></li>
                      <li><a href="?id=technician-pkl">PKL Technician Name</a></li>
                      <li><a href="?id=project-title">Project Title</a></li>
                      <li><a href="?id=list-user">List User</a></li>
                    </ul>
                  </li>

                  <li class=""><a><i class="fa fa-edit"></i> Project <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="?id=add-project&mod=tambah">Add Project</a></li>
                      <li><a href="?id=project">Project List</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-credit-card"></i> Finance <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="?id=income">Income</a></li>
                      <li><a href="?id=cash-receipt">cash receipt</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-bar-chart"></i> Reports <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="?id=report-order">Book Of Live</a></li>
                      <li><a href="?id=report-technician">Technician</a></li>
                      <li><a href="?id=report-income-ex">Income, Expenditure</a></li>
                      <li><a href="?id=report-order-w-t">Order Without Technician</a></li>
                      <li><a href="?id=report-id-wo-n-i">ID WO No Income</a></li>
                    </ul>
                  </li>
              </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/avatar.png" alt=""><?php echo $_SESSION['namauser']; ?> &nbsp
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li class="" style="font-size: 15px;"><a href="logout.php?id=logout" onclick="return confirm('Apakah Anda Yakin Ingin Logout?')"><i class="fa fa-sign-out"></i> Logout </a>
                  </li>
                  </ul>
                </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <form>
 
          <div class="form-group">
            <label for="nama">Nama Mahasiswa</label>
            <input type="text" class="form-control" id="nama">
          </div>
          
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="nis">NIM</label>
                <input type="text" class="form-control" id="nis">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="alamat">Email</label>
                <input type="text" class="form-control" id="alamat">
              </div>
            </div>
          </div>
   
          <div class="form-group">
            <label for="telp">Nomor Telpon</label><br>
            <span id="telp"></span>
          </div>
   
        </form>
          
        </div>
         <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div style="text-align: center;">
            Copyright@2018 PT. Lumbung Riang Communication
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

        <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

    <script src="<?php echo $ambiljs0; ?>"></script>
    <script src="<?php echo $ambiljs1; ?>"></script>
    <script src="<?php echo $ambiljs2; ?>"></script>
    <script src="<?php echo $ambiljs3; ?>"></script>
    <script src="<?php echo $ambiljs4; ?>"></script>
    <script src="<?php echo $ambiljs5; ?>"></script>
    <script src="<?php echo $ambiljs6; ?>"></script>
    <script src="<?php echo $ambiljs7; ?>"></script>
    <script src="<?php echo $ambiljs8; ?>"></script>
    <script src="<?php echo $ambiljs9; ?>"></script>
    <script src="<?php echo $ambiljs10; ?>"></script>
    <script src="<?php echo $ambiljs11; ?>"></script>
    <script src="<?php echo $ambiljs12; ?>"></script>
    <script src="<?php echo $ambiljs13; ?>"></script>
    <script src="<?php echo $ambiljs14; ?>"></script>
    <script src="<?php echo $ambiljs15; ?>"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function(){
        $('#nama').autocomplete({
          minLength: 2, //minimal huruf saat autocomplete di proses
          source: 'search.php', //file untuk mencari data mahasiswa
          select:function(event, ui){
            $('#nama').val(ui.item.nama);
            $('#nis').val(ui.item.nis);
            $('#alamat').val(ui.item.alamat);
            $('#telp').html(ui.item.telp);
          }
        })
      });
    </script>
  
  </body>
</html>
