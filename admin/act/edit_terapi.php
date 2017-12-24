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
	$sql1 = "UPDATE terapi SET nama_terapi = '$nama_terapi', kategori = '$kat', tarif = '$tarif' WHERE id_terapi = $_GET[id_terapi]";

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