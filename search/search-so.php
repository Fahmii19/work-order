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
 
$query = $pdo->prepare("SELECT * FROM tbl_income WHERE ket = 'first' so_id AND like '%".$term."%'");
$query->execute();
$json = array();
while($datacust = $query->fetch()) {
	$json[] = array(
		'label' => $datacust['so_id'], // text sugesti saat user mengetik di input box
		'value' => $datacust['so_id'], 
		'woid' => $datacust['wo_id'],
	);
}

header("Content-Type: text/json");
echo json_encode($json);
?>