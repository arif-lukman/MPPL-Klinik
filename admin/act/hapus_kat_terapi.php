<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//SQL command
	//username
	$sql1 = "DELETE FROM kategori_terapi WHERE id_kategori_terapi = '$_GET[id_kat]'";

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil dihapus');
		location='../kategori_terapi.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal dihapus');
		location='../kategori_terapi.php';
		</script>";
	}

?>