<?php
	//include
	include "../../connection/connect.php";

	//ambil data
	$result = $conn->query("SELECT harga FROM obat WHERE id_obat = $_GET[id_obat]");
	//echo "SELECT nama_pasien FROM pasien WHERE nama_pasien LIKE '%$q%'";
	//balikin
	$data = $result->fetch_assoc();

	//echo "Harga: Rp " . number_format($data['harga'], 0, ".", ",");
	echo $data['harga'];

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