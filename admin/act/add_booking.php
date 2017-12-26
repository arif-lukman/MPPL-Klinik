<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//pasien
	$id_pasien = $_POST['id_pasien'];
	$nama_pasien = $_POST['nama_pasien'];
	$id_dokter = $_POST['id_dokter'];
	$tanggal = $_POST['tanggal'];
	$jam = $_POST['jam'];
	$no_telp = $_POST['no_telp'];
	$status_pasien = $_POST['status_pasien'];

	//SQL command
	//antrian
	$sql1 = "INSERT INTO booking(id_pasien, nama_pasien, id_dokter, tanggal, jam, no_telp, status_pasien) VALUES ('$id_pasien', '$nama_pasien', '$id_dokter', '$tanggal', '$jam', '$no_telp', '$status_pasien')";
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