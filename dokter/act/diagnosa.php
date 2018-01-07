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
	$transaksi = GetData($conn, "SELECT AUTO_INCREMENT AS max FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'klinik' AND TABLE_NAME = 'transaksi'");
	$maxTransaksi = $transaksi['max'];
	//echo $maxTransaksi;

	$sqlDiag = "INSERT INTO detail_diagnosa(id_transaksi, k1, k2, k3, k4, diagnosa) VALUES ";
	$sqlTerapi = "INSERT INTO detail_transaksi_terapi(id_transaksi, id_terapi, biaya, keterangan) VALUES ";
	$sqlObat = "INSERT INTO detail_transaksi_obat(id_transaksi, id_obat, jumlah, biaya) VALUES ";

 	//CREATE DIAGNOSA
 	for ($i=0; $i < $maxDiag; $i++) { 
 		$sqlDiag = $sqlDiag . "('$maxTransaksi', '$k1d[$i]', '$k2d[$i]', '$k3d[$i]', '$k4d[$i]', '$ketd[$i]')";
 		if($i < $maxDiag - 1){
 			$sqlDiag = $sqlDiag . ", ";
 		}
 	}

 	//echo "DIAG = " . $sqlDiag . "<br>";

 	//CREATE TERAPI
 	for ($i=0; $i < $maxTerapi; $i++) { 
 		$sqlTerapi = $sqlTerapi . "('$maxTransaksi', '$idt[$i]', '$tarift[$i]', '$kett[$i]')";
 		if($i < $maxTerapi - 1){
 			$sqlTerapi = $sqlTerapi . ", ";
 		}
 	}

 	//echo "TERAPI = " . $sqlTerapi . "<br>";

 	//CREATE OBAT
 	for ($i=0; $i < $maxObat; $i++) {
 		if(isset($ido[$i]) && isset($jumo[$i]) && isset($hrgo[$i]))
 			$sqlObat = $sqlObat . "('$maxTransaksi', '$ido[$i]', '$jumo[$i]', '$hrgo[$i]')";
 		//echo $i;
 		//echo $ido[$i];
 		//echo $jumo[$i];
 		//echo $hrgo[$i];
 		if($i < $maxObat - 1){
 			$sqlObat = $sqlObat . ", ";
 		}
 	}

 	//echo "OBAT = " . $sqlObat . "<br>";

 	//AMBIL PARAM TRANSAKSI
 	$id_antrian = $_POST['id_antrian'];
 	$no_rekam_medis = $_POST['no_rekam_medis'];
 	$id_dokter = $_POST['id_dokter'];
 	$id_perawat = $_POST['id_perawat'];
 	$tanggal = date("Y-m-d");
 	$jam = date("H:i");
 	$metode_pembayaran = $_POST['metode_pembayaran'];
 	$biaya_total = $_POST["biaya_total"];
 	$diskon = $_POST["diskon"];

 	//CREATE TRANSAKSI
 	$sqlTransaksi = "INSERT INTO transaksi(no_rekam_medis, id_dokter, id_perawat, tanggal, jam, metode_pembayaran, biaya_total, diskon) VALUES 
 	('$no_rekam_medis', '$id_dokter', '$id_perawat', '$tanggal', '$jam', '$metode_pembayaran', '$biaya_total', '$diskon')";

 	//UPDATE ANTRIAN
 	$sqlAntrian = "UPDATE antrian SET status = 'Selesai', jam_selesai = '$jam' WHERE id_antrian = '$id_antrian'";

 	//UPDATE STOK
 	$sqlStok = "";

 	//echo "TRANSAKSI = " . $sqlTransaksi . "<br>";

 	if(isset($ido[0]) && isset($jumo[0]) && isset($hrgo[0]))
 		$sql = $sqlDiag . "; " . $sqlTerapi . "; " . $sqlObat . "; " . $sqlTransaksi . "; " . $sqlAntrian;
 	else
 		$sql = $sqlDiag . "; " . $sqlTerapi . "; " . $sqlTransaksi . "; " . $sqlAntrian;

 	//echo $sql;
 	if($conn->multi_query($sql) === TRUE){
 		echo "berhasil";
		//echo "<script> alert('Data berhasil diinputkan');
		//location='../antrian.php';
		//</script>";
	} else {
		echo "gagal";
		//echo "<script> alert('Data gagal diinputkan');
		//location='../antrian.php';
		//</script>";
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