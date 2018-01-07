<?php
	//include
	include "../../connection/connect.php";

	//ambil data
	$result = $conn->query("SELECT id_kategori_terapi, nama_kategori_terapi FROM kategori_terapi");
	//echo "SELECT nama_pasien FROM pasien WHERE nama_pasien LIKE '%$q%'";
	//balikin
	$s = "";
	
	while($kat = $result->fetch_assoc()){
		$s = $s . "<option value=\"$kat[id_kategori_terapi]\">$kat[nama_kategori_terapi]</option>";
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