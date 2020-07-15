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
 
$query = $pdo->prepare("SELECT * FROM tbl_income WHERE ket='first' AND no_ba like '%".$term."%' ORDER BY no_ba ASC");
$query->execute();
$json = array();
while($datacust = $query->fetch()) {
	$json[] = array(
		'label' => $datacust['no_ba'], // text sugesti saat user mengetik di input box
		'value' => $datacust['no_ba'], 
		'wo' => $datacust['wo_id'],
		'so' => $datacust['so_id'],
		'tglba' => $datacust['tglba'],
		'pm' => $datacust['pm'],
		'desk' => $datacust['deskripsi'],
	);
}

header("Content-Type: text/json");
echo json_encode($json);
?>