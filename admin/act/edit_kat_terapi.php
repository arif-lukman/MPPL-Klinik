<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//dokter
	$nama_kat = $_POST['nama_kat'];

	//SQL command
	//username
	$sql1 = "UPDATE kategori_terapi SET nama_kategori_terapi = '$nama_kat' WHERE id_kategori_terapi = '$_GET[id_kat]'";

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil diupdate');
		location='../kategori_terapi.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diupdate');
		location='../kategori_terapi.php';
		</script>";
	}

?>