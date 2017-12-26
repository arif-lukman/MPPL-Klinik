<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//pasien
	$nama_pasien = $_POST['nama_pasien'];
	$id_pasien = $_POST['id_pasien'];
	$id_dokter = $_POST['id_dokter'];
	$tanggal = $_POST['tanggal'];
	$jam_daftar = $_POST['jam_daftar'];
	$jam_layan = $_POST['jam_layan'];

	//SQL command
	//antrian
	$sql1 = "UPDATE antrian SET id_pasien = '$id_pasien', nama_pasien = '$nama_pasien', id_dokter = '$id_dokter', tanggal = '$tanggal', jam_daftar = '$jam_daftar', jam_layan = '$jam_layan'  WHERE id_antrian = '$_GET[id_antrian]'";
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