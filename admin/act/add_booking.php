<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//pasien
	$no_rekam_medis = $_POST['no_rekam_medis'];
	$tanggal = $_POST['tanggal'];
	$time = $_POST['time'];
	$no_telp = $_POST['no_telp'];
	$nama_pasien = $_POST['nama_pasien'];
	$no_reg_dokter = $_POST['no_reg_dokter'];
	$status_pasien = $_POST['status_pasien'];

	//SQL command
	//antrian
	$sql1 = "INSERT INTO booking(no_rekam_medis, tanggal, status, jam_daftar, jam_layan, no_reg_dokter, status_pasien) VALUES ('$no_rekam_medis', '$tanggal', '$status', '$jam_daftar', '$jam_layan', '$no_reg_dokter', '$status_pasien')";

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil diinputkan');
		location='../booking.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diinputkan');
		location='../add_booking.php';
		</script>";
	}

?>