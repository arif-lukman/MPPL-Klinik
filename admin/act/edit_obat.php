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
	$sql1 = "UPDATE obat SET nama_obat = '$nama_obat', id_satuan = '$satuan', stok = '$jumlah', harga = '$harga' WHERE id_obat = '$_GET[id_obat]'";

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil diupdate');
		location='../obat.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diupdate');
		location='../obat.php';
		</script>";
	}

?>