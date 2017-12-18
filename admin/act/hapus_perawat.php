<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//SQL command
	//ambil max value id dari tabel dokter ama user_klinik
	$sql1 = "DELETE perawat, user_klinik FROM perawat INNER JOIN detail_akun_perawat ON detail_akun_perawat.id_perawat = perawat.id_perawat INNER JOIN user_klinik ON user_klinik.id_user_klinik = detail_akun_perawat.id_user_klinik WHERE perawat.id_perawat = detail_akun_perawat.id_perawat AND detail_akun_perawat.id_user_klinik = user_klinik.id_user_klinik AND perawat.id_perawat = '$_GET[id_perawat]'";
	//echo $sql1;

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil dihapus');
		location='../perawat.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal dihapus');
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