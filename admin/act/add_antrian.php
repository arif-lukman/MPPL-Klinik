<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//pasien
	$nama_pasien = $_POST['nama_pasien'];
	$id_pasien = $_POST['id_pasien'];
	$id_dokter = $_POST['id_dokter'];
	$status = $_POST['status'];
	$tanggal = $_POST['tanggal'];
	$jam_daftar = $_POST['jam_daftar'];
	$jam_layan = $_POST['jam_layan'];

	//SQL command
	//antrian
	$sql1 = "INSERT INTO antrian(id_pasien, nama_pasien, id_dokter, tanggal, status, jam_daftar, jam_layan) VALUES ('$id_pasien', '$nama_pasien', '$id_dokter', '$tanggal', '$status', '$jam_daftar', '$jam_layan')";
	//echo $sql1;

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil diinputkan');
		location='../antrian_hari_ini.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diinputkan');
		location='../antrian_hari_ini.php';
		</script>";
	}

?>