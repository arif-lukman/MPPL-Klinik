<?php
	//Include file koneksi
	include "../connection/connect.php";

	//Ambil parameter
	$uid = $_POST["uid"];
	$pw = md5($_POST["pw"]);

	//debug
	//echo $uid;
	//echo "  ";
	//echo $pw;

	//Cek data
	//Set parameter
	$data = GetData($conn, "SELECT username, password, jenis_user FROM user_klinik WHERE username = '$uid' AND password = '$pw'");
	$tgt = SelectTarget($data["jenis_user"]);

	if($data){
		if(!isset($_SESSION)){
			session_start();
			$_SESSION["uid"] = $uid;
			$_SESSION["tgt"] = $data["jenis_user"];
		}
		header ("location:" . $tgt);
	} else {
		echo "<script> alert('Username atau Password Salah');
		location='../login.php';
		</script>";
		//echo "SELECT username, password, jenis_user FROM user_klinik WHERE username = '$uid' AND password = '$pw'";
	}

	//Fungsi
	function GetData($conn, $sql){
		$result = $conn -> query($sql);
		echo $result -> num_rows;
		if($result -> num_rows > 0){
			return $result -> fetch_assoc();
		} else {
			return false;
		}
	}

	function SelectTarget($usrType){
		switch ($usrType) {
			case 1:
				//Admin
				return "../admin/dashboard.php";
				break;
			case 2:
				//Dokter
				return "../dokter/dashboard.php";
				break;
			case 3:
				//Perawat
				return "../perawat/dashboard.php";
				break;
		}
	}
?>