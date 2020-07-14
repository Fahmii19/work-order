<?php
	
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "k0762615_pegawai_1";

	$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

	if ($con ->connect_error) {
		die('Koneksi gagal: '.$con->connect_error);
	}
?>