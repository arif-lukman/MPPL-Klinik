<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//pasien
	$no_rekam_medis = $_POST['no_rekam_medis'];
	$tanggal = $_POST['tanggal'];
	$status = $_POST['status'];
	$jam_daftar = $_POST['jam_daftar'];
	$jam_layan = $_POST['jam_layan'];
	$no_reg_dokter = $_POST['no_reg_dokter'];
	$status_pasien = $_POST['status_pasien'];

	//SQL command
	//antrian
	//$sql1 = "INSERT INTO antrian(no_rekam_medis, tanggal, status, jam_daftar, jam_layan, no_reg_dokter, status_pasien) VALUES ('$no_rekam_medis', '$tanggal', '$status', '$jam_daftar', '$jam_layan', '$no_reg_dokter', '$status_pasien')";
	$sql1 = "UPDATE antrian SET no_rekam_medis = '$no_rekam_medis', tanggal = '$tanggal', status = '$status', jam_daftar = '$jam_daftar', jam_layan = '$jam_layan', no_reg_dokter = '$no_reg_dokter', status_pasien = '$status'  WHERE id_antrian = '$_GET[id_antrian]'";
	//echo $sql1;

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil diupdate');
		location='../antrian_hari_ini.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diupdate');
		location='../antrian_hari_ini.php';
		</script>";
	}

?>