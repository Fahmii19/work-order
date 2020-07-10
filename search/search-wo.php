<?php
//Sesuaikan config mysql nya
    $dns 		= "mysql:host=127.0.0.1;dbname=k0762615_pegawai_1";
	$db_user 	= "k0762615_pegawai";
	$db_pass 	= "PegawaiLrcom123!@#";
	
	try {
        $pdo = new PDO($dns, $db_user, $db_pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));      
    } catch (PDOException $e) {
        echo "Koneksi ke database gagal: ".$e->getMessage();
        die();
    }
 
$term = $_GET['term'];
 
$query = $pdo->prepare("SELECT * FROM tbl_project_wo join tbl_schedule_wo on tbl_schedule_wo.kode_jadwal = tbl_project_wo.kode_jadwal join tbl_teknisi_wo on tbl_teknisi_wo.kode_teknisi = tbl_project_wo.kode_teknisi WHERE status = 'first' AND wo_id like '%".$term."%'");
$query->execute();
$json = array();
while($datacust = $query->fetch()) {
	$json[] = array(
		'label' => $datacust['wo_id'], // text sugesti saat user mengetik di input box
		'value' => $datacust['wo_id'], 
		'idproject' => $datacust['id_project'],
		'kodeproject' => $datacust['kode_project'],
		'kodejadwal' => $datacust['kode_jadwal'],
		'kodeteknisi' => $datacust['kode_teknisi'],
		'level' => $datacust['level'],
		'date' => $datacust['tgl_project'],
		'project' => $datacust['project_title'],
		'so' => $datacust['so_id'],
		'customer' => $datacust['customer'],
		'lokasi' => $datacust['lokasi'],
		'pic' => $datacust['pic'],
		'tgl' => $datacust['tgl'],
		't1' => $datacust['teknisi1'],
		't2' => $datacust['teknisi2'],
		't3' => $datacust['teknisi3'],
		't4' => $datacust['teknisi4'],
		'pkl1' => $datacust['pkl1'],
		'pkl2' => $datacust['pkl2'],
		'pkl3' => $datacust['pkl3'],
	);
}

header("Content-Type: text/json");
echo json_encode($json);
?>