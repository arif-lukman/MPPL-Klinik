<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//pasien
	$nama_pasien = $_POST['nama_pasien'];
	$tanggal = $_POST['tanggal'];
	$jam = $_POST['jam'];
	$no_telp = $_POST['no_telp'];
	$no_reg_dokter = $_POST['no_reg_dokter'];
	$status_pasien = $_POST['status_pasien'];

	//SQL command
	//antrian
	$sql1 = "INSERT INTO booking(nama_pasien, tanggal, jam, no_telp, no_reg_dokter, status_pasien) VALUES ('$nama_pasien', '$tanggal', '$jam', '$no_telp', '$no_reg_dokter', '$status_pasien')";
	//echo $sql1;

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil diinputkan');
		location='../booking.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diinputkan');
		location='../booking.php';
		</script>";
	}

?>