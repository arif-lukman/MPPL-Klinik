<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//dokter
	$nama_admin = $_POST['nama_admin'];
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
	//ambil max value id dari tabel dokter ama user_klinik
	$adm = GetData($conn, "SELECT MAX(id_admin) AS max FROM admin");

	$usr = GetData($conn, "SELECT MAX(id_user_klinik) AS max FROM user_klinik");

	$maxAdm = $adm['max'] + 1;
	$maxUsr = $usr['max'] + 1;
	//dokter
	$sql1 = "INSERT INTO admin(nama_admin, alamat, tanggal_lahir, jenis_kelamin, no_telp, email, status) VALUES ('$nama_admin', '$alamat', '$tanggal_lahir', '$jenis_kelamin', '$no_telp', '$email', '$status')";
	//username
	$sql2 = "INSERT INTO user_klinik(username, password, jenis_user) VALUES ('$username', '$password', 1)";
	//link
	$sql3 = "INSERT INTO detail_akun_admin VALUES ('$maxAdm', '$maxUsr')";

	//Masukkan data
	if($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE){
		echo "<script> alert('Data berhasil diinputkan');
		location='../admin.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diinputkan');
		location='../admin.php';
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