<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//pasien
	$nama_pasien = $_POST['nama_pasien'];
	$id_pasien = $_POST['id_pasien'];
	$id_dokter = $_POST['id_dokter'];
	$tanggal = $_POST['tanggal'];
	$jam = $_POST['jam'];

	//SQL command
	//booking
	if($_POST['id_pasien'] != '' || $_POST['id_pasien'] != 0)
		$sql1 = "UPDATE booking SET id_pasien = '$id_pasien', nama_pasien = '$nama_pasien', id_dokter = '$id_dokter', tanggal = '$tanggal', jam = '$jam'  WHERE id_booking = '$_GET[id_booking]'";
	else 
		$sql1 = "UPDATE booking SET nama_pasien = '$nama_pasien', id_dokter = '$id_dokter', tanggal = '$tanggal', jam = '$jam'  WHERE id_booking = '$_GET[id_booking]'";
	//echo $sql1;

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil diupdate');
		location='../booking.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diupdate');
		location='../booking.php';
		</script>";
	}
?>