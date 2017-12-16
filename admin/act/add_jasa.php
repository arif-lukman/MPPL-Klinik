<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//dokter
	$nama_jasa = $_POST['nama_jasa'];
	$tarif = $_POST['tarif'];

	//SQL command
	//username
	$sql1 = "INSERT INTO jasa(nama_jasa, tarif) VALUES ('$nama_jasa', '$tarif')";

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil diinputkan');
		location='../jasa.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diinputkan');
		location='../add_jasa.php';
		</script>";
	}

?>