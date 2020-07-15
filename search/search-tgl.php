<?php
//Sesuaikan config mysql nya
    $dns 		= "mysql:host=localhost;dbname=k0762615_pegawai_1";
	$db_user 	= "root";
	$db_pass 	= "";
 
	try {
        $pdo = new PDO($dns, $db_user, $db_pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));      
    } catch (PDOException $e) {
        echo "Koneksi ke database gagal: ".$e->getMessage();
        die();
    }
 
$term = $_GET['term'];
 
$query = $pdo->prepare("SELECT * FROM tbl_project_wo join tbl_schedule_wo on tbl_schedule_wo.kode_jadwal = tbl_project_wo.kode_jadwal join tbl_teknisi_wo on tbl_teknisi_wo.kode_teknisi = tbl_project_wo.kode_teknisi WHERE tgl like '%".$term."%'");
$query->execute();
$json = array();
while($datacust = $query->fetch()) {
	$json[] = array(
		'label' => $datacust['tgl'], // text sugesti saat user mengetik di input box
		'value' => $datacust['tgl'], 
	);
}

header("Content-Type: text/json");
echo json_encode($json);
?>