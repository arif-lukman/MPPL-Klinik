<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//dokter
	$nama_terapi = $_POST['nama_terapi'];
	$kat = $_POST['kat'];
	$tarif = $_POST['tarif'];

	//SQL command
	//username
	$sql1 = "INSERT INTO terapi(nama_terapi, kategori, tarif) VALUES ('$nama_terapi', '$kat', '$tarif')";

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