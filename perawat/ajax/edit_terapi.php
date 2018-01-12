<?php
	//include
	include "../../connection/connect.php";

	$id_kat = $_GET["id_kat"];

	//ambil data
	$result = $conn->query("SELECT id_terapi, nama_terapi, kategori FROM terapi WHERE kategori='$id_kat'");
	//echo "SELECT nama_pasien FROM pasien WHERE nama_pasien LIKE '%$q%'";
	//balikin
	$s = "<option disabled selected hidden>-- Pilih Kategori Terapi --</option>";
	
	while($terapi = $result->fetch_assoc()){
		if($terapi['id_terapi'] == $_GET['id_terapi'])
			$s = $s . "<option value=\"$terapi[id_terapi]\" id=\"$terapi[kategori]\" selected>$terapi[nama_terapi]</option>";
		else 
			$s = $s . "<option value=\"$terapi[id_terapi]\" id=\"$terapi[kategori]\">$terapi[nama_terapi]</option>";
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