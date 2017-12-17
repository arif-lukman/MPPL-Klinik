<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//akun dokter
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	//dokter
	//$sql1 = "INSERT INTO dokter(no_reg_dokter, nama_dokter, alamat, tanggal_lahir, jenis_kelamin, no_telp, email, status) VALUES ('$no_reg_dokter', '$nama_dokter', '$alamat', '$tanggal_lahir', '$jenis_kelamin', '$no_telp', '$email', '$status')";
	$sql1 = "UPDATE user_klinik SET username = '$username', password = '$password' WHERE id_user_klinik = '$_GET[id_akun]'";
	//echo $sql1;
	//Masukkan data
	
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil diupdate');
		location='../akun.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diupdate');
		location='../akun.php';
		</script>";
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