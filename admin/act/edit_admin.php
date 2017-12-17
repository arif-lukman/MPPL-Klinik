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

	//SQL command
	$sql1 = "UPDATE admin SET nama_admin = '$nama_admin', alamat = '$alamat', tanggal_lahir = '$tanggal_lahir', jenis_kelamin = '$jenis_kelamin', no_telp = '$no_telp', email = '$email', status = '$status' WHERE id_admin = '$_GET[id_admin]'";
	//echo $sql1;

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil diupdate');
		location='../admin.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diupdate');
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