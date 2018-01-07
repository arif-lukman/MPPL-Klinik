<?php
	//include
	include "../../connection/connect.php";

	$id_terapi = $_GET["id_terapi"];

	//ambil data
	$result = $conn->query("SELECT tarif_min, tarif_max FROM terapi WHERE id_terapi='$id_terapi'");
	//echo "SELECT nama_pasien FROM pasien WHERE nama_pasien LIKE '%$q%'";
	//balikin
	$data = $result->fetch_assoc();

	echo "Min. Rp " . number_format($data['tarif_min'], 0, ".", ",") . " ~ Rp " . number_format($data['tarif_max'], 0, ".", ",") . " Max.";

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