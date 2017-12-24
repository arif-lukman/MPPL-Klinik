<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//dokter
	$nama_satuan = $_POST['nama_satuan'];

	//SQL command
	//username
	$sql1 = "INSERT INTO satuan(nama_satuan) VALUES ('$nama_satuan')";

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil diinputkan');
		location='../satuan_obat.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diinputkan');
		location='../satuan_obat.php';
		</script>";
	}

?>