<?php
	//include
	include "../../connection/connect.php";

	$id_terapi = $_GET["id_terapi"];

	//ambil data
	$result = $conn->query("SELECT tarif_min FROM terapi WHERE id_terapi='$id_terapi'");
	//echo "SELECT nama_pasien FROM pasien WHERE nama_pasien LIKE '%$q%'";
	//balikin
	$data = $result->fetch_assoc();

	echo $data['tarif_min'];

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