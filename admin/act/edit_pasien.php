<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//Ambil parameter
	//pasien
	$nama_pasien = $_POST['nama_pasien'];
	$alamat = $_POST['alamat'];
	$tanggal_lahir = $_POST['tanggal_lahir'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$no_telp = $_POST['no_telp'];
	$pekerjaan = $_POST['pekerjaan'];
	$no_rekam_medis = $_POST['no_rekam_medis'];

	//SQL command
	$sql1 = "UPDATE pasien SET nama_pasien = '$nama_pasien', alamat = '$alamat', tanggal_lahir = '$tanggal_lahir', jenis_kelamin = '$jenis_kelamin', no_telp = '$no_telp', pekerjaan = '$pekerjaan', no_rekam_medis = '$no_rekam_medis' WHERE id_pasien = '$_GET[id_pasien]'";
	//echo $sql1;

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil diupdate');
		location='../pasien.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal diupdate');
		location='../pasien.php';
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