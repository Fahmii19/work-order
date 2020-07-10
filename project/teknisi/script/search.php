<?php
//Sesuaikan config mysql nya
    $dns 		= "mysql:host=localhost;dbname=portofolio";
	$db_user 	= "root";
	$db_pass 	= "";
 
	try {
        $pdo = new PDO($dns, $db_user, $db_pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));      
    } catch (PDOException $e) {
        echo "Koneksi ke database gagal: ".$e->getMessage();
        die();
    }
 
$term = $_GET['term'];
 
$query = $pdo->prepare("select * from siswa where nama like '%".$term."%'");
$query->execute();
$json = array();
while($datacust = $query->fetch()) {
	$json[] = array(
		'label' => $datacust['nama'], // text sugesti saat user mengetik di input box
		'value' => $datacust['nama'], // nilai yang akan dimasukkan diinputbox saat user memilih salah satu sugesti
		'nis' => $datacust['nis'],
		'alamat' => $datacust['alamat'],
		'telp' => $datacust['telp'],
	);
}
header("Content-Type: text/json");
echo json_encode($json);
?>