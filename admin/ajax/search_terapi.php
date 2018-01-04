<?php
	//include
	include "../../connection/connect.php";

	//ambil parameter
	$q = $_GET['q'];

	//ambil data

	$result = $conn->query("SELECT * FROM kategori_terapi WHERE nama_kategori_terapi LIKE '%$q%'");
	//echo "SELECT nama_pasien FROM pasien WHERE nama_pasien LIKE '%$q%'";
	//balikin
	$s = "";
	
	while($kat = $result->fetch_assoc()){
		$s = $s . "
                    <tr>
                      <td>
                        $kat[nama_kategori_terapi]
                      </td>
                      </td>
                      <td align =\"right\">
                        <a href=\"edit_kat_terapi.php?id_kat=$kat[id_kategori_terapi]\" class=\"btn btn-primary btn-xs\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>
                      
                      	<a href=\"act/hapus_kat_terapi.php?id_kat=$kat[id_kategori_terapi]\" class=\"btn btn-danger btn-xs\" role=\"button\"><i class=\"fa fa-trash-o\"></i></a>
                      </td>
                    </tr>
                  ";
	}

	echo $s;

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