<?php
	//include
	include "../../connection/connect.php";

	//ambil data

	$rm = GetData($conn,"SELECT MAX(no_rekam_medis) as max FROM pasien");

	echo "<h5><b>Nomor Rekam Medis Terakhir: " . $rm['max'] . "</b></h5>";

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