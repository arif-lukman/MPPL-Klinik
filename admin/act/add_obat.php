<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//dokter
	$nama_obat = $_POST['nama_obat'];
	$satuan = $_POST['satuan'];
	$jumlah = $_POST['jumlah'];
	$harga = $_POST['harga'];

	//SQL command
	//username
	$sql1 = "INSERT INTO obat(nama_obat, satuan, stok, harga) VALUES ('$nama_obat', '$satuan', '$jumlah', '$harga')";

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil diinputkan');
		location='../obat.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diinputkan');
		location='../add_obat.php';
		</script>";
	}

?>