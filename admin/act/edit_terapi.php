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
	$sql1 = "UPDATE terapi SET nama_terapi = '$nama_terapi', kategori = '$kat', tarif_min = '$tarif_min', tarif_max = '$tarif_max' WHERE id_terapi = $_GET[id_terapi]";

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil diupdate');
		location='../terapi.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diupdate');
		location='../terapi.php';
		</script>";
	}

?>