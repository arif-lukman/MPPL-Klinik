<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//dokter
	$nama_jasa = $_POST['nama_jasa'];
	$tarif = $_POST['tarif'];

	//SQL command
	//username
	$sql1 = "UPDATE jasa SET nama_jasa = '$nama_jasa', tarif = '$tarif' WHERE id_jasa = $_GET[id_jasa]";

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil diupdate');
		location='../jasa.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diupdate');
		location='../jasa.php';
		</script>";
	}

?>