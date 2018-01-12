<?php
	//Include file koneksi
  	include "../../connection/connect.php";
	$id_diagnosa = $_GET["id_diagnosa"];
	$id_pasien = $_GET["id_pasien"];
	$k1 = $_POST["k1"];
	$k2 = $_POST["k2"];
	$k3 = $_POST["k3"];
	$k4 = $_POST["k4"];
	$ketd = $_POST["ketd"];
	$idt = $_POST["idt"];
	$tarif = $_POST["tarif"];
	$kett = $_POST["kett"];

	$sql = "UPDATE detail_diagnosa SET k1 = '$k1', k2 = '$k2', k3 = '$k3', k4 = '$k4', diagnosa = '$ketd', id_terapi = '$idt', biaya = '$tarif', terapi = '$kett' WHERE id_detail_diagnosa = '$id_diagnosa'";

	if($conn->query($sql) === TRUE){
		echo "<script> alert('Data berhasil diupdate');
		location='../rekam_medis.php?id_pasien=$id_pasien';
		</script>";
	} else {
		echo "<script> alert('Data gagal diupdate');
		location='../rekam_medis.php?id_pasien=$id_pasien';
		</script>";
	}
?>