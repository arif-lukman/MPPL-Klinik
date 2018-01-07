<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	$id_obat = $_GET['id_obat'];
	$jumlah  = $_POST['jumlah'];

	//SQL command
	//username
	$sql1 = "UPDATE obat SET  stok = stok+'$jumlah' WHERE id_obat = '$_GET[id_obat]'";

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Stok berhasil ditambah');
		location='../obat.php';
		</script>";
	} else {
		echo "<script> alert('Stok gagal ditambah');
		location='../obat.php';
		</script>";
	}

?>