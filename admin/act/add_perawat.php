<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//dokter
	$nama_perawat = $_POST['nama_perawat'];
	$no_reg_perawat = $_POST['no_reg_perawat'];
	$alamat = $_POST['alamat'];
	$tanggal_lahir = $_POST['tanggal_lahir'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$no_telp = $_POST['no_telp'];
	$email = $_POST['email'];
	$status = $_POST['status'];

	//akun dokter
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	//SQL command
	$usr = GetData($conn, "SELECT AUTO_INCREMENT AS max FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'klinik' AND TABLE_NAME = 'user_klinik'");
	$maxUsr = $usr['max'];
	//echo $maxUsr;
	//perawat
	$sql1 = "INSERT INTO perawat(no_reg_perawat, nama_perawat, alamat, tanggal_lahir, jenis_kelamin, no_telp, email, status, id_user_klinik) VALUES ('$no_reg_perawat', '$nama_perawat', '$alamat', '$tanggal_lahir', '$jenis_kelamin', '$no_telp', '$email', '$status', '$maxUsr')";
	//username
	$sql2 = "INSERT INTO user_klinik(username, password, jenis_user) VALUES ('$username', '$password', 3)";
	//link

	//Masukkan data
	if($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE){
		echo "<script> alert('Data berhasil diinputkan');
		location='../perawat.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diinputkan');
		location='../perawat.php';
		</script>";
		//echo $conn->error();
		//echo mysqli_errno($conn) . ": " . mysqli_error($conn). "\n";
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