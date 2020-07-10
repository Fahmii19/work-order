<?php

include('koneksi.php');

$januari = '01';
$februari = '02';
$maret = '03';
$april = '04';
$mei = '05';
$juni = '06';
$juli = '07';
$agustus = '08';
$september = '09';
$oktober = '10';
$nopember = '11';
$desember = '12';
$date = date("Y-m-d");

$sql_januari 	=mysqli_query($con, "SELECT * from tbl_project_wo WHERE month(tgl_project) = '$januari' AND year(tgl_project) = '$date' ");
$jum_jan		=mysqli_num_rows($sql_januari);

$sql_februari 	=mysqli_query($con, "SELECT * from tbl_project_wo WHERE month(tgl_project) = '$februari' AND year(tgl_project) = '$date' ");
$jum_feb		=mysqli_num_rows($sql_februari);

$sql_maret 	=mysqli_query($con, "SELECT * from tbl_project_wo WHERE month(tgl_project) = '$maret' AND year(tgl_project) = '$date' ");
$jum_mar		=mysqli_num_rows($sql_maret);

$sql_april 	=mysqli_query($con, "SELECT * from tbl_project_wo WHERE month(tgl_project) = '$april' AND year(tgl_project) = '$date' ");
$jum_apr		=mysqli_num_rows($sql_april);

$sql_mei 	=mysqli_query($con, "SELECT * from tbl_project_wo WHERE month(tgl_project) = '$mei' AND year(tgl_project) = '$date' ");
$jum_mei		=mysqli_num_rows($sql_mei);

$sql_juni 	=mysqli_query($con, "SELECT * from tbl_project_wo WHERE month(tgl_project) = '$juni' AND year(tgl_project) = '$date' ");
$jum_jun		=mysqli_num_rows($sql_juni);

$sql_juli		=mysqli_query($con, "SELECT * from tbl_project_wo WHERE month(tgl_project) = '$juli' AND year(tgl_project) = '$date' ");
$jum_jul		=mysqli_num_rows($sql_juli);

$sql_agustus 	=mysqli_query($con, "SELECT * from tbl_project_wo WHERE month(tgl_project) = '$agustus' AND year(tgl_project) = '$date' ");
$jum_agt		=mysqli_num_rows($sql_agustus);

$sql_september 	=mysqli_query($con, "SELECT * from tbl_project_wo WHERE month(tgl_project) = '$september' AND year(tgl_project) = '$date' ");
$jum_sep		=mysqli_num_rows($sql_september);

$sql_oktober 	=mysqli_query($con, "SELECT * from tbl_project_wo WHERE month(tgl_project) = '$oktober' AND year(tgl_project) = '$date' ");
$jum_okt		=mysqli_num_rows($sql_oktober);

$sql_nopember 	=mysqli_query($con, "SELECT * from tbl_project_wo WHERE month(tgl_project) = '$nopember' AND year(tgl_project) = '$date' ");
$jum_nop		=mysqli_num_rows($sql_nopember);

$sql_desember 	=mysqli_query($con, "SELECT * from tbl_project_wo WHERE month(tgl_project) = '$desember' AND year(tgl_project) = '$date' ");
$jum_des		=mysqli_num_rows($sql_desember);

$income_januari = "SELECT SUM(price) FROM tbl_income WHERE month(waktu_input) = '$januari' AND year(waktu_input) = '$date' ";
$income_jan = mysqli_query($con, $income_januari) or die(mysqli_error($con));
while($row = mysqli_fetch_array($income_jan)){    
	$price_jan = $row['SUM(price)'];
}

$income_februari = "SELECT SUM(price) FROM tbl_income WHERE month(waktu_input) = '$februari' AND year(waktu_input) = '$date' ";
$income_feb = mysqli_query($con, $income_februari) or die(mysqli_error($con));
while($row = mysqli_fetch_array($income_feb)){    
	$price_feb = $row['SUM(price)'];
}

$income_maret = "SELECT SUM(price) FROM tbl_income WHERE month(waktu_input) = '$maret' AND year(waktu_input) = '$date' ";
$income_mar = mysqli_query($con, $income_maret) or die(mysqli_error($con));
while($row = mysqli_fetch_array($income_mar)){    
	$price_mar = $row['SUM(price)'];
}

$income_april = "SELECT SUM(price) FROM tbl_income WHERE month(waktu_input) = '$april' AND year(waktu_input) = '$date' ";
$income_apr = mysqli_query($con, $income_april) or die(mysqli_error($con));
while($row = mysqli_fetch_array($income_apr)){    
	$price_apr = $row['SUM(price)'];
}

$income_mei = "SELECT SUM(price) FROM tbl_income WHERE month(waktu_input) = '$mei' AND year(waktu_input) = '$date' ";
$income_may = mysqli_query($con, $income_mei) or die(mysqli_error($con));
while($row = mysqli_fetch_array($income_may)){    
	$price_mei = $row['SUM(price)'];
}

$income_juni = "SELECT SUM(price) FROM tbl_income WHERE month(waktu_input) = '$juni' AND year(waktu_input) = '$date' ";
$income_jun = mysqli_query($con, $income_juni) or die(mysqli_error($con));
while($row = mysqli_fetch_array($income_jun)){    
	$price_jun = $row['SUM(price)'];
}

$income_juli = "SELECT SUM(price) FROM tbl_income WHERE month(waktu_input) = '$juli' AND year(waktu_input) = '$date' ";
$income_jul = mysqli_query($con, $income_juli) or die(mysqli_error($con));
while($row = mysqli_fetch_array($income_jul)){    
	$price_jul = $row['SUM(price)'];
}

$income_agustus = "SELECT SUM(price) FROM tbl_income WHERE month(waktu_input) = '$agustus' AND year(waktu_input) = '$date' ";
$income_agt = mysqli_query($con, $income_agustus) or die(mysqli_error($con));
while($row = mysqli_fetch_array($income_agt)){    
	$price_agt = $row['SUM(price)'];
}

$income_september = "SELECT SUM(price) FROM tbl_income WHERE month(waktu_input) = '$september' AND year(waktu_input) = '$date' ";
$income_sep = mysqli_query($con, $income_september) or die(mysqli_error($con));
while($row = mysqli_fetch_array($income_sep)){    
	$price_sep = $row['SUM(price)'];
}

$income_oktober = "SELECT SUM(price) FROM tbl_income WHERE month(waktu_input) = '$oktober' AND year(waktu_input) = '$date' ";
$income_okt = mysqli_query($con, $income_oktober) or die(mysqli_error($con));
while($row = mysqli_fetch_array($income_okt)){    
	$price_okt = $row['SUM(price)'];
}

$income_nopember = "SELECT SUM(price) FROM tbl_income WHERE month(waktu_input) = '$nopember' AND year(waktu_input) = '$date' ";
$income_nop = mysqli_query($con, $income_nopember) or die(mysqli_error($con));
while($row = mysqli_fetch_array($income_nop)){    
	$price_nop = $row['SUM(price)'];
}

$income_desember = "SELECT SUM(price) FROM tbl_income WHERE month(waktu_input) = '$desember' AND year(waktu_input) = '$date' ";
$income_des = mysqli_query($con, $income_desember) or die(mysqli_error($con));
while($row = mysqli_fetch_array($income_des)){    
	$price_des = $row['SUM(price)'];
}

$rata = $jum_jan + $jum_feb + $jum_mar + $jum_apr + $jum_mei + $jum_jun + $jum_jul + $jum_agt + $jum_sep + $jum_okt + $jum_nop + $jum_des;
if ($jum_jan == 0) {
	$c_jan = 0;
} else {
	$c_jan = 1;
}

if ($jum_feb == 0) {
	$c_feb = 0;
} else {
	$c_feb = 1;
}

if ($jum_mar == 0) {
	$c_mar = 0;
} else {
	$c_mar = 1;
}

if ($jum_apr == 0) {
	$c_apr = 0;
} else {
	$c_apr = 1;
}

if ($jum_mei == 0) {
	$c_mei = 0;
} else {
	$c_mei = 1;
}

if ($jum_jun == 0) {
	$c_jun = 0;
} else {
	$c_jun = 1;
}

if ($jum_jul == 0) {
	$c_jul = 0;
} else {
	$c_jul = 1;
}

if ($jum_agt == 0) {
	$c_agt = 0;
} else {
	$c_agt = 1;
}

if ($jum_sep == 0) {
	$c_sep = 0;
} else {
	$c_sep = 1;
}

if ($jum_okt == 0) {
	$c_okt = 0;
} else {
	$c_okt = 1;
}

if ($jum_nop == 0) {
	$c_nop = 0;
} else {
	$c_nop = 1;
}

if ($jum_des == 0) {
	$c_des = 0;
} else {
	$c_des = 1;
}
$jan = $c_jan;
$feb = $c_feb;
$mar = $c_mar;
$apr = $c_apr;
$mei = $c_mei;
$jun = $c_jun;
$jul = $c_jul;
$agt = $c_agt;
$sep = $c_sep;
$okt = $c_okt;
$nop = $c_nop;
$des = $c_des;

$count = $jan + $feb + $mar + $apr + $mei + $jun + $jul + $agt + $sep + $okt + $nop + $des;

$rata_wo = $rata / $count;


// Income
$jum_income = $price_jan + $price_feb + $price_mar + $price_apr + $price_mei + $price_jun + $price_jul + $price_agt + $price_sep + $price_okt + $price_nop + $price_des;
if ($price_jan == 0) {
	$p_jan = 0;
} else {
	$p_jan = 1;
}

if ($price_feb == 0) {
	$p_feb = 0;
} else {
	$p_feb = 1;
}

if ($price_mar == 0) {
	$p_mar = 0;
} else {
	$p_mar = 1;
}

if ($price_apr == 0) {
	$p_apr = 0;
} else {
	$p_apr = 1;
}

if ($price_mei == 0) {
	$p_mei = 0;
} else {
	$p_mei = 1;
}

if ($price_jun == 0) {
	$p_jun = 0;
} else {
	$p_jun = 1;
}

if ($price_jul == 0) {
	$p_jul = 0;
} else {
	$p_jul = 1;
}

if ($price_agt == 0) {
	$p_agt = 0;
} else {
	$p_agt = 1;
}

if ($price_sep == 0) {
	$p_sep = 0;
} else {
	$p_sep = 1;
}

if ($price_okt == 0) {
	$p_okt = 0;
} else {
	$p_okt = 1;
}

if ($price_nop == 0) {
	$p_nop = 0;
} else {
	$p_nop = 1;
}

if ($price_des == 0) {
	$p_des = 0;
} else {
	$p_des = 1;
}
$jan_P = $p_jan;
$feb_p = $p_feb;
$mar_p = $p_mar;
$apr_p = $p_apr;
$mei_p = $p_mei;
$jun_p = $p_jun;
$jul_p = $p_jul;
$agt_p = $p_agt;
$sep_p = $p_sep;
$okt_p = $p_okt;
$nop_p = $p_nop;
$des_p = $p_des;

$count_p = $jan_p + $feb_p + $mar_p + $apr_p + $mei_p + $jun_p + $jul_p + $agt_p + $sep_p + $okt_p + $nop_p + $des_p;

$rata_income = $jum_income / $count_p;

$dataPoints1 = array(
	array("label"=> "Januari", "y"=> $jum_jan),
	array("label"=> "Februari", "y"=> $jum_feb),
	array("label"=> "Maret", "y"=> $jum_mar),
	array("label"=> "April", "y"=> $jum_apr),
	array("label"=> "Mei", "y"=> $jum_mei),
	array("label"=> "Juni", "y"=> $jum_jun),
	array("label"=> "Juli", "y"=> $jum_jul),
	array("label"=> "Agustus", "y"=> $jum_agt),
	array("label"=> "September", "y"=> $jum_sep),
	array("label"=> "Oktober", "y"=> $jum_okt),
	array("label"=> "Nopember", "y"=> $jum_nop),
	array("label"=> "Desember", "y"=> $jum_des),
	array("label"=> " ", "y"),
	array("label"=> "Rata - Rata", "y"=> $rata_wo),
);
$dataPoints2 = array(
	array("label"=> "Januari", "y"=> $price_jan),
	array("label"=> "Februari", "y"=> $price_feb),
	array("label"=> "Maret", "y"=> $price_mar),
	array("label"=> "April", "y"=> $price_apr),
	array("label"=> "Mei", "y"=> $price_mei),
	array("label"=> "Juni", "y"=> $price_jun),
	array("label"=> "Juli", "y"=> $price_jul),
	array("label"=> "Agustus", "y"=> $price_agt),
	array("label"=> "September", "y"=> $price_sep),
	array("label"=> "Oktober", "y"=> $price_okt),
	array("label"=> "Nopember", "y"=> $price_nop),
	array("label"=> "Desember", "y"=> $price_des),
	array("label"=> " ", "y"),
	array("label"=> "Rata - Rata", "y"=> $rata_income),
);
	
?>