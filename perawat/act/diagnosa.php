<?php
	//Include file koneksi
  	include "../../connection/connect.php";

	//ARRAY BUAT NYIMPEN POST
	$k1d = array();
	$k2d = array();
	$k3d = array();
	$k4d = array();
	$ketd = array();
	$idt = array();
	$tarift = array();
	$kett = array();
	$ido = array();
	$jumo = array();
	$hrgo = array();

	foreach ($_POST as $key => $value){
 		//echo "Field with name or id ".htmlspecialchars($key)." has a value equals ".htmlspecialchars($value)."<br>";

 		$varName = substr($key, 0, strlen($key)-1);
 		switch ($varName) {
 			//KUADRAN 1
 			case 'k1d':
 				//echo 'Ini k1d';
 				array_push($k1d, $value);
 				//echo sizeof($k1d);
 				break;

 			//KUADRAN 2
 			case 'k2d':
 				//echo 'Ini k2d';
 				array_push($k2d, $value);
 				//echo sizeof($k2d);
 				break;

 			//KUADRAN 3
 			case 'k3d':
 				//echo 'Ini k3d';
 				array_push($k3d, $value);
 				//echo sizeof($k3d);
 				break;

 			//KUADRAN 4
 			case 'k4d':
 				//echo 'Ini k4d';
 				array_push($k4d, $value);
 				//echo sizeof($k4d);
 				break;

 			//KETERANGAN DIAGNOSA
 			case 'ketd':
 				//echo 'Ini ketd';
 				array_push($ketd, $value);
 				//echo sizeof($ketd);
 				break;

 			//ID TERAPI
 			case 'idt':
 				//echo 'Ini idt';
 				array_push($idt, $value);
 				//echo sizeof($idt);
 				break;
 			
 			//TARIF TERAPI
 			case 'tarift':
 				//echo 'Ini tarift';
 				array_push($tarift, $value);
 				//echo sizeof($tarift);
 				break;

 			//KETERANGAN TERAPI
 			case 'kett':
 				//echo 'Ini kett';
 				array_push($kett, $value);
 				//echo sizeof($kett);
 				break;

 			//ID OBAT
 			case 'ido':
 				//echo 'Ini ido';
 				array_push($ido, $value);
 				//echo sizeof($ido);
 				break;

 			//JUMLAH OBAT
 			case 'jumo':
 				//echo 'Ini jumo';
 				array_push($jumo, $value);
 				//echo sizeof($jumo);
 				break;

 			//HARGA OBAT
 			case 'hrgo':
 				array_push($hrgo, $value);
 				break;
 		}
 		//echo substr($key, 0, strlen($key)-1) ."<br>";
 	}

 	//NILAI MAKSIMUM DARI MASING2 KOLOM
 	$maxDiag = max(sizeof($k1d), sizeof($k2d), sizeof($k3d), sizeof($k4d), sizeof($ketd));
 	$maxTerapi = max(sizeof($idt), sizeof($tarift), sizeof($kett));
 	$maxObat = max(sizeof($ido), sizeof($jumo));

 	//echo $maxDiag;
 	//echo $maxTerapi;
 	//echo $maxObat;

 	//GET MAX TRANSAKSI
	//$transaksi = GetData($conn, "SELECT AUTO_INCREMENT AS max FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'klinik' AND TABLE_NAME = 'transaksi'");

 	$id_antrian = $_POST['id_antrian'];
 	$id_pasien = $_POST['id_pasien'];
 	$id_dokter = $_POST['id_dokter'];
 	$id_perawat = $_POST['id_perawat'];
 	$tanggal = date("Y-m-d");
 	$jam = date("H:i");
 	$metode_pembayaran = $_POST['metode_pembayaran'];
 	$biaya_total = $_POST["biaya_total_diskon"];
 	$diskon = $_POST["diskon"];

 	$sqlTransaksi = "INSERT INTO transaksi(id_pasien, id_dokter, id_perawat, tanggal, jam, metode_pembayaran, biaya_total, diskon) VALUES 
 	('$id_pasien', '$id_dokter', '$id_perawat', '$tanggal', '$jam', '$metode_pembayaran', '$biaya_total', '$diskon')";
 	$conn->query($sqlTransaksi);
 	/*
 	if($conn->query($sqlTransaksi) === TRUE){
 		//echo "berhasil";
		echo "<script> alert('Data transaksi berhasil diinputkan');
		</script>";
	} else {
		//echo "gagal";
		echo "<script> alert('Data transaksi gagal diinputkan');
		</script>";
		//echo $conn->error();
		//echo mysqli_errno($conn) . ": " . mysqli_error($conn). "\n";
	}*/

	$transaksi = GetData($conn, "SELECT MAX(id_transaksi) as max FROM transaksi");
	$maxTransaksi = $transaksi['max'];
	//echo $maxTransaksi;

	$sqlDiag = "INSERT INTO detail_diagnosa(id_transaksi, k1, k2, k3, k4, diagnosa, id_terapi, biaya, terapi) VALUES ";
	//$sqlTerapi = "INSERT INTO detail_transaksi_terapi(id_transaksi, id_terapi, biaya, keterangan) VALUES ";
	$sqlObat = "INSERT INTO detail_transaksi_obat(id_transaksi, id_obat, jumlah, biaya) VALUES ";
	$sqlStok = "";

 	//CREATE DIAGNOSA
 	for ($i=0; $i < $maxDiag; $i++) { 
 		$sqlDiag = $sqlDiag . "('$maxTransaksi', '$k1d[$i]', '$k2d[$i]', '$k3d[$i]', '$k4d[$i]', '$ketd[$i]', '$idt[$i]', '$tarift[$i]', '$kett[$i]')";
 		if($i < $maxDiag - 1){
 			$sqlDiag = $sqlDiag . ", ";
 		}
 	}

 	//echo "DIAG = " . $sqlDiag . "<br>";

 	//CREATE OBAT
 	for ($i=0; $i < $maxObat; $i++) {
 		if(isset($ido[$i]) && isset($jumo[$i]) && isset($hrgo[$i]))
 			$sqlObat = $sqlObat . "('$maxTransaksi', '$ido[$i]', '$jumo[$i]', '$hrgo[$i]')";

			$resStok = $conn->query("SELECT stok FROM obat WHERE id_obat='$ido[$i]'");
		 	$dataStok = $resStok->fetch_assoc();
		 	$deltaStok = $dataStok['stok'] - $jumo[$i];
		 	if($deltaStok >= 0)
 				$conn->query("UPDATE obat SET stok='$deltaStok' WHERE id_obat='$ido[$i]'");
 			$resStok->data_seek(0);
 		//echo $i;
 		//echo $ido[$i];
 		//echo $jumo[$i];
 		//echo $hrgo[$i];
 		if($i < $maxObat - 1){
 			$sqlObat = $sqlObat . ", ";
 		}
 	}

 	//echo "OBAT = " . $sqlObat . "<br>";

 	//UPDATE ANTRIAN
 	$sqlAntrian = "UPDATE antrian SET status = 'Menunggu', jam_selesai = '$jam' WHERE id_antrian = '$id_antrian'";

 	//echo "TRANSAKSI = " . $sqlTransaksi . "<br>";

 	if(isset($ido[0]) && isset($jumo[0]) && isset($hrgo[0]))
 		$sql = $sqlDiag . "; " . $sqlObat . "; " . $sqlAntrian;
 	else
 		$sql = $sqlDiag . "; " . $sqlAntrian;

 	//echo $sql;
 	if($conn->multi_query($sql) === TRUE){
 		//echo "berhasil";
		echo "<script> alert('Data berhasil diinputkan');
		location='../antrian.php';
		</script>";
	} else {
		//echo "gagal";
		echo "<script> alert('Data gagal diinputkan');
		location='../antrian.php';
		</script>";
		//echo $conn->error();
		echo mysqli_errno($conn) . ": " . mysqli_error($conn). "\n";
	}

 	//Fungsi
	function GetData($conn, $sql){
    $result = $conn -> query($sql);
    //echo $result -> num_rows;
    if($result -> num_rows > 0){
	      	return $result -> fetch_assoc();
	    } else {
	      	return false;
	    }
	}
?>