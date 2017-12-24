<?php
	//Include file koneksi
	include "../../connection/connect.php";

	//SQL command
	//ambil max value id dari tabel dokter ama user_klinik
	$sql1 = "DELETE FROM terapi WHERE terapi.id_terapi = '$_GET[id_terapi]'";
	//echo $sql1;

	//Masukkan data
	if($conn->query($sql1) === TRUE){
		echo "<script> alert('Data berhasil dihapus');
		location='../terapi.php';
		</script>";
	} else {
		echo "<script> alert('Data gagal dihapus');
		location='../terapi.php';
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