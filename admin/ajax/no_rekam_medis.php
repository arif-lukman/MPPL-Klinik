<?php
	//include
	include "../../connection/connect.php";

	//ambil parameter
	$no = $_GET['no'];

	//ambil data
	$data = GetData($conn,"SELECT no_rekam_medis FROM pasien WHERE no_rekam_medis='$no'");
	//echo "SELECT nama_pasien FROM pasien WHERE nama_pasien LIKE '%$q%'";
	//balikin
	if($data){
		echo "
		<div class=\"col-sm-12 alert alert-danger\">
			Nomor rekam medis telah terdaftar.
			<span class=\"glyphicon glyphicon-remove\"></span>
		</div>
		";
	} else {
		echo "
		<div class=\"col-sm-12 alert alert-success\">
			Nomor rekam medis dapat digunakan.
			<span class=\"glyphicon glyphicon-ok\"></span>
		</div>
		";
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