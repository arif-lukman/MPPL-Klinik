<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//SQL command
	//ambil max value id dari tabel admin ama user_klinik
	$sql1 = "DELETE admin, user_klinik FROM admin INNER JOIN user_klinik ON user_klinik.id_user_klinik = admin.id_user_klinik WHERE  admin.id_user_klinik = user_klinik.id_user_klinik AND admin.id_admin = '$_GET[id_admin]'";
	//echo $sql1;

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil dihapus');
		location='../admin.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal dihapus');
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