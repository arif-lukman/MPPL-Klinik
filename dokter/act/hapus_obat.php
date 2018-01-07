<?php
	//Include file koneksi
  	include "../../connection/connect.php";

	$id_pasien = $_GET['id_pasien'];
	$id_obat = $_GET['id_obat'];
	$id_transaksi = $_GET['id_transaksi'];

	$hrgTerapi = 0;
	$hrgObat = 0;
	$diskon = 0;

	$resTerapi = $conn->query("SELECT detail_transaksi_terapi.biaya FROM detail_transaksi_terapi, transaksi WHERE transaksi.id_transaksi = detail_transaksi_terapi.id_transaksi AND transaksi.id_transaksi = '$id_transaksi'");
	while ($terapi = $resTerapi->fetch_assoc()) {
		$hrgTerapi += $terapi['biaya'];
		//echo $terapi['biaya'] . '<br>';
	}

	$resObat = $conn->query("SELECT detail_transaksi_obat.biaya FROM detail_transaksi_obat, transaksi WHERE transaksi.id_transaksi = detail_transaksi_obat.id_transaksi AND detail_transaksi_obat.id_detail_transaksi_obat != '$id_obat' AND transaksi.id_transaksi = '$id_transaksi'");
	while ($obat = $resObat->fetch_assoc()) {
		$hrgObat += $obat['biaya'];
		//echo $obat['biaya'] . '<br>';
	}

	$resDiskon = $conn->query("SELECT diskon FROM transaksi WHERE id_transaksi = '$id_transaksi'");
	$dataDiskon = $resDiskon->fetch_assoc();
	$diskon = $dataDiskon['diskon'] / 100;

	//echo $hrgTerapi . '<br>';
	//echo $hrgObat . '<br>';
	//echo $diskon;

	$totalBaru = ($hrgTerapi + $hrgObat) - (($hrgTerapi + $hrgObat) * $diskon);

	//echo ($tarif + $hrgTerapi + $hrgObat);
	//echo $totalBaru;

	$sqlDel = "DELETE FROM detail_transaksi_obat WHERE id_transaksi = '$id_transaksi' AND id_detail_transaksi_obat = '$id_obat'";
	$sqlBiayaTransaksi = "UPDATE transaksi SET biaya_total = '$totalBaru' WHERE id_transaksi = '$id_transaksi'";

	$sql = $sqlDel . "; " . $sqlBiayaTransaksi;

	//echo $sql;
 	if($conn->multi_query($sql) === TRUE){
 		//echo "berhasil";
		echo "<script> alert('Data berhasil dihapus');
		location='../rekam_medis.php?id_pasien=$id_pasien';
		</script>";
	} else {
		//echo "gagal";
		echo "<script> alert('Data gagal dihapus');
		location='../rekam_medis.php?id_pasien=$id_pasien';
		</script>";
		//echo $conn->error();
		//echo mysqli_errno($conn) . ": " . mysqli_error($conn). "\n";
	}

?>