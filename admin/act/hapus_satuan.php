<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//SQL command
	//username
	$sql1 = "DELETE FROM satuan WHERE id_satuan = '$_GET[id_satuan]'";

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil dihapus');
		location='../satuan_obat.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal dihapus');
		location='../satuan_obat.php';
		</script>";
	}

?>