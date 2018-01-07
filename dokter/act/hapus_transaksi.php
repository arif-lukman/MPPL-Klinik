<?php
	//Include file koneksi
  	include "../../connection/connect.php";

	$id_transaksi = $_GET['id_transaksi'];
	$id_pasien = $_GET['id_pasien'];

	$sql = "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi'";

	//$sql = $sqlObat . "; " . $sqlBiayaTransaksi;
	//echo $sql;
	
 	if($conn->query($sql) === TRUE){
 		//echo "berhasil";
		echo "<script> alert('Data berhasil dihapus');
		location='../rekam_medis.php?id_pasien=$id_pasien';
		</script>";
	} else {
		//echo "gagal";
		echo "<script> alert('Data gagal dihapus');
		location='../rekam_medis.php?id_pasien=$id_pasien';
		</script>";
		//echo $conn->error();
		//echo mysqli_errno($conn) . ": " . mysqli_error($conn). "\n";
	}

?>