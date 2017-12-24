<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//dokter
	$nama_kat = $_POST['nama_kat'];

	//SQL command
	//username
	$sql1 = "INSERT INTO kategori_terapi(nama_kategori_terapi) VALUES ('$nama_kat')";

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil diinputkan');
		location='../kategori_terapi.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diinputkan');
		location='../kategori_terapi.php';
		</script>";
	}

?>