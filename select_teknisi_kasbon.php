<?php
	$q = mysqli_query($con, "SELECT teknisi1 as nama FROM tbl_teknisi_wo JOIN tbl_project_wo ON tbl_project_wo.kode_teknisi = tbl_teknisi_wo.kode_teknisi WHERE tbl_project_wo.wo_id = '$wo_id'
		UNION
		SELECT teknisi2 FROM tbl_teknisi_wo JOIN tbl_project_wo ON tbl_project_wo.kode_teknisi = tbl_teknisi_wo.kode_teknisi WHERE tbl_project_wo.wo_id = '$wo_id'
		UNION
		SELECT teknisi3 FROM tbl_teknisi_wo JOIN tbl_project_wo ON tbl_project_wo.kode_teknisi = tbl_teknisi_wo.kode_teknisi WHERE tbl_project_wo.wo_id = '$wo_id'
		UNION
		SELECT teknisi4 FROM tbl_teknisi_wo JOIN tbl_project_wo ON tbl_project_wo.kode_teknisi = tbl_teknisi_wo.kode_teknisi WHERE tbl_project_wo.wo_id = '$wo_id'
		UNION
		SELECT pkl1 FROM tbl_teknisi_wo JOIN tbl_project_wo ON tbl_project_wo.kode_teknisi = tbl_teknisi_wo.kode_teknisi WHERE tbl_project_wo.wo_id = '$wo_id'
		UNION
		SELECT pkl2 FROM tbl_teknisi_wo JOIN tbl_project_wo ON tbl_project_wo.kode_teknisi = tbl_teknisi_wo.kode_teknisi WHERE tbl_project_wo.wo_id = '$wo_id'
		UNION
		SELECT pkl3 FROM tbl_teknisi_wo JOIN tbl_project_wo ON tbl_project_wo.kode_teknisi = tbl_teknisi_wo.kode_teknisi WHERE tbl_project_wo.wo_id = '$wo_id';"); 

    while ($a = mysqli_fetch_array($q)){
            echo "<option value='$a[nama]'>$a[nama]</option>";
        }
?>