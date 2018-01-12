<?php
	//include
	include "../../connection/connect.php";

	//ambil parameter
	$q = $_GET['q'];

	//ambil data

	$result = $conn->query("SELECT id_pasien, nama_pasien, no_rekam_medis, alamat FROM pasien WHERE nama_pasien LIKE '%$q%' or no_rekam_medis LIKE '%$q%'");
	//echo "SELECT nama_pasien FROM pasien WHERE nama_pasien LIKE '%$q%'";
	//balikin
	$s = "";
	
	while($data = $result->fetch_assoc()){
		$s = $s . "<div id=\"searchitem\" onclick=\"setPasien('$data[nama_pasien]', '$data[id_pasien]')\">$data[nama_pasien] | $data[no_rekam_medis] | $data[alamat]</div>";
	}

	echo $s;

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