<?php
	//Include file koneksi
  	include "../../connection/connect.php";
	$id_diagnosa = $_GET["id_diagnosa"];
	$id_pasien = $_GET["id_pasien"];
	$id_transaksi = $_GET["id_transaksi"];
	$k1 = $_POST["k1"];
	$k2 = $_POST["k2"];
	$k3 = $_POST["k3"];
	$k4 = $_POST["k4"];
	$ketd = $_POST["ketd"];
	$idt = $_POST["idt"];
	$tarif = $_POST["tarif"];
	$kett = $_POST["kett"];

	$hrgTerapi = 0;
	$hrgObat = 0;
	$diskon = 0;

	$resTerapi = $conn->query("SELECT detail_diagnosa.biaya FROM detail_diagnosa, transaksi WHERE transaksi.id_transaksi = detail_diagnosa.id_transaksi AND detail_diagnosa.id_detail_diagnosa != '$id_diagnosa' AND transaksi.id_transaksi = '$id_transaksi'");
	while ($terapi = $resTerapi->fetch_assoc()) {
		$hrgTerapi += $terapi['biaya'];
		//echo $terapi['biaya'] . '<br>';
	}

	$resObat = $conn->query("SELECT detail_transaksi_obat.biaya FROM detail_transaksi_obat, transaksi WHERE transaksi.id_transaksi = detail_transaksi_obat.id_transaksi AND transaksi.id_transaksi = '$id_transaksi'");
	while ($obat = $resObat->fetch_assoc()) {
		$hrgObat += $obat['biaya'];
		//echo $obat['biaya'] . '<br>';
	}

	$resDiskon = $conn->query("SELECT diskon FROM transaksi WHERE id_transaksi = '$id_transaksi'");
	$dataDiskon = $resDiskon->fetch_assoc();
	$diskon = $dataDiskon['diskon'];

	$totalBaru = ($tarif + $hrgTerapi + $hrgObat) - $diskon;

	$sqlTerapi = "UPDATE detail_diagnosa SET k1 = '$k1', k2 = '$k2', k3 = '$k3', k4 = '$k4', diagnosa = '$ketd', id_terapi = '$idt', biaya = '$tarif', terapi = '$kett' WHERE id_detail_diagnosa = '$id_diagnosa'";
	$sqlBiayaTransaksi = "UPDATE transaksi SET biaya_total = '$totalBaru' WHERE id_transaksi = '$id_transaksi'";

	$sql = $sqlTerapi . "; " . $sqlBiayaTransaksi;

	if($conn->multi_query($sql) === TRUE){
		echo "<script> alert('Data berhasil diupdate');
		location='../rekam_medis.php?id_pasien=$id_pasien';
		</script>";
	} else {
		echo "<script> alert('Data gagal diupdate');
		location='../rekam_medis.php?id_pasien=$id_pasien';
		</script>";
	}
?>