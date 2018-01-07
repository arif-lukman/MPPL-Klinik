<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	$id_obat = $_GET['id_obat'];
	$jumlah = $_POST['jumlah'];
	
	$dataObat = $conn->query("SELECT * FROM obat WHERE id_obat = '$_GET[id_obat]'");
	while($obat = $dataObat->fetch_assoc()){
		if(($obat['stok']-$jumlah)<=0){
			echo "<script> alert('Data gagal diupdate stok tidak memenuhi atau kosong');
			location='../stok_obat.php';
			</script>";
		}else{
			$sql1 = "UPDATE obat SET  stok = stok-'$jumlah' WHERE id_obat = '$_GET[id_obat]'";
			if($conn->query($sql1) === TRUE){
				echo "<script> alert('Stok berhasil dikurangi');
				location='../obat.php';
				</script>";
			} else {
				echo "<script> alert('Stok gagal dikurangi');
				location='../obat.php';
				</script>";
				}
		}
	}

?>