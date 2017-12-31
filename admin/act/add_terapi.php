<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//dokter
	$nama_terapi = $_POST['nama_terapi'];
	$kat = $_POST['kat'];
	$tarif_min = $_POST['tarif_min'];
	$tarif_max = $_POST['tarif_max'];

	//SQL command
	//username
	$sql1 = "INSERT INTO terapi(nama_terapi, kategori, tarif_min, tarif_max) VALUES ('$nama_terapi', '$kat', '$tarif_min', '$tarif_max')";

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil diinputkan');
		location='../terapi.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diinputkan');
		location='../terapi.php';
		</script>";
	}

?>