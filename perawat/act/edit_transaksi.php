<?php
	//Include file koneksi
  	include "../../connection/connect.php";

	$id_pasien = $_GET['id_pasien'];
	$id_transaksi = $_GET['id_transaksi'];

	$tanggal = $_POST['tanggal'];
	$jam = $_POST['jam'];
	$id_dokter = $_POST['id_dokter'];
	$id_perawat = $_POST['id_perawat'];
	$metode_pembayaran = $_POST['metode_pembayaran'];
	$diskon = $_POST['diskon'];

	$hrgTerapi = 0;
	$hrgObat = 0;
	$diskonBaru = $diskon;

	$resTerapi = $conn->query("SELECT detail_diagnosa.biaya FROM detail_diagnosa, transaksi WHERE transaksi.id_transaksi = detail_diagnosa.id_transaksi AND transaksi.id_transaksi = '$id_transaksi'");
	while ($terapi = $resTerapi->fetch_assoc()) {
		$hrgTerapi += $terapi['biaya'];
		//echo $terapi['biaya'] . '<br>';
	}

	$resObat = $conn->query("SELECT detail_transaksi_obat.biaya FROM detail_transaksi_obat, transaksi WHERE transaksi.id_transaksi = detail_transaksi_obat.id_transaksi AND transaksi.id_transaksi = '$id_transaksi'");
	while ($obat = $resObat->fetch_assoc()) {
		$hrgObat += $obat['biaya'];
		//echo $obat['biaya'] . '<br>';
	}

	//$resDiskon = $conn->query("SELECT diskon FROM transaksi WHERE id_transaksi = '$id_transaksi'");
	//$dataDiskon = $resDiskon->fetch_assoc();
	//$diskon = $dataDiskon['diskon'] / 100;

	//echo $hrgTerapi . '<br>';
	//echo $hrgObat . '<br>';
	//echo $diskon;

	$totalBaru = ($hrgTerapi + $hrgObat) - $diskonBaru;

	//echo ($tarif + $hrgTerapi + $hrgObat);
	//echo $totalBaru;
	$sql = "UPDATE transaksi SET tanggal = '$tanggal', jam = '$jam', id_dokter = '$id_dokter', id_perawat = '$id_perawat', metode_pembayaran = '$metode_pembayaran', biaya_total = '$totalBaru', diskon = '$diskon' WHERE id_transaksi = '$id_transaksi'";

	//$sql = $sqlObat . "; " . $sqlBiayaTransaksi;
	//echo $sql;
	
 	if($conn->query($sql) === TRUE){
 		//echo "berhasil";
		echo "<script> alert('Data berhasil diupdate');
		location='../rekam_medis.php?id_pasien=$id_pasien';
		</script>";
	} else {
		//echo "gagal";
		echo "<script> alert('Data gagal diupdate');
		location='../rekam_medis.php?id_pasien=$id_pasien';
		</script>";
		//echo $conn->error();
		//echo mysqli_errno($conn) . ": " . mysqli_error($conn). "\n";
	}

?>