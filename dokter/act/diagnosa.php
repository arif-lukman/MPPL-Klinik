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
 	$maxTerapi = max(sizeof($idk), sizeof($idt), sizeof($tarift), sizeof($kett));
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
 		$sqlDiag = $sqlDiag . "('$maxTransaksi', '$k1d[$i]', '$k2d[$i]', '$k3d[$i]', '$k4d[$i]')";
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
 		$sqlObat = $sqlObat . "('$maxTransaksi', '$ido[$i]', '$jumo[$i]', '$hrgo[$i]')";
 		if($i < $maxObat - 1){
 			$sqlObat = $sqlObat . ", ";
 		}
 	}

 	//echo "OBAT = " . $sqlObat . "<br>";

 	//CREATE TRANSAKSI
 	$sqlTransaksi = "";

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