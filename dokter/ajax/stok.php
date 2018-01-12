<?php
	//include
	include "../../connection/connect.php";

	$id_obat = $_GET['id_obat'];
	$jml = $_GET['jml'];

	$result = $conn->query("SELECT stok FROM obat WHERE id_obat = '$id_obat'");
	$data = $result->fetch_assoc();

	$stok = $data['stok'];

	if($stok < $jml){
		echo "
		<div class=\"col-sm-12 alert alert-danger\">
			Stok obat tidak mencukupi.
			<span class=\"glyphicon glyphicon-remove\"></span>
		</div>
		";
	}
?>