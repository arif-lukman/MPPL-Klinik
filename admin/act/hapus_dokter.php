<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//SQL command
	//ambil max value id dari tabel dokter ama user_klinik
	$sql1 = "DELETE dokter, user_klinik FROM dokter INNER JOIN detail_akun_dokter ON detail_akun_dokter.id_dokter = dokter.id_dokter INNER JOIN user_klinik ON user_klinik.id_user_klinik = detail_akun_dokter.id_user_klinik WHERE dokter.id_dokter = detail_akun_dokter.id_dokter AND detail_akun_dokter.id_user_klinik = user_klinik.id_user_klinik AND dokter.id_dokter = '$_GET[id_dokter]'";
//	echo $sql1;

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil dihapus');
		location='../dokter.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal dihapus');
		location='../dokter.php';
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