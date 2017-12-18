<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//pasien
	$nama_pasien = $_POST['nama_pasien'];
	$alamat = $_POST['alamat'];
	$tanggal_lahir = $_POST['tanggal_lahir'];
	$pekerjaan = $_POST['pekerjaan'];
	$no_telp = $_POST['no_telp'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$no_rekam_medis = $_POST['no_rekam_medis'];

	echo $pekerjaan;

	//SQL command
	//dokter
	$sql1 = "INSERT INTO pasien(nama_pasien, alamat, tanggal_lahir, pekerjaan, no_telp, jenis_kelamin, no_rekam_medis) VALUES ('$nama_pasien', '$alamat', '$tanggal_lahir', '$pekerjaan', '$no_telp', '$jenis_kelamin', '$no_rekam_medis')";

	//Masukkan data
	if($conn->query($sql1)){
		echo "<script> alert('Data berhasil diinputkan');
		location='../pasien.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diinputkan');
		location='../add_pasien.php';
		</script>";
	}

?>