<?php
	//include
	include "../../connection/connect.php";

	//ambil data
	$result = $conn->query("SELECT id_obat, nama_obat FROM obat");
	//echo "SELECT nama_pasien FROM pasien WHERE nama_pasien LIKE '%$q%'";
	//balikin
	$s = "";
	
	while($obat = $result->fetch_assoc()){
		$s = $s . "<option value=\"$obat[id_obat]\">$obat[nama_obat]</option>";
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