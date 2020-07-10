<?php		
	$keyword = strval($_POST['query1']);
	$search_param = "{$keyword}%";
	$conn =new mysqli('localhost', 'root', '' , 'db_pega');

	$sql = $conn->prepare("SELECT customer FROM tbl_project_wo WHERE customer LIKE ?");
	$sql->bind_param("s",$search_param);			
	$sql->execute();
	$result = $sql->get_result();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		$countryResult[] = $row["customer"];
		}
		echo json_encode($countryResult);
	}
	$conn->close();
?>

