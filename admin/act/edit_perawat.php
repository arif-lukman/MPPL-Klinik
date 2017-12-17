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

	//dokter
	$sql1 = "UPDATE perawat SET no_reg_perawat = '$no_reg_perawat', nama_perawat = '$nama_perawat', alamat = '$alamat', tanggal_lahir = '$tanggal_lahir', jenis_kelamin = '$jenis_kelamin', no_telp = '$no_telp', email = '$email', status = '$status' WHERE id_perawat = '$_GET[id_perawat]'";

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil diupdate');
		location='../perawat.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diupdate');
		location='../perawat.php';
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