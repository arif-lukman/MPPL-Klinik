<?php
	//Include file koneksi
  	include "../../connection/connect.php";
	$id_diagnosa = $_GET["id_diagnosa"];
	$id_pasien = $_GET["id_pasien"];

	$sql = "DELETE FROM detail_diagnosa WHERE id_detail_diagnosa = '$id_diagnosa'";

	if($conn->query($sql) === TRUE){
		echo "<script> alert('Data berhasil dihapus');
		location='../rekam_medis.php?id_pasien=$id_pasien';
		</script>";
	} else {
		echo "<script> alert('Data gagal dihapus');
		location='../rekam_medis.php?id_pasien=$id_pasien';
		</script>";
	}
?>