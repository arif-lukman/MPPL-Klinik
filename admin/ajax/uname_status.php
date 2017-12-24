<?php
	//include
	include "../../connection/connect.php";

	//ambil parameter
	$uname = $_GET['uname'];

	//ambil data
	$data = GetData($conn, "SELECT username FROM user_klinik WHERE username = '$uname'");

	if($data){
		echo "
		<div class=\"col-sm-12 alert alert-danger\">
			Username telah terdaftar.
			<span class=\"glyphicon glyphicon-remove\"></span>
		</div>
		";
	} else {
		echo "
		<div class=\"col-sm-12 alert alert-success\">
			Username dapat digunakan.
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