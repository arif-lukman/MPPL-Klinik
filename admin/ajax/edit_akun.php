<?php
	//include
	include "../../connection/connect.php";

	//ambil parameter
	$id = $_GET['id'];
	$uname = $_GET['uname'];

	//ambil data
	$data = GetData($conn, "SELECT id_user_klinik, username FROM user_klinik WHERE username = '$uname'");

	if($data && $data['id_user_klinik'] != $id){
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