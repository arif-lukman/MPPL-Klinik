<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//dokter
	$nama_satuan = $_POST['nama_satuan'];

	//SQL command
	//username
	$sql1 = "UPDATE satuan SET nama_satuan = '$nama_satuan' WHERE id_satuan = '$_GET[id_satuan]'";

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil diupdate');
		location='../satuan_obat.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diupdate');
		location='../satuan_obat.php';
		</script>";
	}

?>