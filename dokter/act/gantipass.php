<?php
	//Include file koneksi
	include "../../connection/connect.php";
	include "../../process/session_check.php";
	
	//Ambil parameter
	$passlama = md5($_POST['pass']);
	$passbaru = md5($_POST['passbaru']);
	$verpass = md5($_POST['verpass']);
	
	//cek pass
	$sqlpass = "SELECT * FROM user_klinik WHERE username = '$_SESSION[uid]' and password='$passlama'";
	$rs = mysql_query($sqlpass);
	$data=mysql_num_rows($rs);
	
	if($data >=1){
		echo "<script> alert('Password anda salah');
		location='../gantipass.php';
		</script>";
		
		//session_destroy();
	}
	else if(empty($_POST['passbaru']) || empty($_POST['verpass'])){
		echo "<script> alert('PGanti Password Gagal!');
		location='../gantipass.php';
		</script>";
	}
	else if(($_POST['passbaru']) != ($_POST['verpass'])){
		echo "<script> alert('Ganti Password Gagal! Password dan Konfirmasi Password Berbeda');
		location='../gantipass.php';
		</script>";
	}
	else {
		$sql = "UPDATE user_klinik SET password='$passbaru' WHERE username='$_SESSION[uid]'";
		$rs = mysql_query($sql);
		
		if($conn->query($sql) === TRUE){
			echo "<script> alert('Data berhasil diinputkan');
			location='../gantipass.php';
			</script>";
		} else {
			echo "<script> alert('Data gagal diinputkan');
			location='../gantipass.php';
			</script>";
		}
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